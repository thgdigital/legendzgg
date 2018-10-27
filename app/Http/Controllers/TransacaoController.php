<?php

namespace App\Http\Controllers;

use App\Models\Jogador;
use App\Models\Saldo;
use App\Models\Transacao;
use App\Repositories\CreditRepository;
use Illuminate\Http\Request;
use App\Repositories\TransacaoRepository;
use Illuminate\Support\Facades\Auth;

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

        return view('pages.admin.transacao');
    }

    public function fidAll()
    {
        //

        return $this->repository->findOrder();
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
