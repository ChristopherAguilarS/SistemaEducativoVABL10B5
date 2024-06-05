<div>
    <div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xxl-12">
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-user-voice" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;">Datos Personales | Los campos con (*) son obligatorios.</span>
                            </h6>
                            <hr style="margin: 10px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Nombre de Horario <font style="color:red">(*)</font></label>
                                        <input type="text" class="form-control" wire:model.live="state.nombre">
                                        @error('state.nombre')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Estado <font style="color:red">(*)</font></label>
                                        <select class="form-select" wire:model.live="state.estado">
                                            <option value="0">Inactivo </option>
                                            <option value="1" wire:key="1">Activo</option>
                                        </select>
                                        @error('state.estado')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Usuario <font style="color:red">(*)</font></label>
                                        <input type="text" class="form-control" wire:model.live="userNombre">
                                        @error('userNombre')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Fecha <font style="color:red">(*)</font></label>
                                        <input type="date" class="form-control" wire:model.live="userFecha">
                                        @error('userFecha')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <table style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="whitespace-nowrap text-center rounded bg-slate-200 px-3 py-2 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-2"
                                                    >
                                                        Lunes
                                                    </th>
                                                    <th
                                                        class="whitespace-nowrap text-center bg-slate-200 px-4 py-2 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-2"
                                                    >
                                                        Martes
                                                    </th>
                                                    <th
                                                        class="whitespace-nowrap text-center bg-slate-200 px-4 py-2 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-2"
                                                    >
                                                        Miércole
                                                    </th>
                                                    <th
                                                        class="whitespace-nowrap text-center bg-slate-200 px-4 py-2 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-2"
                                                    >
                                                        Jueves
                                                    </th>
                                                    <th
                                                        class="whitespace-nowrap text-center rounded bg-slate-200 px-3 py-2 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-2"
                                                    >
                                                        Viernes
                                                    </th>
                                                    <th
                                                        class="whitespace-nowrap text-center rounded bg-slate-200 px-3 py-2 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-2"
                                                    >
                                                        Sabado
                                                    </th>
                                                    <th
                                                        class="whitespace-nowrap text-center rounded bg-slate-200 px-3 py-2 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-2"
                                                    >
                                                        Domingo
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                    <td class="whitespace-nowrap rounded-l-lg" style="    vertical-align: top;">
                                                        @if(isset($dias[1]))
                                                            @foreach ($dias[1] as $dia)
                                                            <div class="relative flex -space-x-px">
                                                                <input value="{{strtoupper($dia['ab']).' ['.$dia['inicio'].' a '.$dia['fin'].']'}}" class="mt-1 form-input h-8 w-full rounded-l-sm border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600" type="text">
                                                                <button wire:click="delDia(1, {{$dia['id']}})" class="mt-1 h-8 btn rounded rounded-l-none bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                    <i class="fa fa-remove" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                        <div class="relative flex -space-x-px">
                                                            <div class="input-group input-group-sm">
                                                                <select  wire:model="addDia.1" class="form-select form-select-sm">
                                                                    <option value="0">--seleccione</option>
                                                                    @foreach ($turnos as $turno)
                                                                        <option value="{{$turno->id}}">{{$turno->descripcion}} [ {{date('h:i a', strtotime($turno->horaInicio)).' a '.date('h:i a', strtotime($turno->horaFin))}} ]</option>
                                                                    @endforeach
                                                                </select>
                                                                <button wire:click="add(1)" class="btn btn-info btn-sm">
                                                                    <i class="bx bx-plus-medical"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="whitespace-nowrap rounded-l-lg" style="    vertical-align: top;">
                                                        @if(isset($dias[2]))
                                                            @foreach ($dias[2] as $dia)
                                                            <div class="relative flex -space-x-px">
                                                                <input value="{{strtoupper($dia['ab']).' ['.$dia['inicio'].' a '.$dia['fin'].']'}}" class="mt-1 form-input h-8 w-full rounded-l-sm border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600" type="text">
                                                                <button wire:click="delDia(2, {{$dia['id']}})" class="mt-1 h-8 btn rounded rounded-l-none bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                    <i class="fa fa-remove" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                        <div class="relative flex -space-x-px">
                                                            <div class="input-group input-group-sm">
                                                                <select  wire:model="addDia.2" class="form-select form-select-sm">
                                                                    <option value="0">--seleccione</option>
                                                                    @foreach ($turnos as $turno)
                                                                        <option value="{{$turno->id}}">{{$turno->descripcion}} [ {{date('h:i a', strtotime($turno->horaInicio)).' a '.date('h:i a', strtotime($turno->horaFin))}} ]</option>
                                                                    @endforeach
                                                                </select>
                                                                <button wire:click="add(2)" class="btn btn-info btn-sm">
                                                                    <i class="bx bx-plus-medical"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="whitespace-nowrap rounded-l-lg" style="    vertical-align: top;">
                                                        @if(isset($dias[3]))
                                                            @foreach ($dias[3] as $dia)
                                                            <div class="relative flex -space-x-px">
                                                                <input value="{{strtoupper($dia['ab']).' ['.$dia['inicio'].' a '.$dia['fin'].']'}}" class="mt-1 form-input h-8 w-full rounded-l-sm border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600" type="text">
                                                                <button wire:click="delDia(3, {{$dia['id']}})" class="mt-1 h-8 btn rounded rounded-l-none bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                    <i class="fa fa-remove" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                        <div class="relative flex -space-x-px">
                                                            <div class="input-group input-group-sm">
                                                                <select  wire:model="addDia.3" class="form-select form-select-sm">
                                                                    <option value="0">--seleccione</option>
                                                                    @foreach ($turnos as $turno)
                                                                        <option value="{{$turno->id}}">{{$turno->descripcion}} [ {{date('h:i a', strtotime($turno->horaInicio)).' a '.date('h:i a', strtotime($turno->horaFin))}} ]</option>
                                                                    @endforeach
                                                                </select>
                                                                <button wire:click="add(3)" class="btn btn-info btn-sm">
                                                                    <i class="bx bx-plus-medical"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="whitespace-nowrap rounded-l-lg" style="    vertical-align: top;">
                                                        @if(isset($dias[4]))
                                                            @foreach ($dias[4] as $dia)
                                                            <div class="relative flex -space-x-px">
                                                                <input value="{{strtoupper($dia['ab']).' ['.$dia['inicio'].' a '.$dia['fin'].']'}}" class="mt-1 form-input h-8 w-full rounded-l-sm border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600" type="text">
                                                                <button wire:click="delDia(4, {{$dia['id']}})" class="mt-1 h-8 btn rounded rounded-l-none bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                    <i class="fa fa-remove" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                        <div class="relative flex -space-x-px">
                                                            <div class="input-group input-group-sm">
                                                                <select  wire:model="addDia.4" class="form-select form-select-sm">
                                                                    <option value="0">--seleccione</option>
                                                                    @foreach ($turnos as $turno)
                                                                        <option value="{{$turno->id}}">{{$turno->descripcion}} [ {{date('h:i a', strtotime($turno->horaInicio)).' a '.date('h:i a', strtotime($turno->horaFin))}} ]</option>
                                                                    @endforeach
                                                                </select>
                                                                <button wire:click="add(4)" class="btn btn-info btn-sm">
                                                                    <i class="bx bx-plus-medical"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="whitespace-nowrap rounded-l-lg" style="    vertical-align: top;">
                                                        @if(isset($dias[5]))
                                                            @foreach ($dias[5] as $dia)
                                                            <div class="relative flex -space-x-px">
                                                                <input value="{{strtoupper($dia['ab']).' ['.$dia['inicio'].' a '.$dia['fin'].']'}}" class="mt-1 form-input h-8 w-full rounded-l-sm border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600" type="text">
                                                                <button wire:click="delDia(5, {{$dia['id']}})" class="mt-1 h-8 btn rounded rounded-l-none bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                    <i class="fa fa-remove" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                        <div class="relative flex -space-x-px">
                                                            <div class="input-group input-group-sm">
                                                                <select  wire:model="addDia.5" class="form-select form-select-sm">
                                                                    <option value="0">--seleccione</option>
                                                                    @foreach ($turnos as $turno)
                                                                        <option value="{{$turno->id}}">{{$turno->descripcion}} [ {{date('h:i a', strtotime($turno->horaInicio)).' a '.date('h:i a', strtotime($turno->horaFin))}} ]</option>
                                                                    @endforeach
                                                                </select>
                                                                <button wire:click="add(5)" class="btn btn-info btn-sm">
                                                                    <i class="bx bx-plus-medical"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="whitespace-nowrap rounded-l-lg" style="    vertical-align: top;">
                                                        @if(isset($dias[6]))
                                                            @foreach ($dias[6] as $dia)
                                                            <div class="relative flex -space-x-px">
                                                                <input value="{{strtoupper($dia['ab']).' ['.$dia['inicio'].' a '.$dia['fin'].']'}}" class="mt-1 form-input h-8 w-full rounded-l-sm border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600" type="text">
                                                                <button wire:click="delDia(6, {{$dia['id']}})" class="mt-1 h-8 btn rounded rounded-l-none bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                    <i class="fa fa-remove" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                        <div class="relative flex -space-x-px">
                                                            <div class="input-group input-group-sm">
                                                                <select  wire:model="addDia.6" class="form-select form-select-sm">
                                                                    <option value="0">--seleccione</option>
                                                                    @foreach ($turnos as $turno)
                                                                        <option value="{{$turno->id}}">{{$turno->descripcion}} [ {{date('h:i a', strtotime($turno->horaInicio)).' a '.date('h:i a', strtotime($turno->horaFin))}} ]</option>
                                                                    @endforeach
                                                                </select>
                                                                <button wire:click="add(6)" class="btn btn-info btn-sm">
                                                                    <i class="bx bx-plus-medical"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="whitespace-nowrap rounded-l-lg" style="vertical-align: top;">
                                                        @if(isset($dias[7]))
                                                            @foreach ($dias[7] as $dia)
                                                            <div class="relative flex -space-x-px">
                                                                <input value="{{strtoupper($dia['ab']).' ['.$dia['inicio'].' a '.$dia['fin'].']'}}" class="mt-1 form-input h-8 w-full rounded-l-sm border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600" type="text">
                                                                <button wire:click="delDia(7, {{$dia['id']}})" class="mt-1 h-8 btn rounded rounded-l-none bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                    <i class="fa fa-remove" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                        <div class="relative flex -space-x-px">
                                                            <div class="input-group input-group-sm">
                                                                <select  wire:model="addDia.7" class="form-select form-select-sm">
                                                                    <option value="0">--seleccione</option>
                                                                    @foreach ($turnos as $turno)
                                                                        <option value="{{$turno->id}}">{{$turno->descripcion}} [ {{date('h:i a', strtotime($turno->horaInicio)).' a '.date('h:i a', strtotime($turno->horaFin))}} ]</option>
                                                                    @endforeach
                                                                </select>
                                                                <button wire:click="add(7)" class="btn btn-info btn-sm">
                                                                    <i class="bx bx-plus-medical"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-info " wire:click="guardar" wire:loading.attr="disabled">
                        <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="guardar" style="display:none; --vz-spinner-width: 1rem; --vz-spinner-height: 1rem;"></span>
                        <i class="bx bx-save" wire:loading.remove="" wire:target="guardar"></i>
                        Guardar
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
