<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href={{asset("assets/images/favicon.ico")}}>
    <!-- Layout config Js -->
    <script src={{asset("assets/js/layout.js")}}></script>
    <!-- Bootstrap Css -->
    <link href={{asset("assets/css/bootstrap.min.css")}} rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href={{asset("assets/css/icons.min.css")}} rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href={{asset("assets/css/app.min.css")}} rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href={{asset("assets/css/custom.min.css")}} rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    @yield('content')
    @yield('js')

    <!-- JAVASCRIPT -->
    <script src={{asset("assets/libs/bootstrap/js/bootstrap.bundle.min.js")}}></script>
    <script src={{asset("assets/libs/simplebar/simplebar.min.js")}}></script>
    <script src={{asset("assets/libs/node-waves/waves.min.js")}}></script>
    <script src={{asset("assets/libs/feather-icons/feather.min.js")}}></script>
    <script src={{asset("assets/js/pages/plugins/lord-icon-2.1.0.js")}}></script>
    <script src={{asset("assets/js/plugins.js")}}></script>

    <!-- particles js -->
    <script src={{asset("assets/libs/particles.js/particles.js")}}></script>

    <!-- particles app js -->
    <script src={{asset("assets/js/pages/particles.app.js")}}></script>

    <!-- password-addon init -->
    <script src={{asset("assets/js/pages/passowrd-create.init.js")}}></script>
    <script src={{asset("assets/js/pages/password-addon.init.js")}}></script>
</body>
</html>