<section class="section bg-light" id="marketplace" style="    padding: 40px 0;">
    <style>
        .dropdown-item:hover, .dropdown-item:focus {
    color: var(--vz-dropdown-link-hover-color);
    background-color: #e5e7ea;
}
    </style>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                    <div class="text-center mb-2">
                            <h2 class="mb-3 fw-semibold lh-base">Nuestra biblioteca</h2>
                            <p class="text-muted mb-4">Podrás consultar nuestro catálogo virtual de libros, solicitar su préstamo o reservarlo.</p>
                        </div>
                    </div><!-- end col -->
                    <div class="col-lg-12">
                        <div class="d-lg-flex align-items-center mb-4">
                            <div class="flex-grow-1">
                            </div>
                            <div class="flex-shrink-0 mt-4 mt-lg-0">
                                <a href="/biblioteca/ver-libros" class="btn btn-soft-primary">Ver Todo <i class="ri-arrow-right-line align-bottom"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- end row -->
                <div class="row">
                    <div class="col-xl-9 col-lg-4">
                        <div class="row">
                            @foreach($libros as $libro)
                            <?php
                            if($libro->imagen){
                                $rImagen = $libro->id.'.'.$libro->imagen;
                            }else{
                                $rImagen = 'sin_foto.jpeg';
                            }
                            ?>
                                <div class="col-lg-3 product-item artwork crypto-card 3d-style mb-4">
                                    <div class="card explore-box card-animate" style="height:100%; margin-bottom: 0rem;">
                                        <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                                            <button type="button" class="btn btn-icon active" data-bs-toggle="button" aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
                                        </div>
                                        <div class="explore-place-bid-img">
                                            <img src="/images/libros/{{$rImagen}}" alt="" class="card-img-top explore-img" />
                                            <div class="bg-overlay"></div>
                                            <div class="place-bid-btn">
                                                <a href="#!" class="btn btn-success"><i class="ri-auction-fill align-bottom me-1"></i> Ver</a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="mb-1"><a href="apps-nft-item-details">{{$libro->nombre}}</a></h5>
                                            <p class="text-muted mb-0">{{$libro->autor}}</p>
                                        </div>
                                        <div class="card-footer border-top border-top-dashed">
                                            <div class="d-flex align-items-center">
                                                <p class="fw-medium mb-0 float-end">
                                                    @if($libro->valoracion == 1)
                                                        <span class="mdi mdi-star text-warning"></span>
                                                    @elseif($libro->valoracion == 2)
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                    @elseif($libro->valoracion == 3)
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                    @elseif($libro->valoracion == 4)
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                    @elseif($libro->valoracion == 5)
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                    @else
                                                        <center><i>Sin Valoraciones</i></center>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="card">
                            <div class="accordion accordion-flush filter-accordion">
                                <div class="card-body border-bottom">
                                    <div>
                                        <p class="text-muted text-uppercase fs-12 fw-medium mb-2">Categorias</p>
                                        <ul class="list-unstyled mb-0 filter-list">
                                            @foreach($categorias as $categoria)
                                                <li>
                                                    <a href="/biblioteca/ver-libros/{{$categoria->id}}/0" class="d-flex py-1 align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-13 mb-0 listname">{{$categoria->descripcion}}</h5>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <span class="badge bg-light text-muted">{{ $categoria->libros_count }}</span>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingBrands">
                                        <button class="accordion-button bg-transparent shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseBrands" aria-expanded="true" aria-controls="flush-collapseBrands">
                                            <span class="text-muted text-uppercase fs-12 fw-medium">Autores</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge" style="display: none;">0</span>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseBrands" class="accordion-collapse collapse show" aria-labelledby="flush-headingBrands">
                                        <div class="accordion-body text-body pt-0">
                                            <ul class="list-unstyled mb-0 filter-list">
                                                @foreach($autores as $autor)
                                                    <li>
                                                        <a href="/biblioteca/ver-libros/0/{{$autor->id}}" class="d-flex py-1 align-items-center dropdown-item">
                                                            <div class="flex-grow-1">
                                                                <h5 class="fs-13 mb-0 listname">{{$autor->descripcion}}</h5>
                                                            </div>
                                                            @if($autor->libros_count)
                                                            <div class="flex-shrink-0 ms-2">
                                                                <span class="badge bg-light text-muted">{{ $autor->libros_count }}</span>
                                                            </div>
                                                            @endif
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="d-lg-flex align-items-center mb-4">
                        <div class="flex-grow-1"></div>
                        <div class="flex-shrink-0 mt-4 mt-lg-0">
                            <a href="/biblioteca/ver-libros" class="btn btn-soft-primary">Ver Todo <i class="ri-arrow-right-line align-bottom"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>