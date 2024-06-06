<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card p-3" wire:loading.class="opacity-50">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th style="width:5px" scope="col">Cód</th>
                                    <th scope="col">Equipo/Bien</th>
                                    <th class="text-center" scope="col">Trabajador</th>
                                    <th class="text-center" scope="col">Ambiente</th>
                                    <th class="text-center" scope="col">Observaciones <br>Entrega</th>
                                    <th class="text-center" scope="col">Observaciones <br>Devolucion</th>
                                    <th class="text-center" scope="col">Atendido Por</th>
                                    <th style="width:5px" class="text-center" scope="col">Fecha/Hora <br>Prestamo</th>
                                    <th style="width:5px" class="text-center" scope="col">Fecha/Hora <br>Devolucion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($s_equipo != 0)
                                    @if($posts->count()>0)
                                        @foreach ($posts as $documento)
                                            <tr>                
                                                <td class="font-medium" style="vertical-align:middle">
                                                    <button type="button" @click="$dispatch('nuevoIngreso', [{{ $documento->id }}, 3])" class="btn btn-ghost-primary waves-effect waves-light material-shadow-none">
                                                        {{ $documento->CODIGO_ACTIVO?$documento->CODIGO_ACTIVO:'E'.str_pad($documento->Id, 11, "0", STR_PAD_LEFT) }}
                                                    </button>
                                                </td>
                                                <td style="vertical-align:middle">
                                                    {{ ucwords(strtolower($documento->DESCRIPCION)) }} 
                                                </td>
                                                <td style="vertical-align:middle">
                                                    {{ $documento->trabajador?$documento->trabajador:'No Asignado' }}
                                                </td>
                                                <td style="vertical-align:middle">
                                                    {{ $documento->ambiente }}
                                                </td>
                                                <td style="vertical-align:middle">
                                                    {{ $documento->observaciones_entrega }}
                                                </td>
                                                <td style="vertical-align:middle">
                                                    {{ $documento->observaciones_devolucion }}
                                                </td>
                                                <td style="vertical-align:middle">
                                                    {{ $documento->trabajador2 }}
                                                </td>
                                                <td style="vertical-align: middle;">{{date('d/m/Y', strtotime($documento->created_at))}}<br><small class="text-muted ms-1">{{date('h:i a', strtotime($documento->created_at))}}</small></td>
                                                <td style="vertical-align: middle;">
                                                    @if(!$documento->estado)
                                                    {{date('d/m/Y', strtotime($documento->fecha_devolucion))}}<br><small class="text-muted ms-1">{{date('h:i a', strtotime($documento->fecha_devolucion))}}</small>
                                                    @else
                                                        No devuelto
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6"><center>Sin Información</center></td>
                                        </tr>
                                    @endif
                                @else
                                    <tr>
                                        <td colspan="6"><center>Selecciona un Equipo</center></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $posts->links() }}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
</div>
