@extends('layouts.admin')


@section('content')


    <!-- Main content -->
    <section class="content">

    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Criar cadastro de Admin</h3>


            </div>

        <div class="box-body table-responsive ">

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
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" id="salvarAdmin" action="{{route('administradores.salvar')}}">
                {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nome</label>
                                <input class="form-control" id="name" name="name" value="" placeholder="Digite nome" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Ativação</label>
                                <select class="form-control" name="status" required>
                                    <option value="">Selecione um status</option>
                                    <option value="1" >Ativo</option>
                                    <option value="0">Desativado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input class="form-control" name="email" value=""  type="text" placeholder="Digite e-mail" required>
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Senha</label>
                                <input class="form-control" name="senha" value="" id="senha" type="password" placeholder="Digite senha" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Confirma senha</label>
                                <input class="form-control" type="password" name="confirma_senha" value="" placeholder="Digite code" required>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-default btn-sm" href="{{url('admin/administradores')}}">Voltar a página</a>
                    <input type="submit" class="btn btn-primary btn-sm" value="Salvar Dados">
                </form>

            </div>

        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- /.box-footer-->
        </div>

    </section>
    <!-- /.content -->
    @push('scripts')

    <script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/admin/cadastroAdminValidate.js') }}"></script>
    @endpush
@stop
