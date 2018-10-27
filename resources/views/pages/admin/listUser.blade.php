@extends('layouts.admin')


@section('content')


    <!-- Main content -->
    <section class="content">

    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Lista de Usuarios</h3>


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
            @isset($users)
            <table class="table table-bordered  table-responsive table-hover">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>E-mail</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>

                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td><?php echo date('d/m/Y', strtotime($user->created_at))?></td>
                    <td>
                        <?php if($user->verified == 1){?>
                        <span class="label label-success">Verificado</span></td>
                    <?php }else{?>
                    <span class="label label-danger">não verificado</span></td>
                    <?php }?>
                    <td>
                        <a href="{{url("admin/user/edit/$user->id")}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                        <a href="{{url("admin/user/transacao/$user->id")}}" class="btn btn-success btn-xs"><i class="fa fa-money"></i></a>
                        <button type="button" data-toggle="modal" data-target="#exampleModal-<?php echo $user->id; ?>" class="btn btn-success btn-xs"><i class="fa fa-fw fa-dollar"></i></button>




                            <!-- Modal -->
                        <div class="modal fade" id="exampleModal-<?php echo $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Inserir Credito</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formCredit" method="POST" action="{{route('usuarios.credit')}}">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label>Inserir crédito</label>

                                                <input type="hidden" name="idUser" id="idUser" value="{{$user->id}}">

                                                <input type="number" class="form-control" name="valor" id="credit" placeholder="Digite o Valor" required>
                                            </div>

                                            <input type="submit" id="inserirValor" class="btn btn-primary btn-lg" value="Inserir valor">
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>



                        {{--<a href="#" class="btn btn-warning btn-xs"><i class="fa fa-sitemap"></i></a>--}}
                        {{--<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>--}}
                    </td>
                </tr>
                @endforeach

            </table>

            @endisset
            </div>

        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- /.box-footer-->
        </div>

    </section>
    <!-- /.content -->

@stop
