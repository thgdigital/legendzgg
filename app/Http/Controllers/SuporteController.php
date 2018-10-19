<?php

namespace App\Http\Controllers;

use App\Models\Jogador;
use App\Models\Suporte;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SuporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.suporte');
    }

    public function listHelpDesk(){
        $suporte = Suporte::with('jogador')->orderBy('updated_at', 'desc')->get();


        return view('pages.admin.listHelp')->with(['suportes' => $suporte]);
    }

    public function resposta($id){
        $suporte = Suporte::find($id)->orderBy('updated_at', 'desc')->get();
        return $suporte;
        return view('pages.admin.resposta');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.perqunta');
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
        $validatedData = Validator::make($request->all(), [
            'SuporteDetalhes' => 'required|string|max:255',

        ]);



        if ($validatedData->fails()) {
            return redirect('suporte/create')
                ->withErrors($validatedData)
                ->withInput();
        }
        if($request->input("topico") == null && $request->input("SuporteOutros") == null){
            return redirect('suporte/create')->with('error', 'Por favor escolha um tópico');

        }
        $jogador = Jogador::find(Auth::user()->id);

        $suporte = new Suporte(
            [
                'topico'=>$request->input('topico'),
                'detalhe'=>$request->input('SuporteDetalhes'),
                'outro'=> $request->input('SuporteOutros'),
                'status'=> 1,
            ]
        );

        $saved =  $jogador->suporte()->save($suporte);

       if ($saved){
           return redirect('suporte/create')->with('success', 'Olá recebemos seu ticket breve entraremos em contato ');

       }
        return redirect('suporte/create')->with('error', 'Error ao criar suporte');
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

    public function lista()
    {
        //

        $userId = Auth::user()->id;
        $suportes = Jogador::find($userId)->suporte()->get();

          return view('pages.listarsuporte')->with('suportes', $suportes);

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
