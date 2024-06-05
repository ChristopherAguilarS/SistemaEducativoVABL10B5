    <div class="row" wire:loading.class="opacity-50">
        @foreach($posts as $post)
            <?php 
                if($post->imagen){
                    $rImagen = $post->id.'.'.$post->imagen;
                }else{
                    $rImagen = 'sin_foto.jpeg';
                }
                $rating = $post->valoracion; // Este sería tu valor de calificación, puedes obtenerlo desde tu base de datos o de cualquier otra fuente
                $fullStars = floor($rating); // Número de estrellas llenas (parte entera del valor)
                $halfStar = ceil($rating - $fullStars);
             ?>
            <div class="col-lg-3">
                <div class="card border card-animate">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-xl" style="min-height: 150px;">
                                <div class="avatar-title bg-light rounded material-shadow">
                                    <img src="/images/libros/{{$rImagen}}" style="height: 100%; width: 120px;">
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div>
                                    <h6 class="mb-0 fs-14">"{{$post->nombre}}"</h6>
                                    <div class="mb-0 text-muted">
                                        Autor: <cite title="Source Title">{{$post->autor->descripcion}}</cite>
                                    </div>
                                    <p class="text-muted mb-1 fst-italic mt-2 text-truncate-two-lines" style="text-align: justify;">
                                        @if($post->descripcion)
                                            {{$post->descripcion}}...
                                        @else
                                            <i><br>Sin información disponible</i>
                                        @endif
                                    </p>
                                    <div class="flex-grow-1">
                                        <div class="fs-16 align-middle text-warning">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $fullStars)
                                                    <i class="ri-star-fill"></i> <!-- Estrella llena -->
                                                @elseif ($halfStar > 0)
                                                    <i class="ri-star-half-fill"></i> <!-- Estrella media -->
                                                    @php $halfStar = 0; @endphp <!-- Marca que ya se ha utilizado la estrella media -->
                                                @else
                                                    <i class="ri-star"></i> <!-- Estrella vacía -->
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-end mb-0 text-muted mt-4">
                                    <button type="button" style="width:80px; padding: 4px;" @click="$dispatch('ver', [{{ $post->id }}])" wire:loading.attr="disabled" class="btn btn-outline-info waves-effect waves-light material-shadow-none">
                                        <span class="spinner-border spinner-border-sm flex-shrink-0" wire:loading  style="display:none"></span>
                                        <span wire:loading.remove><b>Ver Mas</b></span>
                                    </button>
                                    @if(!$post->reservado_por)
                                        <button type="button" style="width:80px; padding: 4px;" wire:click="reservar({{ $post->id }})" wire:loading.attr="disabled" class="btn btn-outline-warning waves-effect waves-light material-shadow-none">
                                            <span class="spinner-border spinner-border-sm flex-shrink-0" wire:loading  style="display:none"></span>
                                            <span wire:loading.remove><b>Reservar</b></span>
                                        </button>
                                    @else
                                        @if($post->reservado_por == auth()->user()->id)
                                            <button type="button" style="width:80px; padding: 4px;" wire:click="devolver({{ $post->id }})" wire:loading.attr="disabled" class="btn btn-outline-danger waves-effect waves-light material-shadow-none">
                                                <span class="spinner-border spinner-border-sm flex-shrink-0" wire:loading  style="display:none"></span>
                                                <span wire:loading.remove><b>Cancelar</b></span>
                                            </button>
                                        @else
                                            Reservado
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-lg-12">
            <div class="d-flex justify-content-center mt-2">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
