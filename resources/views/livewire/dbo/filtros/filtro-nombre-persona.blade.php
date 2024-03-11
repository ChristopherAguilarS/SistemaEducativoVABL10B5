<div class="row align-items-center g-3">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
        <div class="col-lg-12">
            <input class="form-control" type="text" wire:model="nombres" placeholder="Nombres">
        </div>
        <div class="col-lg-12 mt-2">
            <input class="form-control" type="text" wire:model="apPaterno" placeholder="Apellido Paterno">
        </div>
        <div class="col-lg-12 mt-2">
            <input class="form-control" type="text" wire:model="apMaterno" placeholder="Apellido Materno">
        </div>
        <div class="col-lg-12 mt-2 text-right" style="text-align:right">
            <button type="button" class="btn btn-info waves-effect waves-light" wire:click="buscar">Buscar</button>
        </div>
    </div>
    <div class="col-lg-4"></div>
</div>