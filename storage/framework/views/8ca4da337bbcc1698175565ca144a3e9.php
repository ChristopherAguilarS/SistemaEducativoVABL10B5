
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">aaaaaaaa
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo_vab_icono.png')); ?>" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo_vab.png')); ?>" alt="" height="40">
                <img src="<?php echo e(URL::asset('build/images/logo_vab_icono2.png')); ?>" alt="" height="50">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="/" class="logo logo-light">aaaaaaaa
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo_vab_icono.png')); ?>" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo_vab_icono.png')); ?>" alt="" height="40">
                <img src="<?php echo e(URL::asset('build/images/logo_vab_icono2.png')); ?>" alt="" height="50">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span><?php echo e($modulo); ?>

                    </span></li>
                <li class="nav-item">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!--[if BLOCK]><![endif]--><?php if($menu['tipo']): ?>
                            <a class="nav-link menu-link" href="#sidebar<?php echo e($menu['vista']); ?>" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar<?php echo e($menu['vista']); ?>">
                                <i class="mdi <?php echo e($menu['icon']); ?>"></i> <span><?php echo e($menu['nombre']); ?></span>
                            </a>

                            <div class="collapse menu-dropdown <?php echo e($prefix === $url.'/'.$menu['vista'] ? 'show' : ''); ?>" id="sidebar<?php echo e($menu['vista']); ?>">
                                <ul class="nav nav-sm flex-column">
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $menu['detalle']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route($url.'/'.$menu['vista'].'/'.$submenu['vista'])); ?>" class="nav-link <?php echo e(request()->routeIs($url.'/'.$menu['vista'].'/'.$submenu['vista']) ? 'active' : ''); ?>" data-key="t-<?php echo e($submenu['vista']); ?>"><?php echo e($submenu['nombre']); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                                </ul>
                            </div>
                        <?php else: ?>
                            <a class="nav-link menu-link <?php echo e(request()->routeIs($url.'/'.$menu['vista']) ? 'active' : ''); ?>" href="<?php echo e(route($url.'/'.$menu['vista'])); ?>">
                                <i class="mdi <?php echo e($menu['icon']); ?>"></i> <span><?php echo e($menu['nombre']); ?></span>
                            </a>
                        <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<?php /**PATH D:\Sistema Educativo - B5\resources\views/livewire/administracion/menus.blade.php ENDPATH**/ ?>