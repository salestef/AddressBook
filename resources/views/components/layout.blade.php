<!doctype html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{--<meta name="csrf-token" content="{{ csrf_token() }}" />--}}
    {{--<meta name="_token" content="{!! csrf_token() !!}"/>--}}

    <title>AddressBook</title>
    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/js/main.js"></script>
</head>


{{--<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}
<body>
<section>
    {{--<nav class="md:flex md:justify-between md:items-center">--}}
        {{--<div>--}}
            {{--<a href="/">--}}
                {{--<img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">--}}
            {{--</a>--}}
        {{--</div>--}}

        {{--<div class="mt-8 md:mt-0">--}}
            {{--<a href="/" class="text-xs font-bold uppercase">Home Page</a>--}}

            {{--<a href="#" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">--}}
                {{--Subscribe for Updates--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</nav>--}}

    {{ $slot }}

    <footer>
        FOOTER
    </footer>
</section>
</body>
</html>
