
<?php $__env->startSection('title'); ?>
    Tipos de Transacciones
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Finaciero
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Tipos de Transacciones
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('configuracion.financiero.tipo-transaccion.filtro');

$__html = app('livewire')->mount($__name, $__params, 'lw-2685783238-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('configuracion.financiero.tipo-transaccion.table');

$__html = app('livewire')->mount($__name, $__params, 'lw-2685783238-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\tavo_\OneDrive\Escritorio\Proyectos\SistemaEducativoVABL10B5\resources\views/livewire/configuracion/financiero/tipo-transaccion/index.blade.php ENDPATH**/ ?>