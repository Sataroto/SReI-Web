
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Form Wizard | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('Template/favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('Template/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('Template/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('Template/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="{{asset('Template/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('Template/css/style.css')}}" rel="stylesheet">
</head>

<body class="login-page ls-closed">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>SReI</b></a>
            <small>Sistema de Registro e Inventario</small>
        </div>
        <div class="card">

                @yield('content')

        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{asset('Template/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('Template/plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Select Plugin Js -->
    <script src="{{asset('Template/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

    <!-- Slimscroll Plugin Js -->
    <!--script src="{{asset('Template/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script-->

    <!-- Jquery Validation Plugin Css -->
    <script src="{{asset('Template/plugins/jquery-validation/jquery.validate.js')}}"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="{{asset('Template/plugins/jquery-steps/jquery.steps.js')}}"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="{{asset('Template/plugins/sweetalert/sweetalert.min.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('Template/plugins/node-waves/waves.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{asset('Template/js/admin.js')}}"></script>
    <script src="{{asset('Template/js/pages/forms/form-wizard.js')}}"></script>

    <!-- Demo Js -->
    <script src="{{asset('Template/js/demo.js')}}"></script>
</body>
</html>
