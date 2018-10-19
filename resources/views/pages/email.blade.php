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
            <form class="form-horizontal" method="POST" action="{{ url('/seller_password/email') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Enviar o link de redefinição de senha
                        </button>
                    </div>
                </div>
            </form>
    </div>
@stop
@push('scripts')
<script src="{{ asset('assets/js/cadastroValidate.js') }}"></script>
@endpush