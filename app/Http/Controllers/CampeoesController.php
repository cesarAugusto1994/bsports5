<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campeoes;

class CampeoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campeoes = Campeoes::paginate();
        return view('admin.campeoes.index', compact('campeoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.campeoes.create');
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

      if ($request->hasFile('imagem')) {
          $path = $request->imagem->store('campeoes');
          $data['imagem'] = $path;
      }

      $campeao = Campeoes::create($data);

      session()->forget('campeoes');

      flash('Campeão adicionado com sucesso.')->success()->important();

      return redirect()->route('campeoes.index');
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

          $campeao = Campeoes::findOrFail($id);

          if(\Storage::exists($campeao->imagem)) {
            \Storage::delete($campeao->imagem);
          }

          $campeao->delete();

          session()->forget('campeoes');

          return response()->json([
            'code' => 201,
            'message' => 'registro removido com sucesso!'
          ]);

      } catch(Exception $e) {
          return response()->json([
            'code' => 501,
            'message' => $e->getMessage()
          ]);
      }
    }
}
