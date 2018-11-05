@extends('layouts.admin')


@section('content')



    <!-- Main content -->
    <section class="content">
        @isset($categoria)

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Rifas</h3>

                    <div class="box-tools pull-right">

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus"></i> Adicionar nova rifa
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="box-title" id="exampleModalLabel">Criar nova Rifa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <nova-rifa id="{{$categoria->id}}"></nova-rifa>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar Tela</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="box-body">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Tipo</th>
                            <th>Nome</th>
                            <th>Valor Rifa</th>
                            <th>N de rifa</th>
                            <th>Progresso</th>
                            <th>Data inicial</th>
                            <th>Data final</th>
                            <th>Vencedor</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>

                        @isset($rifas)

                        @foreach($rifas as $rifa)
                        <tr>

                            <?php
                            $imagam = null;
                                $tipo = null;
                                $valorRifa = null;
                                $num_rifias = null;
                                $idItem = null;
                                $dateInicial = date('d/m/Y', strtotime($rifa->date_inicio));
                                $dateFim = date('d/m/Y', strtotime($rifa->date_fim));
                            $vencedor = null;
                            $total = 0;

                            if(count($rifa->items) > 0){




                                    $imagam = $rifa->items[0]->imagem;
                                    $tipo = $rifa->items[0]->tipo->name;
                                    $valorRifa = $rifa->items[0]->valor_rifa;
                                    $num_rifias = $rifa->items[0]->num_rifias;
                                    $idItem = $rifa->items[0]->id;

                                $total = round($rifa->items[0]->jogadors->count() * 100 / $num_rifias) ;
                                if($rifa->is_fechada == 1){
                                     $vencedor = $rifa->items[0]->jogadors()->wherePivot('numeber', $rifa->sorteio)->first();
                                }

                                }


                                ?>


                            <td>



                                <img width="80" height="80" src="<?=

                                Croppa::url("/storage/rifas/$imagam", 80,80)?>" />


                            </td>
                                <td>{{$rifa->name}}</td>
                                <td> <span class="label label-info">{{$tipo}}</span></td>
                                <td>
                                    R$  <?php echo  number_format($valorRifa, 2, ",", "."); ?>
                                </td>
                                <td>{{$num_rifias}}</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-primary"
                                             style="width: <?php echo  $total?>%"

                                        ></div>
                                    </div>
                                </td>
                                <td>{{$dateInicial}}</td>
                                <td>{{$dateFim}}</td>
                                <td>
                                    @isset($vencedor)
                                    <span class="label label-success">{{$vencedor->username}}</span>

                                    @endisset
                            </td>
                            <td>
                                <?php if($rifa->is_fechada == 0){?>
                                <span class="label label-success">Em andamento</span>
                                <?php }else{?>
                                <span class="label label-danger">Finalizada</span>
                                <?php }?>
                            </td>
                            <td>
                                <a href="{{url("admin/rifas/edit/".$rifa->id)}}" v-b-tooltip.hover title="I'm a tooltip!" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i></a>

                                <a href="{{url("/admin/rifas/items/".$rifa->id)}}" class="btn btn-primary  btn-xs"><i class="fa  fa-sitemap"></i></a>
                                <a href="{{url("/admin/items/number/".$idItem)}}" class="btn btn-primary  btn-xs"><i class="fa  fa-bookmark-o"></i></a>
                            </td>
                        </tr>
                            @endforeach
                        @endisset
                        </tbody>

                        </table>

                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer-->
                </div>
        @endisset
    </section>
    <!-- /.content -->

@stop
