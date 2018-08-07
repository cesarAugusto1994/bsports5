<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Torneio};

class TorneiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $torneios = Torneio::orderByDesc('id')->paginate();
        return view('admin.torneio.index', compact('torneios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.torneio.create');
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
        $data['valor'] = number_format(str_replace(',', '.', $data['valor']), 2);
        Torneio::create($data);

        flash('Torneio adicionada com sucesso.')->success()->important();

        return redirect()->route('torneios.index');
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
        $torneio = Torneio::findOrFail($id);

        return view('admin.torneio.edit', compact('torneio'));
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

        $torneio = Torneio::findOrFail($id);
        $data['ativo'] = $request->has('ativo') ? true : false;
        $data['valor'] = number_format(str_replace(',', '.', $data['valor']), 2);
        $torneio->update($data);

        flash('Torneio atualizado com sucesso.')->success()->important();

        return redirect()->route('torneios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $torneio = Torneio::findOrFail($id);

        $torneio->delete();

        flash('Torneio removido com sucesso.')->success()->important();
        return redirect()->route('torneios.index');
    }
}
