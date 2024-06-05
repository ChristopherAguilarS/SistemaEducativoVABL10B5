<div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body"><hr style="width:100%; margin-top:-10px">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Tipo de ingreso <font style="color:red">(*)</font></label>
                                        <select wire:model="state.catalogo_tipo_ingreso_id" class="form-select">
                                            <option value="0">Seleccione</option>
                                            @if(!is_null($ingresos))
                                                @foreach($ingresos as $ingreso)
                                                    <option value="{{$ingreso->id}}">{{$ingreso->descripcion}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state.catalogo_tipo_ingreso_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12" style="text-align:center; ">
                                    <div class="mt-4 text-center">
                                        <div wire:loading.delay>
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="sr-only">Cargando...</span>
                                            </div>
                                        </div>
                                        <div wire:loading.remove>
                                            @if($preview) 
                                                <img src="{{ $Foto->temporaryUrl() }}" height="200"> 
                                            @else  
                                                <img src="/images/libros/{{ $urlFoto }}" height="200"> 
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <span class="btn btn-light" style="margin-top: 12px;width: 200px">
                                                Adjuntar Foto
                                                <input type="file" id="imgInp" name="archivo" style="width:100%;height:100%;position:absolute;top:0;left:0;opacity:0;cursor:pointer;" wire:model.live="Foto" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="La imagen no puede ser mayor a 500px de alto y 500px de ancho y debe ser en formatos jpg,jpeg,bmp,png">
                                            </span>   
                                        </div>
                                        @error('Foto') <span class="text-danger-emphasis">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="input-group">
                                        <select class="form-select" wire:model="selMat">
                                            <option value="0">Seleccione Materia</option>
                                            @if(!is_null($materias))
                                                @foreach($materias as $materia)
                                                    <option value="{{$materia->id}}">{{$materia->descripcion}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <button class="btn btn-info" wire:click="aniadir">Añadir</button>
                                    </div>
                                    <hr>
                                    @if((!is_null($vMaterias) && $vMaterias->count()>0))
                                        @foreach($vMaterias as $vMat)
                                            <div class="input-group mt-2">
                                                <input type="text" class="form-control" value="{{$vMat->descripcion }}">
                                                <button class="btn btn-danger" wire:click="delMat({{$vMat->id}})">X</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <center><i>Sin Materias Asignadas</i></center>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Nombre del Libro <font style="color:red">(*)</font></label>
                                        <input type="text" wire:model="state.nombre" class="form-control">
                                        @error('state.nombre') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Descripcion del Libro </label>
                                        <textarea wire:model="state.descripcion" rows="6" class="form-control"></textarea>
                                        @error('state.descripcion') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Autor<font style="color:red">(*)</font></label>
                                        <select wire:model="state.catalogo_autor_id" class="form-select">
                                            <option value="0">Seleccione</option>
                                            @if(!is_null($autores))
                                                @foreach($autores as $autor)
                                                    <option value="{{$autor->id}}">{{$autor->descripcion}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state.catalogo_autor_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Editorial<font style="color:red">(*)</font></label>
                                        <select wire:model="state.catalogo_editorial_id" class="form-select">
                                            <option value="0">Seleccione</option>
                                            @if(!is_null($editoriales))
                                                @foreach($editoriales as $editorial)
                                                    <option value="{{$editorial->id}}">{{$editorial->descripcion}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state.catalogo_editorial_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Categoría<font style="color:red">(*)</font></label>
                                        <select wire:model="state.catalogo_categoria_id" class="form-select">
                                            <option value="0">Seleccione</option>
                                            @if(!is_null($categorias))
                                                @foreach($categorias as $categoria)
                                                    <option value="{{$categoria->id}}">{{$categoria->descripcion}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state.catalogo_categoria_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Idioma<font style="color:red">(*)</font></label>
                                        <select wire:model="state.catalogo_idioma_id" class="form-select">
                                            <option value="0">Seleccione</option>
                                            @if(!is_null($idiomas))
                                                @foreach($idiomas as $idioma)
                                                    <option value="{{$idioma->id}}">{{$idioma->descripcion}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state.catalogo_idioma_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Año de Publicación<font style="color:red">(*)</font></label>
                                        <input type="number" class="form-control" wire:model="state.anio">
                                        @error('state.anio') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">ISBN</label>
                                        <input type="number" class="form-control" wire:model="state.ISBN">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Estado<font style="color:red">(*)</font></label>
                                        <select wire:model="state.estado" class="form-select">
                                            <option value="1">Bueno</option>
                                            <option value="2">Dañado</option>
                                            <option value="0">No Disponible</option>
                                        </select>
                                        @error('state.catalogo_idioma_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><br><hr style="width:100%; margin-top:-10px">
         
                    <button type="button" class="btn btn-info material-shadow-none" wire:click="guardar">Guardar</button>
      
                    <button type="button" class="btn btn-light material-shadow-none" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
