@extends('layouts.default')
@section('pageTitle', 'PROGRAMA DE RECOMPENSA')
@section('content')


    <div class="box-recompensa">
        <h1>PROGRAMA DE RECOMPENSA</h1>
        <div class="clear"></div>
        <span class="descricao-left" style="text-align: justify">
				Quando alguém compra créditos e utiliza seu código de cupom, esse amigo se torna seu indicado. A cada duas indicações você avança um nível na escalada rumo ao DESAFIANTE. Envie seu cupom agora e ganhe Essência, elas ficarão acumuladas em seu progresso até que você resgate. A contagem de níveis também vale pontos em nossa LIGA!
			</span>
        <div class="codigo-cupom">
            <span>Seu código de cupom</span>

            <?php

                $user =  Auth::user();
                $code =  Auth::user()->code;
            ?>
            <div class="codigo">
                <input id="myInput" width="200px" value="{{$code}}" />
                <div class="button-codigo" onclick="myFunction()">
                    <span>COPIAR</span>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="box-moedas">
            <div class="header-moeda">
                <span class="moeda-nivel">RANK:
                    <?php
                        $class = $dados["nivel"] == 0 ? "none": 'block';
                    ?>
                <?php  echo $dados["statusNivel"]; ?></span>
                <ul id="rank-list" style="display: <?php echo $class; ?>">
                    <li <?php echo $dados["nivel"] == 1 ? 'class="active-rank"':"" ?>>I</li>
                    <li <?php echo $dados["nivel"] == 2 ? 'class="active-rank"':"" ?>>II</li>
                    <li <?php echo $dados["nivel"] == 3 ? 'class="active-rank"':"" ?>>III</li>
                    <li <?php echo $dados["nivel"] == 4 ? 'class="active-rank"':"" ?>>IV</li>
                    <li <?php echo $dados["nivel"] == 5 ? 'class="active-rank"':"" ?>>V</li>
                </ul>
                <img src="{{ asset('assets/imagem/friend.png') }}" width="25"><span class="moeda-indicacoes"> TOTAL INDICAÇÕES:   <?php  echo $dados["totalIndicacao"]; ?></span>

            </div>
            <div class="body-moedas">

                <img src="{{ asset('assets/imagem/tier-icons.png') }}" width="100%">

                <div class="bottom-border"></div>
                <div class="footer-moedas">
                    <div class="footer-right">
                        <?php
                            $disabled = $dados["essencia"] == 0 ? "disabled='disabled'": ""
                        ?>
                        <button href="#" <?php echo $disabled;?>>RESGATAR</button>
                        <img src="{{ asset('assets/imagem/moeda-essencia.png') }}" width="30">
                        <span>ESSÊNCIA DISPONÍVEL:  <?php  echo $dados["essencia"]; ?></span>


                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
<script src="{{ asset('assets/js/recompensa.js') }}"></script>
@endpush