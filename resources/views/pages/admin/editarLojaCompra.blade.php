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
<form class="" method="POST" action="{{route('loja.editarCompra')}}">
    <input type="hidden" value="{{$loja->id}}" name="lojaId">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Items</label>

                <select class="form-control select2" placeholder="Selecione um item"  name="item" style="width: 100%;">
                    @isset($items)
                    @foreach ($items as $item)
                    <option value="{{$item->id}}" <?php echo ($item->id == $loja->items->id)? 'selected="selected"': "" ?>>
                        {{$item->name}}
                    </option>

                    @endforeach
                    @endisset
                </select>
            </div>
            </div>
        </div>
    <button type="submit" class="btn btn-primary btn-sm">Alterar dados</button>
</form>



            </div>

        <!-- /.box-body -->
        <div class="box-footer">
            <a class="btn btn-default btn-sm" href="{{url('admin/loja/loja-compra')}}">Voltar a página</a>

        </div>
        <!-- /.box-footer-->
        </div>

    </section>
    <!-- /.content -->
    @push('scripts')

    <script src="{{ asset('assets/js/admin/editar-compra.js') }}"></script>
    @endpush
@stop
