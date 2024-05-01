<div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h5 class="text-white modal-title" id="exampleModalLabel">Inventariar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="text" id="resultado" class="form-control" wire:model.prevent="dni">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" wire:click="buscar" type="button"><i class="ti-search"></i></button>
                    </div>
                </div>
                <div id="contenedor"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" onclick="cerrar()" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancelar</button>
                    <button  class="btn btn-outline-info">Guardar y salir</button>
                </div>
            </div>
        </div>
    </div>
    


</div>
