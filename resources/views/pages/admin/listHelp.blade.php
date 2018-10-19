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

            @isset($suportes)
            <table class="table table-bordered  table-responsive table-hover">
                <tr>
                    <th>ID</th>
                    <th>Topico</th>
                    <th>Status</th>
                    <th>Detalhe</th>
                    <th>Outro</th>
                    <th>Username</th>

                    <th>Ações</th>
                </tr>
                @foreach ($suportes as $suporte)
                <tr>
                    <td>{{$suporte->id}}</td>
                    <td>
                        <?php if($suporte->topico == 1){?>
                            <span class="label label-default">COMPRA DE CRÉDITOS</span>
                            <?php }elseif($suporte->topico == 2){?>
                            <span class="label label-default">CONTA</span>
                            <?php }elseif($suporte->topico == 3){?>
                            <span class="label label-default">LOJA</span>
                            <?php }elseif($suporte->topico == 4){?>
                            <span class="label label-default">RIFA</span>
                            <?php }else{?>
                            <span class="label label-default">SAQUE</span>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if($suporte->status == 1){?>
                        <span class="label label-default">Aberto</span>
                        <?php }elseif($suporte->status == 2){?>
                        <span class="label label-warning">Respondido</span>
                        <?php }elseif($suporte->status == 3){?>
                        <span class="label label-danger">Fechado</span>

                        <?php } ?>
                        </td>
                    <td>{{$suporte->detalhe}}</td>
                    <td>{{$suporte->outro}}</td>
                    <td>
                        @isset($suporte->jogador)
                        {{$suporte->jogador->username}}
                        @endisset
                    </td>

                    <td>
                        <a href="{{ url("admin/suporte/resposta/".$suporte->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-unlink"></i></a>

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
