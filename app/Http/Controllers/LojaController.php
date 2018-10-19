<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use App\Repositories\LojaRepository;
use Illuminate\Http\Request;

class LojaController extends Controller
{
    //
    public  $repository;

    /**
     * LojaController constructor.
     */
    public function __construct(LojaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){

    }
    public function lojaInvatario(){

    }

    public  function  compraAtivar($id){
        $loja = Loja::find($id);

        $loja->status = 1;
       $saved =  $loja->save();
        if($saved){
            return redirect('admin/loja/loja-compra')->with('success', 'Dados atualizado com sucesso');

        }
        return redirect('admin/loja/loja-compra')->with('error', 'Erro ao  atualizado com sucesso');
    }

    public  function  compraDesativar($id){
        $loja = Loja::find($id);

        $loja->status = 0;
        $saved =  $loja->save();
        if($saved){
            return redirect('admin/loja/loja-compra')->with('success', 'Dados atualizado com sucesso');

        }
        return redirect('admin/loja/loja-compra')->with('error', 'Erro ao atualizado com sucesso');


    }

    public function lojacompra(){

        $whre = ['tipo' => 1];

        $compras = Loja::where($whre)->with('items')->first();


        return view('pages.admin.listLojaCompra')->with('compras', $compras);
    }

}

