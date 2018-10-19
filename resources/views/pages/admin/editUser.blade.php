@extends('layouts.admin')


@section('content')


    <!-- Main content -->
    <section class="content">

    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Edição  de Usuarios</h3>


            </div>

        <div class="box-body table-responsive ">
            @isset($user)
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
            <form method="POST" id="formEditUser" action="{{route('usuarios.salvar')}}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$user->id}}" name="idUser">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nome</label>
                                <input class="form-control" id="name" name="name" value="{{$user->name}}" placeholder="Digite nome" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" id="username" name="username" value="{{$user->username}}" placeholder="Digite username" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Data de nascimento</label>
                                <input class="form-control" name="nascimento" value="<?php echo  date('d/m/Y', strtotime($user->nascimento))?>" data-mask="00/00/0000"
                                       data-mask-clearifnotmatch="true" placeholder="__/__/____"

                                       required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Code</label>
                                <input class="form-control" name="code" value="{{$user->code}}" placeholder="Digite code" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Senha</label>
                                <input class="form-control" name="senha" value="" type="password" placeholder="Digite senha">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Ativação</label>
                                <select class="form-control" name="status" required>
                                    <option value="">Selecione um status</option>
                                    <option value="1"  <?php echo $user->verified == 1? 'selected':''; ?>>Ativo</option>
                                    <option value="0" <?php echo $user->verified == 0? 'selected':''; ?>>Desativado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-default btn-sm" href="{{url('admin/user')}}">Voltar a página</a>
                    <input type="submit" class="btn btn-primary btn-sm" value="Salvar Alteração">
                </form>
            @endisset
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
    <script src="{{ asset('assets/js/admin/editUser.js') }}"></script>
    @endpush
@stop
