<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Actividades Operativas</h4>
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
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $actividadOperativas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actividadOperativa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>                
                                        <td class="font-medium">
                                            <?php echo e($loop->index+1); ?>

                                        </td>
                                        <td>
                                            <?php echo e($actividadOperativa->descripcion); ?>

                                        </td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if($actividadOperativa->estado == 1): ?>
                                                <span class="badge bg-success"><?php echo e($actividadOperativa->nEstado); ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-danger"><?php echo e($actividadOperativa->nEstado); ?></span>
                                            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td class="text-center">
                                            <!--[if BLOCK]><![endif]--><?php if($actividadOperativa->estado == 1): ?>
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado(<?php echo e($actividadOperativa->id); ?>)'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            <?php else: ?>
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado(<?php echo e($actividadOperativa->id); ?>)'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar(<?php echo e($actividadOperativa->id); ?>)'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <?php echo e($actividadOperativas->links()); ?>

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
                            <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripcion" wire:model='form.descripcion'></textarea>
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
                            <label for="plan_anual_trabajo_id" class="col-form-label">Plan Anual:</label>
                            <select class="js-example-basic-single" id="plan_anual_trabajo_id" name="state" wire:model='form.plan_anual_trabajo_id'>
                                <option value="">Seleccionar Opcion</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $plan_anuales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan_anual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($plan_anual->id); ?>"><?php echo e($plan_anual->año); ?> - <?php echo e($plan_anual->nombre); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="objetivo_estrategico_id" class="col-form-label">Objetivo Estrategico:</label>
                            <select class="js-example-basic-single" id="objetivo_estrategico_id" name="state" wire:model='form.objetivo_estrategico_id'>
                                <option value="">Seleccionar Opcion</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $objetivos_estrategicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $objetivo_estrategico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($objetivo_estrategico->id); ?>"><?php echo e($objetivo_estrategico->codigo); ?> - <?php echo e($objetivo_estrategico->descripcion); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>    
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click='guardar'>Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
        <?php
        $__scriptKey = '2846044763-0';
        ob_start();
    ?>
        <script>
            $('#plan_anual_trabajo_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#plan_anual_trabajo_id').on('change',function(){
                let a = document.getElementById("plan_anual_trabajo_id").value;
                $wire.set('form.plan_anual_trabajo_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#plan_anual_trabajo_id').val(event.id);
                $('#plan_anual_trabajo_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#plan_anual_trabajo_id').val(null).trigger('change');
            });
        </script>
        <script>
            $('#objetivo_estrategico_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#objetivo_estrategico_id').on('change',function(){
                let a = document.getElementById("objetivo_estrategico_id").value;
                $wire.set('form.objetivo_estrategico_id',a);
            })
            $wire.on('cambiarSeleccionOE', (event) => {
                $('#objetivo_estrategico_id').val(event.id);
                $('#objetivo_estrategico_id').trigger('change');
            });
            $wire.on('anularSeleccionOE', (event) => {
                $('#objetivo_estrategico_id').val(null).trigger('change');
            });
        </script>
        <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
</div>

<?php /**PATH D:\Sistema Educativo - B5\resources\views/livewire/financiero-contable/presupuestal/actividades-operativas/table.blade.php ENDPATH**/ ?>