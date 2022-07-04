<!doctype html>
<html lang="en">
<head>
    @include('template/header')
</head>
<body>

@include('template/nav-bar')
@yield('body')
@include('template/message')
@include('template/footer')
</body>
</html>
