<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogador\Mensalidade;
use App\User;
use laravel\pagseguro\Platform\Laravel5\PagSeguro;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->request->all();
        $mensalidade = Mensalidade::uuid($data['mensalidade']);
        return view('admin.venda.index', compact('mensalidade'));
    }

    public function show($id)
    {
        $mensalidade = Mensalidade::uuid($id);
        return view('checkout.index', compact('mensalidade'));
    }

    public function sale(Request $request)
    {
        $data = $request->request->all();

        $mensalidade = Mensalidade::uuid($data['mensalidade']);
        $pessoa = $mensalidade->jogador->pessoa;

        if($request->has('telefone')) {
           $pessoa->telefone = $data['telefone'];
        }

        if($request->has('cpf')) {
           $pessoa->cpf = $data['cpf'];
        }

        if($request->has('nascimento')) {
           $pessoa->nascimento = \DateTime::createFromFormat('d/m/Y', $data['nascimento']);
        }

        if($request->has('cpf') && $request->has('nascimento')) {
          $pessoa->save();
        }

        $errors = [];

        if(!$pessoa->nascimento) {
          array_push($errors, 'Informe a sua data de nascimento nas suas configurações.');
        } elseif (!$pessoa->cpf) {
          array_push($errors, 'Informe o numero do seu CPF nas suas configurações.');
        }

        if($errors) {
          return redirect()->back()->withErrors($errors);
        }

        $dataSet = [
          'email' => $pessoa->email,
          'name' => $pessoa->nome,
          'cpf' => $pessoa->cpf,
          'phone' => $pessoa->telefone,
          'bornDate' => $pessoa->nascimento->format('Y-m-d'),
        ];

        #dd($dataSet);

        $dataSet['cpf'] = str_replace('-', '', $dataSet['cpf']);
        $dataSet['cpf'] = str_replace('.', '', $dataSet['cpf']);

        $dataSet['phone'] = str_replace('-', '', $dataSet['phone']);
        $dataSet['phone'] = str_replace('_', '', $dataSet['phone']);
        $dataSet['phone'] = str_replace('(', '', $dataSet['phone']);
        $dataSet['phone'] = str_replace(')', '', $dataSet['phone']);

        $validator = \Illuminate\Support\Facades\Validator::make($dataSet, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'cpf' => 'required|min:11',
            'phone' => 'required|min:11',
            'bornDate' => 'date_format:"Y-m-d"|required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $carrinho = [
            'items' => [
                [
                    'id' => $mensalidade->uuid,
                    'description' => 'BSports: Assinatura mensal de sócio',
                    'quantity' => '1',
                    'amount' => 150,
                    'weight' => '0',
                    'shippingCost' => '0',
                    'width' => '0',
                    'height' => '0',
                    'length' => '0',
                ],
            ],
            'sender' => [
                'email' => $dataSet['email'],
                'name' => $dataSet['name'],
                'documents' => [
                    [
                        'number' => $dataSet['cpf'],
                        'type' => 'CPF'
                    ]
                ],
                'phone' => $dataSet['phone'],
                'bornDate' => $dataSet['bornDate'],
            ]
        ];

        $checkout = PagSeguro::checkout()->createFromArray($carrinho);
        $credentials = PagSeguro::credentials()->get();
        $information = $checkout->send($credentials);

        if(!$information) {
          return redirect()->route('planos')->withErrors(['Ops, Ocorreu um erro ao iniciar transação.']);
        }

        return redirect($information->getLink());
    }

    public static function saveSell($information)
    {
        $vendaPS = VendaPagSeguro::where('codigo', $information->getCode())->get();

        $documento = $information->getSender()->getDocuments()[0]->getNumber();

        $pessoa = Pessoas::where('cpf', $documento)->get();
        $pessoa = $pessoa->first();

        if($vendaPS->isEmpty()) {

            $venda = new Venda();
            $venda->pessoa_id = $pessoa->id;
            $venda->gateway_id = 1;
            $venda->status_id = (int)$information->getStatus()->getCode();
            $venda->plano_id = (int)$information->getItems()[0]->getId();
            $venda->referencia = $information->getReference();
            $venda->tipo = (int)$information->getType();
            $venda->meio_pagamento_tipo_id = (int)$information->getPaymentMethod()->getType();
            $venda->meio_pagamento_id = (int)$information->getPaymentMethod()->getCode();
            $venda->valor = (float)$information->getAmounts()->getGrossAmount();
            $venda->save();

            $vendaPS = new VendaPagSeguro();
            $vendaPS->venda_id = $venda->id;
            $vendaPS->status_id = (int)$information->getStatus()->getCode();
            $vendaPS->codigo = $information->getCode();
            $vendaPS->data = $information->getDate();
            $vendaPS->save();
        } else {

            $vendaPS = $vendaPS->first();
            $vendaPS->status_id = (int)$information->getStatus()->getCode();
            $vendaPS->save();

            $venda = Venda::findOrFail($vendaPS->venda_id);
            $venda->save();

        }

        $pessoa->usuario->notify(new \App\Notifications\CompraPlano($venda));

        if((int)$information->getStatus()->getCode() == 3) {

            $plano = Planos::findOrFail((int)$information->getItems()[0]->getId());

            $date = new \DateTime();
            $fim = $date->modify($plano->periodo);

            $usuarios = User::where('pessoa_id', $pessoa->id)->get();

            foreach ($usuarios as $key => $usuario) {

                $plano = new PlanosUsuarios();
                $plano->usuario_id = $usuario->id;
                $plano->profissional_id = $pessoa->id;
                $plano->plano_id = (int)$information->getItems()[0]->getId();
                $plano->inicio = new \DateTime();
                $plano->fim = $fim;
                $plano->save();

                \App\Jobs\EmailVenda::dispatch($pessoa, $venda);

            }

            $pessoa->usuario->notify(new \App\Notifications\ConfirmacaoVendaPlano($venda));
        }

    }

    public function redirect(Request $request)
    {
        return redirect()->route('home');
    }

    public function notification(Request $request)
    {

    }
}
