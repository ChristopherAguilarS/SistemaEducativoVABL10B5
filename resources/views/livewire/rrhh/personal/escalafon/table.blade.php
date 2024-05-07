<div class="row">
    <div class="card col-xl-4">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">ESCALAFON</h4>
        </div>
        <div class="mt-4 simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden;">
            <div class="simplebar-content" style="padding: 0px 24px;">
                <ul class="to-do-menu list-unstyled" id="projectlist-data">
                    <li>
                    <a data-bs-toggle="collapse" href="#v1" class="nav-link fs-13 collapsed" aria-expanded="false">1.- Filiación e Identificación</a>
                        <div class="collapse @if($m == 1) show @endif" id="v1" style="">
                            <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                <li class="p-1 @if($sel == 1) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(1, 1)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Ficha de Datos</span>
                                </li>
                                <li class="p-1 @if($sel == 2) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(2, 1)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i> D.N.I.</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-bs-toggle="collapse" href="#v2" class="nav-link fs-13 collapsed" aria-expanded="false">2.- Situación Académica</a>
                        <div class="collapse @if($m == 2) show @endif" id="v2" style="">
                            <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                <li class="p-1 @if($sel == 3) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(3, 2)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Cert. de Est. Prim., Sec., Titulo Prof. Y Otros</span>
                                </li>
                                <li class="p-1 @if($sel == 4) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(4, 2)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Colegiatura</span>
                                </li>
                                <li class="p-1 @if($sel == 5) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(5, 2)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Maestria, Postgrado</span>
                                </li>
                                <li class="p-1 @if($sel == 6) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(6, 2)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Capacitaciones y Diplomados</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-bs-toggle="collapse" href="#v3" class="nav-link fs-13 collapsed" aria-expanded="false">3.- Contratos y Adendas</a>
                        <div class="collapse @if($m == 2) show @endif" id="v3" style="">
                            <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                <li class="p-1 @if($sel == 7) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(7, 3)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Contrato Inicial / Adendas</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-bs-toggle="collapse" href="#v4" class="nav-link fs-13 collapsed" aria-expanded="false">4.- Ingreso o Reingreso</a>
                        <div class="collapse @if($m == 4) show @endif" id="v4" style="">
                            <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                <li class="p-1 @if($sel == 8) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(8, 4)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Comision de Servicios</span>
                                </li>
                                <li class="p-1 @if($sel == 9) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(9, 4)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Vacaciones</span>
                                </li>
                                <li class="p-1 @if($sel == 9) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(10, 4)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Licencias</span>
                                </li>
                                <li class="p-1 @if($sel == 9) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(11, 4)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Permisos</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-bs-toggle="collapse" href="#v5" class="nav-link fs-13 collapsed" aria-expanded="false">5.- Trayectoria Laboral</a>
                        <div class="collapse @if($m == 5) show @endif" id="v5" style="">
                            <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                <li class="p-1 @if($sel == 10) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(12, 5)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Certificados o Constancias de Trabajos Anteriores</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-bs-toggle="collapse" href="#v6" class="nav-link fs-13 collapsed" aria-expanded="false">6.- Asignaciones e Incentivos</a>
                        <div class="collapse @if($m == 6) show @endif" id="v6" style="">
                            <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                <li class="p-1 @if($sel == 11) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(13, 6)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Meritos</span>
                                </li>
                                <li class="p-1 @if($sel == 12) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(14, 6)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Demeritos</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-bs-toggle="collapse" href="#v6" class="nav-link fs-13 collapsed" aria-expanded="false">7.- Retiro y Régimen Pensionario</a>
                        <div class="collapse @if($m == 6) show @endif" id="v6" style="">
                            <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                <li class="p-1 @if($sel == 11) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(13, 6)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Meritos</span>
                                </li>
                                <li class="p-1 @if($sel == 12) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(14, 6)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Demeritos</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-bs-toggle="collapse" href="#v6" class="nav-link fs-13 collapsed" aria-expanded="false">8.- Premios y Estímulos</a>
                        <div class="collapse @if($m == 6) show @endif" id="v6" style="">
                            <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                <li class="p-1 @if($sel == 11) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(13, 6)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Meritos</span>
                                </li>
                                <li class="p-1 @if($sel == 12) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(14, 6)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Demeritos</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-bs-toggle="collapse" href="#v6" class="nav-link fs-13 collapsed" aria-expanded="false">9.- Sanciones</a>
                        <div class="collapse @if($m == 6) show @endif" id="v6" style="">
                            <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                <li class="p-1 @if($sel == 11) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(13, 6)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Meritos</span>
                                </li>
                                <li class="p-1 @if($sel == 12) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(14, 6)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Demeritos</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-bs-toggle="collapse" href="#v6" class="nav-link fs-13 collapsed" aria-expanded="false">9.- Licencias y Vacaciones</a>
                        <div class="collapse @if($m == 6) show @endif" id="v6" style="">
                            <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                <li class="p-1 @if($sel == 11) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(13, 6)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Meritos</span>
                                </li>
                                <li class="p-1 @if($sel == 12) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(14, 6)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Demeritos</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-bs-toggle="collapse" href="#v6" class="nav-link fs-13 collapsed" aria-expanded="false">10.- Otros</a>
                        <div class="collapse @if($m == 6) show @endif" id="v6" style="">
                            <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                <li class="p-1 @if($sel == 11) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(13, 6)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Meritos</span>
                                </li>
                                <li class="p-1 @if($sel == 12) bg-light @endif">
                                    <span class="cursor-pointer" wire:click="vSel(14, 6)"><i class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>Demeritos</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-xl-8">
        <div class="card card-height-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">PDF</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <iframe id="vIframe" src="/legajos/{{$idSel}}/{{$url}}.pdf" width="100%" height="600"></iframe>
                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>