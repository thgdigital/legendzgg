<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loja;
use App\Repositories\LojaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function editarCompra(Request $request){
        $idLoja = $request->input('lojaId');
        $itemID = $request->input('item');

        $where = ['id'=> $idLoja];
        $loja = Loja::where($where)->first();
        $loja->item_id = $itemID;
        $saved = $loja->save();

        if($saved){
            return redirect('admin/loja/loja-compra')->with('success', 'Dados atualizado com sucesso');
        }
        return redirect('admin/loja/loja-compra')->with('error', 'Erro ao atualizado com sucesso');

    }

    public function compraEditar($id){
        $whre = ['id' => $id];

        $compras = Loja::where($whre)->with('items')->first();

        $where = ['status'=>1];
        $item = Item::where($where)->get();



        return view('pages.admin.editarLojaCompra' )->with(['items' => $item, 'loja'=> $compras]);


    }

    public function salvarCompra(Request $request){
        $itemID = $request->input('item');

        $data = ['status'=> 1, 'item_id' => $itemID, 'tipo'=> 1];

        $saved = $this->repository->create($data);

        if($saved){
            return redirect('admin/loja/loja-compra')->with('success', 'Dados salvo com sucesso');

        }
        return redirect('admin/loja/loja-compra')->with('error', 'Erro ao salvar dados');


    }

    public function lojacompra(){

        $whre = ['tipo' => 1];

        $compras = Loja::where($whre)->with('items')->get();

        $where = ['status'=>1];
        $item = Item::where($where)->get();


        return view('pages.admin.listLojaCompra')->with(['compras'=> $compras, 'items'=> $item]);
    }

}

