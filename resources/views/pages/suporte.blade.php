@extends('layouts.default')


@section('content')
    @include('includes.menu')
    <div class="box-geral">
        <h1>CENTRAL DE SUPORTE</h1>
        <div class="row">
            <div class="col-sm-8">
                <div class="left-suporte">
                    <p>Para simplificar os pedidos de suporte e melhor atendê-lo, utilizamos um sistema de tickets de suporte. Cada solicitação que nosso suporte recebe, gera um número de ticket exclusivo que você pode usar para rastrear o progresso e respostas on-line. Para sua referência, fornecemos arquivos completos e histórico de todas as suas solicitações de suporte. É necessário estar logado em sua conta para enviar um ticket.</p>
                </div>
            </div>
            <div class="col-sm-4">
                <!--<button class="btn btn-ticket color-abrir"  type="button">ABRIR TICKET</button>-->
                <a href="{{url("suporte/create")}}" class="btn btn-ticket color-abrir">
                    ABRIR TICKET
                </a>
                <a href="{{url("suporte/suporte-lista")}}" class="btn btn-ticket color-status">
                    STATUS TICKET
                </a>
            </div>
        </div>
    </div>
@stop
