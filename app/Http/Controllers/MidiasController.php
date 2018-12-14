<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Midia;
use App\Models\Midia\Link;

class MidiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $midias = Midia::paginate();
        return view('admin.midias.index', compact('midias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.midias.create');
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

        $data['user_id'] = \Auth::user()->id;

        $midia = Midia::create($data);

        if($request->get('tipo') == 'imagem') {

          if ($request->hasFile('files')) {

              $files = $request->file('files');

              foreach ($files as $file) {

                  $path = $file->store('midias');

                  Link::create([
                    'midia_id' => $midia->id,
                    'link' => $path
                  ]);
              }

          }

        } elseif ($request->get('tipo') == 'video') {

          $link = $request->get('link');

          Link::create([
            'midia_id' => $midia->id,
            'link' => $link
          ]);

        } else {

          $link = $request->get('link');

          Link::create([
            'midia_id' => $midia->id,
            'link' => $link
          ]);

        }

        flash('Midia adicionada com sucesso.')->success()->important();

        return redirect()->route('midias.index');

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

            $midia = Midia::findOrFail($id);

            $midia->links->map(function($link) {
                $link->delete();
            });

            $midia->delete();

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
