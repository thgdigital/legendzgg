@extends('layouts.admin')


@section('content')


    <!-- Main content -->
    <section class="content">

    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Todos transações do Usuario</h3>


            </div>

        <div class="box-body table-responsive ">

            @isset($transacoes)

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Comprador</th>

                    <th>Valor de compras</th>
                    <th>Status</th>

                    <th>Data de criação</th>
                    <th>Data de atualização</th>

                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($transacoes as $trans)
                <tr >
                    <td>{{$trans->transacao->id}}</td>

                    <td>{{$trans->jogador->username}}</td>
                    <td>
                        R$  <?php echo  number_format($trans->valor_total, 2, ",", "."); ?>
                    </td>
                    <td>
                        <?php if($trans->transacao->status == 1){?>
                            <span class="label label-warning"  >Aguardando pagamento</span>
                        <?php }elseif($trans->transacao->status == 2){?>
                            <span class="label label-primary"  >Em análise</span>
                        <?php }elseif($trans->transacao->status == 3){?>
                            <span class="label label-success"  >Paga</span>
                        <?php }elseif($trans->transacao->status == 4){?>
                            <span class="label label-success"  >Disponível</span>
                        <?php }elseif($trans->transacao->status == 5){?>
                            <span class="label label-warning"  >Em disputa</span>
                        <?php }elseif($trans->transacao->status == 6){?>
                            <span class="label label-danger"  >Devolvida</span>
                        <?php }elseif($trans->transacao->status == 7){?>
                            <span class="label label-danger"  >Cancelada</span>
                        <?php }elseif($trans->transacao->status == 8){?>
                            <span class="label label-primary"  >Debitado</span>
                        <?php }elseif($trans->transacao->status == 9){?>
                            <span class="label label-danger"  >Retenção temporária</span>
                        <?php }?>
                    </td>

                    <td>   <?php echo  date('d/m/Y', strtotime($trans->created_at))?> </td>
                    <td>
                        <?php echo  date('d/m/Y', strtotime($trans->updated_at))?>
                        </td>

                    <td>
                        <a href="{{url('admin/transacao/credit/'.$trans->transacao->id)}}" v-b-tooltip.hover title="I'm a tooltip!" class="btn btn-primary btn-xs"><i class="fa fa-money"></i></a>

                    </td>
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
