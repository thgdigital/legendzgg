@extends('layouts.admin')


@section('content')


    <!-- Main content -->
    <section class="content">

    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Lista de Saques</h3>
            </div>

        <div class="box-body table-responsive ">
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

            @isset($saques)

            <table class="table table-bordered">
                <thead>
                <tr>

                    <th>Forma de pagamento</th>
                    <th>Valor</th>
                    <th>Usuario</th>
                    <th>Admin</th>

                    <th>Status</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($saques as $saque)
                    <tr>

                        <td>

                            @if($saque->type == 1)
                            <span class="label label-success">PagSeguro</span>
                                @else
                                    <span class="label label-primary">PayPal</span>
                                @endif

                        </td>
                        <td>
                            R$  <?php echo  number_format($saque->saque, 2, ",", "."); ?>

                        </td>
                        <td>
                            @isset($saque->jogador)
                            <span class="label label-primary"> {{$saque->jogador->username}}</span>
                            @endisset
                        </td>
                        <td>
                            @isset($saque->admin)
                            <span class="label label-primary"> {{$saque->admin->name}}</span>
                            @endisset
                        </td>

                        <td>
                            <?php if($saque->status == 1){?>
                            <span class="label label-success">Valor regatavel</span>
                            <?php }else{?>
                            <span class="label label-danger">pendente</span>
                            <?php }?>


                        </td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#exampleModal-<?php echo $saque->id; ?>" class="btn btn-success btn-xs"><i class="fa fa-fw fa-dollar"></i></button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal-<?php echo $saque->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Mudar status</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="formCredit" method="POST" action="{{route('transacao.saqueEdit')}}">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label>Mudar status</label>

                                                    <input type="hidden" name="idSaque" id="idSaque" value="{{$saque->id}}">

                                                    <select class="form-control" name="status">
                                                        <option value="">Selecione uma status</option>
                                                        <option value="1" <?php echo  ($saque->status == 1)? 'selected="selected"': '' ?> >Liberar</option>
                                                        <option value="0" <?php echo  ($saque->status == 0)? 'selected="selected"': '' ?>>Pendente</option>

                                                    </select>
                                                </div>

                                                <input type="submit" id="inserirValor" class="btn btn-primary btn-lg" value="Salva dados">
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
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
