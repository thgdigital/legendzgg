@extends('layouts.admin')


@section('content')


    <!-- Main content -->
    <section class="content">

    <!-- Default box -->
        <div class="box">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
            <div class="box-header with-border">
                <h3 class="box-title">Lista de Compras</h3>
                <div class="box-tools pull-right">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus"></i> Adicionar novo item
                    </button>
                    </div>

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
                @isset($compras)
                @foreach ($compras as $compra)
<tr>
    <td>{{$compra->id}}</td>
    <td>{{$compra->items->name}}</td>
    <td>
        <?php if($compra->status == 1){?>
        <span class="label label-success">Ativo</span>
        <?php }else{?>
            <span class="label label-danger">Desativado</span>
        <?php }?>
    </td>
    <td>
        <?php if($compra->status == 1){?>
            <a  href="{{url('admin/loja/inventario-desativar/'.$compra->id)}}" class="label label-danger"><i class="fa fa-power-off"></i></a>

        <?php }else{?>
            <a  href="{{url('admin/loja/inventario-ativar/'.$compra->id)}}" class="label label-success"><i class="fa fa-power-off"></i></a>
        <?php }?>
            <a  href="{{url('admin/loja/inventario-editar/'.$compra->id)}}" class="btn btn-primary btn-xs"><i class="fa  fa-edit"></i></a>
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
                    <form method="POST" action="{{route('loja.salvarInventario')}}">
                        {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="box-title" id="exampleModalLabel">Adicionar novo item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select class="form-control select2" required placeholder="Selecione um item"  name="item" style="width: 100%;">
                            <option value="">Selecione item</option>
                            @isset($items)
                            @foreach ($items as $item)

                                <option value="{{$item->id}}">
                                    {{$item->name}}
                                </option>

                            @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar dados</button>
                    </div>
                    </form>
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
