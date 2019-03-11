<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Modelo, Template};

class ModelosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelos = Modelo::paginate();
        return view('modelos.index', compact('modelos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $templates = Template::all();
        return view('modelos.create', compact('templates'));
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

        $modelo = Modelo::create($data);

        flash('O modelo foi adicionado com sucesso!')->success()->important();

        return redirect()->route('modelos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modelo = Modelo::findOrFail($id);
        $templates = Template::all();

        return view('modelos.includes.' . $modelo->template->arquivo, compact('modelo', 'templates'));

        #return view('modelos.show', compact('modelo', 'templates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modelo = Modelo::findOrFail($id);
        $templates = Template::all();

        return view('modelos.edit', compact('modelo', 'templates'));
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
        $data = $request->request->all();

        $modelo = Modelo::findOrFail($id);
        $modelo->update($data);

        flash('O modelo foi atualizado com sucesso!')->success()->important();

        return redirect()->route('modelos.index');
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
            $registro = Modelo::findOrFail($id);
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

    public function setPreview(Request $request)
    {
        $data = $request->request->all();

    		$idTemplate  =  $request->get('idTemplate');
    		$id         =   $request->get( "id" );

    		$request->request->set( "idTemplate", $idTemplate );

    		$nameProp      =   $request->get( "nameProp" );
    		$request->request->set( "name", $nameProp );

     		if( $id != 5 ) {
    	 		$text1      =   $request->get( "text1" );
    	 		$text2      =   $request->get( "text2" );
    	 		$imgUrl1    =   $request->get( "imgUrl1" );
    	 		$dorms      =   $request->get( "dorms" );
    	 		$suites     =   $request->get( "suites" );
    	 		$vagas      =   $request->get( "vagas" );
    	 		$metragem   =   $request->get( "metragem" );
    	 		$edit1      =   $request->get( "edit1" );
    	 		$edit2      =   $request->get( "edit2" );
    	 		$edit3      =   $request->get( "edit3" );
    	 		$edit4      =   $request->get( "edit4" );
    	 		$img1       =   $request->get( "img1" );
    	 		$img2       =   $request->get( "img2" );
    	 		$img3       =   $request->get( "img3" );
    	 		$img4       =   $request->get( "img4" );
    	 		$local      =   $request->get( "local" );
    	 		$mapa       =   $request->get( "mapa" );
    	 		$link       =   $request->get( "linkGeral" );
    	 		$video      =   $request->get( "video" );

    	 		$request->request->set( "text1", $text1 );
    	 		$request->request->set( "text2", $text2 );
    	 		$request->request->set( "imgUrl1", $imgUrl1 );
    	 		$request->request->set( "dorms", $dorms );
    	 		$request->request->set( "suites", $suites );
    	 		$request->request->set( "vagas", $vagas );
    	 		$request->request->set( "metragem", $metragem );
    	 		$request->request->set( "edit1", $edit1 );
    	 		$request->request->set( "edit2", $edit2 );
    	 		$request->request->set( "edit3", $edit3 );
    	 		$request->request->set( "edit4", $edit4 );
    	 		$request->request->set( "img1", $img1 );
    	 		$request->request->set( "img2", $img2 );
    	 		$request->request->set( "img3", $img3 );
    	 		$request->request->set( "img4", $img4 );
    	 		$request->request->set( "local", $local );
    	 		$request->request->set( "mapa", $mapa );
    	 		$request->request->set( "linkGeral", $link );
    	 		$request->request->set( "video", $video );
    	 	}else {

    	 		$d1      =   $request->get( "d1" );
    	 		$d2      =   $request->get( "d2" );
    	 		$d3      =   $request->get( "d3" );
    	 		$d4      =   $request->get( "d4" );
    	 		$d5      =   $request->get( "d5" );
    	 		$d6      =   $request->get( "d6" );
    	 		$d7      =   $request->get( "d7" );
    	 		$d8      =   $request->get( "d8" );
    	 		$d9      =   $request->get( "d9" );
    	 		$d10     =   $request->get( "d10" );
    	 		$d11     =   $request->get( "d11" );
    	 		$d12     =   $request->get( "d12" );
    	 		$d13     =   $request->get( "d13" );
    	 		$d14     =   $request->get( "d14" );
    	 		$d15     =   $request->get( "d15" );

    	 		$request->request->set( "d1", $d1 );
    	 		$request->request->set( "d2", $d2 );
    	 		$request->request->set( "d3", $d3 );
    	 		$request->request->set( "d4", $d4 );
    	 		$request->request->set( "d5", $d5 );
    	 		$request->request->set( "d6", $d6 );
    	 		$request->request->set( "d7", $d7 );
    	 		$request->request->set( "d8", $d8 );
    	 		$request->request->set( "d9", $d9 );
    	 		$request->request->set( "d10", $d10 );
    	 		$request->request->set( "d11", $d11 );
    	 		$request->request->set( "d12", $d12 );
    	 		$request->request->set( "d13", $d13 );
    	 		$request->request->set( "d14", $d14 );
    	 		$request->request->set( "d15", $d15 );

    	 	}

     		echo json_encode([
          'url' => route('template_preview_item', $id)
        ]);
    }

    public function preview(Request $request, $id)
    {
        $data   =   array();

        $filters = $request->request->all();

        $data["url"] = config('APP_URL');

        $data["name"] = $request->get('name');

        $data["modelo"] = $id;

          if( $id == 1 || $id == 2 ) {

          $data["text1"]      =   $request->get( "text1" );
          $data["text2"]      =   $request->get( "text2" );
          $data["imgUrl1"]    =   $request->get( "imgUrl1" );
          $data["dorms"]      =   $request->get( "dorms" );
          $data["suites"]     =   $request->get( "suites" );
          $data["vagas"]      =   $request->get( "vagas" );
          $data["metragem"]   =   $request->get( "metragem" );
          $data["edit1"]      =   $request->get( "edit1" );
          $data["edit2"]      =   $request->get( "edit2" );
          $data["edit3"]      =   $request->get( "edit3" );
          $data["edit4"]      =   $request->get( "edit4" );
          $data["img1"]       =   $request->get( "img1" );
          $data["img2"]       =   $request->get( "img2" );
          $data["img3"]       =   $request->get( "img3" );
          $data["img4"]       =   $request->get( "img4" );
          $data["local"]      =   $request->get( "local" );
          $data["mapa"]       =   $request->get( "mapa" );
          $data["linkGeral"]  =   $request->get( "linkGeral" );
          $video              =   $request->get( "video" );
          $data["video"]      =   "";

          $routeVideo=route('storage_images',['link'=>"youtube.png"]);

          if( $video != '' ) {
            $data["video"]  = "	<tr>
                              <td style='text-align: center;'>
                                <a href='$video'>
                                  <img src='$routeVideo' width='250' height='40' />
                                </a>
                              </td>
                            </tr>
                            ";
          }

        }else if( $id == 3 ) {

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
          $data["linkGeral"]  =   $request->get( "d15" );
          $video              =   $request->get( "d14" );
          $data["video"]      =   "";

          $routeVideo=route('storage_images',['link'=>"youtube.png"]);

          if( $video != '' ) {
            $data["video"]  = "	<tr>
                              <td style='text-align: center;'>
                                <a href='$video'>
                                  <img src='$routeVideo' width='250' height='40' />
                                </a>
                              </td>
                            </tr>
                            ";
          }
        }

        #dd($data);

        $data["url"]  =  config('APP_URL');

        return view('modelos.templates.template'.$id, $data);

    }

    public function salvar( $name, $id, $idTemplate )
    {


    }
}
