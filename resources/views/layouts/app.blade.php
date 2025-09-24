<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Easy Accounting</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/logo_EA7.svg') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/plugins/fontawesome/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="{{ URL::to('assets/css/feathericon.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
    <script src="tom-select.complete.js"></script>
    <link href="tom-select.bootstrap4.css" rel="stylesheet" />
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @stack('scripts')
</head>

<!-- Moment.js -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

<!-- Daterangepicker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<body>
    @yield('content')

    <!-- Core bundle (jQuery, Bootstrap, Popper) -->
    <script src="{{ asset('template/vendor/global/global.min.js') }}"></script>

    <!-- Charts & vendor yang perlu jQuery -->
    <script src="{{ asset('template/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('template/vendor/apexchart/apexchart.js') }}"></script>
    <script src="{{ asset('template/vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('template/vendor/wnumb/wNumb.js') }}"></script>

    <!-- Moment + Daterangepicker (pindah ke sini, setelah jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- Theme scripts -->
    <script src="{{ asset('template/js/dashboard/dashboard-1.js') }}"></script>
    <script src="{{ asset('template/js/custom.min.js') }}"></script>
    <script src="{{ asset('template/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('template/js/demo.js') }}"></script>
    <script src="{{ asset('template/js/styleSwitcher.js') }}"></script>

    @stack('scripts')
</body>


</html>
