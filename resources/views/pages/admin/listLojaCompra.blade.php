@extends('layouts.admin')


@section('content')


    <!-- Main content -->
    <section class="content">

    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Lista de Compras</h3>


            </div>

        <div class="box-body table-responsive ">

            @isset($compras)
            <table class="table table-bordered  table-responsive table-hover">
                <tr>
                    <th>ID loja</th>
                    <th>Nome item</th>
                    <th>Status</th>

                    <th>Ações</th>
                </tr>

                @isset($compras->items)
                @foreach ($compras->items as $item)
<tr>
    <td>{{$item->pivot->loja_id}}</td>
    <td>{{$item->name}}</td>
    <td>
        <?php if($compras->status == 1){?>
        <span class="label label-success">Ativo</span>
        <?php }else{?>
            <span class="label label-danger">Desativado</span>
        <?php }?>
    </td>
    <td>
        <?php if($compras->status == 1){?>
            <a  href="{{url('admin/loja/compra-desativar/'.$item->pivot->loja_id)}}" class="label label-danger"><i class="fa fa-power-off"></i></a>

        <?php }else{?>
            <a  href="{{url('admin/loja/compra-ativar/'.$item->pivot->loja_id)}}" class="label label-success"><i class="fa fa-power-off"></i></a>
        <?php }?>
            <a  href="{{url('admin/loja/compra-editar/'.$item->pivot->loja_id)}}" class="btn btn-primary btn-xs"><i class="fa  fa-edit"></i></a>
    </td>
</tr>
                @endforeach
                @endisset

            </table>

            @endisset
            </div>

        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- /.box-footer-->
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Criar da</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    @push('scripts')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/select2/select2.full.min.js') }}">
    <script src="{{ asset('assets/js/cardList.js') }}"></script>
    @endpush
@stop
