<?php
/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 14/08/2018
 * Time: 00:29
 */

namespace App\Models;


class Pagamento
{
    protected   $orderId;
    protected   $code;
    protected   $cpf;
    protected   $cep;
    protected   $endereco;
    protected   $bairro;
    protected   $cidade;
    protected   $estado;
    protected   $valorTotal;
    protected   $valorParcela;
    protected   $qtdParcela;
    protected   $tokencard;
    protected   $idCard;
    protected   $tipo;
    protected   $paymentMethod;
    protected   $hasCard;
    protected  $qtd;

    /**
     * Pagamento constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }



    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param mixed $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param mixed $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getValorTotal()
    {
        return $this->valorTotal;
    }

    /**
     * @param mixed $valorTotal
     */
    public function setValorTotal($valorTotal)
    {
        $this->valorTotal = $valorTotal;
    }

    /**
     * @return mixed
     */
    public function getValorParcela()
    {
        return $this->valorParcela;
    }

    /**
     * @param mixed $valorParcela
     */
    public function setValorParcela($valorParcela)
    {
        $this->valorParcela = $valorParcela;
    }



    /**
     * @return mixed
     */
    public function getQtdParcela()
    {
        return $this->qtdParcela;
    }

    /**
     * @param mixed $qtdParcela
     */
    public function setQtdParcela($qtdParcela)
    {
        $this->qtdParcela = $qtdParcela;
    }

    /**
     * @return mixed
     */
    public function getTokencard()
    {
        return $this->tokencard;
    }

    /**
     * @param mixed $tokencard
     */
    public function setTokencard($tokencard)
    {
        $this->tokencard = $tokencard;
    }

    /**
     * @return mixed
     */
    public function getIdCard()
    {
        return $this->idCard;
    }

    /**
     * @param mixed $idCard
     */
    public function setIdCard($idCard)
    {
        $this->idCard = $idCard;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param mixed $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param mixed $cep
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    /**
     * @return mixed
     */
    public function getHasCard()
    {
        return $this->hasCard;
    }

    /**
     * @param mixed $hasCard
     */
    public function setHasCard($hasCard)
    {
        $this->hasCard = $hasCard;
    }

    /**
     * @return mixed
     */
    public function getQtd()
    {
        return $this->qtd;
    }

    /**
     * @param mixed $qtd
     */
    public function setQtd($qtd)
    {
        $this->qtd = $qtd;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }



}