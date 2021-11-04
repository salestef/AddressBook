<!doctype html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <title>AddressBook - @yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/js/main.js"></script>
</head>


<body>
<section>
    <div class="container">
        @include('contact._header')
        @yield('content')
    </div>

<footer>&copy; Copyright <?=date('Y')?> <b>AddressBook</b></footer>

</section>

</body>
</html>
