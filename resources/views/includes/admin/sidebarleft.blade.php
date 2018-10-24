<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php
                $image = (auth()->guard("admin")->user()->avatar != null) ?  auth()->guard("admin")->user()->avatar : ''

                ?>
                <img src="{{asset("assets/imagem/admin/$image")}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->guard("admin")->user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Navegação</li>

            
            <li class="treeview {{setActive('admin/dashboard')}}">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                </ul>
            </li>

            <li class="{{setActive('admin/user')}}">
                <a href="{{route('usuarios.list')}}">
                    <i class="fa  fa-users"></i> <span>Lista de usuarios</span>
                    </span>
                </a>
            </li>
            <li class="treeview {{setActive('admin/administradores')}}">
                <a href="{{route('administradores.index')}}">
                    <i class="fa  fa-users"></i> <span>Administradores</span>
                    </span>
                </a>

            <ul class="treeview-menu">
                <li class="{{setActive('admin/administradores/create')}}">
                    <a href="{{route('administradores.create')}}"><i class="fa fa-circle-o"></i> Criar cadastro</a></li>

                <li><a href="{{route('administradores.index')}}"><i class="fa fa-circle-o"></i> Listar Administradores</a></li>
            </ul>
            </li>
            <li class="{{setActive('admin/transacao')}}">
                <a href="{{route('transacao.index')}}">
                    <i class="fa fa-money"></i> <span>Transações</span>
                     </span>
                </a>
            </li>
            <li class="{{setActive('admin/suporte')}}">
                <a href="{{route('admin.suporte.index')}}">
                    <i class="fa fa-ticket"></i> <span>Suporte</span>
                     </span>
                </a>
            </li>
            <li class="treeview {{setActive('admin/rifas')}}">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Rifas</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{setActive('admin/rifas/hextec')}}"><a href="{{url("admin/rifas/hextec")}}"><i class="fa fa-circle-o"></i> HEXTEC</a></li>
                    <li class="{{setActive('admin/rifas/promocional')}}"><a href="{{url("admin/rifas/promocional")}}"><i class="fa fa-circle-o"></i> PROMOCIONAL</a></li>
                    <li class="{{setActive('admin/rifas/void')}}"><a href="{{url("admin/rifas/void")}}"><i class="fa fa-circle-o"></i> VOID</a></li>
                </ul>
            </li>
            <li class="treeview {{setActive('admin/loja')}}">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i> <span>Loja</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{setActive('admin/loja')}}">
                        <a href="#"><i class="fa fa-circle-o"></i> Loja Compra
                            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{setActive('admin/loja/loja-compra')}}"><a href="{{url("admin/loja/loja-compra")}}"><i class="fa fa-circle-o"></i> Listar items</a></li>
                            <li class="{{setActive('admin/loja/slider-compra')}}"><a href="{{url("admin/loja/slider-compra")}}"><i class="fa fa-circle-o"></i> Configurar Slider</a></li>

                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa  fa-shopping-cart"></i> <span>Loja</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{setActive('admin/loja/loja-invantario')}}"><a href="{{url("admin/loja/loja-invantario")}}"><i class="fa fa-circle-o"></i> Loja Invantario</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>