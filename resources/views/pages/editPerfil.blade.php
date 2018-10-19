@extends('layouts.default')
@section('pageTitle', 'Criar conta')
@section('content')


    <div class="box-perfil">

        <?php
            $user =  Auth::user();
            $avatar =  Auth::user()->avatar;
        ?>

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
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif
        <form name="cadastroJogado" id="editJogado" enctype="multipart/form-data" method="POST" action="{{ route('jogador.salvar') }}">
            {{ csrf_field() }}
            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name" class="control-label">Nome completo *</label>
                        <input type="text" class="form-control form-control1" id="name"
                               placeholder="Digite seu nome completo" value="{{$user->name}}" name="name" required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nickName" class="control-label">NickName *</label>
                        <input type="text" name="nickName" class="form-control form-control1" id="nickName"
                               placeholder="Digite seu NickName "
                               value="{{$user->username}}" required disabled="disabled">
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="emailCadastro" class="control-label">Email *</label>
                        <input type="email" class="form-control form-control1" id="emailCadastro"
                               placeholder="Digite seu email " name="email"
                               value="{{$user->email}}" required="" disabled="disabled">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nascimento" class="control-label">Data de nascimento *</label>
                        <input type="text" class="form-control form-control1" id="nascimento" name="nascimento"
                               data-mask="00/00/0000"
                               data-mask-clearifnotmatch="true" placeholder="__/__/____"
                               value="<?php echo date('d-m-Y' , strtotime($user->nascimento))?>" required="">
                    </div>
                </div>
            </div>

            <span class="btn btn-primary btn-file">
                    Selecione um arquivo      <input type="file" name="file">
                </span>
            <br/>
            <br/>


            <img src="{{ url("storage/jogadores/{$avatar}")}}" width="100" height="100" style="border: 1px solid #fff">
            <br/>
            <br/>

            <div class="row">
                <div class="col-sm-6">
                    <button type="submit" id="btn_cadastrar_assinante" class="btn btn-primary btn-md ">Atualizar cadastro
                    </button>
                </div>
            </div>
        </form>
    </div>
@stop
@push('scripts')
<script src="{{ asset('assets/js/cadastroValidate.js') }}"></script>
@endpush