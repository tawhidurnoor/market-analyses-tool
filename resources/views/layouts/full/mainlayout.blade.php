<!doctype html>
<html class="no-js" lang="">

<head>
    @yield('head')

    @include('layouts.partials.head')
</head>

<body>

    @include('layouts.partials.header')

    @include('layouts.partials.menu')

    <!-- Main Body -->
    @yield('body')
    <!-- Main Body Ends-->

    @include('layouts.partials.footer')

    @include('layouts.partials.scripts')

    @yield('scripts')

</body>

</html>