<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/ela/images/favicon.png">
    <title>Ela - Bootstrap Admin Dashboard Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="/ela/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->

    <link href="/ela/css/lib/calendar2/semantic.ui.min.css" rel="stylesheet">
    <link href="/ela/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="/ela/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="/ela/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="/ela/css/helper.css" rel="stylesheet">
    <link href="/ela/css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    @include('cms::partials.__preloader')
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        @include('cms::partials.__header')
        <!-- End header header -->
        <!-- Left Sidebar  -->
        @include('cms::partials.__sidebar')
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            @include('cms::partials.__bread-crum')
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                @yield('content')
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            @include('cms::partials.__footer')
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="/ela/js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="/ela/js/lib/bootstrap/js/popper.min.js"></script>
    <script src="/ela/js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="/ela/js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="/ela/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="/ela/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->


    <!-- Amchart -->
     <script src="/ela/js/lib/morris-chart/raphael-min.js"></script>
    <script src="/ela/js/lib/morris-chart/morris.js"></script>
    <script src="/ela/js/lib/morris-chart/dashboard1-init.js"></script>


    <script src="/ela/js/lib/calendar-2/moment.latest.min.js"></script>
    <!-- scripit init-->
    <script src="/ela/js/lib/calendar-2/semantic.ui.min.js"></script>
    <!-- scripit init-->
    <script src="/ela/js/lib/calendar-2/prism.min.js"></script>
    <!-- scripit init-->
    <script src="/ela/js/lib/calendar-2/pignose.calendar.min.js"></script>
    <!-- scripit init-->
    <script src="/ela/js/lib/calendar-2/pignose.init.js"></script>

    <script src="/ela/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="/ela/js/lib/owl-carousel/owl.carousel-init.js"></script>
    <script src="/ela/js/scripts.js"></script>
    <!-- scripit init-->

    <script src="/ela/js/custom.min.js"></script>

</body>

</html>