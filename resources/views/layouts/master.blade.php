<!DOCTYPE html>
<html>
<head>
    @yield('style')
    <title>JUST FILLING :: @yield('title')</title>


</head>
<body>
@include('components.nav')
@yield('content')
@include('components.footer')
@yield('js')
</body>

</html>
