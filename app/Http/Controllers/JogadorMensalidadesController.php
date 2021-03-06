<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogador\Mensalidade;
use App\Models\Pessoa\Jogador;
use laravel\pagseguro\Platform\Laravel5\PagSeguro;
use Notification;
use App\Helpers\Helper;

use App\Models\Mensalidade\Log;

use App\Notifications\CreateMensalidade;

class JogadorMensalidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensalidades = Mensalidade::orderBy('mes')->paginate(10);
        return view('admin.jogador-mensalidades.index', compact('mensalidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jogador-mensalidades.create');
    }

    public function createFromCategories(Request $request)
    {

        $jogadores = [];
        $quantidade = 0;

        if($request->has('categoria')) {

          $categoria = $request->get('categoria');

          $jogadores = Jogador::where('categoria_id', $categoria)->where('ativo', true)->orderBy('nome')->get();
          $quantidade = $jogadores->count();

        }

        $categorias = Helper::categorias();

        return view('admin.jogador-mensalidades.create-from-categorias', compact('jogadores', 'quantidade', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->request->all();

        if(!$request->has('jogador')) {
          flash('O jogador deve ser informado.')->error()->important();
          return back();
        }

        if(empty($data['mes'])) {
          flash('O mês referência da mensalidade deve ser informado.')->error()->important();
          return back();
        }
/*
        if(empty($data['valor'])) {
          flash('O valor da mensalidade deve ser informado.')->error()->important();
          return back();
        }
*/
        $meses = explode(', ', $data['mes']);

        $jogadores = $data['jogador'];
        //$valor = (float)$data['valor'] ?? 265.00;

        foreach ($jogadores as $key => $jogador) {

            $jog = Jogador::findOrFail($jogador);

            $valor = \App\Helpers\Helper::getConfig('valor-mensalidade');

            if($jog->aluno) {
                $valor = \App\Helpers\Helper::getConfig('valor-mensalidade-aluno');
            }

            $valor = str_replace(',','.', $valor);

            $mesesCobrarMensalidade = [];

            foreach($meses as $mes) {

                $dataMes = (\DateTime::createFromFormat('m/Y', $mes))->format('mY');

                $existeMensalidade = Mensalidade::where('referencia', "$jogador:$dataMes")->get();

                $vcto = \App\Helpers\Helper::getConfig('dias-vencimento-debito');

                $vigencia = \DateTime::createFromFormat('m/Y', $mes);
                $dataVencimento = \DateTime::createFromFormat('m/Y', $mes);

                $dataVencimento->setDate($dataVencimento->format('Y'),$dataVencimento->format('m'),1);

                $dataVencimento->modify("+$vcto days");

                if($existeMensalidade->isEmpty()) {
                      $mensalidade = new Mensalidade();
                      $dataMes = $vigencia;
                      $mensalidade->mes = $dataMes->format('m/Y');
                      $mensalidade->jogador_id = $jogador;
                      $mensalidade->referencia = "$jogador:" . $dataMes->format('mY');
                      $mensalidade->valor = $valor;

                      $mensalidade->vencimento = $dataVencimento;
                      $mensalidade->status_id = 1;
                      $mensalidade->criado_por = \Auth::user()->id;
                      $mensalidade->save();

                      $log = new Log();
                      $log->mensalidade_id = $mensalidade->id;
                      $log->status_anterior_id = 1;
                      $log->status_atual_id = 1;
                      $log->mensagem = 'Mensalidade criada';
                      $log->save();

                      if((boolean)\App\Helpers\Helper::getConfig('notificacao-nova-mensalidade') == true) {

                          if($mensalidade->jogador->usuario()) {

                            $user = $mensalidade->jogador->usuario()->get()->first();

                            if($user) {
                                Notification::send($user, new CreateMensalidade($mensalidade));
                            }

                          }

                      }
                }
            }
        }

        //$request->user()->notify(new CreateMensalidade());

        flash('Mensalidade Gerada com sucesso.')->success()->important();

        return redirect()->route('mensalidades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $registro = Mensalidade::findOrFail($id);

            if($registro->status_id == 1) {
              $registro->log->map(function($log) {
                $log->delete();
              });
            }

            $registro->delete();

            return response()->json([
              'code' => 201,
              'message' => 'Removido com sucesso!'
            ]);

        } catch(Exception $e) {
            return response()->json([
              'code' => 501,
              'message' => $e->getMessage()
            ]);
        }
    }

    public function sale(Request $request)
    {
        $data = $request->request->all();

        $plano = Mensalidade::findOrFail($data['mensalidade_id']);
        $pessoa = Pessoa::findOrFail($data['pessoa_id']);

        $errors = [];

        if(!$pessoa->nascimento) {
          array_push($errors, 'Informe a sua data de nascimento nas suas configurações.');
        } elseif (!$pessoa->cpf) {
          array_push($errors, 'Informe o numero do seu CPF nas suas configurações.');
        }

        if($errors) {
          //return redirect()->route('planos')->withErrors($errors);
          exit('erro');
        }

        $dataSet = [
          'mes' => $mes,
          'email' => $pessoa->email,
          'name' => $pessoa->nome,
          'cpf' => "",
          'phone' => "",
          'nascimento' => $pessoa->nascimento->format('Y-m-d'),
        ];

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
            'nascimento' => 'date_format:"Y-m-d"|required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('planos')->withErrors($validator);
        }

        $carrinho = [
            'items' => [
                [
                    'id' => 1,
                    'description' => 'BSports: Mensalidade mes referencia ' . $dataSet['mes'],
                    'quantity' => '1',
                    'amount' => 150.00,
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
                'bornDate' => $dataSet['nascimento'],
            ]
        ];

        $checkout = PagSeguro::checkout()->createFromArray($carrinho);

        $credentials = PagSeguro::credentials()->get();

        $information = $checkout->send($credentials);

        if(!$information) {
          exit('erro o redirecionamento');
        }

        return redirect($information->getLink());
    }

}
