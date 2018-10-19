<nav class="navbar navbar-static-top inicio">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div id="logo-div">
                <div class="super-logo">
                    <a href="?">
                        <img src="{{ asset('assets/imagem/LegendzGG_Logo_p.png') }}" alt="">
                    </a>
                </div>
                <div class="sub-logo">
                    <a href="?">
                        <img src="{{ asset('assets/imagem/lettering.png') }}">
                    </a>
                </div>
            </div>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <div class="menu-right">


                @if(Auth::check())

<?php

                        $valorSaldo =  Auth::user()->saldo->saldo != null ? Auth::user()->saldo->saldo : 0;
                    $valoressencia =  Auth::user()->saldo->essencia != null ? Auth::user()->saldo->essencia : 0;

                   $saldo =   str_replace(".", ",", $valorSaldo);
                   $essencia =  str_replace(".", ",",$valoressencia);
                    $avatar =  Auth::user()->avatar;

                    ?>

                <div class="backgroud-avatar">

                    <img src="{{ url("storage/app/public/jogadores/{$avatar}")}}" alt="{{Auth::user()->name}}"/></div>
                <div class="dados-avatar">

                    <div id="poupover" style="display: none">
                        <ul id="menuPoupover">
                            <li><a href="{{url("jogador/edit")}}">Editar Perfil</a></li>
                            <li><a href="{{url("jogador/email")}}">Modificar senha</a></li>
                            <li><a href="{{url("jogador/endereco")}}">Editar Endereço</a></li>
                            <li><a href="{{url("jogador/listar-cartao")}}">Listar cartões</a></li>
                            <li><a href="{{url("jogador/sair")}}">Sair</a></li>
                        </ul>
                    </div>
                    <div class="dados-header">
                        <span>{{Auth::user()->username}}</span>
                        <span><img src="{{ asset('assets/imagem/moeda.png') }}" width="20" />   <?php echo $saldo;?></span>
                        <span><img src="{{ asset('assets/imagem/moeda-essencia.png') }}" width="15"/>  <?php echo $essencia;?> </span>
                    </div>
                    <div class="dados-footer">
                        <ul class="lista-button">
                            <li><button class="button-alerta"><img src="{{ asset('assets/imagem/alerta.png') }}"></button></li>
                            <li><button class="button-perfil" id="examplepoupover" data-container="body" data-toggle="popover" data-placement="bottom"><img src="{{ asset('assets/imagem/perfil.png') }}"></button></li>
                            <li><a  href="{{url("pagseguro/carrinho")}}" class="button-credito"><img src="{{ asset('assets/imagem/creditos.png') }}"></a></li>
                            <li><button class="button-invetario"><img src="{{ asset('assets/imagem/inventario.png') }}"></button></li>

                        </ul>
                    </div>
                </div>
            </div>
            @else
                <div class="div_menu_media5" style="float:right; margin-top:25px;padding-right: 70px; ">
                    <a href="#" class="dropdown-toggle btEntrar" role="button" style="" data-toggle="modal" data-target="#loginModal">
                        <span class="hidden-xs">
                            <i class="fa fa-unlock-alt fazul" aria-hidden="true"></i>
                            Entrar
                        </span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</nav>