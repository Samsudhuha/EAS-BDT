<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{url('vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{url('vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{url('vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{url('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{url('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{url('vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('js/select.dataTables.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{url('css/vertical-layout-light/style.css')}}">
    <link rel="stylesheet" href="{{url('vendors/sweetalert2/sweetalert2.min.css')}}">
    <!-- endinject -->
    @section('include-js')

    @show

    @yield('custom-css')
</head>
<body>
    <div class="container-scroller">
        @yield('navbar')

        <div class="container-fluid page-body-wrapper">
            @yield('sidebar')

            @yield('content')

        </div>
    </div>
  

    <!-- plugins:js -->
    <script src="{{url('vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{url('vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{url('vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{url('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    <script src="{{url('js/dataTables.select.min.js')}}"></script>
    <script src="{{url('vendors/sweetalert2/sweetalert2.min.js')}}"></script>
    
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{url('js/off-canvas.js')}}"></script>
    <script src="{{url('js/hoverable-collapse.js')}}"></script>
    <script src="{{url('js/template.js')}}"></script>
    <script src="{{url('js/settings.js')}}"></script>
    <script src="{{url('js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{url('js/dashboard.js')}}"></script>
    <script src="{{url('js/Chart.roundedBarCharts.js')}}"></script>
    <!-- End custom js for this page-->

    @section('include-js')

    @show

    @yield('custom-js')
</body>

</html>

