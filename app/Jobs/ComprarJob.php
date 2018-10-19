<?php

namespace App\Jobs;

use App\Models\CardCredit;
use App\Models\Jogador;
use App\Models\OrderPedido;
use App\Models\Pagamento;
use App\Models\Transacao;
use App\Notifications\OrderPedidoNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ComprarJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected  $pagamento;
    public $tries = 3;

    private $url = "https://ws.sandbox.pagseguro.uol.com.br";
    private $email = "dvb.business@gmail.com";
    private $token_pagSeguro = "A9A590D499884B52844EF4A11F8C2D4C";
    private $token_sendbox = "C5112C45B6D243F998D90F8E0E190D00";

    private  $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Pagamento $pagamento, Jogador $jogador)
    {
        //
        $this->pagamento = $pagamento;
        $this->user = $jogador;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //

        $endereco = $this->pagamento->getEndereco();
        $cep = $this->pagamento->getCep();
        $bairro = $this->pagamento->getBairro();
        $cidade = $this->pagamento->getCidade();
        $estado = $this->pagamento->getEstado();
        $code = $this->pagamento->getCode();

        $valorTotal = $this->pagamento->getValorTotal();

        $jogador = $this->user;



        $name =  $this->user->name;


        $hasCard = $this->pagamento->getHasCard();


        $Data["email"]=$this->email;
        $Data["token"]=$this->token_sendbox;
        $Data["paymentMode"]="default";
        $Data["receiverEmail"]=$this->email;
        $Data["shippingType"]="1";
        $Data["shippingAddressStreet"]=$endereco;
        $Data["shippingAddressNumber"]='1384';
        $Data["shippingAddressComplement"]='5 Andar';
        $Data["shippingAddressDistrict"]=$bairro;
        $Data["shippingAddressPostalCode"]=$cep;
        $Data["shippingAddressCity"]=$cidade;
        $Data["shippingAddressState"]=$estado;
        $Data["shippingAddressCountry"]="BRA";
        $Data["senderName"]=$name;
        $Data["senderCPF"]='22111944785';
        $Data["senderAreaCode"]='37';
        $Data["senderPhone"]='99999999';
        $Data["senderEmail"]="c41941516612103853193@sandbox.pagseguro.com.br";
        $Data["currency"]="BRL";
        $Data["itemId1"] = $this->pagamento->getOrderId();
        $Data["itemDescription1"] = 'Compra de Crédito';
        $Data["itemAmount1"] = "$valorTotal";
        $Data["itemQuantity1"] = 1;
        $Data["notificationURL="]="http://legendzgg.com/novo/notificacao-pagseguro";
        $Data["receiverEmail"]=$this->email;
        $Data["reference"]=$this->pagamento->getOrderId();

        $Data["senderHash"]=$hasCard;




        if ($this->pagamento->getPaymentMethod() == "creditCard") {




            $tokencard = $this->pagamento->getTokencard();

            $valorParcela = $this->pagamento->getValorParcela();
            $qtdParcela = $this->pagamento->getQtdParcela();
            $idCard = $this->pagamento->getIdCard();


            $qtd = $this->pagamento->getQtd();


            $card = CardCredit::find($idCard);
            $cpf = explode(".", $card->cpf);
            $cpf2 = explode("-", $cpf[2]);
            $cpf_completo = $cpf[0].$cpf[1].$cpf2[0].$cpf2[1];





            $Data["paymentMethod"]="creditCard";


            $Data["shippingType"]="1";
            $Data["shippingCost"]="0.00";
            $Data["creditCardToken"]=$tokencard;
            $Data["installmentQuantity"]=$qtdParcela;
            $Data["installmentValue"]=$valorParcela;
            $Data["noInterestInstallmentQuantity"]=2;
            $Data["creditCardHolderName"]= $card->name;
            $Data["creditCardHolderCPF"]=$cpf_completo;
            $Data["creditCardHolderBirthDate"]='27/10/1987';
            $Data["creditCardHolderAreaCode"]='37';
            $Data["creditCardHolderPhone"]='99999999';
            $Data["billingAddressStreet"]= $endereco;
            $Data["billingAddressNumber"]='1384';
            $Data["billingAddressComplement"]='';
            $Data["billingAddressDistrict"]=$bairro;
            $Data["billingAddressPostalCode"]=$cep;
            $Data["billingAddressCity"]=$cidade;
            $Data["billingAddressState"]=$estado;
            $Data["billingAddressCountry"]="BRA";





        }else {



            $Data["paymentMethod"]="boleto";



        }


        $buildQuery=http_build_query($Data);
        $Url="https://ws.sandbox.pagseguro.uol.com.br/v2/transactions";

        $Curl=curl_init($Url);
        curl_setopt($Curl,CURLOPT_HTTPHEADER,Array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
        curl_setopt($Curl,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($Curl,CURLOPT_POSTFIELDS,$buildQuery);
        $Retorno=curl_exec($Curl);
        curl_close($Curl);

        $Xml =simplexml_load_string($Retorno);


        $oderSave = OrderPedido::find($this->pagamento->getOrderId());

        if($Xml->error->code != null){
            $transacao = new Transacao([ "status" => 7]);

            $oderSave->transacao()->save($transacao);

            Log::error('Error pagemento numb: '.$Xml->error->code);


        }else{
            $transacao = new Transacao([ "status" => 1]);
            $oderSave->transacao()->save($transacao);
            Log::info('Enviado com sucesso ');
        }
//
//
    }
}
