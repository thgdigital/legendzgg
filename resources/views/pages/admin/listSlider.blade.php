@extends('layouts.admin')


@section('content')


    <!-- Main content -->
    <section class="content">

    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Lista de Imagens</h3>
                <div class="box-tools pull-right">
                    <!-- Button trigger modal -->
                    <a href="{{url('admin/loja/slider-compra-create')}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Adicionar nova imagem
                    </a>
                </div>

            </div>

        <div class="box-body table-responsive ">

            @isset($imagens)
            <table class="table table-bordered  table-responsive table-hover">
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>

                @foreach ($imagens as $imagem)
                <tr>
                    <td>{{$imagem->id}}</td>
                    <td>

                        <img class="d-block w-100"
                             src="<?=Croppa::url('/storage/slider/'.$imagem->imagem, 100, 100)?>"/>

                    </td>
                    <td>
                        <a href="{{url("admin/loja/slider-compra-delete/$imagem->id")}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>

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
