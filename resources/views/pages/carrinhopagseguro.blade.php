@extends('layouts.default')
@section('pageTitle', 'Carrinho de compras')
@section('content')
    @include('includes.menu')

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
            <h3>Seu carrinho de compras</h3>
<table class="table ">

        <thead>
        <tr>
                <th scope="col">Descrição</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Valor Unitário</th>
                <th scope="col">Valor Total</th>
        </tr>
        </thead>


        <tbody>
<tr>
    <td><span class="valor_credito">1 credito</span></td>
    <td>
        <div class="botoes_result">
            <button class="btn btn-default" id="butto_decremento"><i class="fas fa-minus"></i></button>
            <div id="result_total"><span class="qtd_carrinho">1</span></div>
            <button class="btn btn-default" id="butto_incremento"><i class="fas fa-plus"></i></button>

        </div>


    </td>
    <td><span class="valor_unitario">R$ 1,00</span></td>
    <td><span class="valor_total">R$ 1,00</span></td>
</tr>
        </tbody>

</table>
            <form name="formCarrinho" method="POST" action="{{ route('pagseguro.salveCarrinho') }}">

                {{ csrf_field() }}

                <input type="hidden" name="qtd"  id="form_qtd" value="1" class="form-control">

                <input type="hidden" name="valor_unitario" class="form-control" id="form_unitario" value="1">

                <button type="submit" class="btn btn-primary btn-sm"style="float: right">Finalizar a compra</button>
            </form>

    </div>
@stop
@push('scripts')
<script src="{{ asset('assets/js/carrinho.js') }}"></script>
@endpush