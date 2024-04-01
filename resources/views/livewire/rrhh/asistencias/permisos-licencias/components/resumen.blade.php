    <div wire:ignore.self id="form5" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body"><hr style="width:100%; margin-top:-10px">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label" for="steparrow-gen-info-email-input">Nro. Documento <font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model.live="documento" class="form-control">
                                        <a class="input-group-text cursor-pointer" wire:click="buscar"><i class="bx bx-search-alt-2"></i></a>
                                    </div>
                                    @error('documento') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="mb-3">
                                    <label class="form-label" for="steparrow-gen-info-email-input">Apellidos y Nombres <font style="color:red">(*)</font></label>
                                    <input class="form-control" wire:model.live="nombres" type="text" disabled>
                                    @error('nombres') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <hr class="mb-3" style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            </div>
                            <div class="col-lg-12">
                                <table class="table table-nowrap table-striped-columns mb-4">
                                    <thead>
                                        <tr>
                                            <th style="width:5px" scope="col">N°</th>
                                            <th style="width:5px" scope="col">Tipo</th>
                                            <th scope="col">Motivo</th>
                                            @if($tp == 1)
                                                <th style="width:5px" class="text-center" scope="col">Inicio</th>
                                                <th style="width:5px" class="text-center" scope="col">Fin</th>
                                                <th style="width:5px" class="text-center" scope="col">Periodo</th>
                                                <th style="width:5px" class="text-center" scope="col">Dias</th>
                                            @elseif($tp == 2)
                                                <th style="width:5px" class="text-center" scope="col">Fecha</th>
                                                <th style="width:5px" class="text-center" scope="col">Desde</th>
                                                <th style="width:5px" class="text-center" scope="col">Hasta</th>
                                            @elseif($tp == 3)
                                                <th style="width:5px" class="text-center" scope="col">Inicio</th>
                                                <th style="width:5px" class="text-center" scope="col">Fin</th>
                                            @elseif($tp == 4)
                                                <th style="width:5px" class="text-center" scope="col">Inicio</th>
                                                <th style="width:5px" class="text-center" scope="col">Fin</th>
                                                <th class="text-center" scope="col">Lugar</th>
                                            @endif
                                            <th  class="text-center" scope="col">Observaciones</th>
                                            <th class="text-center" scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!is_null($posts))
                                            @foreach ($posts as $especifica)
                                                <tr>
                                                    <td class="font-medium align-middle">
                                                        {{ $loop->iteration}}
                                                    </td>
                                                    <td class="align-middle">
                                                        {{ $especifica->pagado?'Con goce de haber':'Sin goce de haber' }}
                                                    </td>
                                                    <td class="align-middle">
                                                        {{ $especifica->motivo}} <br>
                                                        {{$especifica->motivos2}}
                                                    </td>
                                                    @if($tp == 1)
                                                        <td class="align-middle">
                                                            {{ date('d/m/Y', strtotime($especifica->inicio)) }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ date('d/m/Y', strtotime($especifica->fin)) }}
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            {{ $especifica->periodo }}
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            {{ $especifica->dias }}
                                                        </td>
                                                    @elseif($tp == 2)
                                                        <td class="align-middle">
                                                            {{ date('d/m/Y', strtotime($especifica->inicio)) }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ date('h:i a', strtotime($especifica->inicio)) }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ date('h:i a', strtotime($especifica->fin)) }}
                                                        </td>
                                                    @elseif($tp == 3)
                                                        <td class="align-middle">
                                                            {{ date('d/m/Y', strtotime($especifica->inicio)) }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ date('d/m/Y', strtotime($especifica->fin)) }}
                                                        </td>
                                                    @elseif($tp == 4)
                                                        <td class="align-middle">
                                                            {{ date('d/m/Y', strtotime($especifica->inicio)) }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ date('d/m/Y', strtotime($especifica->fin)) }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ $especifica->lugar }}
                                                        </td>
                                                    @endif
                                                    <td class="align-middle">
                                                        {{ $especifica->observaciones }}
                                                    </td>
                                                    <td class="align-middle">
                                                        
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
                    </div>
                </div>
                <div class="modal-footer"><br><hr style="width:100%; margin-top:-10px">
                    <button type="button" class="btn btn-info material-shadow-none" wire:click="guardar">Guardar</button>
                    <button type="button" class="btn btn-light material-shadow-none" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
