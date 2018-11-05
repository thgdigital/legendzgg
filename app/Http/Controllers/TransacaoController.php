<?php

namespace App\Http\Controllers;

use App\Models\Jogador;
use App\Models\Loja;
use App\Models\Saldo;
use App\Models\Saque;
use App\Models\Transacao;
use App\Repositories\CreditRepository;
use Illuminate\Http\Request;
use App\Repositories\TransacaoRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransacaoController extends Controller
{
    /**
     * TransacaoController constructor.
     */
    public  $repository;
    public  $repositoryCredit;
    public function __construct(TransacaoRepository  $repository, CreditRepository  $repositoryCredit)
    {
        $this->repository = $repository;
        $this->repositoryCredit = $repositoryCredit;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //

$dados = $this->repository->findOrder();


        foreach ($dados as $dado){

            if($dado->order == null){
                DB::table('transacaos')->where('id', '=', $dado->id)->delete();
            }else if ($dado->order->jogador == null){
                DB::table('transacaos')->where('id', '=', $dado->id)->delete();
                DB::table('order_pedidos')->where('jogador_id', '=', $dado->order->jogador_id)->delete();
            }
        }

        return view('pages.admin.transacao');
    }
    public function compra()
    {
        //

        $dados = $this->repository->findOrder();


        foreach ($dados as $dado){

            if($dado->order == null){
                DB::table('transacaos')->where('id', '=', $dado->id)->delete();
            }else if ($dado->order->jogador == null){
                DB::table('transacaos')->where('id', '=', $dado->id)->delete();
                DB::table('order_pedidos')->where('jogador_id', '=', $dado->order->jogador_id)->delete();
            }
        }

        return view('pages.admin.transacao');
    }
    public function fidAll()
    {
        //
        return $this->repository->findOrder();
    }


    public function saqueAll(){

            $saques = Saque::with('jogador', 'admin')->orderBy('created_at', 'desc')->get();
         return view('pages.admin.listSaque')->with('saques', $saques);
    }

    public function  saqueEdit(Request $request){

       $status = $request->input('status');

        $ID = $request->input('idSaque');
        $saque = Saque::where(['id'=> $ID])->first();

        $saque->admin_id = auth()->guard('admin')->user()->id;
        $saque->status = $status;

        $where = ['id'=> $ID];
       $saved =  $saque->save();

        if($saved){

            if($status == 1){
                $saldo = Saldo::where(['jogador_id'=> $saque->jogador_id])->first();
                $saldo->saldo -= $saque->saque;

                $saldo->save();
            }
            return redirect('admin/transacao/saque')->with('success', 'Dados atualizado');
        }
        return redirect('admin/transacao/saque')->with('error', 'Error ao liberar saque');
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


public function loja(){

    $lojas = DB::table('jogador_loja')->get();


    $lojas = DB::table('jogador_loja')
        ->join('jogadors', 'jogador_loja.jogador_id', '=', 'jogadors.id')
        ->join('lojas', 'lojas.id', '=', 'jogador_loja.loja_id')
        ->join('items', 'items.id', '=', 'lojas.item_id')

        ->select('jogadors.username',
            'jogador_loja.valor_credito',
            'jogador_loja.valor_resgate',
            'jogador_loja.valor_essencia',
            'jogador_loja.id',
            'items.name')
        ->get();


    return view('pages.admin.listLoja')->with(["lojas" => $lojas]);

}
    public function  credit($id){
        $where= ["id"=>  $id];

        $transacao = Transacao::where($where)->with('order.jogador', 'credit.admin')->first();



        return view('pages.admin.credit')->with(["transacao" => $transacao]);

    }
    public function salveCredit(Request $request){

            $idJogogador = $request->input('idUser');
            $dados = $this->repositoryCredit->create([
               "user_id" => $idJogogador ,
               "valor" => $request->input("valor"),
               "transacao_id" => $request->input("id"),
                "admin_id" => $request->input('admin')
            ]);

        if($dados){
            $saldo = Saldo::where(["jogador_id" => $idJogogador])->first();

            $saldo->saldo += $request->input("valor");

            $saldo->save();

            return ['status' => true];
        }

        return ['status' => false];
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
