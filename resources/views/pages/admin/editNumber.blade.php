@extends('layouts.admin')


@section('content')
    <section class="content-header">
        <h1>
            Editar bilhete
            <small>Edição de Bilhetes</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Editar bilhete</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Editar bilhete</h3>

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
                @isset($numbes)

                <form method="POST" action="{{url('admin/items/form-number')}}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input name="numberId" value="{{$numbes->id}}" type="hidden">
                                <input name="itemId" value="{{$numbes->items_id}}" type="hidden">
                                <input name="jogadorId" value="{{$numbes->jogador_id}}" type="hidden">
                                <input name="number" type="number" value="{{$numbes->numeber}}" class="form-control" required placeholder="Digite numero do bilhete">

                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Alterar dados" class="btn btn-primary">
                </form>
                @endisset


            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {{--Footer--}}
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@stop