<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Matriculas</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Estudiante</th>
                                    <th scope="col">Ciclo</th>
                                    <th scope="col">N° Creditos</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matriculas as $matricula)
                                    <tr>                
                                        <td class="font-medium">{{ $loop->index+1 }}</td>                                        
                                        <td>{{ $matricula->descripcion }}</td>
                                        <td>
                                            {{ $matricula->ciclo }}
                                        </td>
                                        <td>
                                            {{ $matricula->nro_creditos }}
                                        </td>
                                        <td>
                                            @if($matricula->estado == 1)
                                                <span class="badge bg-success">{{ $matricula->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $matricula->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="min-width: 250px;">
                                            <div class="btn-group" role="group" aria-label="Acciones">
                                                @if($matricula->estado == 1)
                                                    <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light btn-sm me-2" wire:click='cambiarEstado({{ $matricula->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-success bg-gradient waves-effect waves-light btn-sm me-2" wire:click='cambiarEstado({{ $matricula->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                                @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $matricula->id }})'>Editar <i class="las la-edit"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>                            
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{-- {{ $matriculas->links() }} --}}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
    
    <!-- Default Modals -->
    <div wire:ignore.self id="myModalCurso" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $tituloRequisito }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <table class="table table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Area</th>
                                    <th scope="col">Turno</th>
                                    <th scope="col">Seccion</th>
                                    <th scope="col">Docente</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><input type="radio" name="curso"/></th>
                                    <th>ESPIRITUALIDAD Y MANIFESTACIONES RELIGIOSAS PARA EL APRENDIZAJE</th>
                                    <th>MAÑANA</th>
                                    <th>C</th>
                                    <th>JOSE LUNA PUENTE</th>
                                    <th><span class="badge bg-success">Activo</span></th>
                                    <th><button type="button" class="btn btn-info bg-gradient waves-effect waves-light btn-sm me-2">Editar <i class="las la-trash"></i></button></th>
                                </tr>
                                <tr>
                                    <th><input type="radio" name="curso"/></th>
                                    <th>PLANIFICACION POR COMPETENCIAS Y EVALUACION PARA EL APRENDIZAJE</th>
                                    <th>TARDE</th>
                                    <th>B</th>
                                    <th>MARCOS SANCHEZ FLOREZ</th>
                                    <th><span class="badge bg-success">Activo</span></th>
                                    <th><button type="button" class="btn btn-info bg-gradient waves-effect waves-light btn-sm me-2">Editar <i class="las la-trash"></i></button></th>
                                </tr>
                            </tbody>
                        </table>                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click='guardar'>Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
                        <div class="row">
                            <div class="col-2">
                                <input type="text" id="nro_documento" class="form-control" placeholder="Ingresar DNI">
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary">Buscar</button>
                            </div>
                        </div>
                        <hr>
                        {{-- <div class="mb-3">
                            <label for="codigo" class="col-form-label">Codigo:</label>
                            <input type="text" class="form-control" id="codigo" wire:model='form.codigo'>
                            <div>
                                @error('form.codigo') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div> --}}
                        <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                    Datos del Estudiante
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#foto" role="tab">
                                    Foto
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                    Pago
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#profile2" role="tab">
                                    Cursos a Matricular
                                </a>
                            </li>
                        </ul>
                         <!-- Tab panes -->
                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="home1" role="tabpanel">
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
                                    <div class="mb-3 col-lg-3">
                                        <label for="nombres" class="col-form-label">Lengua Nacimiento:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="">Seleccionar Opcion</option>
                                            <option value="0">Castellano</option> 
                                            <option value="1">Privada</option> 
                                        </select><div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-3">
                                        <label for="nombres" class="col-form-label">Lengua Secundaria:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="">Seleccionar Opcion</option>
                                            <option value="0">Castellano</option> 
                                            <option value="1">Privada</option> 
                                        </select><div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-3">
                                        <label for="nombres" class="col-form-label">Fecha Nacimiento:</label>
                                        <input type="date" class="form-control">
                                        <div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-3">
                                        <label for="nombres" class="col-form-label">Telf. Casa:</label>
                                        <input type="text" class="form-control">
                                        <div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-3">
                                        <label for="nombres" class="col-form-label">Pais Nacimiento:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="">Seleccionar Opcion</option>
                                            <option value="0">Perú</option> 
                                            <option value="1">Privada</option> 
                                        </select><div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-3">
                                        <label for="nombres" class="col-form-label">Departamento Nacimiento:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="">Seleccionar Opcion</option>
                                            <option value="0">Publica</option> 
                                            <option value="1">Privada</option> 
                                        </select><div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-3">
                                        <label for="nombres" class="col-form-label">Provincia de Nacimiento:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="">Seleccionar Opcion</option>
                                            <option value="0">Publica</option> 
                                            <option value="1">Privada</option> 
                                        </select><div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-3">
                                        <label for="nombres" class="col-form-label">Distrito de Nacimiento:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="">Seleccionar Opcion</option>
                                            <option value="0">Publica</option> 
                                            <option value="1">Privada</option> 
                                        </select>
                                        <div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-3">
                                        <label for="nombres" class="col-form-label">Departamento Domicilio:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="">Seleccionar Opcion</option>
                                            <option value="0">Publica</option> 
                                            <option value="1">Privada</option> 
                                        </select><div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-3">
                                        <label for="nombres" class="col-form-label">Provincia Domicilio:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="">Seleccionar Opcion</option>
                                            <option value="0">Publica</option> 
                                            <option value="1">Privada</option> 
                                        </select><div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-3">
                                        <label for="nombres" class="col-form-label">Distrito Domicilio:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="">Seleccionar Opcion</option>
                                            <option value="0">Publica</option> 
                                            <option value="1">Privada</option> 
                                        </select>
                                        <div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-3">
                                        <label for="nombres" class="col-form-label">Dirección:</label>
                                        <input type="text" class="form-control">
                                        <div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-2">
                                        <label for="nombres" class="col-form-label">Etnia:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="">Seleccionar Opcion</option>
                                            <option value="0">Publica</option> 
                                            <option value="1">Privada</option> 
                                        </select>
                                        <div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-2">
                                        <label for="nombres" class="col-form-label">Tiene Discapacidad:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="">Seleccionar Opcion</option>
                                            <option value="0">Si</option> 
                                            <option value="1">No</option> 
                                        </select>
                                        <div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-2">
                                        <label for="nombres" class="col-form-label">Estado Civil:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="">Seleccionar Opcion</option>
                                            <option value="0">Soltero</option> 
                                            <option value="1">Casado</option>
                                            <option value="2">Viudo</option>
                                            <option value="3">Divorciado</option> 
                                        </select>
                                        <div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-2">
                                        <label for="nombres" class="col-form-label">Tiene Beca PronaBec:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="">Seleccionar Opcion</option>
                                            <option value="0">Si</option> 
                                            <option value="1">No</option> 
                                        </select>
                                        <div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-2">
                                        <label for="nombres" class="col-form-label">N° Resolución Pronabec:</label>
                                        <input type="text" class="form-control">
                                        <div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="foto" role="tabpanel">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title mb-0">Profile Picture Selection</h4>
                                        </div><!-- end card header -->
                
                                        <div class="card-body">
                                            <p class="text-muted">FilePond is a JavaScript library with profile picture-shaped file
                                                upload variation.</p>
                                            <div class="avatar-xl mx-auto">
                                                <input type="file" class="filepond filepond-input-circle" name="filepond"
                                                    accept="image/png, image/jpeg, image/gif" />
                                            </div>
                
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div> <!-- end col -->
                            </div>
                            <div class="tab-pane" id="profile1" role="tabpanel">
                                <div class="row">
                                    <div class="mb-3 col-3">
                                        <label for="genero" class="col-form-label">Tipo Comprobante:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="">Seleccionar Opcion</option>
                                            <option value="0">Boleta de Pago - Tesoreria</option> 
                                            <option value="1">Femenino</option> 
                                        </select>
                                        @error('form.genero') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="nombres" class="col-form-label">N° Comprobante:</label>
                                        <input type="text" class="form-control">
                                        <div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="nombres" class="col-form-label">Monto:</label>
                                        <input type="number" class="form-control">
                                        <div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="genero" class="col-form-label">Exoneracion Pago:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="0">No</option> 
                                            <option value="1">Si</option> 
                                        </select>
                                        @error('form.genero') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="genero" class="col-form-label">Tipo de exoneración:</label>
                                        <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                            <option value="0">No</option> 
                                            <option value="1">Si</option> 
                                        </select>
                                        @error('form.genero') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3 col-12">
                                        <label for="nombres" class="col-form-label">Motivo de Exoneracion:</label>
                                        <input type="text" class="form-control">
                                        <div>
                                            @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile2" role="tabpanel">
                                <label for="nombres" class="col-form-label">Formación Inicial Docente - Educacion Inicial:</label>
                                <div class="table-responsive table-card">
                                    <div class="row">
                                        <div class="col-lg-3">       
                                        </div>
                                        <div class="col-lg-7">
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="btn btn-outline-secondary btn-label waves-effect right waves-light m-3" data-bs-toggle="modal" data-bs-target="#myModalCurso" wire:click='agregar'>
                                                <i class="ri-add-fill label-icon align-middle fs-16 ms-2"></i> AGREGAR
                                            </button>
                                        </div>
                                    </div>
                                    <table class="table table-striped-columns mb-4">
                                        <thead>
                                            <tr>
                                                <th scope="col">N°</th>
                                                <th scope="col">Area</th>
                                                <th scope="col">Turno</th>
                                                <th scope="col">Seccion</th>
                                                <th scope="col">Docente</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col" class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <th>APRENDIZAJE DE LAS CIENCIAS</th>
                                                <th>Mañana</th>
                                                <th>A</th>
                                                <th>JUAN PEREZ RUIZ</th>
                                                <th><span class="badge bg-success">Activo</span></th>
                                                <th><button type="button" class="btn btn-info bg-gradient waves-effect waves-light btn-sm me-2">Editar <i class="las la-trash"></i></button></th>
                                            </tr>
                                            {{-- @foreach ($cursos as $curso)
                                                <tr>                
                                                    <td class="font-medium">{{ $loop->index+1 }}</td>                                        
                                                    <td>{{ $matricula->descripcion }}</td>
                                                    <td>
                                                        {{ $matricula->ciclo }}
                                                    </td>
                                                    <td>
                                                        {{ $matricula->nro_creditos }}
                                                    </td>
                                                    <td>
                                                        @if($matricula->estado == 1)
                                                            <span class="badge bg-success">{{ $matricula->nEstado }}</span>
                                                        @else
                                                            <span class="badge bg-danger">{{ $matricula->nEstado }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center" style="min-width: 250px;">
                                                        <div class="btn-group" role="group" aria-label="Acciones">
                                                            @if($matricula->estado == 1)
                                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light btn-sm me-2" wire:click='cambiarEstado({{ $matricula->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                                            @else
                                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light btn-sm me-2" wire:click='cambiarEstado({{ $matricula->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                                            @endif
                                                            <button type="button" class="btn btn-info bg-gradient waves-effect waves-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $matricula->id }})'>Editar <i class="las la-edit"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                        </tbody>                            
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
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

