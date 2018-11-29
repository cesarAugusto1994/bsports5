<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quadras;
use App\Helpers\Helper;

class QuadrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quadras = Helper::quadras();
        return view('admin.quadras.index', compact('quadras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quadras.create');
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

        Quadras::create($data);

        Helper::drop('quadras');

        flash('Quadra adicionada com sucesso.')->success()->important();

        return redirect()->route('quadras.index');
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
        $quadra = Quadras::findOrFail($id);
        return view('admin.quadras.edit', compact('quadra'));
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

        $quadra = Quadras::findOrFail($id);
        $data['ativo'] = $request->has('ativo') ? true : false;
        $quadra->update($data);

        Helper::drop('quadras');

        flash('Quadra atualizada com sucesso.')->success()->important();

        return redirect()->route('quadras.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quadra = Quadras::findOrFail($id);
        $quadra->delete();
        Helper::drop('quadras');
        flash('Quadra removida com sucesso.')->success()->important();
        return redirect()->route('quadras.index');
    }
}
