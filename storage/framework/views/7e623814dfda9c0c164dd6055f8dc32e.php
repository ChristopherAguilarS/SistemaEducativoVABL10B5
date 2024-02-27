<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Personas</h4>
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
                                <th scope="col">Nombre</th>
                                <th scope="col">Tipo Documento</th>
                                <th scope="col">N° Documento</th>
                                <th scope="col">Genero</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $personas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $persona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>                
                                        <td class="font-medium">
                                            <?php echo e($loop->index+1); ?>

                                        </td>
                                        <td>
                                            <?php echo e($persona->n_nombre_completo); ?>

                                        </td>
                                        <td>
                                            <?php echo e($persona->n_tipo_documento); ?>

                                        </td>
                                        <td>
                                            <?php echo e($persona->nro_documento); ?>

                                        </td>
                                        <td>
                                            <?php echo e($persona->genero); ?>

                                        </td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if($persona->estado == 1): ?>
                                                <span class="badge bg-success"><?php echo e($persona->nEstado); ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-danger"><?php echo e($persona->nEstado); ?></span>
                                            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td class="text-center">
                                            <!--[if BLOCK]><![endif]--><?php if($persona->estado == 1): ?>
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado(<?php echo e($persona->id); ?>)'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            <?php else: ?>
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado(<?php echo e($persona->id); ?>)'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar(<?php echo e($persona->id); ?>)'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <?php echo e($personas->links()); ?>

                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
    <!-- Default Modals -->
    <div wire:ignore.self id="myModal" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"><?php echo e($titulo); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombres" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombres" wire:model='form.nombres'>
                            <div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.nombres'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ape_pat" class="col-form-label">Ap. Paterno:</label>
                            <input type="text" class="form-control" id="ape_pat" wire:model='form.ape_pat'>
                            <div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.ape_pat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ape_mat" class="col-form-label">Ap. Materno:</label>
                            <input type="text" class="form-control" id="ape_mat" wire:model='form.ape_mat'>
                            <div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.ape_mat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tipo_documento" class="col-form-label">Tipo de Documento:</label>
                            <select class="form-control" id="tipo_documento" name="state" wire:model='form.tipo_documento'>
                                <option value="">Seleccionar Opcion</option>
                                <option value="dni">DNI</option> 
                                <option value="carnet_extranjeria">Carnet de Extranjeria</option> 
                                <option value="pasaporte">Pasaporte</option> 
                            </select>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.tipo_documento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <div class="mb-3">
                            <label for="nro_documento" class="col-form-label">N° Documento:</label>
                            <input type="text" class="form-control" id="nro_documento" wire:model='form.nro_documento'>
                            <div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.nro_documento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="genero" class="col-form-label">Genero:</label>
                            <select class="form-control" id="genero" name="genero" wire:model='form.genero'>
                                <option value="">Seleccionar Opcion</option>
                                <option value="0">Masculino</option> 
                                <option value="1">Femenino</option> 
                            </select>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.genero'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
                        </div> 
                        <div class="mb-3">
                            <label for="telefono" class="col-form-label">Telefono:</label>
                            <input type="text" class="form-control" id="telefono" wire:model='form.telefono'>
                            <div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>   
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click='guardar'>Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
        <?php
        $__scriptKey = '1758749957-0';
        ob_start();
    ?>
        <script>
        </script>
        <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
</div>
<?php /**PATH D:\Sistema Educativo - B5\resources\views/livewire/academico/persona/table.blade.php ENDPATH**/ ?>