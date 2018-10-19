@extends('layouts.login')


@section('content')

    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}"><b>Legendzgg</b></a>
        </div>

        <!-- /.login-logo -->
        <div class="login-box-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{--<p class="login-box-msg">Sign in to start your session</p>--}}

            <form  method="POST" name="login" action="{{ url('admin/send-login') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email"  name="email" value="{{ old('email') }}" class="form-control" placeholder="Digite seu e-mail">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" name="password" placeholder="Digite sua senha">

                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Realizar Login</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    @push('scripts')
    <script src="{{ asset('assets/js/login/login.js') }}"></script>
    @endpush
@stop
