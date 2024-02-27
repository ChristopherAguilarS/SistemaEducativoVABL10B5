<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="row">
                <div class="d-flex justify-content-end">
                    <!--[if BLOCK]><![endif]--><?php if($apertura == true): ?>
                        <button type="button" class="btn btn-outline-success btn-label waves-effect right waves-light m-3" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='aperturaCC'>
                            <i class="ri-add-fill label-icon align-middle fs-16 ms-2"></i> APERTURAR CAJA CHICA
                        </button>
                    <?php else: ?>
                        <button type="button" class="btn btn-outline-secondary btn-label waves-effect right waves-light m-3" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='agregar'>
                            <i class="ri-add-fill label-icon align-middle fs-16 ms-2"></i> AGREGAR
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-label waves-effect right waves-light m-3" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='cierreCC'>
                            <i class="ri-add-fill label-icon align-middle fs-16 ms-2"></i> CERRAR CAJA CHICA
                        </button>
                    <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\Sistema Educativo - B5\resources\views/livewire/financiero-contable/contabilidad/caja-chica/filtro.blade.php ENDPATH**/ ?>