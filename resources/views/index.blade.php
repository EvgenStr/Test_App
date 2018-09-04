<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcome!</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
{{--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6LBg88R5EChHzEcAr2MNoA3vGiS44gds&callback=initMap"--}}
            {{--type="text/javascript"></script>--}}

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 100vh;
        }
        .position-ref {
            position: relative;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
{{--<div class="flex-start position-ref full-height">--}}
    {{--<div id="app">--}}
        {{--<router-view></router-view>--}}
    {{--</div>--}}
{{--</div>--}}

<div class="container">
    <div id="app"></div>
</div>
{{--<script src='/js/app.js' defer></script>--}}


{{--@yield('content')--}}

</body>
</html>
