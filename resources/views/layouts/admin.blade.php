<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard 2</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('public/backend/plugins/toastr/toastr.css')}}">

</head>
<body >

<div class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    @guest
        
    @else
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        @include('layouts.admin_partial.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
       @include('layouts.admin_partial.sidebar')

      @endguest
        @yield('admin_content')
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

   
    </div>
</div>  

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('public/backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('public/backend')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('public/backend')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/backend')}}/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('public/backend')}}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{asset('public/backend')}}/plugins/raphael/raphael.min.js"></script>
<script src="{{asset('public/backend')}}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{asset('public/backend')}}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('public/backend')}}/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/backend')}}/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('public/backend')}}/dist/js/pages/dashboard2.js"></script>
<script type="text/javascript" src="{{asset('public/backend/plugins/toastr/toastr.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/backend/plugins/sweetalert/sweetalert.min.js')}}"></script>

<script>
   $(document).ready(function () {

    $("#test").click(function(e){
        e.prenentDefault();
        alert('done');
    })

});
</script>

</script>

<script>
    $(document).on("click","#delete",function(e){
        e.prenentDefault();
        var link = $(this).attr("href");
        swal({
            title:"Are you want to delete?",
            text:"Once Delete, This will be Permanently Delete!",
            icon:"warning",
            dangerMode:true,
        })
        .then((willDelete) => {
            if(willDelete){
                window.location.href = link;
            }
            else{
                swal("Safe Delete");
            }
        });
    });
</script>

<script>
    @if(Session::has('message'))
        var type="{{Session::get('alert-type','info')}}"
        switch(type){
            case 'info':
                toastr.info("{{Session::get('message')}}");
                break;
            case 'success':
                toastr.success("{{Session::get('message')}}");
                break;
            case 'warning':
                toastr.warning("{{Session::get('message')}}");
                break; 
            case 'error':
                toastr.error("{{Session::get('message')}}");
                break;   
        }
    @endif
</script>


</body>
</html>
