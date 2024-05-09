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
                    <div class="row" style="padding: 0px 5px">            
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <input type="text" class="form-control" wire:model.live="state.rol" disabled>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <input type="text" class="form-control" wire:model.live="state.usuario" disabled>
                                @error('state.name')
                                    <small style="color:red">(*) Obligatorio</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <input type="date" class="form-control" wire:model.live="state.creado" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6"></div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <select wire:model.live="modulo" class="form-select">
                                    <option value="0">Seleccione Modulo</option>
                                    @foreach($modulos as $modulo)
                                        <option value="{{$modulo->raiz}}">{{$modulo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table class="table table-hover table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th colspan="3" style="width:5px">
                                            Nro
                                        </th>
                                        <th>
                                            Descripcion
                                        </th>
                                        <th  style="width:5px">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $c =  1;
                                    @endphp
                                    @if($v_modulos)
                                        @foreach($v_modulos as $lista)
                                            <tr>    
                                                <td colspan="3">
                                                    {{$c}}
                                                </td>
                                                <td><b>Modulo : {{$lista->nombre}}</b></td>
                                                <td style="text-align:center">
                                                    <input class="form-check-input" type="checkbox" wire:model.live="chk.{{$lista->id}}">
                                                </td>
                                            </tr>
                                            @php  $d =  1; @endphp
                                            @foreach($v_menus as $v_menu)
                                                <tr>
                                                    <td style="width:20px"></td>
                                                    <td colspan="2">
                                                        {{$c}}.{{$d}}
                                                    </td>
                                                    <td><b>Menu : {{$v_menu->nombre}}</b></td>
                                                    <td style="text-align:center">
                                                        <input class="form-check-input" type="checkbox" wire:model.live="chk.{{$v_menu->id}}" >
                                                    </td>
                                                </tr>
                                                @php  $e =  1; @endphp
                                                @foreach($v_submenus->where('icon', $v_menu->id) as $v_submenu)
                                                    <tr>
                                                        <td style="width:20px"></td>
                                                        <td style="width:20px"></td>
                                                        <td style="width:20px">
                                                            {{$c}}.{{$d}}.{{$e}}
                                                        </td>
                                                        <td><b>Sub Menu : {{$v_submenu->nombre}}</b></td>
                                                        <td style="text-align:center">
                                                            <input class="form-check-input" type="checkbox" wire:model.live="chk.{{$v_submenu->id}}">
                                                        </td>
                                                    </tr>
                                                    @php $e++; @endphp
                                                @endforeach
                                                @php $d++; @endphp
                                            @endforeach
                                            @php $c++; @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-info " wire:click="guardar" wire:loading.attr="disabled">
                        <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="guardar" style="display:none"></span>
                        <i class="bx bx-save" wire:loading.remove="" wire:target="guardar"></i>
                         Guardar
                    </button>     
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
