<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Página de Teste Joinner Sistemas</title>

    <meta name="_token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800"
        rel="stylesheet">
    <!-- Libraries CSS Files -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Common plugins -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="plugins/bootstrap-sweet-alerts/sweet-alert.css" rel="stylesheet" type="text/css">
    <link href="css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/plugins/select2/select2.min.css" rel="stylesheet" type="text/css">
    <link href="css/shared/select2.css" rel="stylesheet" type="text/css">
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet" type="text/css">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet" type="text/css">
    <link href="css/plugins/cropper/cropper.min.css" rel="stylesheet" type="text/css">
    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.min.js"></script>
    <link href="https://kendo.cdn.telerik.com/2021.1.119/styles/kendo.common.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2021.1.119/styles/kendo.rtl.min.css">
    <link href="https://kendo.cdn.telerik.com/2021.1.119/styles/kendo.default.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2021.1.119/styles/kendo.mobile.all.min.css">
    <script src="https://kendo.cdn.telerik.com/2021.1.119/js/angular.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2021.1.119/js/jszip.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2021.1.119/js/kendo.all.min.js"></script>
    <script src="js/kendo.pt-BR.js"></script>

    {{-- @stack('css') --}}
    @if (!empty($css))
        @foreach ($css as $s)
            <style type="text/css" src="{{ asset('css/' . $s . '.css') }}" rel="stylesheet"></style>
        @endforeach
    @endif

</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <h2>Joinner</h2>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">Ricardo Oliveira <b class="caret"></b></span>
                                <span class="text-muted text-xs block">Teste Full Stack</span>
                            </a>
                        </div>
                        <div class="logo-element">
                            J
                        </div>
                    </li>
                    <li class="{{ !empty($active) && $active == 'pessoa' ? 'active' : '' }}">
                        <a href="pessoa">
                            <i class="fa fa-th-large"></i> <span class="nav-label">PESSOAS</span>
                        </a>
                    </li>
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">

            <div class="container">
                @yield('content')
            </div>

            <!-- Footer -->
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- ChartJS-->
    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>
    <script src="js/default.js"></script>

    <script src="plugins/bootstrap-sweet-alerts/sweet-alert.min.js"></script>
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>
    <script src="js/plugins/select2/select2.full.min.js"></script>
    <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
    <script src="js/plugins/fullcalendar/moment.min.js"></script>
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script src="js/plugins/cropper/cropper.min.js"></script>
    <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>


    @if (!empty($js))
        @foreach ($js as $j)
            <script src="{{ asset('js/' . $j . '.js') }}"></script>
        @endforeach
    @endif
</body>

</html>
