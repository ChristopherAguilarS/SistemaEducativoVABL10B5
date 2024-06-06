<div>
    <div class="row">
        @if($resetFiltros)
            <div class="mt-2 grid grid-cols-1 gap-4 sm:grid-cols-3">
                <label></label>
                <label class="mt-1 flex -space-x-px">
                    <button wire:click="menSem" wire:target="menSem" wire:loading.attr="disabled" class="flex items-center justify-center rounded-l-lg border border-slate-300 px-3.5 font-inter dark:border-navy-450">
                        <i class="fa fa-minus"></i>
                    </button>
                    <select wire:model="semana" class="form-input w-full border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                        @if(!is_null($semanas))
                            <?php $c=1; ?>
                            @foreach ($semanas as $semana)
                                <option value="{{$c}}">{{$semana['inicio']}} al {{$semana['fin']}}</option>
                                <?php $c++; ?>
                            @endforeach
                        @endif
                    </select>

                    <button wire:click="masSem" wire:target="masSem" wire:loading.attr="disabled" class="flex items-center justify-center rounded-r-lg border border-slate-300 px-3.5 font-inter dark:border-navy-450">
                        <i class="fa fa-plus"></i>
                    </button>
                </label>
            </div>
            <div wire:loading style="width: 100%;">
                <center>
                    <div class="spinner-border text-info" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </center>
            </div>
        @endif
        @if($resetFiltros)
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-nowrap table-striped-columns mb-4">
                                <thead>
                                    <tr>
                                        <th style="width:5px" scope="col">N°</th>
                                        <th style="width:5px" scope="col">Nro. Doc</th>
                                        <th scope="col">Apellidos y Nombres</th>
                                        <th style="width:5px" class="text-center" scope="col">Area de Trabajo</th>
                                        <th style="width:5px" class="text-center" scope="col">Inicio</th>
                                        <th style="width:5px" scope="col" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($especificas->count()>0)
                                        @foreach ($especificas as $especifica)
                                            <tr>                
                                                <td class="font-medium align-middle">
                                                    {{ $loop->iteration}}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $especifica->dni }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $especifica->nombres }} 
                                                    <br>  
                                                    @if($especifica->catalogo_tipo_trabajador_id == 1)
                                                        <span style="margin-top:5px" class="badge bg-success">Docente</span>
                                                    @else
                                                        <span class="badge bg-danger">Administrativo</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    {{ $especifica->area }} 
                                                </td>
                                                <td class="align-middle">
                                                    {{ date('d/m/Y', strtotime($especifica->fecha_inicio)) }} 
                                                </td>
                                                <td class="text-center align-middle"> 
                                                    <button type="button" @click="$dispatch('verResumen', [{{ $especifica->id }}])" class="btn btn-info btn-sm"><i class="ri-contacts-book-line"></i> Ver</button>
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
                        <div class="d-flex justify-content-end mt-2">
                            {{ $especificas->links() }}
                        </div>
                        <div class="d-none code-view">
                            
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!--end col-->
        @else
            <center><i>Para continuar de click en "BUSCAR"</i></center>
        @endif
    </div>
</div>
