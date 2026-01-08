<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title inertia>{{ config('app.name', 'MARISTAN') }}</title>

    
    <!-- Fonts -->
 <!-- <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">  -->
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('css/typography.css') }}" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
    <!--Print CSS -->
    <link rel="stylesheet" href="{{ asset('css/print.css') }}"/>
    <!-- Full calendar -->
    <link rel="stylesheet" href="{{ asset('fullcalendar/core/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('fullcalendar/daygrid/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('fullcalendar/timegrid/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('fullcalendar/list/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
    <!-- Scripts -->
    <!-- Wrapper END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('plugin/jquery.min.js') }}"></script>
    <script src="{{ asset('plugin/popper.min.js') }}"></script>
    <script src="{{ asset('plugin/bootstrap.min.js') }}"></script>
    <!-- Appear JavaScript -->
    <script src="{{ asset('plugin/jquery.appear.js') }}"></script>
    <script src="{{ asset('plugin/printjs.js') }}"></script>


    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased" style="background-image: url('{{ asset('images/bg.jpg') }}'); ">
    @inertia
    <!-- Countdown JavaScript -->
    <script src="{{ asset('plugin/countdown.min.js') }}"></script>
    <!-- Counterup JavaScript -->
    <script src="{{ asset('plugin/waypoints.min.js') }}"></script>
    <script src="{{ asset('plugin/jquery.counterup.min.js') }}"></script>
    <!-- Wow JavaScript -->
    <script src="{{ asset('plugin/wow.min.js') }}"></script>
    <!-- Apexcharts JavaScript -->
    <script src="{{ asset('plugin/apexcharts.js') }}"></script>
    <!-- Slick JavaScript -->
    <script src="{{ asset('plugin/slick.min.js') }}"></script>
    <!-- Select2 JavaScript -->
    <script src="{{ asset('plugin/select2.min.js') }}"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="{{ asset('plugin/owl.carousel.min.js') }}"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{ asset('plugin/jquery.magnific-popup.min.js') }}"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="{{ asset('plugin/smooth-scrollbar.js') }}"></script>
    <!-- lottie JavaScript -->
    <script src="{{ asset('plugin/lottie.js') }}"></script>

    <!-- Full calendar -->
    <script src="{{ asset('fullcalendar/core/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/daygrid/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/timegrid/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/list/main.js') }}"></script>
    <!-- Flatpicker Js -->
    <script src="{{ asset('plugin/flatpickr.js') }}"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('plugin/chart-custom.js') }}"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('plugin/custom.js') }}"></script>

    <!-- <script src="{{ asset('plugin/jquery.min.js')  }}"></script> -->

    <script src="{{ asset('plugin/owl.carousel.min.js') }}"></script>




</body>

</html>
