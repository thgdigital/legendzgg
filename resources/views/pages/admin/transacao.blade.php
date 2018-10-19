@extends('layouts.admin')


@section('content')
    <section class="content-header">
        <h1>
           Transações
            <small>Controler deTransações</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Transações</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">


            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Transações</h3>

                </div>
                <div class="box-body">
                    <list-transacoes></list-transacoes>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer-->
                </div>

    </section>
    <!-- /.content -->

@stop
