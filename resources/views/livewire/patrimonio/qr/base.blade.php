<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        <div class="col-xxl-12">
                            <div class="row g-2 text-center">
                                <div class="col-lg-12">
                                    @if($state['id'])
                                        <div class="col-md-12 mb-2">
                                            @if($state['anio'] != $anioCurso)
                                                <div class="alert alert-warning" role="alert">
                                                    <i class="mdi mdi-alert-outline mr-2"></i> Este <strong>equipo</strong> no se encuentra inventariado para el año en curso <strong>({{$anioCurso}})</strong>, click <a href="javascript:void(0);" wire:click="$emit('inventa', {{$state['id']}})">AQUI</a>, para inventariar.
                                                </div>
                                            @else
                                                <div class="alert alert-info" role="alert">
                                                    <i class="mdi mdi-bookmark-check mr-2"></i> <strong>Equipo</strong> inventariado para el año <strong>({{$anioCurso}})</strong>, click <a href="javascript:void(0);" wire:click="$emit('inventa', {{$state['id']}}, 1)">AQUI</a>, para editar inventario.
                                                </div>
                                            @endif

                                            <div class="col-lg-12 mb-3" style="text-align: center;">
                                                <img src="/equipamiento/CatalogoEquipos/{{ $urlFoto }}" alt="img" class="img-fluid blog-img-height">
                                                <center><small>Código Patrimonial</small><h4><b>{{$state['CODIGO_ACTIVO']}}</b></h4></center>
                                            </div>
                                            <?php 
                                                if($state['ESTADO_CONSERV']==1){
                                                    ?><button type="button" class="btn waves-effect waves-light btn-lg btn-info" style="width: 100%;">Bueno</button><?php
                                                }elseif($state['ESTADO_CONSERV']==2){
                                                    ?><button type="button" class="btn waves-effect waves-light btn-lg btn-primary" style="width: 100%;">Regular</button><?php
                                                }elseif($state['ESTADO_CONSERV']==3){
                                                    ?><button type="button" class="btn waves-effect waves-light btn-lg btn-warning" style="width: 100%;">Malo</button><?php
                                                }elseif($state['ESTADO_CONSERV']==4){
                                                    ?><button type="button" class="btn waves-effect waves-light btn-lg btn-danger" style="width: 100%;">Muy Malo</button><?php
                                                }elseif($state['ESTADO_CONSERV']==5){
                                                    ?><button type="button" class="btn waves-effect waves-light btn-lg btn-success" style="width: 100%;">Nuevo</button><?php
                                                }elseif($state['ESTADO_CONSERV']==6){
                                                    ?><button type="button" class="btn waves-effect waves-light btn-lg btn-secondary" style="width: 100%;">Chatarra</button><?php
                                                }elseif($state['ESTADO_CONSERV']==7){
                                                    ?><button type="button" class="btn waves-effect waves-light btn-lg btn-light" style="width: 100%;">RAEE</button><?php
                                                }
                                            ?>
                                        </div>

                                        <div class="col-md-12 mb-2">
                                            <label><b>Número de Serie</b></label>
                                            <input type="text" wire:model.defer="state.NRO_SERIE" class="form-control">
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label><b>Trabajador</b></label>
                                            <input type="text" wire:model.defer="trabajador" class="form-control" readonly>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label><b>Área</b></label>
                                            <textarea class="form-control" wire:model.defer="state.area" readonly></textarea>
                                        </div>

                                        <div class="col-md-12 mb-2">
                                            <div id="accordion" style="margin-bottom:0rem!important" class="custom-accordion mb-4">
                                                <div class="card mb-3" style="border: 1px solid #dee2e6;">
                                                    <div class="card-header" id="headingOne">
                                                        <h5 class="m-0">
                                                            <a class="custom-accordion-title d-block d-flex align-items-center collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                                Ver Mas <span class="ml-auto"><i class="mdi mdi-chevron-down accordion-arrow"></i></span>
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                        <div class="card-body" style="padding: 6px;">
                                                            <div class="row">
                                                                <div class="col-md-12 mb-2">
                                                                    <label><b>AREA</b></label>
                                                                    <select class="form-control" wire:model="state.area_id">
                                                                        @if(!is_null($areas))
                                                                        @foreach($areas as $area)
                                                                            <option value="{{$area->Id}}">{{$area->Descripcion}}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-12 mb-2">
                                                                    <label><b>Registrado en SIGA</b></label>
                                                                    <select class="form-control" wire:model="state.SIGA" disabled>
                                                                        <option value="1">Si</option>
                                                                        <option value="0">No</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-12 mb-2">
                                                                    <label><b>Tipo</b></label>
                                                                    <select class="form-control" wire:model="tipo" disabled="">
                                                                        <option value="1">Equipo</option>
                                                                        <option value="2">Componente</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-12 mb-2">
                                                                    <label><b>Observaciones</b></label>
                                                                    <textarea class="form-control" wire:model.defer="state.OBSERVACIONES"></textarea>
                                                                </div>
                                                                <div class="col-md-12 mb-2">
                                                                    <label><b>Grupo</b></label>
                                                                    <input type="text" wire:model.defer="state.grupo" class="form-control" readonly>
                                                                </div>
                                                                <div class="col-md-12 mb-2">
                                                                    <label><b>Clase</b></label>
                                                                    <input type="text" wire:model.defer="clase" class="form-control" readonly>
                                                                </div>
                                                                <div class="col-md-12 mb-2">
                                                                    <label><b>Familia</b></label>
                                                                    <input type="text" wire:model.defer="familia" class="form-control" readonly>
                                                                </div>
                                                                <div class="col-md-12 mb-2">
                                                                    <label><b>Marca</b></label>
                                                                    <input type="text" wire:model.defer="state.MARCA" class="form-control">
                                                                </div>
                                                                <div class="col-md-12 mb-2">
                                                                    <label><b>Modelo</b></label>
                                                                    <input type="text" wire:model.defer="state.MODELO" class="form-control">
                                                                </div>
                                                                <div class="col-md-12 mb-2">
                                                                    <label><b>Color</b></label>
                                                                    <input type="text" wire:model.defer="state.COLOR" class="form-control">
                                                                </div>
                                                                <div class="col-md-12 mb-2">
                                                                    <label><b>Observaciones</b></label>
                                                                    <input type="text" wire:model.defer="state.OBSERVACIONES" class="form-control">
                                                                </div>
                                                            </div>                  
                                                        </div>
                                                    </div>
                                                    
                                                </div> <!-- end card-->
                                                <button type="button" class="btn waves-effect waves-light btn-info" wire:click="editar">
                                                        <i class="fa fa-edit"></i> | EDITAR
                                                    </button>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12 mb-2">
                                            Para visualizar un equipo, dar click en <i class="fa fa-search"></i> para buscar por código, click en <i class="mdi mdi-barcode-scan"></i> para buscar por código de barras.
                                        </div>      
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contenedor btn-flotante">
        <button class="botonF2" wire:click="$emit('buscarnum')">
            <span id="txtBtn2"><i class="mdi mdi-tab-search"></i></span>
        </button>
        <button class="botonF1" onclick="iniciar();">
            <span id="txtBtn"><i class="mdi mdi-qrcode-scan"></i></span>
        </button>
    </div>

    <style type="text/css">      
        .error{
            color: red;
        }
        .btn-flotante {
            font-weight: bold; /* Fuente en negrita o bold */
            color: #ffffff; /* Color del texto */
            letter-spacing: 2px; /* Espacio entre letras */
            position: fixed;
            bottom: 40px;
            right: 40px;
            transition: all 300ms ease 0ms;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            z-index: 99;
        }
        .btn-flotante:hover {
            box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
        }
        .botonF1{
          width:60px;
          height:60px;
          border-radius:100%;
          background:#1e88e5;
          right:0;
          bottom:0;
          position:absolute;
          margin-right:16px;
          margin-bottom:16px;
          border:none;
          outline:none;
          color:#FFF;
          font-size:36px;
          box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
          transition:.3s;  
        }
        .botonF2{
          width:60px;
          height:60px;
          border-radius:100%;
          background:#1e88e5;
          right:0;
          bottom:0;
          position:absolute;
          margin-right:16px;
          margin-bottom:80px;
          border:none;
          outline:none;
          color:#FFF;
          font-size:36px;
          box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
          transition:.3s;  
        }
        @media  only screen and (max-width: 600px) {
            .btn-flotante {
                font-size: 14px;
                padding: 12px 20px;
                bottom: 20px;
                right: 20px;
            }
        } 
    
        #contenedor video{
            max-width: 100%;
            width: 100%;
        }

        canvas{
            max-width: 100%;
        }
        canvas.drawingBuffer{
            position:absolute;
            top:0;
            left:0;
        }
    </style>
</div>