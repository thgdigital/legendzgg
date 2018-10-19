@include('includes.admin.head')
<body class="hold-transition skin-blue sidebar-mini">
    <div id="app">
        <div class="wrapper">

        @include('includes.admin.header')
        @include('includes.admin.sidebarleft')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- /.content-wrapper -->
        @include('includes.admin.footer')

        @include('includes.admin.sidebarright')
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>

    </div>

    {{--<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->--}}
    {{--<script>--}}
        {{--$.widget.bridge('uibutton', $.ui.button);--}}
    {{--</script>--}}
    <!-- Scripts -->
    <script src="{{ asset('admin/js/app.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

    <script src="{{ asset('admin/js/all.js') }}"></script>
    @stack('scripts')
</body>
</html>
