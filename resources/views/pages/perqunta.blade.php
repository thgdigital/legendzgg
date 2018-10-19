@extends('layouts.default')


@section('content')
    @include('includes.menu')
    <div class="box-suporte">


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
            <h1>CENTRAL DE SUPORTE - ABRIR NOVO TICKET</h1>
            <span class="sub-title">Por favor, preencha todos os campos do formulário abaixo. </span>
        <form role="form" action="{{ route('suporte.salvar') }}" method="post" name="UserCreateForm">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tópico de Ajuda:
                            <select class="form-control"  name="topico" >
                                <option value="">Selecione um Tópico</option>
                                <option value="1">COMPRA DE CRÉDITOS</option>
                                <option value="2">CONTA</option>
                                <option value="3">LOJA</option>
                                <option value="4">RIFA</option>
                                <option value="5">SAQUE</option>
                            </select>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Outros:
                            <input type="text" class="form-control" name="SuporteOutros">
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Detalhes do Ticket:
                    <small class="redcolor">*</small>
                </label>
                <textarea class="form-control" name="SuporteDetalhes" placeholder="Digite.." rows="7" required=""></textarea>
            </div>

            <div class="footer-button">
                <button class="btn btn-suporte" name="SendPostForm" value="" type="submit">Enviar
                </button>
                <a href="{{url('suporte')}}" class="btn btn-suporte right">
                    RETORNAR
                </a>
            </div>

        </form>

    </div>
@stop
