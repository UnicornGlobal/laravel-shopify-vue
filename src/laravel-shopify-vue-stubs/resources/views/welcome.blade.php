<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{ config('shopify-app.app_name') }}</title>

        @yield('styles')
        <!-- <script src="http://localhost:8098"></script> -->
    </head>

    <body>
        @include('splash')
        @include('pre-loader')

        <script type="text/plain" id="shop_key">{{ config('shopify-app.api_key') }}</script>
        <script type="text/plain" id="shop_name">{{ Request::input('shop') }}</script>

        <div class="app-wrapper" id="app"></div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
