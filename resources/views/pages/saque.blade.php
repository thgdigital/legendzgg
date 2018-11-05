@extends('layouts.default')
@section('pageTitle', 'Saque')
@section('content')
    @include('includes.menu')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-warning">
            {{ session('status') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>

    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<?php

$valorSaldo =  Auth::user()->saldo->saldo != null ? Auth::user()->saldo->saldo : 0;
$valoressencia =  Auth::user()->saldo->essencia != null ? Auth::user()->saldo->essencia : 0;

$saldo =   str_replace(".", ",", $valorSaldo);
$essencia =  str_replace(".", ",",$valoressencia);
        ?>

    <div class="box-saque">
        <h1>SAQUE</h1>
        <form method="POST" action="{{url('loja/saque-salvar')}}" id="formSaque">
            {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-6">
                <div class="left-saque">

                        <div class="form-saque">
                            <span>Saldo atual  $</span>
                            <input name="saldo" value="{{$saldo}}" disabled="disabled"/>
                        </div>
                        {{--<div class="form-saque">--}}
                            {{--<span>Disponível para levantamento  $</span>--}}
                            {{--<input name="saldo" value=""/>--}}
                        {{--</div>--}}

                        <div class="form-saque">
                            <span>Valor solicitado (min.$5 / max.$20)  $</span>
                            <input type="number" name="regaste" value="" size="2"  required/>
                        </div>
                        <div class="form-saque">
                            <span>Saque através do</span>
                        <select class="form-control" name="tipo" required>
                            <option value="">Selecione um tipo de conta</option>
                            <option value="1">Pagseguro</option>
                            <option value="2">PayPal</option>
                        </select>
                        </div>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="right-saque">
                    <p>Os fundos serão creditados na sua conta  PagSeguro em até 5 dias, após o saque.</p>
                    <p>Taxas extras podem ser cobradas pelo  PagSeguro para que seja feita sua transferência.</p>
                    <p>ATENÇÃO! O site não se responsabilizará pelo envio de informações prestadas pelo assinante de forma errada ou incompleta, cabendo a este último preencher os dados corretamente.</p>
                    <div class="descricao-promo">
                        <span class="title">LIMITE DE SAQUE EXCEDIDO</span>
                        <span class="title-sub">próximo saque em</span>
                        <span class="title-red">7 dia(s)</span>

                    </div>
                </div>

            </div>
        </div>
        <div class="saque-footer">
            <button type="submit" class="btn btn-primary btn-suporte">REALIZAR SAQUE</button>
        </div>
        </form>
    </div>


@stop
@push('scripts')
<style type="text/css">
    .error{
        color: red;
    }
    .box-saque .left-saque input.error{
        border-color: red;
    }
</style>
<script>
    $(function () {
        $("#formSaque").validate({
            rules: {
                regaste:{
                    required: true,
                    number:true



                },
            },
            messages: {
                regaste: {
                    required: "Campo valor solicitado obrigatório"
                },
                tipo:{
                    required: "Selecione um tipo de conta",
                }
            }
        });
    })

</script>
@endpush