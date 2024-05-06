<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico')}}">
    
    @include('layouts.head-css')
</head>

@section('body')
    @include('layouts.body')
@show
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.topbar')
        @livewire('administracion.menus')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    @include('layouts.customizer')

    <!-- JAVASCRIPT -->
    @include('layouts.vendor-scripts')

<!-- apexcharts -->
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>


<!-- dashboard init -->
<script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/rater-js/index.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/rating.init.js') }}"></script>
    <script>
        window.addEventListener('confirmar', event => {
            console.log(event.detail[0]);
            Swal.fire({
                title: "<strong>"+ event.detail[0].mensaje +"</u></strong>",
                icon: "info",
                html: event.detail[0].detalle,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                cancelButtonColor: "#d33",
                confirmButtonColor: "#3085d6",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch(event.detail[0].funcion);
                } else {
                    //Livewire.dispatch('cerrar');
                }
            })
        });
        window.addEventListener('info', event => {
            console.log(event.detail[0]);
            Swal.fire({
                title: "<strong>"+ event.detail[0].mensaje +"</u></strong>",
                icon: event.detail[0].icon,
                html: event.detail[0].detalle
            })
        });
        window.addEventListener('alert_info', event => {
            Toastify({
                text: event.detail[0].mensaje,
                className: "info",
                gravity: "bottom", // `top` or `bottom`
                position: "left", // `left`, `center` or `right`
                style: {
                    background: "#05ad64",
                },
            }).showToast()
        });
        window.addEventListener('alert_warning', event => {
            Toastify({
                text: event.detail[0].mensaje,
                className: "info",
                gravity: "bottom", // `top` or `bottom`
                position: "left", // `left`, `center` or `right`
                style: {
                    background: "#fdda4b",
                },
            }).showToast()
        });
        window.addEventListener('alert_success', event => {
            Toastify({
                text: event.detail[0].mensaje,
                className: "info",
                gravity: "bottom", // `top` or `bottom`
                position: "left", // `left`, `center` or `right`
                style: {
                    background: "#05ad64",
                },
            }).showToast()
        });
        window.addEventListener('alert_danger', event => {
            Toastify({
                text: event.detail[0].mensaje,
                className: "danger",
                gravity: "bottom", // `top` or `bottom`
                position: "left", // `left`, `center` or `right`
                style: {
                    background: "#f06548",
                },
            }).showToast()
        });
        window.addEventListener('verModal', event => {
           $('#'+event.detail[0].id).modal(event.detail[0].accion)
        });
    </script>
</body>

</html>
