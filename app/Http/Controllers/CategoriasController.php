<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Categoria, MenuCategorias};
use App\Helpers\Helper;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorias = Categoria::all();
        return view('admin.categoria.index', compact('categorias'));
    }

    public function toMenu($id)
    {
        $categoria = Categoria::findOrFail($id);

        if(!$categoria->habilitar_menu) {
            $categoria->habilitar_menu = true;
        } else {
            $categoria->habilitar_menu = false;
        }

        $categoria->save();

        Helper::drop('categorias');

        flash('Categoria atualizada com sucesso.')->success()->important();

        return redirect()->route('categorias.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categoria.create');
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
        Categoria::create($data);

        Helper::drop('categorias');

        flash('Categoria adicionada com sucesso.')->success()->important();

        return redirect()->route('categorias.index');
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
        $categoria = Categoria::findOrFail($id);

        return view('admin.categoria.edit', compact('categoria'));
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

        $data['ativo'] = $request->has('ativo');

        $categoria = Categoria::findOrFail($id);
        $categoria->update($data);

        Helper::drop('categorias');

        flash('Categoria atualizada com sucesso.')->success()->important();

        return redirect()->route('categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);

        if($categoria->jogadores->isNotEmpty()) {
          flash('Esta Categoria não pode ser removida.')->warning()->important();
          return redirect()->route('categorias.index');
        }

        $categoria->delete();

        Helper::drop('categorias');

        flash('Categoria removida com sucesso.')->success()->important();
        return redirect()->route('categorias.index');
    }
}
