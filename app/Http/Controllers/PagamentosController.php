<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogador\Mensalidade;

use App\Models\Mensalidade\Log;

class PagamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagamentos = Mensalidade::paginate();

        return view('admin.pagamento.index', compact('pagamentos'));
    }

    public function informe($uuid, Request $request)
    {
        $pagamento = Mensalidade::uuid($uuid);

        if($request->filled('status') && $request->get('status') == 3) {

          $atualStatus = $pagamento->status_id;

          $pagamento->status_id = 3;
          $pagamento->save();

          $log = new Log();
          $log->mensalidade_id = $pagamento->id;
          $log->status_anterior_id = $atualStatus;
          $log->status_atual_id = 3;
          $log->mensagem = 'Pagamento confirmado.';
          $log->save();

          flash('Pagamento confirmado com sucesso.')->success()->important();
          return redirect()->route('pagamentos.index');

        }

        if($request->filled('status') && $request->get('status') == 10) {

          $atualStatus = $pagamento->status_id;

          $pagamento->status_id = 10;
          $pagamento->recebido_por = \Auth::user()->id;
          $pagamento->forma_pagamento = $request->get('forma_pagamento');
          $pagamento->descricao = $request->get('descricao');

          $dataPgamento = \DateTime::createFromFormat('d/m/Y', $request->get('data_pagamento'));

          if(!$dataPgamento instanceof \DateTime) {
            $dataPgamento = now();
          }

          $pagamento->data_pagamento = $dataPgamento;

          $pagamento->save();

          $log = new Log();
          $log->mensalidade_id = $pagamento->id;
          $log->status_anterior_id = $atualStatus;
          $log->status_atual_id = 10;
          $log->mensagem = 'Informe de pagamento';
          $log->save();

          flash('Informe de pagamento registrado com sucesso.')->success()->important();
          return redirect()->route('pagamentos.index');
        }

        return view('admin.pagamento.informe', compact('pagamento'));
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
        //
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
        //
    }
}
