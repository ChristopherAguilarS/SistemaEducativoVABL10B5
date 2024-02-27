<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Ciclos</h4>
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
                                <th scope="col">Tipo de Ingreso</th>
                                <th scope="col">Ciclo</th>
                                <th scope="col">Especifica Nivel 2</th>
                                <th scope="col">Fec. Vigencia</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $conceptoIngresos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $concepto_ingreso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>                
                                        <td class="font-medium">
                                            <?php echo e($loop->index+1); ?>

                                        </td>
                                        <td>
                                            <?php echo e($concepto_ingreso->descripcion); ?>

                                        </td>
                                        <td>
                                            <?php echo e(optional(optional($concepto_ingreso)->tipoIngreso)->descripcion); ?>

                                        </td>
                                        <td>
                                            <?php echo e(optional(optional($concepto_ingreso)->ciclo)->descripcion); ?>

                                        </td>
                                        <td>
                                            <?php echo e(optional(optional($concepto_ingreso)->especificanivel2)->descripcion); ?>

                                        </td>
                                        <td>
                                            <?php echo e(optional($concepto_ingreso)->fecha_vigencia); ?>

                                        </td>
                                        <td>
                                            <?php echo e(optional($concepto_ingreso)->monto); ?>

                                        </td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if($concepto_ingreso->estado == 1): ?>
                                                <span class="badge bg-success"><?php echo e($concepto_ingreso->nEstado); ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-danger"><?php echo e($concepto_ingreso->nEstado); ?></span>
                                            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td class="text-center">
                                            <!--[if BLOCK]><![endif]--><?php if($concepto_ingreso->estado == 1): ?>
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado(<?php echo e($concepto_ingreso->id); ?>)'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            <?php else: ?>
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado(<?php echo e($concepto_ingreso->id); ?>)'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar(<?php echo e($concepto_ingreso->id); ?>)'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <?php echo e($conceptoIngresos->links()); ?>

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
                        <div class="mb-3">
                            <label for="tipo" class="col-form-label">Ingreso con Vigencia?</label>
                            <select class="form-control" id="tipo" name="state" wire:model='form.tipo'>
                                <option value="">Seleccionar Opcion</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_vigencia" class="col-form-label">Fecha Vigencia:</label>
                            <input type="date" class="form-control" wire:model='form.fecha_vigencia'>
                            <div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.fecha_vigencia'];
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
                            <label for="tipo_ingreso_id" class="col-form-label">Tipo de Ingreso:</label>
                            <select class="js-example-basic-single" id="tipo_ingreso_id" name="state" wire:model='form.tipo_ingreso_id'>
                                <option value="">Seleccionar Opcion</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $tipo_ingresos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tipo->id); ?>"><?php echo e($tipo->descripcion); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>                        
                        <div>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.tipo_ingreso_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="ciclo_id" class="col-form-label">Ciclo:</label>
                            <select class="js-example-basic-single" id="ciclo_id" name="state" wire:model='form.ciclo_id'>
                                <option value="">Seleccionar Opcion</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $ciclos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ciclo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($ciclo->id); ?>"><?php echo e($ciclo->descripcion); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>                        
                        <div>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.ciclo_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="especifica_nivel_2_id" class="col-form-label">Especifica Nivel 2:</label>
                            <select class="js-example-basic-single" id="especifica_nivel_2_id" name="state" wire:model='form.especifica_nivel_2_id'>
                                <option value="">Seleccionar Opcion</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $especificas2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $especifica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($especifica->id); ?>"><?php echo e($especifica->descripcion); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>                        
                        <div>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.especifica_nivel_2_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
                        </div>                         
                        <div class="mb-3">
                            <label for="monto" class="col-form-label">Monto:</label>
                            <input type="number" class="form-control" id="monto" wire:model='form.monto'>
                            <div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.monto'];
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
        $__scriptKey = '3686695558-0';
        ob_start();
    ?>
        <script>
            $('#tipo_ingreso_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#tipo_ingreso_id').on('change',function(){
                let a = document.getElementById("tipo_ingreso_id").value;
                $wire.set('form.tipo_ingreso_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#tipo_ingreso_id').val(event.id);
                $('#tipo_ingreso_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#tipo_ingreso_id').val(null).trigger('change');
            });
            $('#ciclo_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#ciclo_id').on('change',function(){
                let a = document.getElementById("ciclo_id").value;
                $wire.set('form.ciclo_id',a);
            })
            $wire.on('cambiarSeleccionCiclo', (event) => {
                $('#ciclo_id').val(event.id);
                $('#ciclo_id').trigger('change');
            });
            $wire.on('anularSeleccionCiclo', (event) => {
                $('#ciclo_id').val(null).trigger('change');
            });
            $('#especifica_nivel_2_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#especifica_nivel_2_id').on('change',function(){
                let a = document.getElementById("especifica_nivel_2_id").value;
                $wire.set('form.especifica_nivel_2_id',a);
            })
            $wire.on('cambiarSeleccionEspecifica2', (event) => {
                $('#especifica_nivel_2_id').val(event.id);
                $('#especifica_nivel_2_id').trigger('change');
            });
            $wire.on('anularSeleccionEspecifica2', (event) => {
                $('#especifica_nivel_2_id').val(null).trigger('change');
            });
        </script>
        <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
</div>
<?php /**PATH D:\Sistema Educativo - B5\resources\views/livewire/academico/concepto-ingreso/table.blade.php ENDPATH**/ ?>