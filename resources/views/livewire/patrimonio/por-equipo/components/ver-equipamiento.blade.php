<div wire:ignore.self id="form2" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog  modal-xl" style="max-width: 90% !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">LISTADO DE EQUIPAMIENTO ASIGNADO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body"><hr style="width:100%; margin-top:-10px">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-lg-5 col-md-12">
                            <input type="text" class="form-control" wire:model.defer="det.nombre" disabled>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <input type="text" class="form-control" wire:model.defer="det.area" disabled>
                        </div>
                        <div class="col-lg-2 col-md-12">
                            <input type="text" class="form-control" wire:model.defer="det.ambiente" disabled>
                        </div>
                        <div class="col-lg-2 col-md-12">
                            <input type="text" class="form-control" wire:model="anio" disabled>
                        </div>
                        <div class="col-lg-12 col-md-12"><hr></div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card-header bg-info" style="padding: 10px;">
                                <h4 class="mb-0 text-white"><i class="mdi mdi-note-multiple"></i> Equipamiento Inventariado</h4>
                            </div>
                            <br>
                            <form class="form-horizontal">
                                @if(count($inventariados)>0)
                                    <table class="table tablesaw no-wrap table-bordered table-hover tablesaw-stack" data-tablesaw-mode="stack">
                                        <thead>
                                            <tr>
                                                <th style=";width:5px">Nº</th>
                                                <th style=";width:5px">QR</th>
                                                <th style="cursor: pointer;;">
                                                    Denominación
                                                </th>
                                                <th style="cursor: pointer;;">
                                                    Observaciones
                                                </th>
                                                <th style="cursor: pointer;width:5px; text-align: center;">
                                                    Estado
                                                </th>
                                                <th style="width: 2px;"></th>
                                                <th style="width: 2px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($inventariados as $inventario)
                                                <tr>
                                                    <td style="border-left: 2px solid #1e88e5;">{{$loop->iteration}}</td>
                                                    <td style="white-space: normal;">
                                                        <b>{{$inventario->id}}<b>
                                                    </td>
                                                    <td style="white-space: normal;">
                                                        <b>{{$inventario->equipo}} <br><span class="mb-1 badge bg-light text-dark">{{$inventario->CODIGO_ACTIVO}}</span></b>
                                                    </td>
                                                    <td style="white-space: normal;">
                                                        <b>{{$inventario->OBSERVACIONES}}</b>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($inventario->estado_eq==1){
                                                                ?><span class="badge badge-info" style="color:white">Bueno</span><?php
                                                            }elseif($inventario->estado_eq==2){
                                                                ?><span class="badge badge-primary">Regular</span><?php
                                                            }elseif($inventario->estado_eq==3){
                                                                ?><span class="badge badge-warning">Malo</span><?php
                                                            }elseif($inventario->estado_eq==4){
                                                                ?><span class="badge badge-danger">Muy Malo</span><?php
                                                            }elseif($inventario->estado_eq==5){
                                                                ?><span class="badge badge-success">Nuevo</span><?php
                                                            }elseif($inventario->estado_eq==6){
                                                                ?><span class="badge badge-secondary">Chatarra</span><?php
                                                            }elseif($inventario->estado_eq==7){
                                                                ?><span class="badge badge-light">RAEE</span><?php
                                                            }
                                                        ?>   
                                                    </td>                                                    
                                                    <td style="text-align: center;">
                                                        <button wire:click.prevent="$emit('verDetalles', 4511)" class="btn btn-outline- btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Visualizar"><i class="fa fa-edit"></i></button>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input name="inv_<?php echo $inventario->id ?>" type="checkbox" id="inv_<?php echo $inventario->id ?>_si" class="radio-col-indigo material-inputs" wire:model="inv.eq<?php echo $inventario->id ?>" value="<?php echo $inventario->id ?>" @if($accion==2) disabled @endif>
                                                        <label for="inv_<?php echo $inventario->id ?>_si" class="mb-0"></label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <center><b><i>No hay equipos inventariados.</i></b></center>
                                @endif
                            </form>
                            <hr>
                            <div class="card-header bg-danger" style="padding: 10px;">
                                <h4 class="mb-0 text-white"><i class="mdi mdi-note-multiple"></i> Equipamiento Pendiente de Inventariado</h4>
                            </div>
                            <br>
                            <form class="form-horizontal">
                                @if(count($pendientes)>0)
                                    <table class="table tablesaw no-wrap table-bordered table-hover tablesaw-stack" data-tablesaw-mode="stack">
                                        <thead>
                                            <tr>
                                                <th style=";width:5px">Nº</th>
                                                <th style=";width:5px">QR</th>
                                                <th style="cursor: pointer;;">
                                                    Denominación
                                                </th>
                                                <th style="cursor: pointer;;">
                                                    Observaciones
                                                </th>
                                                <th style="cursor: pointer;width:5px; text-align: center;">
                                                    Estado
                                                </th>
                                                <th style="width: 2px;"></th>
                                                <th style="width: 2px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pendientes as $inventario)
                                                <tr>
                                                    <td style="border-left: 2px solid #fc4b6c;">{{$loop->iteration}}</td>
                                                    <td style="white-space: normal;">
                                                        <b>{{$inventario->id}}<b>
                                                    </td>
                                                    <td style="white-space: normal;">
                                                        <b>{{$inventario->equipo}} <br><span class="mb-1 badge bg-light text-dark">{{$inventario->CODIGO_ACTIVO}}</span></b>
                                                    </td>
                                                    <td style="white-space: normal;">
                                                        <b>{{$inventario->OBSERVACIONES}}</b>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($inventario->estado_eq==1){
                                                                ?><span class="badge badge-info" style="color:white">Bueno</span><?php
                                                            }elseif($inventario->estado_eq==2){
                                                                ?><span class="badge badge-primary">Regular</span><?php
                                                            }elseif($inventario->estado_eq==3){
                                                                ?><span class="badge badge-warning">Malo</span><?php
                                                            }elseif($inventario->estado_eq==4){
                                                                ?><span class="badge badge-danger">Muy Malo</span><?php
                                                            }elseif($inventario->estado_eq==5){
                                                                ?><span class="badge badge-success">Nuevo</span><?php
                                                            }elseif($inventario->estado_eq==6){
                                                                ?><span class="badge badge-secondary">Chatarra</span><?php
                                                            }elseif($inventario->estado_eq==7){
                                                                ?><span class="badge badge-light">RAEE</span><?php
                                                            }
                                                        ?>   
                                                    </td>                                                    
                                                    <td style="text-align: center;">
                                                        <button wire:click.prevent="$emit('verDetalles', 4511)" class="btn btn-outline- btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Visualizar"><i class="fa fa-edit"></i></button>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input name="inv_<?php echo $inventario->id ?>" type="checkbox" id="inv_<?php echo $inventario->id ?>_si" class="radio-col-indigo material-inputs" wire:model="inv.eq<?php echo $inventario->id ?>" value="<?php echo $inventario->id ?>">
                                                        <label for="inv_<?php echo $inventario->id ?>_si" class="mb-0"></label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <center><b><i>No hay equipos por inventariar.</i></b></center>
                                @endif
                            </form>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <h4 class="mb-0"><i class="mdi mdi-checkbox-multiple-marked"></i> Equipamiento Seleccionado</h4>
                            <br>
                            <div class="row">
                                <div class="col-sm-12 col-md-4" style="vertical-align: middle; text-align: center;">
                                    <small>Equipos</small>
                                    <h1 style="margin-top: 20px;">{{$num_sel}}</h1>
                                </div>
                                <div class="col-sm-12 col-md-8">
                                    <div class="form-group">
                                        <label for="inputname" class="control-label col-form-label"><b>Acción a Realizar</b></label>
                                        <select wire:model="accion" class="form-control">
                                            <option value="1">Desplazar</option>
                                            <option value="2">Inventariar</option>
                                        </select>
                                    </div>
                                </div>
                                @if($accion == 1)
                                    <div class="col-md-12">
                                        <br>
                                        <h4 class="mb-0"><i class="mdi mdi-account-switch"></i> Información del Desplazamiento</h4>
                                        <br>
                                    </div>
                                    <div class="col-md-4">
                                        <label><b>Busq. D.N.I</b></label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" wire:model.prevent="dni">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" wire:click="buscar" type="button"><i class="ti-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label><b>Apellidos y Nombres</b></label>
                                        <input type="text" class="form-control" wire:model.defer="nombres" disabled>
                                        <input type="hidden" wire:model="persona_id">
                                    </div>
                                @endif
                                <div class="col-sm-12 col-md-12"><hr></div>
                                <div class="col-sm-12 col-md-2"></div>
                                <div class="col-sm-12 col-md-4">
                                    @if($save && $accion ==1)
                                        <a style="width: 100%; font-size: 18px;" class="btn waves-effect waves-light btn-info" href="https://sir.diresacajamarca.gob.pe:8002/equipamiento/constancia/{{$save}}" target="_blank">
                                            <i class="fa fa-print"></i> | IMPRIMIR CONST.
                                        </a>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <button type="button" style="width: 100%; font-size: 18px;" class="btn waves-effect waves-light btn-info" wire:click="save">
                                        @if($accion == 1)
                                            <i class="fa fa-save"></i> | GUARDAR
                                        @else
                                            <i class="fa fa-check"></i> | INVENTARIAR
                                        @endif
                                    </button>
                                </div>
                                <div class="col-sm-12 col-md-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"><br><hr style="width:100%; margin-top:-10px">
                <a type="button" class="btn btn-outline-info" href="/patrimonio/inventariado/{{$anio}}/{{$persona}}" target="_blank">
                <i class="fa fa-print mr-1"></i>Imprimir Ficha</a>
                <button type="button" class="btn btn-light material-shadow-none" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
