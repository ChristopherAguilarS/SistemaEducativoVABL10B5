<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th style="width:5px" scope="col">N°</th>
                                    <th scope="col">Nombre</th>
                                    <th style="width:5px" scope="col">Estado</th>
                                    <th style="width:5px" scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $especificas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $especifica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>                
                                        <td class="font-medium">
                                            <?php echo e($loop->iteration); ?>

                                        </td>
                                        <td>
                                            <?php echo e($especifica->nombre); ?>

                                        </td>
                                        <td>
                                            <h5>
                                                <!--[if BLOCK]><![endif]--><?php if($especifica->estado == 1): ?>
                                                    <span style="margin-top:5px" class="badge bg-success">Activo</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Inactivo</span>
                                                <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                            </h5>
                                            
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-sm"  @click="$dispatch('nuevo', [<?php echo e($especifica->id); ?>])"><i class="ri-edit-2-line"></i> Editar</button>
                                            <button type="button" class="btn btn-danger btn-sm"  @click="$dispatch('eliminar', [<?php echo e($especifica->id); ?>])"><i class="ri-delete-bin-line"></i> Eliminar</button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <?php echo e($especificas->links()); ?>

                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
</div>
<?php /**PATH C:\Users\tavo_\OneDrive\Escritorio\Proyectos\SistemaEducativoVABL10B5\resources\views/livewire/academico/administracion/plan-academico/table.blade.php ENDPATH**/ ?>