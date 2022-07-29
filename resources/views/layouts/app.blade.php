<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kerry Festival') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?ver=1.0">
    <script src="https://kit.fontawesome.com/087ab91f74.js" crossorigin="anonymous"></script>
    @stack('extra_styles')
    @livewireStyles

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NCK4G147KV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-NCK4G147KV');
    </script>
{{--    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}

</head>
<body class="font-sans antialiased">
<div class="flex flex-col justify-between min-h-screen bg-gray-100" id="main-box">
    <div>
    @include('layouts.header')

    <!-- Page Heading -->
        @if(! Request::is('/'))
            <header class="bg-white shadow-lg z-50" id="white-header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
    @endif

    <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>


    <footer class="w-full mt-8">
        {{--  Logos --}}
        <div class="flex flex-wrap justify-center lg:justify-between bg-white py-4 px-6">
            <img src="{{ asset('img/logos/mental-health.jpg') }}" class="w-auto h-12 object-center px-1 mt-2 lg:mt-0" alt="Kerry Mental Health Association">
            <img src="{{ asset('img/logos/connecting-for-life.jpg') }}" class="w-auto h-12 object-center px-1 mt-2 lg:mt-0" alt="Connecting for Life Kerry">
            <img src="{{ asset('img/logos/hse.jpg') }}" class="w-auto h-12 object-center px-1 mt-2 lg:mt-0" alt="Health Service Executive">
            <img src="{{ asset('img/logos/cork-kerry.jpg') }}" class="w-auto h-12 object-center px-1 mt-2 lg:mt-0" alt="Cork Kerry Community Healthcare">
            <img src="{{ asset('img/logos/jigsaw.jpg') }}" class="w-auto h-12 object-center px-1 mt-2 lg:mt-0" alt="Jigsaw Kerry">
            <img src="{{ asset('img/logos/kerry-sports-partnership.jpg') }}" class="w-auto h-12 object-center px-1 mt-2 lg:mt-0" alt="Kerry Sports Partnership">
            <img src="{{ asset('img/logos/kerry-volunteer.png') }}" class="w-auto h-12 object-center px-1 mt-2 lg:mt-0" alt="Kerry Volunteer Centre">
            <img src="{{ asset('img/logos/newkd.jpg') }}" class="w-auto h-12 object-center px-1 mt-2 lg:mt-0" alt="North East West Kerry Development Programme">
            <img src="{{ asset('img/logos/sicap.jpg') }}" class="w-auto h-12 object-center px-1 mt-2 lg:mt-0" alt="The Social Inclusion and Community Activation Programme">
            <img src="{{ asset('img/logos/skdp.jpg') }}" class="w-auto h-12 object-center px-1 mt-2 lg:mt-0" alt="South Kerry Development Programme">
        </div>
        @include('layouts.footer')
    </footer>
</div>
@livewireScripts
@stack('footer_styles')
</body>

</html>
