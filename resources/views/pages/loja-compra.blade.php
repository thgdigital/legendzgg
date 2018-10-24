@extends('layouts.default')
@section('pageTitle', 'Editar ou cadastrar endereços')
@section('content')

    @include('includes.menu')
    <div class="inventario-content">
        <div class="contant-slider">

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


                @if ($compras)
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php $i =0; ?>
                    @foreach ($sliders as $slider)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"
                        <?php  echo ($i== 0)? 'class="active"':"";?>

                        ></li>

                            <?php $i++; ?>
                    @endforeach
                </ol>
                <div class="carousel-inner">

                    <?php $j=0; ?>
                    @foreach ($sliders as $slider)

                    <div class="item
                     <?php echo ($j == 0)? 'active': ''; ?>

                     ">

                        <img class="d-block w-100"
                             src="<?=Croppa::url('/storage/slider/'.$slider->imagem, 800, 420)?>"/>

                    </div>
                            <?php $j++; ?>
                    @endforeach


                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
                @endif
            <ul id="loja-inventario-sub">
                @if ($compras)
                    @foreach ($compras as $compra)

                <li>
                    <div class="thumbnail-loja">

                        <?php
                        $path = $compra->items->imagem;
                        ?>
                        <img  src="<?=

                        Croppa::url("/storage/rifas/$path", 166,150)?>" /></a>

                        <span class="desconto">-50%</span>
                        <div class="description-loja">
                            <span class="title-loja">{{$compra->items->name}}</span>
                            <span class="numeber-loja">{{$compra->items->valor_rp}}</span>

                        </div>
                    </div>

                </li>
                    @endforeach
                @endif


            </ul>
        </div>
    </div>


@stop
@push('scripts')

@endpush