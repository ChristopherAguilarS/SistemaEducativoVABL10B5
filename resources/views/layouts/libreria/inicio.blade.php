@extends('layouts.master-without-nav')
@section('title') @lang('translation.landing') @endsection
@section('css')
<!--Swiper slider css-->
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body')
<body data-bs-spy="scroll" data-bs-target="#navbar-example">
    @endsection
    @section('content')

    <!-- Begin page -->
    <div class="layout-wrapper landing">
        <nav class="navbar navbar-expand-lg navbar-landing navbar-light fixed-top" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="index">
                <img src="{{URL::asset('build/images/logo-light.png')}}" class="card-logo card-logo-dark" alt="logo dark" height="67">
                    <img src="{{URL::asset('build/images/logo-light.png')}}" class="card-logo card-logo-light" alt="logo light" height="67">
                </a>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                        <li class="nav-item">
                            <a class="nav-link active" href="#hero">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#wallet">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/biblioteca/ver-libros">Libros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contactanos">Contactanos</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
        <!-- end navbar -->

        <!-- start hero section -->
        @livewire('biblioteca.inicio.components.slider')    

        <!-- start wallet -->
        <section class="section" id="wallet" style="padding: 30px 0;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h2 class="mb-3 fw-semibold lh-base">Servicios</h2>
                            <p class="text-muted">Solicita el préstamo/reserva de libros para la revisión en tu hogar, siempre que cumplas los siguientes requisitos:</p>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->

                <div class="row">
                    <div class="col-lg-3">
                        <div class="card shadow-none">
                            <div class="card-body text-center"> 
                                <img src="{{URL::asset('build/images/nft/user-pass.png')}}" alt="" class="avatar-md">
                                <p class="text-muted fs-14">Ser estudiante de nuestra institución y tener el respectivo usuario y contraseña.</p>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-3">
                        <div class="card shadow-none">
                            <div class="card-body text-center"> 
                                <img src="{{URL::asset('build/images/nft/solicita-libro.png')}}" alt="" class="avatar-md">
                                <p class="text-muted fs-14">Solicita el libro de tu interés dando click en la opcién "Solicitar Préstamo".</p>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-3">
                        <div class="card shadow-none">
                            <div class="card-body text-center">
                                <img src="{{URL::asset('build/images/nft/carne.png')}}" alt="" class="avatar-md">
                                <p class="text-muted fs-14">Acercate a la biblioteca al módulo de atención con tu carnet de estudiante o DNI para registrar el préstamo..</p>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-3">
                        <div class="card shadow-none">
                            <div class="card-body text-center">
                                <img src="{{URL::asset('build/images/nft/tiempo.png')}}" alt="" class="avatar-md">
                                <p class="text-muted fs-14">Toma nota de la fecha de devolución del libro  y devuélvelo a tiempo..</p>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div><!-- end container -->
        </section>

        <!-- start marketplace -->
        @livewire('biblioteca.inicio.components.categorias')
        <!-- end marketplace -->

        <!-- start features -->
        <!-- end features -->

        <!-- end plan -->

        <!-- start Discover Items-->
        @livewire('biblioteca.inicio.components.contactanos')
        <!--end Discover Items-->

        <!-- start Work Process -->
        
        <!-- start cta -->
        
        <!-- end cta -->

        <!-- Start footer -->
        <footer class="custom-footer bg-dark py-5 position-relative">
            <div class="container">
                <div class="row">
     
                        <div>
                            <div>
                                <img src="{{URL::asset('build/images/logo-light.png')}}" alt="logo light" height="80">
                            </div>
                            <div class="mt-4">
                                <p>40 años al servicio de la educación del país, formando maestros que promueven la investigación y la innovación.</p>
                                <ul>
                          <li class="phone"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> (076) 431496
                          <small><i class="fa fa-clock-o" aria-hidden="true"></i> Lunes a viernes 8:00 am - 5:30 pm</small></li>
                          <li class="address">
                          <address>
                            <i class="fa fa-map-pin" aria-hidden="true"></i>
                            Calle Hospital N° 350 - Jaén
                          </address>
                          </li>
                      </ul>
                            </div>
                        </div>
     

                    

                </div>

                <div class="row text-center text-sm-start align-items-center mt-5">
                    <div class="col-sm-6">

                        <div>
                            <p class="copy-rights mb-0">
                                <script>
                                    document.write(new Date().getFullYear())

                                </script> © Velzon - Themesbrand
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end mt-3 mt-sm-0">
                            <ul class="list-inline mb-0 footer-social-link">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-facebook-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-github-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-linkedin-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-google-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-dribbble-line"></i>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->

        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

    </div>
    <!-- end layout wrapper -->

    @endsection
    @section('script')
    <!--Swiper slider js-->
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/nft-landing.init.js') }}"></script>
    @endsection
