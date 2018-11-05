@extends('layouts.admin')


@section('content')

    @isset($items)
    <section class="content-header">
        <h1>
            {{$items->name}}
            <small>Numeros comprados</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Numeros comprados</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Lista de numeros comprados</h3>


            </div>

            <div class="box-body table-responsive ">
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
                <table class="table table-bordered  table-responsive table-hover">
                    <tr>

                        <th>Valor R.</th>

                        <th>Username</th>
                        <th>Numero</th>
                        <th>Data</th>
                        <th>Açoes</th>
                    </tr>

                    @foreach ($items->jogadors as $user)
                        <tr>

                            <td>R$  <?php echo  number_format($items->valor_rifa, 2, ",", "."); ?></td>
                            <td><span class="label label-primary">{{$user->username}}</span></td>
                            <td><span class="label label-success">{{$user->pivot->numeber}}</span></td>
                            <td><?php echo date('d/m/Y', strtotime($user->pivot->created_at))?></td>
                            <td>
                                <a href="{{url('admin/items/edit-number/'.$user->pivot->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                <a href="{{url('admin/items/delete-number/'.$user->pivot->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
                            </td>
                         </tr>
                    @endforeach

                </table>


            </div>

            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{url('admin/rifas/items/'.$items->id)}}" v-b-tooltip.hover title="I'm a tooltip!" class="btn btn-default btn-xs">Voltar pagina</a>
            </div>
            <!-- /.box-footer-->
        </div>

    </section>
    <!-- /.content -->
    @endisset
@stop
