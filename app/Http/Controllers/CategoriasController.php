<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Categoria, MenuCategorias};

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('adicionar-menu')) {

            $id = $request->get('adicionar-menu');

            $menuCategoria = MenuCategorias::where('categoria_id', $id)->get();

            if($menuCategoria->isEmpty()) {
                $menu = new MenuCategorias();
                $menu->categoria_id = $id;
                $menu->save();
            } else {
              $menuCategoria->first()->delete();
            }

        }

        $categorias = Categoria::orderBy('tipo')->paginate(20);

        return view('admin.categoria.index', compact('categorias'));
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

        $categoria = Categoria::findOrFail($id);
        $categoria->update($data);

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

        flash('Categoria removida com sucesso.')->success()->important();
        return redirect()->route('categorias.index');
    }
}
