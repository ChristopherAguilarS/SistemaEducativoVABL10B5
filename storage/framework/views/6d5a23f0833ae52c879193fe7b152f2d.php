<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Caja y Bancos</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                        </div>
                    </div>
                </div><!-- end card header -->
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('financiero-contable.contabilidad.caja-bancos.cards');

$__html = app('livewire')->mount($__name, $__params, 'lw-4034613722-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Cuenta</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $movimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>                
                                        <td class="font-medium">
                                            <?php echo e($loop->index+1); ?>

                                        </td>
                                        <td>
                                            <?php echo e($movimiento->descripcion); ?>

                                        </td>
                                        <td>
                                            <?php echo e($movimiento->cuenta->descripcion); ?>

                                        </td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if(optional($movimiento)->fecha != null): ?>
                                                <?php echo e(Carbon\Carbon::parse($movimiento->fecha)->format('d/m/Y')); ?>

                                            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td>
                                            <?php echo e($movimiento->nTipo); ?>

                                        </td>
                                        <td>
                                            <?php echo e(Illuminate\Support\Number::currency($movimiento->monto, in: 'S/.', locale: 'en')); ?>

                                        </td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if($movimiento->estado == 1): ?>
                                                <span class="badge bg-success"><?php echo e($movimiento->nEstado); ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-danger"><?php echo e($movimiento->nEstado); ?></span>
                                            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td class="text-center">
                                            <!--[if BLOCK]><![endif]--><?php if($movimiento->estado == 1): ?>
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado(<?php echo e($movimiento->id); ?>)'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            <?php else: ?>
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado(<?php echo e($movimiento->id); ?>)'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar(<?php echo e($movimiento->id); ?>)'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <?php echo e($movimientos->links()); ?>

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
                        <div class="mb-3" wire:ignore>
                            <label for="cuenta_id" class="col-form-label">Cuenta:</label>
                            <select class="js-example-basic-single" id="cuenta_id" name="state" wire:model='form.cuenta_id'>
                                <option value="">Seleccionar Opcion</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $cuentas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuenta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cuenta->id); ?>"><?php echo e($cuenta->codigo); ?> - <?php echo e($cuenta->descripcion); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>                        
                        <div>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.cuenta_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" wire:model='form.fecha'>
                            <div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.fecha'];
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
                            <label for="tipo" class="col-form-label">Tipo:</label>
                            <select class="form-control" id="tipo" name="state" wire:model='form.tipo'>
                                <option value="">Seleccionar Opcion</option>
                                <option value="1">Deudor</option>
                                <option value="2">Acreedor</option>
                            </select>
                            <div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.fecha'];
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
                            <label for="monto" class="form-label">Monto</label>
                            <input type="number" class="form-control" placeholder="Monto" id="monto" wire:model='form.monto'>
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
        $__scriptKey = '4034613722-0';
        ob_start();
    ?>
        <script>
            $('#cuenta_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#cuenta_id').on('change',function(){
                let a = document.getElementById("cuenta_id").value;
                $wire.set('form.cuenta_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#cuenta_id').val(event.id);
                $('#cuenta_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#cuenta_id').val(null).trigger('change');
            });
        </script>
        <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
</div>
<?php /**PATH D:\Sistema Educativo - B5\resources\views/livewire/financiero-contable/contabilidad/caja-bancos/table.blade.php ENDPATH**/ ?>