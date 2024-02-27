
<?php $__env->startSection('title'); ?>
    Presupuestal
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Plan Anual de Trabajo
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        Plan Anual de Trabajo
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('financiero-contable.presupuestal.plan-anual-trabajo.filtro');

$__html = app('livewire')->mount($__name, $__params, 'lw-1669370765-0', $__slots ?? [], get_defined_vars());

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
[$__name, $__params] = $__split('financiero-contable.presupuestal.plan-anual-trabajo.table');

$__html = app('livewire')->mount($__name, $__params, 'lw-1669370765-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Sistema Educativo - B5\resources\views/livewire/financiero-contable/presupuestal/plan-anual-trabajo/index.blade.php ENDPATH**/ ?>