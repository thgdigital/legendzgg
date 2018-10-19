@extends('layouts.default')
@section('pageTitle', 'Finalizar Compra')
@section('content')
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <div class="box-perfil">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-warning">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif

            @if($carrinho)

            <?php

                $var = floatval($carrinho["qtd"]);
                    $qtd = $carrinho["qtd"];
                $valor =  number_format($var, 2, ".", ",");
            ?>
                <h3 style="font-weight: bold;">Valor Total: R$ <span><?php echo number_format($var, 2, ",", "."); ?></span>
                   <br/>
                   <br/>
                    <a href="{{url("pagseguro/remove")}}" class="btn btn-danger"><i class="far fa-trash-alt"></i> Deletar Carrinho</a>
                </h3>

            @else
                <?php
                $qtd = 0;
                $valor = 0;
                ?>
<h3>Seu carrinho esta vazio :(  <a href="{{url("pagseguro/carrinho")}}" class="btn btn-primary"><i class="far fa-shopping-cart"></i> Continuar comprando</a></h3>
            @endif




            @if(Auth::check()&& $carrinho)


                    <h2>Finalizar compras</h2>

                    <?php
                    $cep = "";
                    $endereco = "";
                    $bairro = "";
                    $cidade = "";
                    $estado = "";
                    ?>

                    @if (Auth::user()->endereco != null)

                        <?php
                        $enderecos = Auth::user()->endereco;
                        $cep = $enderecos->cep;
                        $endereco = $enderecos->endereco;
                        $bairro = $enderecos->bairro;
                        $cidade = $enderecos->cidade;
                        $estado = $enderecos->estado;
                        ?>
                    @endif

                        <form method="POST" class="" name="finalizarComprar" id="finalizarComprar" action="{{route("paypal.salvar")}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="typePagamento" value=""  id="typePagamento"/>
                            <input type="hidden" name="tokencard" value="" id="tokencard"/>
                            <input type="hidden" name="idCard" value="" id="idCard"/>
                            <input type="hidden" name="hasCard" value="" id="hasCard"/>
                            <input type="hidden" name="qtdParcela" value="" id="qtdParcela"/>
                            <input type="hidden" name="valorParcela" value="" id="valorParcela"/>
                            <input type="hidden" name="valorTotal" value="<?php echo $valor; ?>" id="valorTotal" />
                            <input type="hidden" name="qtd" value="<?php echo $qtd; ?>" id="qtd" />
                            <input  type="hidden" name="code" id="code" placeholder="CUPOM">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control form-control1" type="text" name="code_user" id="code_user" placeholder="CUPOM">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Forma de pagamento</label>
                            <select name="form" class="form-control" id="formPagamento" required>
                                <option value="">Selecione forma de Pagamento</option>
                                <option value="1">Pagseguro</option>
                                <option value="2">PayPal</option>
                            </select>
                                </div>
                            </div>
                    </div>

               <input class="btn btn-primary btn-sm" type="submit" id="btn_pagamento" value="Efetuar pagamento">

                </form>


            @endif

@stop
@push('scripts')
            <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>


            <script src="{{ asset('assets/js/pagaseguroCheckout.js') }}"></script>
@endpush