<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Auction-Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="">

    <!-- App css -->
    <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/theme.min.css')}}" rel="stylesheet" type="text/css" />


</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

    @include('backend.layouts.header')

        

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
       

           @yield('content')

           @yield('scripts')
                
            <!-- End Page-content -->

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>

    
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery  -->
    <script src="{{asset('backend/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/metismenu.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/waves.js')}}"></script>
    <script src="{{asset('backend/assets/js/simplebar.min.js')}}"></script>

    <!-- Sparkline Js-->
    <script src="{{asset('backend/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Chart Js-->
    <script src="{{asset('backend/assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>

    <!-- Morris Js-->
    <script src="{{asset('backend/assets/plugins/morris-js/morris.min.js')}}"></script>
    <!-- Raphael Js-->
    <script src="{{asset('backend/assets/plugins/raphael/raphael.min.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{asset('backend/assets/pages/dashboard-demo.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('backend/assets/js/theme.js')}}"></script>

    
     <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="{{ mix('/js/app.js') }}"></script>

</body>

</html>