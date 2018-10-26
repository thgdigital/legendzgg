@extends('layouts.admin')


@section('content')


    <!-- Main content -->
    <section class="content">

    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Lista de Items</h3>
            </div>

        <div class="box-body table-responsive ">

            @isset($items)

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Valor Rifa</th>
                    <th>Valor Venda</th>
                    <th>Valor Rp</th>
                    <th>Valor Credito</th>
                    <th>Valor essencia</th>
                    <th>N Rifas</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>
                        R$  <?php echo  number_format($item->valor_rifa, 2, ",", "."); ?>
                        </td>
                    <td>
                        R$  <?php echo  number_format($item->valor_venda, 2, ",", "."); ?>
                        </td>
                    <td>
                        R$  <?php echo  number_format($item->valor_rp, 2, ",", "."); ?>
                        </td>
                    <td>
                        R$  <?php echo  number_format($item->valor_credito, 2, ",", "."); ?>
                        </td>
                    <td>
                        R$  <?php echo  number_format($item->valor_essencia, 2, ",", "."); ?>
                       </td>
                    <td>{{$item->num_rifias}}</td>
                    <td>
                        <?php if($item->status == 1){?>
                        <span class="label label-success">Ativo</span>
                        <?php }else{?>
                        <span class="label label-danger">Desativado</span>
                        <?php }?>

                    </td>
                    <td>
                        <a href="{{url('admin/items/edit/'.$item->id)}}" v-b-tooltip.hover title="I'm a tooltip!" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="{{url('admin/rifas/items/image/'.$item->id)}}" class="btn btn-primary btn-xs"><i class="fa  fa-file-image-o"></i></a>
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
