@extends('layouts.admin')


@section('content')


    <!-- Main content -->
    <section class="content">

    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Lista de compra loja</h3>
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


            @isset($lojas)

            <table class="table table-bordered">
                <thead>
                <tr>

                    <th>Tipo de Compra</th>
                    <th>Usuario</th>
                    <th>Item</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lojas as $loja)
                    <tr>
                        <td>
                            @if($loja->valor_credito == 1)
                                <span class="label label-primary">Valor de crédito</span>
                            @elseif($loja->valor_resgate == 1)
                                <span class="label label-primary">Valor de regaste</span>
                            @elseif($loja->valor_essencia == 1)
                                <span class="label label-primary">Valor de Essencia</span>
                            @endif
                        </td>
                        <td>{{$loja->username}}</td>
                        <td>{{$loja->name}}</td>
                        <td></td>
                    </tr>

                @endforeach

                </tbody>
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
