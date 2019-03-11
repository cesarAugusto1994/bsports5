<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Propaganda;
use App\Models\Imovel;
use App\Models\Perfil\Imoveis as PerfilImovel;
use App\Models\{Chamados, Manifestacao, Empresa, Produtos, LogEmail, Clientes};
use App\Models\Chamados\{Classificacao, Previsao, Status, Empreendimentos, Midias, Logs, Anotacoes, Fase};

class PropagandasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propagandas = Propaganda::paginate();

        return view('empresa.propagandas.index', compact('propagandas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data   =   array();

        $id = $request->get("modelo");
        $nome = $request->get("nome");
        $idTemplate = $request->get("template");
        $modelo = $request->get('modelo');

        $nomeTemp    =  "modelo";

        $code = 100;

        $base = config('APP_URL');

        if( $id == 1 || $id == 2 ) {
          $data["url0"]  =  $base;
          $data["nameProp0"]  =  $nome;
          $data["url1"]  =  $base;
          $data["nameProp1"]  =  $nome;
          $data["url2"]  =  $base;
          $data["nameProp2"]  =  $nome;
          $data["url3"]  =  $base;
          $data["nameProp3"]  =  $nome;
          $data["url4"]  =  $base;
          $data["nameProp4"]  =  $nome;
          $data["linkGer1"]   =   $request->get( "linkGeral" );
          $data["linkGer2"]   =   $data["linkGer1"];
          $data["linkGer3"]   =   $data["linkGer1"];
          $data["linkGer4"]   =   $data["linkGer1"];

          $data["text1"]     =   $request->get( "text1" );
          $data["text2"]     =   $request->get( "text2" );
          $data["imgUrl1"]   =   $request->get( "imgUrl1" );
          $data["dorms"]     =   $request->get( "dorms" );
          $data["suites"]    =   $request->get( "suites" );
          $data["vagas"]     =   $request->get( "vagas" );
          $data["metragem"]  =   $request->get( "metragem" );
          $data["edit1"]     =   $request->get( "edit1" );
          $data["edit2"]     =   $request->get( "edit2" );
          $data["edit3"]     =   $request->get( "edit3" );
          $data["edit4"]     =   $request->get( "edit4" );

          $data["img1"]      =   $request->get( "img1" );
          $data["img2"]      =   $request->get( "img2" );
          $data["img3"]      =   $request->get( "img3" );
          $data["img4"]      =   $request->get( "img4" );

          $data["local"]     =   $request->get( "local" );
          $data["mapa"]      =   $request->get( "mapa" );
          $data["linkGer"]   =   $request->get( "linkGeral" );
          $video             =   $request->get( "video" );
          $data["video"]     =   "";

          if( $video != '' ) {

            if( $id == 2 ) {
              $number = 2;
              $width = 44;
            }else {
              $number = 3;
              $width = 44;
            }

            $routeVideo=route('images',['link'=>$nome . "_top2.png"]);

            $data["video"]  =  "
                        <table width='902' height='" . $width . "' align='center' bgcolor='#FFFFFF' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td>
                              <a href='" . $video . "'>
                                <img style='display:block' src='$routeVideo' width='900' height='" . $width . "' />
                              </a>
                            </td>
                          </tr>
                        </table>
                        ";
          }

        } else if( $id == 3 ) {
          $data["url1"]  =  $base;
          $data["nameProp1"]  =  $nome;
          $data["url2"]  =  $base;
          $data["nameProp2"]  =  $nome;
          $data["url3"]  =  $base;
          $data["nameProp3"]  =  $nome;
          $data["url4"]  =  $base;


          $data["text1"]  =  $request->get( "text1" );
          $data["text2"]  =  $request->get( "text2" );
          $data["d1"]     =  $request->get( "d1" );
          $data["d2"]     =  $request->get( "d2" );
          $data["d3"]     =  $request->get( "d3" );
          $data["d4"]     =  $request->get( "d4" );
          $data["d5"]     =  $request->get( "d5" );
          $data["d6"]     =  $request->get( "d6" );
          $data["d7"]     =  $request->get( "d7" );
          $data["d8"]     =  $request->get( "d8" );
          $data["d9"]     =  $request->get( "d9" );
          $data["d10"]    =  $request->get( "d10" );
          $data["d11"]    =  $request->get( "d11" );
          $data["d12"]    =  $request->get( "d12" );
          $data["d13"]    =  $request->get( "d13" );
          $data["d14"]    =  $request->get( "d14" );
          $data["d15"]    =  $request->get( "d15" );
          $data["d16"]    =  $request->get( "d16" );
          $data["d17"]    =  $request->get( "d17" );
          $data["d18"]    =  $request->get( "d18" );
          $data["d19"]    =  $request->get( "d19" );
          $data["d20"]    =  $request->get( "d20" );
          $data["d21"]    =  $request->get( "d21" );
          $data["d22"]    =  $request->get( "d22" );
          $data["d23"]    =  $request->get( "d23" );
          $data["d24"]    =  $request->get( "d24" );
          $data["d25"]    =  $request->get( "d25" );
          $data["d26"]    =  $request->get( "d26" );
          $data["d27"]    =  $request->get( "d27" );
          $data["d28"]    =  $request->get( "d28" );
          $data["d29"]    =  $request->get( "d29" );
          $data["d30"]    =  $request->get( "d30" );
          $data["d31"]    =  $request->get( "d31" );
          $data["d32"]    =  $request->get( "d32" );
          $data["d33"]    =  $request->get( "d33" );
          $data["d34"]    =  $request->get( "d34" );
          $data["d35"]    =  $request->get( "d35" );
          $data["d36"]    =  $request->get( "d36" );
          $data["d37"]    =  $request->get( "d37" );
          $data["d38"]    =  $request->get( "d38" );
          $data["d39"]    =  $request->get( "d39" );
          $data["d40"]    =  $request->get( "d40" );
          $data["d41"]    =  $request->get( "d41" );
          $data["d42"]    =  $request->get( "d42" );
          $data["d43"]    =  $request->get( "d43" );
          $data["d44"]    =  $request->get( "d44" );
          $data["d45"]    =  $request->get( "d45" );
          $data["d46"]    =  $request->get( "d46" );
          $data["d47"]    =  $request->get( "d47" );
          $data["d48"]    =  $request->get( "d48" );

        }else if( $id == 4 ) {
            $data["url1"]  =  $base;
            $data["nameProp1"]  =  $nome;

            $data["text1"]  =  $request->get( "text1" );
            $data["text2"]  =  $request->get( "text2" );
            $data["d1"]     =  $request->get( "d1" );
            $data["d2"]     =  $request->get( "d2" );
            $data["d3"]     =  $request->get( "d3" );
            $data["d4"]     =  $request->get( "d4" );
            $data["d5"]     =  $request->get( "d5" );
            $data["d6"]     =  $request->get( "d6" );
            $data["d7"]     =  $request->get( "d7" );
            $data["d8"]     =  $request->get( "d8" );
            $data["d9"]     =  $request->get( "d9" );
            $data["d10"]    =  $request->get( "d10" );
            $data["d11"]    =  $request->get( "d11" );
            $data["d12"]    =  $request->get( "d12" );
            $data["d13"]    =  $request->get( "d13" );
            $data["d14"]    =  $request->get( "d14" );
            $data["d15"]    =  $request->get( "d15" );
            $data["d16"]    =  $request->get( "d16" );
            $data["d17"]    =  $request->get( "d17" );
            $data["d18"]    =  $request->get( "d18" );
            $data["d19"]    =  $request->get( "d19" );
            $data["d20"]    =  $request->get( "d20" );
            $data["d21"]    =  $request->get( "d21" );
            $data["d22"]    =  $request->get( "d22" );
            $data["d23"]    =  $request->get( "d23" );
            $data["d24"]    =  $request->get( "d24" );
            $data["d25"]    =  $request->get( "d25" );
            $data["d26"]    =  $request->get( "d26" );
            $data["d27"]    =  $request->get( "d27" );
            $data["d28"]    =  $request->get( "d28" );
            $data["d29"]    =  $request->get( "d29" );
            $data["d30"]    =  $request->get( "d30" );
            $data["d31"]    =  $request->get( "d31" );
            $data["d32"]    =  $request->get( "d32" );

            $data["d33"]    =  $request->get( "d33" );
            $data["d34"]    =  $request->get( "d34" );
            $data["d35"]    =  $request->get( "d35" );
            $data["d36"]    =  $request->get( "d36" );

            $data["d37"]    =  $request->get( "d37" );
            $data["d38"]    =  $request->get( "d38" );
            $data["d39"]    =  $request->get( "d39" );
            $data["d40"]    =  $request->get( "d40" );
        }else if( $id == 5 ) {
            $data["url1"]  =  $base;
            $data["nameProp1"]  =  $nome;

            $data["d1"]     =  $request->get( "d1" );
            $data["d2"]     =  $request->get( "d2" );
            $data["d3"]     =  $request->get( "d3" );
            $data["d4"]     =  $request->get( "d4" );
            $data["d5"]     =  $request->get( "d5" );
            $data["d6"]     =  $request->get( "d6" );
            $data["d7"]     =  $request->get( "d7" );
            $data["d8"]     =  $request->get( "d8" );
            $data["d9"]     =  $request->get( "d9" );
            $data["d10"]    =  $request->get( "d10" );
            $data["d11"]    =  $request->get( "d11" );
            $data["d12"]    =  $request->get( "d12" );
            $data["d13"]    =  $request->get( "d13" );
            $data["d14"]    =  $request->get( "d14" );
            $data["d15"]    =  $request->get( "d15" );
            $data["video"]  =  "";
            $video          =  $data["d14"];

            $width = 44;

            if( $video != '' ) {

              $routeVideo=route('images',['link'=>$nome . "_top2.png"]);

              $data["video"]  = "	<table width='902' height='" . $width . "' align='center' bgcolor='#FFFFFF' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td>
                              <a href='$video'>
                                <img style='display:block' src='".$routeVideo."' width='900' height='" . $width . "' />
                              </a>
                            </td>
                          </tr>
                        </table>
                              ";
            }

        }

          $arquivo0 = $nome . '_top1.png';
          $arquivo1 = $nome . '_top0.png';
          $arquivo2 = $nome . '_top2.png';
          $arquivo3 = $nome . '_top3.png';
          $arquivo4 = $nome . '_top4.png';
          $arquivo5 = $nome . '_top5.png';
          $arquivo6 = $nome . '_top6.png';
          $arquivo7 = $nome . '_top7.png';

          $data['nameProp0'] = Storage::exists('propaganda/imagens/'.$arquivo0) ? $arquivo0 : '';
          $data['nameProp1'] = Storage::exists('propaganda/imagens/'.$arquivo1) ? $arquivo1 : '';
          $data['nameProp2'] = Storage::exists('propaganda/imagens/'.$arquivo2) ? $arquivo2: '';
          $data['nameProp3'] = Storage::exists('propaganda/imagens/'.$arquivo3) ? $arquivo3 : '';
          $data['nameProp4'] = Storage::exists('propaganda/imagens/'.$arquivo4) ? $arquivo4 : '';
          $data['nameProp5'] = Storage::exists('propaganda/imagens/'.$arquivo5) ? $arquivo5 : '';
          $data['nameProp6'] = Storage::exists('propaganda/imagens/'.$arquivo6) ? $arquivo6 : '';
          $data['nameProp7'] = Storage::exists('propaganda/imagens/'.$arquivo7) ? $arquivo7 : '';

          $view = view('empresa.modelos.templates.t'.$idTemplate, $data);
          $contents = $view->render();

          $propaganda = Propaganda::create([
            'nome' => $nome,
            'modelo_id' => $modelo,
            'conteudo' => $contents,
          ]);

          if(\Request::has('chamado')) {
            $anotacao = new Anotacoes();
            $anotacao->descricao = 'Propaganda <a href='.route("propagandas.show", $propaganda->id).'>#' . $propaganda->id . '</a> foi gerada para o cliente.';
            $anotacao->chamado_id = \Request::has('chamado');
            $anotacao->save();
          }

          $message  =  "Salvo com sucesso";

          $resp = array();

          $resp["message"]  =  $message;
          $resp["code"]  =  $code;

          return $resp;
    }

    public function externalImages(Request $request)
    {
        $link = $request->get('link');

        $link = str_replace('../', '', $link);

        $image = file_get_contents($link);

        return response($image, 200)->header('Content-Type', 'image/png');
    }

    public function storageImages(Request $request)
    {
        $link = $request->get('link');

        if(!\Storage::exists($link)) {
          return null;
        }

        return \Storage::get($link);

        $image = file_get_contents($link);

        return response($image, 200)->header('Content-Type', 'image/png');
    }

    public function images(Request $request)
    {
        $link = $request->get('link');

        $link = '/propaganda/imagens/' . $link;

        $image = Storage::exists($link) ? Storage::get($link) : false;

        if(!$image) {
          return null;
        }

        return response($image, 200)->header('Content-Type', 'image/png');
    }

    public function googleImages(Request $request)
    {
        $link = $request->get('link');

        $image = Storage::exists($link) ? Storage::get($link) : false;

        if(!$image) {
          return 'null';
        }

        return response($image, 200)->header('Content-Type', 'image/png');
    }

    public function storeImages(Request $request)
    {
        $data = $request->request->all();

        sleep(5);

    		$image    = $data['image'];
    		$item     = $data['item'];
    		$nomeProp = $data['nomeProp'];
        $idTemplate = $data['template_id'];
        $modelo = $data['modelo'];

    		switch( $item ) {
    			case 0: {
    				$name = $nomeProp . '_top0';
    				$this->storeFile( $name, $image );
    				break;
    			}
    			case 1: {
    				$name = $nomeProp . '_top1';
    				$this->storeFile( $name, $image );
    				break;
    			}
    			case 2: {
    				$name = $nomeProp . '_top2';
    				$this->storeFile( $name, $image );
    				break;
    			}
    			case 3: {
    				$name = $nomeProp . '_top3';

            if($idTemplate==2){
              $id = 2;
              $request->request->set('nome', $nomeProp);
              $request->request->set('nomePropaganda', $name);
              $request->request->set('id', $id);
              $request->request->set('template', $idTemplate);
              $request->request->set('modelo', $modelo);
            }

            if($idTemplate==5){
              $id = 5;
              $request->request->set('nome', $nomeProp);
              $request->request->set('nomePropaganda', $name);
              $request->request->set('id', $id);
              $request->request->set('template', $idTemplate);
              $request->request->set('modelo', $modelo);
            }

    				$this->storeFile( $name, $image );

            if($idTemplate==2){
              $response = $this->store($request);
      				echo json_encode( $response );
              exit;
            }

            if($idTemplate==5){
              $response = $this->store($request);
      				echo json_encode( $response );
              exit;
            }

    				break;
    			}
    			case 4: {

            $name = $nomeProp . '_top4';

            if($idTemplate==1){

              $request->request->set('nome', $nomeProp);
              $request->request->set('nomePropaganda', $name);
              $request->request->set('id', $item);
              $request->request->set('template', $idTemplate);
              $request->request->set('modelo', $modelo);

              $this->storeFile( $name, $image );

      				$response = $this->store($request);
      				echo json_encode( $response );
              exit;

            }


    				$this->storeFile( $name, $image );

    				break;
    			}
          case 5: {
    				$name = $nomeProp . '_top5';

            if($idTemplate==4){

              $id=4;

              $request->request->set('nome', $nomeProp);
              $request->request->set('nomePropaganda', $name);
              $request->request->set('id', $id);
              $request->request->set('template', $idTemplate);
              $request->request->set('modelo', $modelo);

              $this->storeFile( $name, $image );

              $response = $this->store($request);
              echo json_encode( $response );
              exit;

            } else {
              $this->storeFile( $name, $image );
            }

    				break;
    			}
          case 6: {
    				$name = $nomeProp . '_top6';
            $this->storeFile( $name, $image );
            break;
    			}
          case 7: {
    				$name = $nomeProp . '_top7';

            $id = 3;

            $request->request->set('nome', $nomeProp);
            $request->request->set('nomePropaganda', $name);
            $request->request->set('id', $id);
            $request->request->set('template', $idTemplate);
            $request->request->set('modelo', $modelo);

    				$this->storeFile( $name, $image );

            $response = $this->store($request);
    				echo json_encode( $response );
            exit;

    				break;
    			}

    		}

    		echo json_encode( array() );
  	}

    public function storeFile($name, $image)
    {
      $image   = str_replace('data:image/png;base64,', '', $image);
      $decoded = base64_decode($image);

      $path = Storage::put('propaganda/imagens/'.$name.'.png', $decoded);

      return $path;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $propaganda = Propaganda::findOrFail($id);

        $conteudo = $propaganda->conteudo;

        #dd($conteudo);

        return $conteudo;
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
            $registro = Propaganda::findOrFail($id);
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

    public function enviarImagem(Request $request)
    {
        if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {

          $path = $request->arquivo->store('images/googlemaps');

          $data["code"]     = 100;
          $data["message"]  =  'Upload realizado com sucesso.';
          $data["urlimg"]  =  route('google_images', ['link'=>$path]);

        }else{

          $data["code"]     = 101;
          $data["message"]  =  'Adicione um arquivo.';
          $data["urlimg"]  =  "";

        }

        echo json_encode( $data );
    }


    public function envioEmail(Request $request, $id)
    {
        $data = $request->request->all();

        if(!$request->has('cliente')) {
          flash('Informe o cliente para enviar o e-mail.')->error()->important();
          return back();
        }

        $propaganda = Propaganda::findOrFail($id);

        if($request->has('cliente')) {

          $cliente = Clientes::findOrFail($request->get('cliente'));

          if(\Request::has('chamado')) {

            $chamado = Chamados::findOrFail(\Request::get('chamado'));

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
                  $cliente = $request->get('cliente');

                  $chamado->save();

              }

              $anotacao = new Anotacoes();
              $anotacao->descricao = 'Propaganda <a href='.route("propagandas.show", $propaganda->id).'>#' . $propaganda->id . '</a> foi enviada para o cliente.';
              $anotacao->chamado_id = $chamado->id;
              $anotacao->save();

          }

        }

        return view('empresa.propagandas.editor', compact('mensagem', 'propaganda', 'chamado'));
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

            $assunto = 'SEABRA | ' . $propaganda->nome;

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

    public function adicionarCliente(Request $request, $id)
    {
        $propaganda = Propaganda::findOrFail($id);

        return view('empresa.propagandas.adicionar-cliente', compact('propaganda'));
    }
}
