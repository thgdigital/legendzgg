<?php

namespace App\Http\Controllers;


use App\Jobs\ComprarJob;
use App\Models\OrderPedido;
use App\Models\Pagamento;
use App\Models\Transacao;
use App\Notifications\OrderPedidoNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\CardCredit;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Models\Jogador;


class PagseguroController extends Controller
{

    private $url = "https://ws.sandbox.pagseguro.uol.com.br";
    private $email = "dvb.business@gmail.com";
    private $token_pagSeguro = "A9A590D499884B52844EF4A11F8C2D4C";
    private $token_sendbox = "C5112C45B6D243F998D90F8E0E190D00";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $carrinho = null;

        if (Session::has("carrinho")) {
            //
            $carrinho = Session::get("carrinho");

        }else{
            $carrinho = null;
        }


        if($carrinho != null) {


        $jogador = Jogador::find(Auth::user()->id);
//
        $order = New OrderPedido(
            [
                "endereco"=>null,
                "code"=> null,
                "cep"=>null,
                "bairro"=>null,
                "cidade"=>null,
                "estado"=>null,
                "valor_total"=> $carrinho['valor_unitario']

            ]
        );

            $name = Auth::user()->name;

            $saved =  $jogador->order()->save($order);



            $Data["email"] = $this->email;
            $Data["token"] = $this->token_sendbox;
            $Data["currency"] = "BRL";
            $Data["itemId1"] = $saved->id;
            $Data["itemDescription1"] = 'Compra de Crédito';
            $Data["itemAmount1"] = "1.00";
            $Data["itemQuantity1"] = $carrinho['qtd'];
            $Data["reference"] = "$saved->id";
            $Data["notificationURL="] = "http://legendzgg.com/novo/notificacao-pagseguro";
//

        $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout";

        $curl = curl_init($url);

        $buildQuery=http_build_query($Data);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Content-Type: application/x-www-form-urlencoded; charset=utf-8")
        );
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$buildQuery);
        $returno = curl_exec($curl);
        curl_close($curl);

        $xml = simplexml_load_string(utf8_encode($returno));

        if($xml->code != null){
            return response()->json( ["error"=> false, "code"=> $xml->code, "orderID" => $saved->id]);
        }else{
            return response()->json( ["error"=> true, "code"=> null, "orderID" => $saved->id]);
        }


        }
        return response()->json( ["error"=> true, "code"=> null, "orderID" => null ]);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $carrinho = null;
        $code = $request->input("code") != null ? $request->input("code"): null;


        if (Session::has("carrinho")) {
            //
            $carrinho = Session::get("carrinho");


        }else{

            $carrinho = null;
        }


        if($carrinho != null) {


            $jogador = Jogador::find(Auth::user()->id);
//
            $order = New OrderPedido(
                [
                    "endereco"=>null,
                    "code"=> $code,
                    "cep"=>null,
                    "bairro"=>null,
                    "cidade"=>null,
                    "estado"=>null,
                    "valor_total"=> $carrinho['valor_unitario']

                ]
            );

            $name = Auth::user()->name;

            $saved =  $jogador->order()->save($order);



            $Data["email"] = $this->email;
            $Data["token"] = $this->token_sendbox;
            $Data["currency"] = "BRL";
            $Data["itemId1"] = $saved->id;
            $Data["itemDescription1"] = 'Compra de Crédito';
            $Data["itemAmount1"] = "1.00";
            $Data["itemQuantity1"] = $carrinho['qtd'];
            $Data["reference"] = "$saved->id";
            $Data["notificationURL="] = "http://legendzgg.com/notificacao-pagseguro";
//

            $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout";

            $curl = curl_init($url);

            $buildQuery=http_build_query($Data);
            curl_setopt($curl, CURLOPT_HTTPHEADER,
                array("Content-Type: application/x-www-form-urlencoded; charset=utf-8")
            );
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$buildQuery);
            $returno = curl_exec($curl);
            curl_close($curl);

            $xml = simplexml_load_string(utf8_encode($returno));

            if($xml->code != null){

                return response()->json( ["error"=> false, "code"=> $xml->code, "orderID" => $saved->id]);
            }else{

                return response()->json( ["error"=> true, "code"=> null, "orderID" => $saved->id]);
            }


        }
        return response()->json( ["error"=> true, "code"=> null, "orderID" => null, "message"  => "Carrinho esta vazio" ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function salveCarrinho(Request $request)
    {

        $name = "carrinho";
        $qtd = $request->input("qtd");
        $valor_total  = $request->input("valor_unitario") * $qtd;
        $valor_unitario = number_format($valor_total, 2, '.', ',');


        $array = ['qtd' => $qtd, 'valor_unitario' => $valor_unitario];
//        $session = Session::has($name) ? Session::get($name) : null;



       $request->session()->put($name, $array);


        return redirect('pagseguro/checkout');
    }

    public function checkout()
    {
        //
        $carrinho = null;

        if (Session::has("carrinho")) {
            //
            $carrinho = Session::get("carrinho");

        }else{
            $carrinho = null;
        }

        $userId = Auth::user()->id;

        $card = CardCredit::with('jogadors')->where(["jogador_id" => $userId])->get();


        return view('pages.checkoutpagseguro')->with(["cards" => $card, "carrinho"=> $carrinho]);
    }

    public function carrinho()
    {
        //

        return view('pages.carrinhopagseguro');
    }

    public function salveCard(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'numero' => 'required',
            'bandeira' => 'required',
            'validacao' => 'required',
            'cvv' => 'required',
            'cpf' => 'required'

        ]);
        if ($validatedData->fails()) {
            return redirect('jogador/cadastrar-credit')
                ->withErrors($validatedData)
                ->withInput();
        }

        $name = $request->input("name");
        $numero = $request->input("numero");
        $bandeira = $request->input("bandeira");
        $validacao = $request->input("validacao");
        $cvv = $request->input("cvv");
        $cpf = $request->input("cpf");

        $card = new CardCredit([
            "name" => $name,
            "number" => $numero,
            "bandeira" => $bandeira,
            "validade" => $validacao,
            "cvv" => $cvv,
            "cpf" => $cpf,
        ]);

        $id = Auth::user()->id;
        $userSalve = Jogador::find($id);


        $saved = $userSalve->cardCredit()->save($card);

        if ($saved) {
            return redirect('pagseguro/checkout')->with('success', 'Cartão cadastrado com sucesso');
        }
        return redirect('pagseguro/checkout')->with('error', 'Error ao cadastrar dados');
    }

    public function comprafinalizada(Request $request)
    {
        $validatedData = Validator::make($request->all(), [

            'endereco' => 'required',
            'cep' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required'

        ]);

        if ($validatedData->fails()) {
            return redirect('pagseguro/checkout')
                ->withErrors($validatedData)
                ->withInput();
        }

       if($request->input("typePagamento") == null){
           return redirect('pagseguro/checkout')->with('error', 'Escolha uma forma de pagamento');
       }

       $pagamento = new Pagamento();

        $tipo = $request->input("typePagamento");
        $endereco = $request->input("endereco");
        $cep = $request->input("cep");
        $bairro = $request->input("bairro");
        $cidade = $request->input("cidade");
        $estado = $request->input("estado");

      $code = $request->input("code") != null ?  $request->input("code"): null;

        if($code != null){
            $where= ['code'=> $code];
            $jogadoCode = Jogador::where($where)->first();
            if(!isset($jogadoCode) && (Auth::user()->code == $jogadoCode)){
                $code = null;
            }
        }

        $pagamento->setCode($code);

        $pagamento->setCep($cep);
        $pagamento->setEndereco($endereco);
        $pagamento->setBairro($bairro);
        $pagamento->setCidade($cidade);
        $pagamento->setEstado($estado);

        $valorTotal = $request->input("valorTotal");

        $jogador = Jogador::find(Auth::user()->id);

        $order = New OrderPedido(
            [
                "endereco"=>$endereco,
                "code"=> $code,
                "cep"=>$cep,
                "bairro"=>$bairro,
                "cidade"=>$cidade,
                "estado"=>$estado,
                "valor_total"=> $valorTotal,
                "typePedido" => 1

            ]
        );

        $name =  Auth::user()->name;

        $saved =  $jogador->order()->save($order);
        $hasCard = $request->input("hasCard");


        if ($tipo == "card") {

            $order->typePedido = 1;


            if($request->input("qtdParcela") == null){
                return redirect('pagseguro/checkout')->with('error', 'Informe uma parcela');
            }

            $tokencard = $request->input("tokencard");

            $valorParcela = $request->input("valorParcela");
            $qtdParcela = $request->input("qtdParcela");
            $idCard = $request->input("idCard");


            $qtd = $request->input("qtd");


            $card = CardCredit::find($idCard);
            $cpf = explode(".", $card->cpf);
            $cpf2 = explode("-", $cpf[2]);
            $cpf_completo = $cpf[0].$cpf[1].$cpf2[0].$cpf2[1];

            $pagamento->setCpf($cpf_completo);
            $pagamento->setValorTotal($valorTotal);
            $pagamento->setIdCard($idCard);
            $pagamento->setQtdParcela($qtdParcela);
            $pagamento->setTokencard($tokencard);
            $pagamento->setPaymentMethod("creditCard");
            $pagamento->setHasCard($hasCard);
            $pagamento->setQtd($request->input("qtd"));
            $pagamento->setOrderId($saved->id);
            $pagamento->setValorParcela($valorParcela);



            $jogador->notify(new OrderPedidoNotification($saved));

        }else {



            $Data["paymentMethod"]="boleto";



        }


        dispatch(new ComprarJob($pagamento, $jogador));
        Session::forget('carrinho');

        return redirect('pagseguro/checkout')->with('success', 'Estamos processando sua transação breve recebera um e-mail');


    }
    public function  salvar($id, Request $request){

        $order = OrderPedido::find($id);

        $transacao = new Transacao([ "status" => $request->input('status')]);

      $salved =   $order->transacao()->save($transacao);
        Session::forget('carrinho');
        if($salved){
            return response()->json(["status"=> true]);
        }
        return response()->json(["status"=> false]);
    }


    public function notificacaopagseguro(Request $request){

        $url= "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/{$request->input('notificationCode')}?email={$this->email}&token={$this->token_sendbox}";



        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $transaction= curl_exec($curl);
        curl_close($curl);

        $Xml = simplexml_load_string($transaction);

       $trasancao =  OrderPedido::find($Xml->reference)->transacao;


        if ($trasancao != null){
            $trasancao->status = $Xml->status;
            $trasancao->save();
        }

    }


    public  function remove(){
        Session::forget('carrinho');
        return redirect('pagseguro/checkout')->with('success', 'Carrinho removido com sucesso');
    }
}
