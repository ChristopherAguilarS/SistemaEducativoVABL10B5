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
                                    <th style="width:5px" class="text-center" scope="col">Cumpleaños</th>
                                    <th style="width:5px" class="text-center" scope="col">Correo</th>
                                    <th style="width:5px" class="text-center" scope="col">Telefono</th>
                                    <th style="width:5px" class="text-center" scope="col">Estado</th>
                                    <th style="width:5px" scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($especificas->count()>0)
                                    <?php
                                        $meses = ['', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SETIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
                                    ?>
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
                                            </td>
                                            <td class="align-middle text-center">
                                                @if($especifica->mes)
                                                    {{ $meses[intval($especifica->mes)] }}
                                                @else
                                                    N/E
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                {{ $especifica->email }} 
                                            </td>
                                            <td class="align-middle">
                                                {{ $especifica->telefonos }} 
                                            </td>
                                            <td class="align-middle">
                                                @if($especifica->estado == 1)
                                                    <span style="margin-top:5px" class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            
                                            <td class="text-center align-middle"> 
                                                <button type="button" @click="$dispatch('nuevo', [{{ $especifica->id }}])" class="btn btn-info btn-sm"><i class="ri-contacts-book-line"></i> Ver</button>
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
