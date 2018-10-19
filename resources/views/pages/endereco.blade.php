@extends('layouts.default')
@section('pageTitle', 'Editar ou cadastrar endereços')
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
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif

            <?php
                $cep = "";
                $endereco = "";
                $bairro = "";
                $cidade = "";
                $estado = "";

            ?>

            @isset($enderecos)

                <?php

                $cep = $enderecos->cep;
                $endereco = $enderecos->endereco;
                $bairro = $enderecos->bairro;
                $cidade = $enderecos->cidade;
                $estado = $enderecos->estado;
              ?>



            @endisset


        <form name="cadastroJogado" id="cadastroEndereco"  method="POST" action="{{ route('jogador.salveEndereco') }}">
            {{ csrf_field() }}
            <div class="row">

                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="name" class="control-label">Cep  *
                            <span id='mensagem'></span>
                        </label>
                        <input type="text" class="form-control form-control1" id="cep"
                               data-mask="00000-000"
                               data-mask-clearifnotmatch="true"
                               placeholder="Digite seu Cep completo" value="<?php echo $cep;?>" name="cep"

                               required>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="endereco" class="control-label">Rua *</label>
                        <input type="text" name="endereco" class="form-control form-control1" id="endereco"
                               placeholder="Digite sua rua "
                               value="<?php echo $endereco;?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="bairro" class="control-label">Bairro *</label>
                        <input type="text" class="form-control form-control1" id="bairro"
                               placeholder="Digite seu bairro " name="bairro"
                               value="<?php echo $bairro;?>" required="">
                    </div>
                </div>

            </div>


            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="cidade" class="control-label">Cidade *</label>
                        <input type="text" class="form-control form-control1" id="cidade" name="cidade"
                                placeholder="Digite sua cidade"
                               value="<?php echo $cidade;?>" required="">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="estado" class="control-label">Estado *</label>
                        <!--Token para proteção contra csrf-->

                        <input type="text" class="form-control form-control1" id="estado"
                               placeholder="Digite sua UF" name="estado"
                               value="<?php echo $estado;?>" required="">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-6">
                    <button type="submit" id="btn_cadastrar_assinante" class="btn btn-primary btn-md ">Atualizar dados
                    </button>
                </div>
            </div>
        </form>
    </div>
@stop
@push('scripts')
<script src="{{ asset('assets/js/cadastroEndereco.js') }}"></script>
@endpush