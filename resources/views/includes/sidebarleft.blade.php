<div id="sidebar" class="sidebar" >
    <div class="button-active-sidebar" id="active-sidebar">
        <span class="acitve-sidebar-left"></span>

    </div>
    <?php
        $class = !Auth::check() ? "isLogin": ""
    ?>
    <div class="box-sidebar">
        <ul id="menu-sidebar" class="nav nav-sidebar">

            <li class="">
                <a href="?1=48o8k8nqb9u05nabiv86l5h075YF9dXURXcl5QQUFYV1QTS1dXRFZUWRdKaUo=" class="emBreve not-active">
                    <img src="{{ asset('assets/imagem/roleta classica.png') }}">
                    <span class="text-sidebar">ROLETA CLÁSSICA</span>


                </a>
            </li>
            <li class="">
                <a href="?1=48o8k8nqb9u05nabiv86l5h075YF9dXURXZVtcV0EXR1BSTVxUXh5Ibkk=" class="emBreve not-active">
                    <img src="{{ asset('assets/imagem/roleta times.png') }}">
                    <span class="text-sidebar">ROLETAS DE TIMES</span>
                </a>
            </li>

            <li class="menu-rifas">
                <a href="#">
                    <img src="{{ asset('assets/imagem/rifas.png') }}">
                    <span class="text-sidebar">RIFAS</span>
                    <span class="icon-right">
                        <i class="fas fa-plus"></i>
                    </span>
                </a>
                <ul id="sub-menu-rifa" style="display:none;">
                    <li>
                        <a href="{{url("rifas/categoria/hextec")}}" class="shadow-azul">HEXTEC</a>
                    </li>
                    <li>
                        <a href="{{url("rifas/categoria/promocional")}}" class="shadow-amarelo">PROMOCIONAL</a>
                    </li>
                    <li>
                        <a href="{{url("rifas/categoria/void")}}" class="shadow-roxo">VOID</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="nav nav-sidebar-sub " id="menu">
            <li class="">
                <a href="{{url('loja/loja-compra')}}" class="">
                    <img src="{{ asset('assets/imagem/loja.png') }}">
                    <span class="text-sidebar"> LOJA</span>
                </a>
            </li>
            <li class="<?php echo  $class ?>">
                <a href="#" class="ativo">
                    <img src="{{ asset('assets/imagem/historico.png') }}">
                    <span class="text-sidebar">HISTÓRICO</span>
                    <span class="icon-right">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </span>
                </a>

                <ul class="treeview-menu" id="menu_100006" style="display: block;">
                    <li>
                        <!--						<a href="--><!--" readonly="readonly">-->
                        <!--							&nbsp; &nbsp; &nbsp;-->
                        <!--							ROLETAS-->
                        <!--						</a>-->
                    </li>
                    <li>
                        <a href="#">
                            &nbsp; &nbsp; &nbsp;
                            RIFAS
                        </a>
                    </li>
                </ul>
            </li>

            <li class="">
                <a href="?1=48o8k8nqb9u05nabiv86l5h075ZkJeW1EQQldWR1xVWxNNYEo=" class="emBreve not-active">
                    <img src="{{ asset('assets/imagem/trocas.png') }}">
                    <span class="text-sidebar">TROCAS E OFERTAS</span>
                </a>
            </li>
            <li class="<?php echo  $class ?>">
                <a href="?1=48o8k8nqb9u05nabiv86l5h075fllWWRZFVFVEXFZeEk1tQA==" class="emBreve not-active">
                    <img src="{{ asset('assets/imagem/liga.png') }}">
                    <span class="text-sidebar">LIGA</span>
                </a>
            </li>
            <li class="<?php echo  $class ?>">
                <a href="{{url("jogador/recompensa")}}">
                    <img src="{{ asset('assets/imagem/recompensa.png') }}">
                    <span class="text-sidebar">RECOMPENSA</span>
                </a>
            </li>

            <li class="<?php echo  $class ?>">

                <a href="?1=48o8k8nqb9u05nabiv86l5h075dUVYWRZFVFVEXFZeEk1tQA==">
                    <img src="{{ asset('assets/imagem/guia.png') }}">
                    <span class="text-sidebar">GUIA</span>
                </a>
            </li>

            <li class="<?php echo  $class ?>">
                <a href="{{url("suporte")}}" class="">
                    <img src="{{ asset('assets/imagem/suporte.png') }}">
                    <span class="text-sidebar">SUPORTE</span>
                </a>
            </li>
        </ul>
        <ul id="rede-social">
            <li>
                <a href="xxxxxxxxxxxxx">
                    <img src="Painel/Assets/Inicial/imagem/facebook.png">
                </a>
            </li>
        </ul>
    </div>
</div>