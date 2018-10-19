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

            @isset($users)
            <table class="table table-bordered  table-responsive table-hover">
                <tr>
                    <th>ID</th>
                    <th>E-mail</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>

                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>

                    <td>{{$user->email}}</td>
                    <td><?php echo date('d/m/Y', strtotime($user->created_at))?></td>
                    <td>
                        <?php if($user->verified == 1){?>
                        <span class="label label-success">Ativo</span></td>
                    <?php }else{?>
                    <span class="label label-danger">Desativado</span></td>
                    <?php }?>
                    <td>
                        <a href="{{url("admin/administradores/edit/$user->id")}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                        <a href="{{url("admin/administradores/imagem/$user->id")}}" class="btn btn-primary btn-xs"><i class="fa fa-upload"></i></a>
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
