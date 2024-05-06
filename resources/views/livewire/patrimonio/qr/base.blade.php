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
                                                    <i class="mdi mdi-alert-outline mr-2"></i> Este <strong>equipo</strong> no se encuentra inventariado para el año en curso <strong>({{$anioCurso}})</strong>, click <a href="javascript:void(0);" @click="$dispatch('inventa', [{{$state['id']}}])">AQUI</a>, para inventariar.
                                                </div>
                                            @else
                                                <div class="alert alert-info" role="alert">
                                                    <i class="mdi mdi-bookmark-check mr-2"></i> <strong>Equipo</strong> inventariado para el año <strong>({{$anioCurso}})</strong>, click <a href="javascript:void(0);" @click="$dispatch('inventa', [{{$state['id']}}, 1])">AQUI</a>, para editar inventario.
                                                </div>
                                            @endif

                                            <div class="col-lg-12 mb-3" style="text-align: center;">
                                                <img src="/images/equipamiento/catalogo_equipos/{{ $urlFoto }}" alt="img" class="img-fluid blog-img-height">
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
                                            <label><b>AMBIENTE</b></label>
                                            <textarea class="form-control" wire:model.defer="state.area" readonly></textarea>
                                        </div>

                                        <div class="col-md-12 mb-2">
                                            <div class="accordion" id="default-accordion-example">
                                                <div class="accordion-item material-shadow">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            Ver Mas
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-md-12 mb-2">
                                                                    <label><b>AMBIENTE</b></label>
                                                                    <select class="form-select" wire:model="state.ambiente_id">
                                                                        @if(!is_null($areas))
                                                                        @foreach($areas as $area)
                                                                            <option value="{{$area->id}}">{{$area->nombre}}</option>
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
                                                                <button type="button" class="btn waves-effect waves-light btn-info" wire:click="editar">
                                                                    <i class="fa fa-edit"></i> | EDITAR
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
        <button class="botonF2" @click="$dispatch('buscarnum')">
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

        <script>
            function iniciar(){
                var btn = $('#txtBtn').html();
                if (btn == "X") {
                    $('#txtBtn').html('<i class="mdi mdi-barcode-scan"></i>');
                    Quagga.stop();
                }else{
                    $('#txtBtn').html('X');
                    $('#form3').modal('show')
                    Quagga.init({
                        inputStream: {
                            constraints: {
                                width: 1920,
                                height: 1920,
                            },
                            name: "Live",
                            type: "LiveStream",
                            target: document.querySelector('#contenedor'), // Pasar el elemento del DOM
                        },
                        decoder: {
                            readers: ["code_128_reader"]
                        }
                    }, function (err) {
                        if (err) {
                            console.log(err);
                            return
                        }
                        console.log("Iniciado correctamente");
                        Quagga.start();
                    });
                }
            }
            function cerrar(){
                    $('#txtBtn').html('<i class="mdi mdi-barcode-scan"></i>');
                    $('#form3').modal('hide');
                    Quagga.stop();
            }

                const $resultados = document.querySelector("#resultado");
                
                

                Quagga.onDetected((data) => {
                    Quagga.stop();
                    window.location.href = "https://sir.diresacajamarca.gob.pe:8002/qr/equipo/" + data.codeResult.code;
                   // $('#resultado').val(data.codeResult.code);
                    // Imprimimos todo el data para que puedas depurar
                    console.log(data);
                });

                Quagga.onProcessed(function (result) {
                    var drawingCtx = Quagga.canvas.ctx.overlay,
                        drawingCanvas = Quagga.canvas.dom.overlay;

                    if (result) {
                        if (result.boxes) {
                            drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                            result.boxes.filter(function (box) {
                                return box !== result.box;
                            }).forEach(function (box) {
                                Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, { color: "green", lineWidth: 2 });
                            });
                        }

                        if (result.box) {
                            Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, { color: "#00F", lineWidth: 2 });
                        }

                        if (result.codeResult && result.codeResult.code) {
                            Quagga.ImageDebug.drawPath(result.line, { x: 'x', y: 'y' }, drawingCtx, { color: 'red', lineWidth: 3 });
                        }
                    }
                });
 
        </script>

</div>