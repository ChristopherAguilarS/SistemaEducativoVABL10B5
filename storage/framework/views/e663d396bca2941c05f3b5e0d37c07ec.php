<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">SubGenericas 2</h4>
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
                                <th scope="col">Sub Generica 1</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $subgenericas2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subgenerica2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>                
                                <td class="font-medium">
                                    <?php echo e($loop->index+1); ?>

                                </td>
                                <td>
                                    <?php echo e($subgenerica2->descripcion); ?>

                                </td>
                                <td>
                                    <?php echo e(optional(optional($subgenerica2)->subgenericanivel1)->descripcion); ?>

                                </td>
                                <td>
                                    <!--[if BLOCK]><![endif]--><?php if($subgenerica2->estado == 1): ?>
                                        <span class="badge bg-success"><?php echo e($subgenerica2->nEstado); ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-danger"><?php echo e($subgenerica2->nEstado); ?></span>
                                    <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                </td>
                                <td class="text-center">
                                    <!--[if BLOCK]><![endif]--><?php if($subgenerica2->estado == 1): ?>
                                        <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado(<?php echo e($subgenerica2->id); ?>)'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                    
                                    <?php else: ?>
                                        <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado(<?php echo e($subgenerica2->id); ?>)'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                    <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                        <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar(<?php echo e($subgenerica2->id); ?>)'>Editar <i class="las la-edit"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <?php echo e($subgenericas2->links()); ?>

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
                            <label for="codigo" class="col-form-label">Codigo:</label>
                            <input type="text" class="form-control" id="codigo" wire:model='form.codigo'>
                            <div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.codigo'];
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
                            <label for="descripcion" class="col-form-label">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion" wire:model='form.descripcion'>
                            <div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="sub_generica_nivel_1_id" class="col-form-label">Generica:</label>
                            <select class="js-example-basic-single" id="sub_generica_nivel_1_id" name="state" wire:model='form.sub_generica_nivel_1_id'>
                                <option value="">Seleccionar Opcion</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $subgenericas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subgenerica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($subgenerica->id); ?>"><?php echo e($subgenerica->codigo); ?> - <?php echo e($subgenerica->descripcion); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>                        
                        <div>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.sub_generica_nivel_1_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
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
        $__scriptKey = '1364827175-0';
        ob_start();
    ?>
        <script>
            $('#sub_generica_nivel_1_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#sub_generica_nivel_1_id').on('change',function(){
                let a = document.getElementById("sub_generica_nivel_1_id").value;
                $wire.set('form.sub_generica_nivel_1_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#sub_generica_nivel_1_id').val(event.id);
                $('#sub_generica_nivel_1_id').trigger('change');
            });
        </script>
        <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
</div>
<?php /**PATH D:\Sistema Educativo - B5\resources\views/livewire/configuracion/financiero/sub-generica-nivel-2/table.blade.php ENDPATH**/ ?>