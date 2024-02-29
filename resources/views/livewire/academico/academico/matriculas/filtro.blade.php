<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        <div class="col-xxl-3">
                            <div class="row g-2 text-center">
                                <div class="col-lg-12 text-center">
                                    <button type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none" @click="$dispatch('nuevo', 0)">
                                        <i class="bx bx-folder-plus" style="font-size:30px"></i><br>
                                        NUEVO
                                    </button>
                                    <button type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none">
                                        <i class="bx bxs-file-doc" style="font-size:30px"></i><br>
                                        FORMATO
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-1">
                        </div>
                        <div class="col-xxl-8">
                            <div class="row g-2 text-center">
                                <div class="col-lg-2">
                                    <b>Año</b>
                                    <select wire:model="anio" class="form-select  mb-3 mt-2">
                                        @for ($i=2024; $i <= date('Y'); $i++) 
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <b>Carrera</b>
                                    <select wire:model="tipo" class="form-select  mb-3 mt-2">
                                        <option value="0">Todos</option>
                                        <option value="BC">Boletas</option>
                                        <option value="FC">Facturas</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <b>Ciclo</b>
                                    <select wire:model="mes" class="form-select  mb-3 mt-2">
                                        <option value="01">I</option>
                                        <option value="02">II</option>
                                        <option value="03">III</option>
                                        <option value="04">IV</option>
                                        <option value="05">V</option>
                                        <option value="06">VI</option>
                                        <option value="07">VII</option>
                                        <option value="08">VIII</option>
                                        <option value="09">IX</option>
                                        <option value="10">X</option>
                                        <option value="11">XI</option>
                                        <option value="12">XII</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 text-center" style="margin-top: 16px;">
                                    <button type="button" wire:loading.attr="disabled" style="width:100%" class="mt-10 btn btn-outline-secondary btn-label waves-effect right waves-light m-3" wire:click="buscar">
                                        <i class="ri-search-line label-icon align-middle fs-16 ms-2"></i> BUSCAR
                                    </button>
                                </div>
                                <div class="col-lg-2 text-center" style="margin-top: 16px;">
                                    <button type="button" wire:loading.attr="disabled" style="width:96%" class="mt-10 btn btn-outline-success btn-label waves-effect right waves-light m-3" wire:click="descargar">
                                        <i class="ri-file-excel-2-line label-icon align-middle fs-16 ms-2"></i> DESCARGAR
                                    </button>
                                </div> 
                            </div>
                        </div>
                           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


