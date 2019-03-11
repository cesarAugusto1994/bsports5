<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Clientes,Propaganda,Chamados};
use App\Models\Chamados\{Anotacoes, Midias};

class MaillingController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->request->all();

        $clientes = [];

        $user = \Auth::user();

        $quantidade = 0;
        $empreendimento = null;

        if($request->has('buscar')) {

            $clientes = Clientes::where('id_empresa', $user->empresa_id);

            if(!empty($data['empreendimento'])) {

                $sql2 = "select * from imoveis where imv_id = " . (int)$request->get('empreendimento');
                $imovel = \DB::connection('mysql_seabra')->select($sql2);

                $produto = $imovelId = null;

                if(!empty($imovel[0])) {
                  $imovelId = $imovel[0]->imv_referencia;
                  $nome = $imovel[0]->imv_titulo;
                  if(!empty($imovelId)) {
                    $produto = \App\Models\Produtos::where('referencia', $imovelId)->where('nome', $nome)->get();

                    if($produto->isEmpty()) {
                      flash('O Empreendimento não foi encontrado na base de dados.')->error()->important();
                      return back();
                    }

                    $produto = $produto->first();
                    $empreendimento = $produto->nome;

                    $clientes->whereHas('empreendimentos', function ($query) use ($data, $produto) {
                        $query->where('produto_id', $produto->id);
                    });
                  }
                }

            }

            if($request->filled('tipo')) {
                $clientes->where('tipo', $request->get('tipo'));
            }

            $quantidade = $clientes->count();

            $clientes = $clientes->get();

        }

        return view('mailling.index',compact('clientes', 'quantidade', 'empreendimento'));
    }

    public function envioEmail(Request $request)
    {
        $data = $request->request->all();

        if(!$request->has('clientes')) {
          flash('Informe o cliente para enviar o e-mail.')->error()->important();
          return back();
        }

        $propaganda = Propaganda::findOrFail($request->get('propaganda'));

        $emails = [];

        if($request->has('clientes')) {

          foreach ($request->get('clientes') as $key => $clienteId) {

            $cliente = Clientes::findOrFail($clienteId);

            foreach ($cliente->emails as $key => $email) {

                if(empty($email->email)) {
                  continue;
                }

                $emails[] = $email->email;
            }

            if($request->has('chamado')) {

              $chamado = Chamados::findOrFail($request->get('chamado'));

              $anotacao = new Anotacoes();
              $anotacao->descricao = 'Propaganda <a href='.route("propagandas.show", $propaganda->id).'>#' . $propaganda->id . '</a> foi enviada para o cliente.';
              $anotacao->chamado_id = \Request::get('chamado');
              $anotacao->save();

            } else {

                $chamados = Chamados::where('id_cliente', $cliente->id)->whereIn('situacao', [1,2,4])->get();

                if($chamados->isNotEmpty()) {

                    $chamado = $chamados->last();

                } else {

                    $chamado = new Chamados();
                    $chamado->id_usuario = \Auth::user()->id;
                    $chamado->id_empresa = \Auth::user()->empresa_id;
                    $chamado->id_cliente = $cliente->id;
                    $chamado->abertura_chamado = now();
                    $chamado->situacao = 4;
                    $chamado->save();

                    $midia = new Midias();
                    $midia->midia_id = 58;
                    $midia->cliente_id = $cliente->id;
                    $midia->chamado_id = $chamado->id;
                    $midia->save();

                }

                $anotacao = new Anotacoes();
                $anotacao->descricao = 'Propaganda <a href='.route("propagandas.show", $propaganda->id).'>#' . $propaganda->id . '</a> foi enviada para o cliente.';
                $anotacao->chamado_id = $chamado->id;
                $anotacao->save();

            }

          }
        }

        $emails = array_unique($emails);

        return view('mailling.editor', compact('mensagem', 'propaganda', 'chamado', 'emails'));
    }

    public function sendEmail(Request $request, $id)
    {
        $data = $request->request->all();

        $propaganda = Propaganda::findOrFail($id);
        $chamado = Chamados::findOrFail($data['chamado']);

        $path = "";

        if(isset($data['enviar_email'])) {

            $user = \Auth::user();

            $empresa = Empresa::where('id', $user->empresa_id)->get();
            $empresa = $empresa->first();

            $descricao = "";

            if(!$empresa->mail_username || !$empresa->mail_password || !$empresa->mail_driver || !$empresa->mail_host || !$empresa->mail_port) {
                flash('Erro no envio: Por favor verifique as configurações de envio de email na cadastro da empresa!')->error()->important();
                return redirect()->back();
            } else {

                \Config::set('mail.username', $empresa->mail_username);
                \Config::set('mail.password', $empresa->mail_password);
                \Config::set('mail.port', $empresa->mail_port);
                \Config::set('mail.driver', $empresa->mail_driver);
                \Config::set('mail.host', $empresa->mail_host);
                \Config::set('mail.encryption', $empresa->mail_encription);
                \Config::set('app.name', $empresa->nome);

              }

            }

        if(isset($data['enviar_email'])) {

            $emails = explode(',', $data['email']);

            $assunto = 'SEABRA – ' . $propaganda->nome;

            if($request->hasFile('arquivo')) {
                $path = $request->file('arquivo')->store('arquivos');
            }

            foreach ($emails as $key => $email) {

              $mail = trim($email);

              \Mail::to([
                $chamado->cliente->nome => $mail,
              ])->send(new \App\Mail\Propaganda($propaganda, $data['mensagem'], $assunto, $path));
            }

            flash('Email enviado com sucesso!')->success()->important();
        }

        return redirect()->back();

        #flash('A descrição foi adicionada ao chamado com sucesso!')->success()->important();
    }

    public function show()
    {

    }
}
