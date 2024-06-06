<div>
    <div wire:ignore.self id="form2" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{$titulo}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <hr>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="col-lg-12">
                                <input type="text" class="form-control" wire:model="equipo" style="text-align:center" disabled>
                                <hr>
                            </div>
                        </div>
                        @if(!$prestado)
                            <div class="col-xxl-12">
                                <input type="text" class="form-control mb-4" wire:keydown.enter="buscar" placeholder="Buscar Trabajador" wire:model="search">
                                <div class="table-responsive table-card">
                                    <table class="table table-nowrap table-striped-columns mb-4">
                                        <thead>
                                            <tr>
                                                <th style="width:5px" scope="col">Doc</th>
                                                <th scope="col">Apellidos y Nombres</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($posts->count()>0)
                                                @foreach ($posts as $especifica)
                                                    <tr wire:click="selecc({{$especifica->id}})" class="cursor-pointer @if($selTab == $especifica->id) table-secondary @endif">
                                                        <td class="align-middle">
                                                            {{ $especifica->numeroDocumento }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ $especifica->noms }} 
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4"><center>Sin Información</center></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <textarea wire:model="observaciones" class="form-control" id="" placeholder="Ingrese alguna observacion"></textarea><br>
                        @else
                            <div class="col-xxl-12" style="text-align: center;">
                            
                            <textarea wire:model="observaciones" class="form-control" id="" placeholder="Ingrese alguna observacion"></textarea><br>
                                <button type="button" class="btn btn-info " wire:click="devolver" wire:loading.attr="disabled">
                                    <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="devolver" style="display:none; --vz-spinner-width: 1rem; --vz-spinner-height: 1rem;"></span>
                                    <i class="bx bx-download" style="font-size:20px" wire:loading.remove="" wire:target="devolver"></i>
                                    <b>ENTREGADO</b>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    @if(!$prestado)
                        <button type="button" class="btn btn-info " wire:click="guardar" wire:loading.attr="disabled">
                            <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="guardar" style="display:none; --vz-spinner-width: 1rem; --vz-spinner-height: 1rem;"></span>
                            <i class="bx bx-save" wire:loading.remove="" wire:target="guardar"></i>
                            Guardar
                        </button>
                    @endif
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
