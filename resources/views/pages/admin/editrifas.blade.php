@extends('layouts.admin')


@section('content')


    <!-- Main content -->
    <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Rifas</h3>

                </div>
                <div class="box-body">
                    @isset($rifas)
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
                    <form method="POST" id="formEditRifas" action="{{route('rifa.update')}}">
                        <input type="hidden" value="{{$rifas->id}}" name="id">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nome da rifa</label>
                                    <input type="text" name="name"  class="form-control" value="{{$rifas->name}}" required>
                                    </div>
                                </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Categoria</label>

                                    <select class="form-control" name="categoria" required>
                                        <option value="">Selecione uma categoria</option>
                                        @foreach ($categorias as $cat)

                                           <?php
                                                if( $cat->id== $rifas->categoria_id)
                                                    $nameCat = $cat->name;
                                            ?>
                                        <option value="{{$cat->id}}"  <?php echo $cat->id== $rifas->categoria_id ? 'selected': '';?>>{{$cat->name}}</option>
                                        @endforeach

                                    </select>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Data de inicio</label>
                                    <input type="date" name="date_inicio"  class="form-control" value="{{$rifas->date_inicio}}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date de fim</label>
                                    <input type="date" name="date_fim"  class="form-control" value="{{$rifas->date_fim}}" required>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-default btn-sm" href="{{url('admin/rifas/'.strtolower($nameCat))}}">Voltar a página</a>
                        <input type="submit" class="btn btn-primary btn-sm" value="Salvar Alteração">
                    </form>
                @endisset
                    <!-- /.box-body -->

                </div>
                @push('scripts')
                <script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
                <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
                <script src="{{ asset('assets/js/admin/editRifas.js') }}"></script>
        @endpush
    </section>
    <!-- /.content -->

@stop
