<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>


@include('includes.header')

    <div class="main">
        <div>
            @include('includes.sidebarleft')
        </div>
        <div class="container-contenet">
            @yield('content')


        </div>
    </div>
        @include('includes.sidebarright')


    <div class="clear">
        <script src="{{ asset('admin/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
        <script type="text/javascript" src=
        "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('admin/js/all.js') }}"></script>
    </div>
        @include('includes.footer')
        @stack('scripts')


</body>
</html>