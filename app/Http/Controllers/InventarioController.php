<?php

namespace App\Http\Controllers;

use App\Models\TipoItem;
use App\Repositories\InventariosRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class InventarioController extends Controller
{

    public  $repository;

    /**
     * InventarioController constructor.
     * @param $repository
     */
    public function __construct(InventariosRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $userId  = Auth::user()->id;
        $tipos = TipoItem::all();

        $inventario = $this->repository->jogadorItems($userId)->get();

        if (Input::get('tipo') != null)
        {
            $tipoID = Input::get('tipo');
            $inventario = $this->repository->model->with(['jogador' ,'items' => function ($query) use  ($tipoID) {
                $query->where(['tipo_items_id' => $tipoID]);
            }])->where(['jogador_id'=> $userId])->get();
        }




       return view('pages.loja-invantario')->with(['inventarios' => $inventario, 'tipos'=> $tipos]);
    }

    public function resgate(Request $request){
        $id = $request->input('id');
        $invocador = $request->input('invocador');

        $inventario = $this->repository->find($id)->with('items')->first();
        $inventario->compra = 2;
        $inventario->invocador = $invocador;
        $saved = $inventario->save();

        if($saved){
            return redirect('inventario')->with(["success" => "Transação realizada com sucesso"]);
        }

        return redirect('inventario')->with(["error" => "Opsss error não conseguimos realizar a transação"]);
    }

    public function credito($id){
        $inventario = $this->repository->find($id)->with('items')->first();
        $saldo  = Auth::user()->saldo;
        $saldo->saldo += $inventario->items->valor_credito;
        $saved = $saldo->save();

        if($saved){
            $inventario->compra = 1;
            $inventario->save();

            return redirect('inventario')->with(["success" => "Transação realizada com sucesso"]);
        }
        return redirect('inventario')->with(["error" => "Opsss error não conseguimos realizar a transação"]);
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
