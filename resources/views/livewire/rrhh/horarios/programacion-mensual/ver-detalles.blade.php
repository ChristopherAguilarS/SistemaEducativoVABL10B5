<div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body"><hr style="width:100%; margin-top:-10px">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label" for="steparrow-gen-info-email-input">Programación:</label>
                                    <select class="form-select" wire:model.live="selHorario">
                                        <option>-- Seleccione</option>
                                        @if(!is_null($programaciones))
                                            @foreach($programaciones as $local)
                                                <option value="{{$local->id}}">{{$local->nombre}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('state.catalogo_tipo_documento') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                @if($selHorario>0)
                                                <div class="col-sm-12 col-lg-12">
                                                    <table class="table align-middle table-nowrap mb-0">
                                                        <tr>
                                                            <th>
                                                                Día
                                                            </th>
                                                            <th>
                                                                Turno
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Lunes</b></td>
                                                            <td class="text-center">
                                                                @if($dias[1]->count()>0)
                                                                    @foreach ($dias[1] as $dia)
                                                                        {{strtoupper($dia->abreviatura).' ['.date('h:i a', strtotime($dia->horaInicio)).' a '.date('h:i a', strtotime($dia->horaFin)).']'}}
                                                                    @endforeach
                                                                @else
                                                                    <center><i>Descanso</i></center>  
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Martes</b></td>
                                                            <td class="text-center">
                                                                @if($dias[2]->count()>0)
                                                                    @foreach ($dias[2] as $dia)
                                                                        {{strtoupper($dia->abreviatura).' ['.date('h:i a', strtotime($dia->horaInicio)).' a '.date('h:i a', strtotime($dia->horaFin)).']'}}
                                                                    @endforeach
                                                                @else
                                                                    <center><i>Descanso</i></center>  
                                                                @endif
                                                                
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Miercoles</b></td>
                                                            <td class="text-center">
                                                                @if($dias[3]->count()>0)
                                                                    @foreach ($dias[3] as $dia)
                                                                        {{strtoupper($dia->abreviatura).' ['.date('h:i a', strtotime($dia->horaInicio)).' a '.date('h:i a', strtotime($dia->horaFin)).']'}}
                                                                    @endforeach
                                                                    @else
                                                                    <center><i>Descanso</i></center>  
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Jueves</b></td>
                                                            <td class="text-center">
                                                                 @if($dias[4]->count()>0)
                                                                    @foreach ($dias[4] as $dia)
                                                                        {{strtoupper($dia->abreviatura).' ['.date('h:i a', strtotime($dia->horaInicio)).' a '.date('h:i a', strtotime($dia->horaFin)).']'}}
                                                                    @endforeach
                                                                    @else
                                                                    <center><i>Descanso</i></center>  
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Viernes</b></td>
                                                            <td>
                                                                @if($dias[5]->count()>0)
                                                                    @foreach ($dias[5] as $dia)
                                                                        {{strtoupper($dia->abreviatura).' ['.date('h:i a', strtotime($dia->horaInicio)).' a '.date('h:i a', strtotime($dia->horaFin)).']'}}
                                                                    @endforeach
                                                                    @else
                                                                    <center><i>Descanso</i></center>  
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Sabado</b></td>
                                                            <td class="text-center">
                                                                @if($dias[6]->count()>0)
                                                                    @foreach ($dias[6] as $dia)
                                                                        {{strtoupper($dia->abreviatura).' ['.date('h:i a', strtotime($dia->horaInicio)).' a '.date('h:i a', strtotime($dia->horaFin)).']'}}
                                                                    @endforeach
                                                                    @else
                                                                    <center><i>Descanso</i></center>  
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Domingo</b></td>
                                                            <td class="text-center">
                                                                @if($dias[7]->count()>0)
                                                                    @foreach ($dias[7] as $dia)
                                                                        {{strtoupper($dia->abreviatura).' ['.date('h:i a', strtotime($dia->horaInicio)).' a '.date('h:i a', strtotime($dia->horaFin)).']'}}
                                                                    @endforeach
                                                                    @else
                                                                    <center><i>Descanso</i></center>  
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-sm-12 col-lg-12">
                                                    <br>
                                                </div>
                                            @endif
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
