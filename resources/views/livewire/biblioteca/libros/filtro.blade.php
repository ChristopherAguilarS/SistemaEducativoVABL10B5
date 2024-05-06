<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        <div class="col-xxl-12">
                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ri-search-line"></i></span>
                                        <input type="text" class="form-control" wire:keydown.enter="buscar" wire:model="search" placeholder="Buscar por titulo, autor" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ri-search-line"></i></span>
                                        <select class="form-select" wire:model="categoria" wire:change="buscar">
                                            <option value="0">Todas las Categorias</option>
                                            @if(!is_null($categorias))
                                                @foreach($categorias as $categoria)
                                                    <option value="{{$categoria->id}}">{{$categoria->descripcion}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ri-search-line"></i></span>
                                        <select class="form-select" wire:model="materia" wire:change="buscar">
                                            <option value="0">Todas las Materias</option>
                                            @if(!is_null($materias))
                                                @foreach($materias as $materia)
                                                    <option value="{{$materia->id}}">{{$materia->descripcion}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


