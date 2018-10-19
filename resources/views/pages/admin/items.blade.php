@extends('layouts.admin')


@section('content')

    @isset($rifas)


    @foreach($rifas as $rifa)

        <section class="content-header">
            <h1>
                {{$rifa->name}}
                <small>Controler de itens {{$rifa->name}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{$rifa->name}}</li>
            </ol>
        </section>
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Lista de Itens</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                <list-items name="{{$rifa->name}}"></list-items>



            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {{--Footer--}}
                <a href="{{url('admin/rifas/'.strtolower($categoria->name))}}" v-b-tooltip.hover title="I'm a tooltip!" class="btn btn-default btn-xs">Voltar pagina</a>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
    @endforeach
    @endisset
@stop
