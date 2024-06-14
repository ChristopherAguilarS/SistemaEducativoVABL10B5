<form>
                        <div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 style="display: flex; align-items: center;">
                                        <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                        <span style="margin-right: 5px;"><b>II. DATOS INSTITUCION FORMADORA</b></span>
                                    </h6>
                                    <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                </div>
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
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 style="display: flex; align-items: center;">
                                        <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                        <span style="margin-right: 5px;"><b>III. DOCENCIA</b></span>
                                    </h6>
                                    <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                </div>
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
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 style="display: flex; align-items: center;">
                                        <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                        <span style="margin-right: 5px;"><b>IV. REQUISITOS</b></span>
                                    </h6>
                                    <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                </div>
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
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 style="display: flex; align-items: center;">
                                        <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                        <span style="margin-right: 5px;"><b>V. PROGRAMA DE ESTUDIOS</b></span>
                                    </h6>
                                    <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                </div>
                                <div class="col-12">
                                    <label for="nro_requerimiento" class="col-form-label">Programa de Estudios:</label>
                                    <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                        <option value="">Seleccionar Opcion</option>
                                        <option value="0">Publica</option> 
                                        <option value="1">Privada</option> 
                                    </select>
                                </div>
                            </div>
                        </div> 
                    </form>