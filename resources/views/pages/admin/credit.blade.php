@extends('layouts.admin')


@section('content')
    @isset($transacao)

    <?php
    $valor =  number_format($transacao->order->valor_total, 2, ".", ",");

    ?>
    <section class="content-header">
        <h1>
            Compra ID
            <small>#{{$transacao->id}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('admin/transacao')}}">Transação</a></li>
            <li class="active">Liberar crédito</li>
        </ol>
    </section>

   <!-- Main content -->

    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i>  Liberar credito.
                    <small class="pull-right">Data: <?php echo date('m/d/Y H:i:s', strtotime($transacao->created_at))?></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-12 invoice-col">
                Usuario
                <address>
                    <strong>{{$transacao->order->jogador->name}}</strong><br>
                    Username: {{$transacao->order->jogador->username}}<br>
                    Email: {{$transacao->order->jogador->email}}
                </address>
            </div>

            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Qtd</th>


                        <th>Descrição</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$transacao->order->valor_total}}</td>


                        <td>Comprar de creditos</td>
                        <td>R$ {{$valor}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            @isset($transacao->credit)
            <div class="col-xs-12 table-responsive">
                <h5><strong>Crédito liberado</strong></h5>


                <table class="table table-striped">
                    <thead>
                    <tr>



                        <th>Adminstrador</th>
                        <th>Creditos</th>
                        <th>Data</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>



                        <td><span class="label  label-warning">{{$transacao->credit->admin->name}}</span></td>
                        <td><span class="label  label-success">Créditos {{$transacao->credit->valor}}</span></td>
                        <td><span class="label  label-primary"><?php echo date('d/m/Y' ,strtotime($transacao->credit->created_at));?></span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
            @endisset
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Metodo de pagamento:</p>
                <img src="{{asset('assets/imagem/credit/visa.png')}}" alt="Visa">
                <img src="{{asset('assets/imagem/credit/mastercard.png')}}" alt="Mastercard">
                <img src="{{asset('assets/imagem/credit/american-express.png')}}" alt="American Express">
                <img src="{{asset('assets/imagem/credit/paypal2.png')}}" alt="Paypal">


            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Data de compra <?php echo date('m/d/Y', strtotime($transacao->created_at))?></p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>R$ {{$valor}}</td>
                        </tr>

                        <tr>
                            <th>Total:</th>
                            <td>R$ {{$valor}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Liberar credito
                </button>
                <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                </button>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inserir Credito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCredit">
                        <div class="form-group">
                            <label>Inserir crédito</label>

                            <input type="number" class="form-control" id="credit" placeholder="Digite o Valor" required>
                            <input type="hidden" name="idTansacao" id="idTansacao" value="{{$transacao->id}}">
                            <input type="hidden" name="idAdmin" id="idAdmin" value="{{auth()->guard("admin")->user()->id}}">
                            <input type="hidden" name="idUser" id="idUser" value="{{$transacao->order->jogador_id}}">
                        </div>

                        <input type="submit" id="inserirValor" class="btn btn-primary btn-lg" value="Inserir valor">
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- /.content -->
    @push('scripts')
    <script src="{{ asset('assets/js/admin/credit.js') }}"></script>
    @endpush
    @endisset
@stop
