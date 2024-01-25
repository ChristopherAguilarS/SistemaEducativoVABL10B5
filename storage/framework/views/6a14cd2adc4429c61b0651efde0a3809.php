<div>
    <div class="box">
        <div class="box-header">
            <h5 class="box-title">Tipos de Transacciones</h5>
        </div>
        <div class="p-0 box-body">
            <div class="overflow-auto">
                <table class="ti-custom-table ti-custom-table-head ti-striped-table">
                    <thead>
                        <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="!text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $tipoTransacciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoTransaccion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>                
                                <td class="font-medium">
                                    <?php echo e($loop->index+1); ?>

                                </td>
                                <td>
                                    <?php echo e($tipoTransaccion->descripcion); ?>

                                </td>
                                <td>
                                    <!--[if BLOCK]><![endif]--><?php if($tipoTransaccion->estado == 1): ?>
                                        <span class="text-white bg-green-500 badge"><?php echo e($tipoTransaccion->nEstado); ?></span>
                                    <?php else: ?>
                                        <span class="text-white bg-red-500 badge"><?php echo e($tipoTransaccion->nEstado); ?></span>
                                    <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                </td>
                                <td class="text-center">
                                    <button type="button" class="rounded-full ti-btn ti-btn-outline ti-btn-outline-danger">
                                        Editar
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-1 mt-5">
                <?php echo e($tipoTransacciones->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\Sistema Educativo - B5\resources\views/livewire/configuracion/financiero/tipo-transaccion/table.blade.php ENDPATH**/ ?>