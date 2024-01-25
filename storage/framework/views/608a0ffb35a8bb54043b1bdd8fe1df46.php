<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">SubGenericas</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Generica</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $subgenericas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subgenerica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>                
                                <td class="font-medium">
                                    <?php echo e($loop->index+1); ?>

                                </td>
                                <td>
                                    <?php echo e($subgenerica->descripcion); ?>

                                </td>
                                <td>
                                    <?php echo e(optional(optional($subgenerica)->generica)->descripcion); ?>

                                </td>
                                <td>
                                    <!--[if BLOCK]><![endif]--><?php if($subgenerica->estado == 1): ?>
                                        <span class="badge bg-success"><?php echo e($subgenerica->nEstado); ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-danger"><?php echo e($subgenerica->nEstado); ?></span>
                                    <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-animation waves-effect waves-light" data-text="Info"><span>Editar</span></button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <?php echo e($subgenericas->links()); ?>

                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
</div>
<?php /**PATH D:\Sistema Educativo - B5\resources\views/livewire/configuracion/financiero/sub-generica-nivel-1/table.blade.php ENDPATH**/ ?>