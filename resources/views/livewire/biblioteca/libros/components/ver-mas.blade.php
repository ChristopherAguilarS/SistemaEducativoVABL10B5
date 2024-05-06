<div>
    <div wire:ignore.self id="form2" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Detalle de Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <hr>
                @if(!is_null($state))
                    <div class="modal-body">
                        <div class="row gx-lg-5">
                            <div class="col-xl-4 col-md-8 mx-auto">
                                <div class="product-img-slider sticky-side-div">
                                    <div class="swiper product-thumbnail-slider p-2 rounded bg-light swiper-initialized swiper-horizontal swiper-backface-hidden">
                                        <div class="swiper-wrapper" id="swiper-wrapper-58637a36a52d762c" aria-live="polite">
                                            <div class="swiper-slide swiper-slide-active"  role="group" aria-label="1 / 4">
                                                <img src="/images/libros/{{$rImagen}}" alt="" class="img-fluid d-block">
                                            </div>
                                            <div class="hstack gap-3 flex-wrap mt-2">
                                                <div class="text-muted">
                                                    Copias disponibles <br>
                                                    <span class="text-body fw-medium">0</span></div>
                                                    <div class="vr"></div>
                                                <div class="text-muted">
                                                    Préstamos totales <br>
                                                    <span class="text-body fw-medium">0</span>
                                                </div>
                                                <div class="vr"></div>
                                                <div class="text-muted">
                                                    Vistas <br>
                                                    <span class="text-body fw-medium">0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-8">
                                <div class="mt-xl-0 mt-5">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h4>{{$state->nombre}}</h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                <div><a class="text-primary d-block">{{$state->autor->descripcion}}</a></div>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div>
                                                <a href="apps-ecommerce-add-product.html" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="ri-pencil-fill align-bottom"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                                        <div class="text-muted fs-16">
                                            <span class="mdi mdi-star text-warning"></span>
                                            <span class="mdi mdi-star text-warning"></span>
                                            <span class="mdi mdi-star text-warning"></span>
                                            <span class="mdi mdi-star text-warning"></span>
                                            <span class="mdi mdi-star text-warning"></span>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            @if(!$state->reservado_por)
                                                <button type="button" wire:click="reservar({{ $state->id }})" wire:loading.attr="disabled" class="btn btn-outline-warning waves-effect waves-light material-shadow-none">
                                                    <span class="spinner-border spinner-border-sm flex-shrink-0" wire:loading  style="display:none"></span>
                                                    <span wire:loading.remove><b>RESERVAR</b></span>
                                                </button>
                                            @else
                                                <button type="button" wire:click="devolver({{ $state->id }})" wire:loading.attr="disabled" class="btn btn-outline-info waves-effect waves-light material-shadow-none">
                                                    <span class="spinner-border spinner-border-sm flex-shrink-0" wire:loading  style="display:none"></span>
                                                    <span wire:loading.remove><b>DEVOLVER</b></span>
                                                </button>
                                            @endif
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <p style="text-align: justify;">
                                                {{ $state->descripcion?$state->descripcion:'Sin descripción disponible.' }}
                                            </p>
                                        </div> 
                                        <div class="col-lg-12 mt-3">
                                            @if($state->materias)
                                                @foreach($state->materias as $materia)
                                                    <h3><span class="badge bg-success">{{$materia->materia->descripcion}}</span></h3>
                                                @endforeach
                                            @endif
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <a class="text-primary d-block">Editorial</a>{{ $state->editorial->descripcion }}
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <a class="text-primary d-block">Año de publicación</a>{{ $state->anio }}
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <a class="text-primary d-block">Idioma</a>{{ $state->idioma->descripcion }}
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <a class="text-primary d-block">ISBN</a>{{ $state->ISBN }}
                                                        </div>
                                                        <div class="col-lg-12 mt-4"></div>
                                                        <div class="col-lg-3">
                                                            <a class="text-primary d-block">Categoría</a>{{ $state->categoria->descripcion }}
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
                    <hr>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal"><b>CANCELAR</b></button>
                        @if(!$state->reservado_por)
                            <button type="button" class="btn btn-warning " @click="$dispatch('reservar', [{{$state->id}}])" wire:loading.attr="disabled">
                                <span class="spinner-border flex-shrink-0" wire:loading=""  style="display:none"></span>
                                <b>RESERVAR</b>
                            </button>
                        @else
                            <button type="button" style="width:80px; padding: 4px;" @click="$dispatch('devolver', [{{$state->id}}])" wire:loading.attr="disabled" class="btn btn-outline-info waves-effect waves-light material-shadow-none">
                                <span class="spinner-border spinner-border-sm flex-shrink-0" wire:loading  style="display:none"></span>
                                <span wire:loading.remove><b>DEVOLVER</b></span>
                            </button>
                        @endif

                        
                    </div>
                @endif
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
