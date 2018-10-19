@extends('layouts.default')
@section('pageTitle', 'Cadastrar cartão')
@section('content')


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
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif
            <form name="cadastroJogado" id="editJogado" enctype="multipart/form-data" method="POST" action="{{ route('jogador.saveCreditCard') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name" class="control-label">Nome cadastrado no cartão *</label>
                            <input type="text" name="name" class="form-control form-control1" id="name"
                                   placeholder="Digite nome cadastrado no cartão "
                                   value="" required>
                        </div>
                    </div>
                    <div class="col-sm-6">

                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-group">
                            <label for="numero" class="control-label">Numero do cartão*</label>
                            <input type="text" name="numero" class="form-control form-control1" id="numero"
                                   placeholder="Digite numero do cartão"
                                   maxlength="16"
                                   value="" required>
                                </div>
                            </div>
                                <div class="col-sm-2">
                                    <div class="bandeira_cartao"></div>
                                </div>
                        </div>



                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-10">
                                    <label for="bandeira" class="control-label">Nome da bandeira do cartão *</label>
                                    <input type="text" name="bandeira" class="form-control form-control1" id="bandeira"
                                           placeholder="Digite bandeira do cartão"
                                           value="" required>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="validacao" class="control-label">Validade do cartão*</label>
                            <input type="text" name="validacao" class="form-control form-control1" id="validacao"

                                   data-mask="00/0000"
                                   data-mask-clearifnotmatch="true" placeholder="__/____"
                                   value="" required>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cvv" class="control-label">CVV *</label>
                            <input type="text" name="cvv" class="form-control form-control1" id="cvv"
                                   placeholder="Digite cvv do cartão"
                                   maxlength="3"
                                   minlength="3"
                                   value="" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cpf" class="control-label">CPF do titular do cartão*</label>
                            <input type="text" name="cpf" class="form-control form-control1" id="cpf"

                                   data-mask="000.000.000-00"
                                   data-mask-clearifnotmatch="true" placeholder="___.___.___-__"
                                   value="" required>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" id="btn_cadastrar_cartao" class="btn btn-primary btn-md ">Salvar cartão
                        </button>
                    </div>
                </div>
            </form>
    </div>
@stop
@push('scripts')
<script src="{{ asset('assets/js/cadCredit.js') }}"></script>
@endpush