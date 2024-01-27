<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" data-layout="vertical" data-topbar="light"
    data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title><?php echo $__env->yieldContent('title'); ?> | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(URL::asset('build/images/favicon.ico')); ?>">
    <?php echo $__env->make('layouts.head-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<?php $__env->startSection('body'); ?>
<?php echo $__env->make('layouts.body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldSection(); ?>
<!-- Begin page -->
<div id="layout-wrapper">
    <header id="page-topbar" style="position: sticky;">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="index" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="http://127.0.0.1:8000/build/images/logo-sm.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="http://127.0.0.1:8000/build/images/logo-dark.png" alt="" height="17">
                            </span>
                        </a>

                        <a href="index" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="http://127.0.0.1:8000/build/images/logo-sm.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="http://127.0.0.1:8000/build/images/logo-light.png" alt="" height="17">
                            </span>
                        </a>
                    </div>

                    <button type="button"
                        class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none"
                        id="topnav-hamburger-icon">
                        <span class="hamburger-icon open">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>

                    <!-- App Search-->

                </div>

                <div class="d-flex align-items-center">





                    <div class="ms-1 header-item d-none d-sm-flex">
                        <button type="button"
                            class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode shadow-none">
                            <i class="bx bx-moon fs-22"></i>
                        </button>
                    </div>



                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        <button type="button" class="btn shadow-none" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">

                                <img class="rounded-circle header-profile-user"
                                    src="data:image/png;base64,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">
                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">Gustavo
                                        Becerra</span>
                                    <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Direccion</span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <h6 class="dropdown-header">Bienvenido! Gustavo Becerra</h6>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item " href="javascript:void();"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="bx bx-power-off font-size-16 align-middle me-1"></i> <span
                                    key="t-logout">Logout</span></a>
                            <form id="logout-form" action="http://127.0.0.1:8000/logout" method="POST"
                                style="display: none;">
                                <input type="hidden" name="_token" value="HiVUyi7LWhYo0PIWj8UiejI3MurF7b8SSp6Fdl7v"
                                    autocomplete="off">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- removeNotificationModal -->
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="NotificationModalbtn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete
                            It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- ========== App Menu ========== -->

    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content" style="    margin-left: 0px;">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">

                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                        <div class="flex-grow-1">
                                            <h4 class="fs-16 mb-1">Good Morning, Anna!</h4>
                                            <p class="text-muted mb-0">Here's what's happening with your store
                                                today.</p>
                                        </div>
                                        <div class="mt-3 mt-lg-0">
                                            <form action="javascript:void(0);">
                                                <div class="row g-3 mb-0 align-items-center">
                                                    <div class="col-sm-auto">
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control border-0 dash-filter-picker shadow flatpickr-input"
                                                                data-provider="flatpickr" data-range-date="true"
                                                                data-date-format="d M, Y"
                                                                data-deafult-date="01 Jan 2022 to 31 Jan 2022"
                                                                readonly="readonly">
                                                            <div
                                                                class="input-group-text bg-primary border-primary text-white">
                                                                <i class="ri-calendar-2-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-auto">
                                                        <button type="button"
                                                            class="btn btn-soft-success shadow-none"><i
                                                                class="ri-add-circle-line align-middle me-1"></i>
                                                            Add Product</button>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-auto">
                                                        <button type="button"
                                                            class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn shadow-none"><i
                                                                class="ri-pulse-line"></i></button>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>
                                        </div>
                                    </div><!-- end card header -->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->

                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Total Earnings</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-success fs-14 mb-0">
                                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                                        +16.24 %
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span
                                                            class="counter-value" data-target="559.25">559.25</span>k
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">View net
                                                        earnings</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-success rounded fs-3">
                                                        <i class="bx bx-dollar-circle"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Orders</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-danger fs-14 mb-0">
                                                        <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                                        -3.57 %
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value" data-target="36894">36,894</span></h4>
                                                    <a href="" class="text-decoration-underline">View all orders</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-info rounded fs-3">
                                                        <i class="bx bx-shopping-bag"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Customers</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-success fs-14 mb-0">
                                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                                        +29.08 %
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value" data-target="183.35">183.35</span>M
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">See details</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-warning rounded fs-3">
                                                        <i class="bx bx-user-circle"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        My Balance</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-muted fs-14 mb-0">
                                                        +0.00 %
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span
                                                            class="counter-value" data-target="165.89">165.89</span>k
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">Withdraw money</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-danger rounded fs-3">
                                                        <i class="bx bx-wallet"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                            </div> <!-- end row-->




                        </div> <!-- end .h-100-->

                    </div> <!-- end col -->


                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <footer class="footer" style="left: 0px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script>2024 © Velzon.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design &amp; Develop by Themesbrand
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<?php echo $__env->make('layouts.customizer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- JAVASCRIPT -->
<?php echo $__env->make('layouts.vendor-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html><?php /**PATH C:\Users\tavo_\OneDrive\Escritorio\Proyectos\SistemaEducativoVABL10B5\resources\views/layouts/inicio.blade.php ENDPATH**/ ?>