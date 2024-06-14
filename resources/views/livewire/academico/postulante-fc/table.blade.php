<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Postulantes</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Programa Estudios</th>
                                <th scope="col">Requisitos</th>
                                <th scope="col">Comprobante</th>
                                <th scope="col">Examen de Admisión</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($postulantes as $postulante)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            {{ $postulante->n_nombre_completo }}
                                            <br>Tipo° Documento: {{ $postulante->n_tipo_documento }}
                                            <br>N° Documento: {{ $postulante->nro_documento }}
                                        </td>
                                        <td>
                                            <br>Certificado de Estudios: 
                                                @if($postulante->certificado_estudios)
                                                    <i class='bx bx-check'></i>
                                                @else
                                                    <i class='bx bx-x'></i>
                                                @endif
                                            <br>Titulo: 
                                                @if($postulante->certificado_estudios)
                                                    <i class='bx bx-check'></i>
                                                @else
                                                    <i class='bx bx-x'></i>
                                                @endif
                                            <br>Copia DNI: 
                                                @if($postulante->certificado_estudios)
                                                    <i class='bx bx-check'></i>
                                                @else
                                                    <i class='bx bx-x'></i>
                                                @endif
                                            <br>Declaración Jurada:
                                                @if($postulante->certificado_estudios)
                                                    <i class='bx bx-check'></i>
                                                @else
                                                    <i class='bx bx-x'></i>
                                                @endif
                                        </td>
                                        <td>
                                            <br>Declaración Jurada: 
                                                @if($postulante->certificado_estudios)
                                                    <i class='bx bx-check'></i>
                                                @else
                                                    <i class='bx bx-x'></i>
                                                @endif
                                        </td>
                                        <td>
                                            {{ $postulante->nro_comprobante_pago }}
                                        </td>
                                        <td>
                                            @if($postulante->estado == 1)
                                                <span class="badge bg-success">{{ $postulante->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $postulante->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($postulante->estado == 1)
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $postulante->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            @else
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $postulante->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $postulante->id }})'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach --}}
                                <tr>
                                    <td>1</td>
                                    <td>
                                        Christopher Aguilar Suni
                                        <br>Tipo° Documento: DNI
                                        <br>N° Documento: 45145226
                                    </td>
                                    <td>
                                        Segunda Especialidad
                                    </td>
                                    <td>
                                        Certificado de Estudios: 
                                        <i class='bx bx-check' style="color:green"></i>
                                        <br>Titulo: 
                                        <i class='bx bx-check' style="color:green"></i>
                                        <br>Copia DNI: 
                                        <i class='bx bx-check' style="color:green"></i>
                                        <br>Declaración Jurada:
                                        <i class='bx bx-check' style="color:green"></i>
                                    </td>
                                    <td>
                                        E-00145
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Aprobado</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Apto</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModalPruebaAdmision">Admision <i class="las la-edit"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        Juan Perez Ruiz
                                        <br>Tipo° Documento: DNI
                                        <br>N° Documento: 43587452
                                    </td>
                                    <td>
                                        Diplomado
                                    </td>
                                    <td>
                                        Certificado de Estudios: 
                                        <i class='bx bx-check' style="color:green"></i>
                                        <br>Titulo: 
                                        <i class='bx bx-check' style="color:green"></i>
                                        <br>Copia DNI: 
                                        <i class='bx bx-check' style="color:green"></i>
                                        <br>Declaración Jurada:
                                        <i class='bx bx-x' style="color:red"></i>
                                    </td>
                                    <td>
                                        E-00145
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">Requerimientos Incompletos</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger">No Apto</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModalPruebaAdmision">Admision <i class="las la-edit"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        Luis Perez Chavez
                                        <br>Tipo° Documento: DNI
                                        <br>N° Documento: 36521452
                                    </td>
                                    <td>
                                        Programa de Profesionalización Docente
                                    </td>
                                    <td>
                                        Certificado de Estudios: 
                                        <i class='bx bx-check' style="color:green"></i>
                                        <br>Titulo: 
                                        <i class='bx bx-check' style="color:green"></i>
                                        <br>Copia DNI: 
                                        <i class='bx bx-check' style="color:green"></i>
                                        <br>Declaración Jurada:
                                        <i class='bx bx-check' style="color:green"></i>
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">Requerimientos Incompletos</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger">No Apto</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModalPruebaAdmision">Admision <i class="las la-edit"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $postulantes->links() }}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
    <!-- Default Modals -->
    <div wire:ignore.self id="myModal" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div>
                            <!-- Accordions Fill Colored -->
                            <div class="accordion custom-accordionwithicon accordion-fill-success" id="accordionFill">
                                <div class="accordion-item material-shadow">
                                    <h2 class="accordion-header" id="accordionFillExample1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_fill1" aria-expanded="true" aria-controls="accor_fill1">
                                            <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                            <span style="margin-right: 5px;"><b>I. DATOS PERSONALES</b></span>
                                        </button>
                                    </h2>
                                    <div id="accor_fill1" class="accordion-collapse collapse show" aria-labelledby="accordionFillExample1" data-bs-parent="#accordionFill">
                                        <div class="accordion-body">                
                                            <div class="row">
                                                <div class="mb-3 col-lg-4">
                                                    <label for="nombres" class="col-form-label">Nombres:</label>
                                                    <input type="text" class="form-control" id="nombres" wire:model='form.nombres'>
                                                    <div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="ape_pat" class="col-form-label">Ap. Paterno:</label>
                                                    <input type="text" class="form-control" id="ape_pat" wire:model='form.ape_pat'>
                                                    <div>
                                                        @error('form.ape_pat') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="ape_mat" class="col-form-label">Ap. Materno:</label>
                                                    <input type="text" class="form-control" id="ape_mat" wire:model='form.ape_mat'>
                                                    <div>
                                                        @error('form.ape_mat') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>                                
                                                <div class="mb-3 col-lg-2">
                                                    <label for="genero" class="col-form-label">Genero:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Masculino</option> 
                                                        <option value="1">Femenino</option> 
                                                    </select>
                                                    @error('form.genero') <span class="error">{{ $message }}</span> @enderror
                                                </div>                            
                                            </div>
                                            <div class="row">
                                                <div class="mb-3 col-lg-2">
                                                    <label for="tipo_documento" class="col-form-label">Tipo de Documento:</label>
                                                    <select class="form-select" id="tipo_documento" name="state" wire:model='form.tipo_documento'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="dni">DNI</option> 
                                                        <option value="carnet_extranjeria">Carnet de Extranjeria</option> 
                                                        <option value="pasaporte">Pasaporte</option> 
                                                    </select>
                                                    @error('form.tipo_documento') <span class="error">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3 col-lg-2">
                                                    <label for="nro_documento" class="col-form-label">N° Documento:</label>
                                                    <input type="text" class="form-control" id="nro_documento" wire:model='form.nro_documento'>
                                                    <div>
                                                        @error('form.nro_documento') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-2">
                                                    <label for="telefono" class="col-form-label">Telefono:</label>
                                                    <input type="text" class="form-control" id="telefono" wire:model='form.telefono'>
                                                    <div>
                                                        @error('form.telefono') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-4">
                                                    <label for="telefono" class="col-form-label">Email:</label>
                                                    <input type="text" class="form-control" id="telefono" wire:model='form.telefono'>
                                                    <div>
                                                        @error('form.telefono') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item material-shadow">
                                    <h2 class="accordion-header" id="accordionFillExample2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_fill2" aria-expanded="false" aria-controls="accor_fill2">
                                            <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                            <span style="margin-right: 5px;"><b>II. DATOS INSTITUCION FORMADORA</b></span>
                                        </button>
                                    </h2>
                                    <div id="accor_fill2" class="accordion-collapse collapse" aria-labelledby="accordionFillExample2" data-bs-parent="#accordionFill">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="mb-3 col-lg-4">
                                                    <label for="nombres" class="col-form-label">Nombre de la Institucion:</label>
                                                    <input type="text" class="form-control" id="nombres" wire:model='form.nombres'>
                                                    <div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Tipo de la Institucion:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Publica</option> 
                                                        <option value="1">Privada</option> 
                                                    </select><div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-2">
                                                    <label for="nombres" class="col-form-label">Año de Egreso:</label>
                                                    <input type="number" class="form-control" id="nombres" wire:model='form.nombres'>
                                                    <div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Carrera Profesional:</label>
                                                    <input type="text" class="form-control" id="nombres" wire:model='form.nombres'>
                                                    <div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Pais Institucion:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Perú</option> 
                                                        <option value="1">Privada</option> 
                                                    </select><div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Departamento Institucion:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Publica</option> 
                                                        <option value="1">Privada</option> 
                                                    </select><div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Provincia de la Institucion:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Publica</option> 
                                                        <option value="1">Privada</option> 
                                                    </select><div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Distrito de la Institucion:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Publica</option> 
                                                        <option value="1">Privada</option> 
                                                    </select>
                                                    <div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-8">
                                                    <label for="nombres" class="col-form-label">Ubicación de la Institucion:</label>
                                                    <input type="number" class="form-control" id="nombres" wire:model='form.nombres'>
                                                    <div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item material-shadow">
                                    <h2 class="accordion-header" id="accordionFillExample3">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_fill3" aria-expanded="false" aria-controls="accor_fill3">
                                            <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                            <span style="margin-right: 5px;"><b>III. DOCENCIA</b></span>
                                        </button>
                                    </h2>
                                    <div id="accor_fill3" class="accordion-collapse collapse" aria-labelledby="accordionFillExample3" data-bs-parent="#accordionFill">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Ejerce Docencia:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Si</option> 
                                                        <option value="1">No</option> 
                                                    </select><div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Modalidad/Nivel:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Publica</option> 
                                                        <option value="1">Privada</option> 
                                                    </select><div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-4">
                                                    <label for="nombres" class="col-form-label">Nombre de la Institucion donde Labora:</label>
                                                    <input type="text" class="form-control" id="nombres" wire:model='form.nombres'>
                                                    <div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-2">
                                                    <label for="nombres" class="col-form-label">N° de la Institucion:</label>
                                                    <input type="text" class="form-control" id="nombres" wire:model='form.nombres'>
                                                    <div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Tipo de la Institucion:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Publica</option> 
                                                        <option value="1">Privada</option> 
                                                    </select><div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Condicion Laboral:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Publica</option> 
                                                        <option value="1">Privada</option> 
                                                    </select><div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Escala Magisterial:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Publica</option> 
                                                        <option value="1">Privada</option> 
                                                    </select><div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Pais Institucion:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Perú</option> 
                                                        <option value="1">Privada</option> 
                                                    </select><div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Departamento Institucion:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Publica</option> 
                                                        <option value="1">Privada</option> 
                                                    </select><div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Provincia de la Institucion:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Publica</option> 
                                                        <option value="1">Privada</option> 
                                                    </select><div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Distrito de la Institucion:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Publica</option> 
                                                        <option value="1">Privada</option> 
                                                    </select><div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-8">
                                                    <label for="nombres" class="col-form-label">Ubicación de la Institucion:</label>
                                                    <input type="number" class="form-control" id="nombres" wire:model='form.nombres'>
                                                    <div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-4">
                                                    <label for="nombres" class="col-form-label">Ocupación:</label>
                                                    <input type="text" class="form-control" id="nombres" wire:model='form.nombres'>
                                                    <div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item material-shadow">
                                    <h2 class="accordion-header" id="accordionFillExample2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_fill4" aria-expanded="false" aria-controls="accor_fill4">
                                            <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                            <span style="margin-right: 5px;"><b>IV. REQUISITOS</b></span>
                                        </button>
                                    </h2>
                                    <div id="accor_fill4" class="accordion-collapse collapse" aria-labelledby="accordionFillExample2" data-bs-parent="#accordionFill">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="nro_requerimiento" class="col-form-label">Certificado de Estudios (pdf):</label>
                                                    <input class="form-control" id="formFileSm" type="file" wire:model='formTarea.documento' accept="application/pdf">
                                                </div>
                                                <div class="col-12">
                                                    <label for="nro_requerimiento" class="col-form-label">Copia de Titulo (pdf):</label>
                                                    <input class="form-control" id="formFileSm" type="file" wire:model='formTarea.documento' accept="application/pdf">
                                                </div>
                                                <div class="col-12">
                                                    <label for="nro_requerimiento" class="col-form-label">Copia de DNI (pdf):</label>
                                                    <input class="form-control" id="formFileSm" type="file" wire:model='formTarea.documento' accept="application/pdf">
                                                </div> 
                                                <div class="col-12">
                                                    <label for="nro_requerimiento" class="col-form-label">Declaracion Jurada (pdf):</label>
                                                    <input class="form-control" id="formFileSm" type="file" wire:model='formTarea.documento' accept="application/pdf">
                                                </div>
                                                <div class="col-12">
                                                    <label for="nro_requerimiento" class="col-form-label">Comprobante (pdf):</label>
                                                    <input class="form-control" id="formFileSm" type="file" wire:model='formTarea.documento' accept="application/pdf">
                                                </div> 
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Tipo de Comprobante:</label>
                                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        <option value="0">Perú</option> 
                                                        <option value="1">Privada</option> 
                                                    </select><div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">N° Comprobante:</label>
                                                    <input type="number" class="form-control" id="importe" wire:model='formTarea.importe'>
                                                    <div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Fecha:</label>
                                                    <input type="date" class="form-control" wire:model='formTarea.fecha_emision'>
                                                    <div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-3">
                                                    <label for="nombres" class="col-form-label">Monto:</label>
                                                    <input type="number" class="form-control" id="importe" wire:model='formTarea.importe'>
                                                    <div>
                                                        @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item material-shadow">
                                    <h2 class="accordion-header" id="accordionFillExample2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_fill5" aria-expanded="false" aria-controls="accor_fill5">
                                            <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                            <span style="margin-right: 5px;"><b>V. PROGRAMA DE ESTUDIOS A POSTULAR</b></span>
                                        </button>
                                    </h2>
                                    <div id="accor_fill5" class="accordion-collapse collapse" aria-labelledby="accordionFillExample5" data-bs-parent="#accordionFill">
                                        <div class="accordion-body">
                                            <div class="col-12">
                                                <label for="nro_requerimiento" class="col-form-label">Programa de Estudios:</label>
                                                <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                                    <option value="">Seleccionar Opcion</option>
                                                    @foreach ($programas_estudio as $programa)
                                                        <option value="{{ $programa->id }}">{{ $programa->descripcion }}</option>    
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click='guardar'>Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Default Modals -->
    <div wire:ignore.self id="myModalPruebaAdmision" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Ingresar Notas Escrita y Entrevista</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>       
                        <div class="row">
                            <div class="mb-3 col-lg-4">
                                <label for="nombres" class="col-form-label">Prueba Escrita</label>:</label>
                                <input type="number" class="form-control" id="nombres" wire:model='form.nombres'>
                                <div>
                                    @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-lg-3">
                                <label for="ape_pat" class="col-form-label">Entrevista:</label>
                                <input type="text" class="form-control" id="ape_pat" wire:model='form.ape_pat'>
                                <div>
                                    @error('form.ape_pat') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-lg-3">
                                <label for="ape_mat" class="col-form-label">Promedio:</label>
                                <input type="text" class="form-control" id="ape_mat" wire:model='form.ape_mat'>
                                <div>
                                    @error('form.ape_mat') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>                                
                                                    
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click='guardar'>Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @script()
        <script>
        </script>
    @endscript
</div>
