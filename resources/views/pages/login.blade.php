@extends('layouts.default')
@section('pageTitle', 'Login')
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

            @if (session('authError'))
                <div class="alert alert-warning">
                    {{ session('authError') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif
            <form class="form-horizontal" id="formLogin" method="POST" name="login" action="{{ route('jogador.auth.login') }}">
                {{ csrf_field() }}
                <div class="row">
                    <br/>
                    <br/>
                    <div class="form-group{{ $errors->has('authError') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-mail* </label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   required >
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('authError') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Senha *</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required minlength="6">


                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" id="login">
                                Login
                            </button>


                        </div>
                    </div>
                </div>
                <div class="footer-cadastro">
                    <a class="btn btn-link" style="color: #ffffff" href="{{ route('jogador.email') }}">
                        Esqueceu sua senha ?
                    </a>
                    <a class="btn btn-link" style="color: #ffffff" href="{{ url('cadastro') }}">
                        Criar cadastro
                    </a>
                </div>
            </form>
    </div>
@stop
@push('scripts')
<script src="{{ asset('assets/js/cadastroValidate.js') }}"></script>
@endpush