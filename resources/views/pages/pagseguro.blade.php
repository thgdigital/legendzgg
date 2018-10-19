@extends('layouts.default')
@section('pageTitle', 'Criar conta')
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
        <form name="cadastroJogado" id="cadastroJogado" enctype="multipart/form-data" method="POST" action="{{ route('jogador.create') }}">
            {{ csrf_field() }}
            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name" class="control-label">Nome completo *</label>
                        <input type="text" class="form-control form-control1" id="name"
                               placeholder="Digite seu nome completo" value="" name="name" required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nickName" class="control-label">NickName *</label>
                        <input type="text" name="nickName" class="form-control form-control1" id="nickName"
                               placeholder="Digite seu NickName "
                               value="" required maxlength="6">
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="emailCadastro" class="control-label">Email *</label>
                        <input type="email" class="form-control form-control1" id="emailCadastro"
                               placeholder="Digite seu email " name="email"
                               value="" required="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nascimento" class="control-label">Data de nascimento *</label>
                        <input type="text" class="form-control form-control1" id="nascimento" name="nascimento"
                               data-mask="00/00/0000"
                               data-mask-clearifnotmatch="true" placeholder="__/__/____"
                               value="" required="">
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="senha" class="control-label">Senha *</label>
                        <!--Token para proteção contra csrf-->
                        {{--<input name="_token" type="hidden" value="token_csrf_aqui">--}}
                        <input type="password" class="form-control form-control1" id="senha"
                               placeholder="Digite sua senha" name="senha"
                               value="" required="">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="password_confirmation" class="control-label">Confirma senha*</label>
                        <input type="password" class="form-control form-control1" id="password_confirmation"
                               placeholder="confirma sua senha " value="" name="password_confirmation" required="">
                    </div>
                </div>
            </div>
            <span class="btn btn-primary btn-file">
                    Selecione um arquivo      <input type="file" name="file" id="uploadImage"  onchange="PreviewImage()">
                </span>
            <br/>
            <br/>
            <img id="uploadPreview" style="width: 100px; height: 75px;" />
            <br/>
            <div class="form-check">
                <div class="form-group">
                    <label class="form-check-label" for="accet">

                        <a href="#">LI E CONCORDO COM OS TERMOS DE USO</a>

                    </label>
                    <input class="form-check-input" type="checkbox" name="accet" value="1" id="accet">
                </div>
            </div>
            <div class="form-check">
                <div class="form-group">
                    <label class="form-check-label" for="topic">

                        DECLARO TER MAIS DE 18 ANOS DE IDADE

                    </label>
                    <input class="form-check-input" type="checkbox" value="1" name="topic" id="topic">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <button type="submit" id="btn_cadastrar_assinante" class="btn btn-primary btn-md ">Criar cadastro
                    </button>
                </div>
            </div>
        </form>
    </div>
@stop
@push('scripts')
<script src="{{ asset('assets/js/cadastroValidate.js') }}"></script>
@endpush