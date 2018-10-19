@extends('layouts.admin')


@section('content')


    @isset($items)
    <section class="content-header">
        <h1>
            {{$items->name}}
            <small>Editar item</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> Rifas</a></li>
            <li class="active">Item</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Item</h3>

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
                <edit-items id="{{$items->id}}"></edit-items>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{url('admin/rifas/items/'. $items->rifas[0]->id)}}" type="button" class="btn btn-warning btn-sm" title="Voltar">Voltar </a>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->

    @endisset

@stop
