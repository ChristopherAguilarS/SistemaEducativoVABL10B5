<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        <div class="col-lg-4">
                            <select class="form-select mb-3" wire:model.live="anio">
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>
                        <?php echo e($anio); ?>

                        <div class="col-lg-4">
                            <button type="button" class="btn btn-outline-secondary btn-label waves-effect right waves-light m-3" @click="$dispatch('nuevo', 0)">
                                <i class="ri-add-fill label-icon align-middle fs-16 ms-2"></i> AGREGAR
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\tavo_\OneDrive\Escritorio\Proyectos\SistemaEducativoVABL10B5\resources\views/livewire/academico/administracion/plan-academico/filtro.blade.php ENDPATH**/ ?>