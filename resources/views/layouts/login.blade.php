@include('includes.login.head')
<body class="hold-transition login-page">
    <div id="app">

                @yield('content')
            </div>

    <!-- Scripts -->
    <script src="{{ asset('admin/js/app.js') }}"></script>
    <script src="{{ asset('admin/js/all.js') }}"></script>

    @stack('scripts')
</body>
</html>
