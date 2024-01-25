<div>
    <div class="box">
        <div class="box-header">
            <h5 class="box-title">Genericas</h5>
        </div>
        <div class="box-body p-0">
            <div class="overflow-auto">
                <table class="ti-custom-table ti-custom-table-head ti-striped-table">
                    <thead>
                        <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Tipo Transaccion</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="!text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $genericas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $generica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>                
                                <td class="font-medium">
                                    <?php echo e($loop->index+1); ?>

                                </td>
                                <td>
                                    <?php echo e($generica->descripcion); ?>

                                </td>
                                <td>
                                    <?php echo e(optional(optional($generica)->tipo_transaccion)->descripcion); ?>

                                </td>
                                <td>
                                    <!--[if BLOCK]><![endif]--><?php if($generica->estado == 1): ?>
                                        <span class="badge bg-green-500 text-white"><?php echo e($generica->nEstado); ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-red-500 text-white"><?php echo e($generica->nEstado); ?></span>
                                    <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                </td>
                                <td class="text-center">
                                    <button type="button" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-danger">
                                        Editar
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                    </tbody>
                </table>
            </div>
            <div class="py-1 px-4 mt-5">
                <?php echo e($genericas->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\Sistema Educativo - B5\resources\views/livewire/configuracion/financiero/generica/table.blade.php ENDPATH**/ ?>