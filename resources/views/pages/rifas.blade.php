@extends('layouts.default')


@section('content')

    @isset($categoria)

    <?php

    $cor = "";


    if(strtolower($categoria->name) == "hextec"){
        $cor = "azul";
    }else if(strtolower($categoria->name) == ""){
        $cor = "amarelo";
    }else if(strtolower($categoria->name) == "void"){
        $cor = "verde";
    }else if(strtolower($categoria->name) == "promocional") {
        $cor = "vermelho";
    }




    ?>
    <div class="contant-line">
        @section('pageTitle',$categoria->name)
        <h5 class="title-rifas shadow-<?php echo $cor; ?>">{{$categoria->name}}</h5>
        <div class="line"></div>
        <div class="row">
    @foreach($rifas as $rifa)







                @foreach($rifa->items as $item)




                    @isset($item->slug)

<?php $urlImage = $item->imagem ?>


                    <div class="col-sm-4">
                        <div class="image-rifas border-image border-color-<?php echo $cor; ?>">

                            <a href="{{url("items/$item->slug")}}">

                                <img
                                     src="<?=Croppa::url('/storage/rifas/'.$urlImage, 260, 190)?>"/>

                            </a>
                            <span class="title-img-rifas shadow-<?php echo $cor; ?>">  {{$item->name}}</span>
                            <a href="{{url("items/$item->slug")}}" class="btn valor-rifas">Valor: <small>$
                                   <?php echo number_format($item->valor_rifa, 2, ',', '.')?></small></a>
                        </div>
                    </div>
                    @endisset
                @endforeach


    @endforeach
            </div>
    @endisset
@stop
