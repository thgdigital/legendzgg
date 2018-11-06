@extends('layouts.default')


@section('content')

    @isset($item)



@section('pageTitle',$item->name)
<div class="row">
    <div class="col-md-6">

        <div class="image-detail-rifas border-image border-color-azul">


            <a href="#" data-lightbox="example-set">


                <img width="409" height="362" src="<?=

                Croppa::url("/storage/rifas/$item->imagem", 409,362)?>" /></a>
            <span class="title-detail-rifas shadow-azul"> {{$item->name}}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="container-rifas-detail">

            <div class="rifas-baloes">
                <p class="title-rifas"> Comprar por R$ <?php echo number_format($item->valor_rifa, 2, ',', '.')?></p>

                <p>número ilimitado de bilhetes</p>
            </div>
            <div class="rifas-baloes">

                <?php
                $array = [];

                $i = 0;
                $j = 0;

                $id = $item->id;
                ?>
                @foreach($users as $number)
                    <?php
                    if (Auth::check()) {
                        if (Auth::user()->id == $number->jogador_id) {
                            $j++;

                            $array[] = $number->numeber;
                        }
                    }


                    $i++;
                    ?>
                @endforeach
                <label style="padding-bottom: 10px;font-size: 12px; color: white; font-weight: bold;">Você
                    tem <?php echo $j; ?> bilhetes </label>
                <p>
                    №:
                    <?php


                    echo implode(", ", $array);

                    $porc = round($i * 100 / $item->num_rifias);

                    if (Auth::check()) {
                        $userId = Auth::user()->id;
                        $valorSaldo =  Auth::user()->saldo->saldo != null ? Auth::user()->saldo->saldo : 0;
                    }else{
                        $valorSaldo = 0;
                        $userId = 0;
                    }

                    ?></p>
            </div>
            <div class="progress progress-defualt">
                <input name="idItem" id="idItem"  type="hidden" value="{{$item->id}}">


                <div class="progress-bar progress-bar  progress-bar-defualt" role="progressbar"
                     aria-valuenow="<?php echo $porc; ?>"
                     aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porc; ?>%">
                    <span class="progress-type"><?php echo $i; ?>/<?php echo $item->num_rifias?></span>
                    <span class="sr-only"><?php echo $porc; ?>% Complete</span>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row category">
    <div class="col-md-2"><span>Bilhetes</span></div>
    <div class="col-md-10">
        <hr/>
    </div>
</div>
<div class="row">
    <div class="col-md-12 margin-avatares">
        <div class="container-avatar">
            <div id="container-avatar"></div>

        </div>
        <div id="loading" style="display: none;"></div>
        <div class="row">
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-block" id="carrageMais">Carregar mais rifas</button>
            </div>
        </div>
        @if($rifa->is_fechada == 1)
        <div class="box-vencedor">

            <div class="bg-vencedor">
                <?php
                    $image = null;
                if($jogador->avatar){
                    $image = $jogador->avatar;
                }else{
                    $image ="profiler.png";
                }

                ?>


                <img  src="<?=

                Croppa::url("/storage/jogadores/$image", 100,100)?>" id="bg-profile" />
            </div>
        </div>
            @endif
    </div>


</div>
<div class="comprar-status" style="display: none">

    <div class="rifas-baloes backgroud-fooer">
        <p><span id="NumerosEscolhidos" class="number-selected">Números escolhidos: </span></p>
    </div>

    <div class="box-comprar">
        <span id="timer" style="padding-left: 20px; color: rgb(255, 255, 0);"></span>
        <button type="button" role="button" class="btn btn-primary btn-lg " id="btnComprar" data-target="#aposta-modal" data-toggle="modal" style="display: block;">
            Comprar
        </button>
    </div>
</div>

</div>
</div>



<div class="modal fade" id="aposta-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dipalog">

        <div class="modal-content" style="width: 400px;margin-left: 40%;margin-top: 200px;">
            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times" aria-hidden="true"></span>
                </button>
            </div>
            <div id="div-forms">


                <form id="Aposta-form">
                    <div class="modal-body">
                        <div id="div-login-msg">
                            <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                            <!--<span id="text-login-msg">Escolha de número.</span>-->
                            <label id="NumerosEscolhidos1" style="padding-bottom: 10px; font-weight: bold;">
                                <br>
                            </label>

                        </div>
                        <div id="div-login-msg">
                            <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>

                            <input type="hidden" name="liberado" id="liberado" value="1">
                            <input type="hidden" name="id_rifa" id="id_rifa" value="{{$item->id}}">
                            <input type="hidden" name="valor_rifa" id="valor_rifa" value="{{$item->valor_rifa}}">
                            <input type="hidden" name="valor_saldo" id="valor_saldo" value="{{$valorSaldo}}">
                            <input type="hidden" name="id_assinante" id="id_assinante" value="{{$userId}}">
                            <input type="hidden" name="quantidade_bilhetes" id="quantidade_bilhetes" value="0">
                            <input type="hidden" name="valor_aposta" id="valor_aposta" value="">
                            <label id="Valor_Aposta_formatado" style="padding-bottom: 10px; font-weight: bold;">

                            </label>
                        </div>
                        <br>
                        <br>
                        <div class="checkbox" style="height: 100px;text-align:center;">
                            <!--Você escolheu : <br>-->
                            <span style="font-weight: bold; font-size: 60px; " id="numeroescolhido1"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div style="text-align: center;">
                            <button type="button" class="btn btn-primary btn-lg" id="escolha_numero_continuar" style="margin-left: 120px;">Confirmar
                            </button>
                            <label id="laber_continuar">
                                Seus créditos são insuficientes para está aposta!
                            </label>
                        </div>

                    </div>
                </form>


                <form id="negado-form" style="display:none;">
                    <div class="modal-body">
                        <div id="div-login-msg">
                            <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                            <span id="text-login-msg" style="color:red; font-weight: bold;">Insuficiência de créditos.</span>
                        </div>

                        <div class="checkbox">
                            <label>
                                Seus créditos são insuficientes para está aposta!
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="button" id="btn_final_aposta1" class="btn btn-primary btn-lg btn-block">Sair
                            </button>
                        </div>
                    </div>
                </form>


                <form id="Apostado-form" style="display:none;">
                    <div class="modal-body">
                        <div id="div-login-msg">
                            <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                            <span id="text-login-msg" style="font-weight: bold;">Compra.</span>
                        </div>

                        <div class="checkbox">
                            <label>
                                Compra efetuada com sucesso!
                            </label>
                        </div>
                    </div>
                    <!--<div class="modal-footer">
                        <div>
                            <button type="button" id="btn_final_aposta2" class="btn btn-primary btn-lg btn-block">
                                Sair
                            </button>
                        </div>
                    </div>-->
                </form>


            </div>
        </div>
    </div>
</div>

@endisset
@stop



@push('scripts')
<script src="{{ asset('assets/js/paginacao.js') }}"></script>
@endpush
