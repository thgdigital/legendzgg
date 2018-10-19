<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use Paypal\Rest\ApiContext;
use Illuminate\Support\Facades\Input;
use PayPal\Api\PaymentExecution;
use App\Models\OrderPedido;
use App\Models\Jogador;
use App\Models\Transacao;
use App\Models\Pagamento;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Validator;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\URL;



class PayPalController extends Controller
{
    private  $_api_context;
    //
    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context =  new \PayPal\Rest\ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function salvar(Request $request){

        $carrinho = Session::get("carrinho");

        $code = $request->input("code") != null ?  $request->input("code"): null;

        if($code != null){
            $where= ['code'=> $code];
            $jogadoCode = Jogador::where($where)->first();
            if(!isset($jogadoCode) && (Auth::user()->code == $jogadoCode)){
                $code = null;
            }
        }

        $valorTotal = $request->input("valorTotal");



        $order = New OrderPedido(
            [
                "endereco"=>null,
                "code"=> $code,
                "cep"=>null,
                "bairro"=>null,
                "cidade"=>null,
                "estado"=>null,
                "valor_total"=> $valorTotal,
                "typePedido" => 2

            ]
        );
        $jogador = Jogador::find(Auth::user()->id);

        $saved =  $jogador->order()->save($order);

        $request->session()->put("order", $saved);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Compar credito 1') /** item name **/
        ->setCurrency('BRL')
            ->setQuantity($carrinho['qtd'])
            ->setPrice('1'); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('BRL')
            ->setTotal($carrinho['valor_unitario']);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Comprar de credito');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('paypal.status')) /** Specify return URL **/
        ->setCancelUrl(URL::route('paypal.status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return redirect('pagseguro/checkout')->with('error', 'Error tempo de conexão ');
            } else {

                return redirect('pagseguro/checkout')->with('error', 'Algum erro ocorre, desculpe por inconveniente');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }

        return redirect('pagseguro/checkout')->with('error', 'Opps ocorreu algum error');
    }


    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        Session::forget('carrinho');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            return redirect('pagseguro/checkout')->with('error', 'Pagamento não concluido');
        }

        $payment_id = Input::get('paymentId');
        $playID = Input::get('PayerID');


        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($playID);


        $orderSession = Session::get("order");

        $order = OrderPedido::find($orderSession['id']);



        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            $transacao = new Transacao([ "status" => 3]);
            $order->transacao()->save($transacao);
            Session::forget('order');

            return redirect('pagseguro/checkout')->with('success', 'Pagamento concluido com sucesso');
        }
        $transacao = new Transacao([ "status" => 7]);
        $order->transacao()->save($transacao);
        Session::forget('order');
        return redirect('pagseguro/checkout')->with('error', 'Pagamento não concluido');

    }

}
