<div wire:ignore.self id="form3" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Personal Inventariador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body"><hr style="width:100%; margin-top:-10px">
                    <div class="col-xl-12">
                        <div class="form-group row">
                            <div class="col-4"></div>
                            <div class="col-3 mb-2" style="text-align:right; top:10px">
                                <b>Año</b>
                            </div>
                            <div class="col-5 mb-2">
                                <select class="form-control" wire:model="anio">
                                    <?php
                                        for ($i=2023; $i <= date('Y'); $i++) { 
                                            ?><option value="{{$i}}">{{$i}}</option><?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12"><hr></div>
                            <div class="col-md-4 mb-4">
                                <label><b>@if($state['tipo']!=3) Busq. D.N.I @else Ingrese D.N.I @endif</b></label>
                                <div class="input-group">
                                    <input type="text" wire:model.prevent="dni" class="form-control">
                                    <a class="input-group-text cursor-pointer" wire:click="buscar"><i class="bx bx-search-alt-2"></i></a>
                                </div>
                                @error('dni')
                                    <span class="text-danger-emphasis">(*)Obligatorio</span>
                                @enderror
                            </div>
                            
                                <div class="col-md-8">
                                    <label><b>Apellidos y Nombres</b></label>
                                    <input type="text" class="form-control" wire:model="nombres">
                                    <input type="hidden" wire:model="state.IdPersona">
                                    @error('nombres')
                                        <span class="text-danger-emphasis">(*)Obligatorio</span>
                                    @enderror
                                </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                <select class="form-select" wire:model="state.tipo">
                                    <option value="1">Presidente</option>
                                    <option value="2">Miembro</option>
                                    <option value="3">Inventariador</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                            <button style="width: 100%;" wire:click="save" class="btn btn-outline-info"><i class="fa fa-plus"></i> Agregar</button>
                            </div>
                            <div class="col-md-12"><hr></div>
                        </div>
                        <div class="col-sm-12">
                            <table style="width:100%" class="table tablesaw no-wrap table-bordered table-hover tablesaw-stack">
                                <tr>
                                    <th style="width:5px">Tipo</th>
                                    <th>Apellidos y Nombres</th>
                                    <th style="width:5px">Acc</th>
                                </tr>
                                @if($trabajadores->count()>0)
                                    @foreach ($trabajadores as $trabajador)
                                        <tr>
                                            <td>{{($trabajador->tipo==1)?'Presidente':'Miembro'}}</td>
                                            <td>
                                                {{$trabajador->personaNombres}}
                                            </td>
                                            <td>
                                                <button wire:click="del({{$trabajador->id}})" class="btn btn-outline-danger  btn-sm"><i class=" mdi mdi-delete"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="3"><center><i>Sin Personal Asignado</i></center></td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><br><hr style="width:100%; margin-top:-10px">
                    <button type="button" class="btn btn-light material-shadow-none" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
