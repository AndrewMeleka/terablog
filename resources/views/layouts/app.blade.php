<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tera Blog</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        {{-- animation --}}
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>

        <!-- Start Header -->
            @yield('header')
        <!-- Start Header -->

        <!-- Start App Content  -->
        <main id="teraApp">
            <div class="container">
                @yield('teracontent')             
            </div>
        </main>
        <!-- End App Content  -->


        <!-- start footer -->
        <footer id="teraFooter">
            <h3>Created By Developers99</h3>
            <p class="my-0">Powered By Laravel</p>
        </footer>
        <!-- End Footer -->

        {{-- scripts --}}
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
        @yield('scripts')
       
    </body>
</html>
