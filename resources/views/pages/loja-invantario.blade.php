@extends('layouts.default')
@section('pageTitle', 'Pagina de INVENTÁRIO')
@section('content')
    @include('includes.menu')

    <div class="box-loja">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-warning">
                {{ session('status') }}
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
        <div class="inventario-left">
            <div class="form-group">
                <input class="form-control custom-search"  placeholder="Buscar"/>
            </div>
            @isset ($tipos)

            <ul id="menu-inventario">
                @foreach ($tipos as $tipo)
                <li class="active-inventario">
                    <a href="{{url('inventario?tipo='.$tipo->id)}}">{{$tipo->name}}</a>
                </li>

                @endforeach
            </ul>
            @endisset
            <div class="selected-filtro">
                <span class="title-selected">Data de lançamentos</span>
                <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                <i class="fa fa-arrows-v" aria-hidden="true"></i>
            </div>
            <ul id="filtro-inventario">
                <li>
                    <a href="#"><span>Data de lançamentos</span>
                        <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                        <small><i class="fa fa-chevron-down" aria-hidden="true"></i></small>
                    </a>
                </li>
                <li>
                    <a href="#"><span>Data de lançamentos</span>
                        <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                </li>
                <li>
                    <a href="#"> <span>Preços (RP)</span>
                        <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="#">  <span>Preços (RP)</span>
                        <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="#">  <span>Alfabética</span>
                        <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="#">  <span>Alfabética</span>
                        <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="#">  <span>Campeões</span>
                        <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="#"> <span>Campeões</span>
                        <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="inventario-right">

            <ul id="skin-collection">
                @isset ($inventarios)
                    @foreach ($inventarios as $compra)

                        <?php if( $compra->compra != 1){?>
                            @isset ($compra->items)
                        <li>
                            <a data-fancybox data-src="#hidden-content-<?php echo $compra->items->id; ?>" href="javascript:;">
                            <div class="thumbnail-loja">

                                <?php
                                $path = $compra->items->imagem;
                                ?>
                                <img  src="<?=

                                Croppa::url("/storage/rifas/$path", 166,150)?>" />

                                <div class="description-loja">
                                    <span class="title-loja">{{$compra->items->name}}</span>
                                    <span class="numeber-loja">{{$compra->items->valor_rp}}</span>

                                </div>

                         </a>
        <div style="display: none; width: 600px; height: 400px"  id="hidden-content-<?php echo  $compra->items->id; ?>">
            <div class="row">
                <div class="col-sm-5">
                    <div class="thumbnail-loja">

                        <?php
                        $path = $compra->items->imagem;
                        ?>
                        <img  src="<?=

                        Croppa::url("/storage/rifas/$path", 166,150)?>" /></a>

                        <div class="description-loja">
                            <span class="title-loja">{{$compra->items->name}}</span>
                            <span class="numeber-loja">{{$compra->items->valor_rp}}</span>

                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="modal-descricao">
                        <h4>Como deseja finalizar a compra</h4>
                        <p>{{$compra->items->name}}</p>
                    </div>
                </div>
            </div>
            <div class="footer-modal">
                <div class="row">
                    <div class="col-sm-6">
                        <button class="btn btn-lg btn-laranja compras-loja" compra-id="{{$compra->id}}">
                            <img src="{{asset('assets/imagem/moeda.png')}}" style="float:left;"><?php echo number_format($compra->items->valor_credito, 2, ',', '.')?> <br/>  Credito
                        </button>
                    </div>
                    <div class="col-sm-6">

                        <button class="btn btn-lg btn-amarelo compras-resgate" fancy="hidden-resgate-<?php echo  $compra->items->id; ?>"  compra-resgate="{{$compra->id}}"
                        <?php echo ($compra->items->resgatavel == 0)  ? 'disabled="disabled"' :'' ?>

                        >
                            Resgate <br/>
                           <br/>

                             </button>
                    </div>
                </div>
            </div>
        </div>
                            <div style="display: none; width: 560px; height: 300px; background: #ffffff !important; "  class="modal-inventario"  id="hidden-resgate-<?php echo  $compra->items->id; ?>">
                                <form method="POST" id="formResgate" action="{{route('inventario.resgate')}}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Informe para qual invocador deseja enviar este item?<br/>
                                                <small>(Lembre-se de enviar corretamente os dados para recibimento do item no LoL)</small></label>
                                                <textarea rows="5" cols="5"  name="invocador" type="text" class="form-control" placeholder="Digite o invocador" required></textarea>
                                                <input type="hidden" name="id" value="{{$compra->id}}">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" value="Enviar dados" class="btn btn-primary btn-sm">
                                </form>

                                </div>


                        </li>
                            @endisset
                            <?php } ?>
                    @endforeach
                @endisset

            </ul>
        </div>
        <div class="row">
            <div class="col-sm-3">

            </div>
            <div class="col-sm-9 no-paddings">

            </div>
        </div>
    </div>
@stop
@push('scripts')
<script src="{{ asset('assets/js/inventario.js') }}"></script>
@endpush