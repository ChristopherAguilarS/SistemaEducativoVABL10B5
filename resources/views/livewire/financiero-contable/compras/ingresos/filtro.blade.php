<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        <div class="col-xxl-3">
                            <div class="row g-2 text-center">
                                <div class="col-lg-12 text-center">
                                    <button title="Agregar Persona" @click="$dispatch('nuevo', [0, {{$almacen}}])" type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none">
                                        <i class="bx bx-folder-plus" style="font-size:30px"></i>
                                    </button>
                                    <button title="Estudios de Pre Grado" @click="$dispatch('preGrado', 0)" type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none">
                                        <i class="bx bxs-download" style="font-size:30px"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-1">
                        </div>
                        <div class="col-xxl-8">
                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <b>Buscar por:</b>
                                    <select wire:model.live="buscarPor" class="form-control">
                                        <option value="1">Dia</option>
                                        <option value="2">Mes</option>
                                        <option value="3">Año</option>
                                        <option value="4">Rango</option>
                                    </select>
                                </div>
                                @if($buscarPor == 1)
                                    <div class="col-lg-2">
                                        <b>Día:</b>
                                        <select wire:model="cbDia" class="form-control">
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                            <option value="5">05</option>
                                            <option value="6">06</option>
                                            <option value="7">07</option>
                                            <option value="8">08</option>
                                            <option value="9">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>
                                    </div>
                                @endif
                                @if($buscarPor == 1 || $buscarPor == 2)
                                    <div class="col-lg-<?php if($buscarPor == 1){ echo 3; }else{ echo 4;} ?>">
                                        <b>Mes:</b>
                                        <select wire:model="cbMes" class="form-control">
                                            <option value="1">Enero</option>
                                            <option value="2">Febrero</option>
                                            <option value="3">Marzo</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Mayo</option>
                                            <option value="6">Junio</option>
                                            <option value="7">Julio</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Setiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>
                                    </div>
                                @endif
                                @if($buscarPor != 4)
                                    <div class="col-lg-<?php if($buscarPor == 1){ echo 3; }else{ echo 4;} ?>">
                                        <b>Año:</b>
                                        <select wire:model="cbAnio" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                            @for($i = 2022; $i <= date('Y'); $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    @if($buscarPor == 3)
                                        <div class="col-lg-3"></div>
                                    @endif
                                @endif
                                @if($buscarPor == 4)
                                    <div class="col-lg-4">
                                        <b>Desde</b>
                                        <input  wire:model.defer="txInicio" type="date" class="form-control">
                                    </div>
                                    <div class="col-lg-4">
                                        <b>Hasta</b>
                                        <input  wire:model.defer="txFin" type="date" class="form-control">
                                    </div>
                                @endif
                                <div class="col-lg-4">
                                    <b>Tipo Ingreso</b>
                                    <select wire:model="cbTipo" class="form-control">
                                        <option value="0">Todos</option>
                                        <option value="2">O/C - O/S</option>
                                        <option value="1">Compra</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <b>Almacen</b>
                                    <select wire:model.live="almacen" class="form-select">
                                        <option value="0">Todos</option>
                                        @foreach($almacenes as $almacen)
                                            <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2"></div>
                                <div class="col-lg-2 mt-2">
                                    <button type="button" class="btn btn-info waves-effect waves-light" wire:click="buscar" style="width:100%">Buscar</button>
                                </div>
                            </div>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


