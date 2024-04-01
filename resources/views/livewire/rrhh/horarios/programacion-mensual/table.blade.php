<div>
    <div class="row">
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
                                    <th style="width:5px" scope="col" class="text-center">Programacion</th>
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
                                            <td class="text-center align-middle"> 
                                                @if($especifica->ide)
                                                    <button type="button" @click="$dispatch('nuevaProgramacion', [{{ $especifica->id }}])" class="btn btn-success btn-sm">
                                                        Programado
                                                    </button>
                                                @else
                                                    <button type="button" @click="$dispatch('nuevaProgramacion', [{{ $especifica->id }}])" class="btn btn-danger btn-sm">
                                                        Pendiente
                                                    </button>
                                                @endif
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
    </div>
</div>
