<div wire:ignore.self id="form3" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog  modal-l">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Escanear QR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"  onclick="cerrar()" aria-label="Close"> </button>
            </div>
            <div class="modal-body"><hr style="width:100%; margin-top:-10px">
                <div div class="row">
                    <input type="text" id="resultado" class="form-control mb-4" readonly>
                    <div id="contenedor"></div>
                </div>
            </div>
            <div class="modal-footer"><br><hr style="width:100%; margin-top:-10px">
                <button type="button" class="btn btn-light material-shadow-none" onclick="cerrar()" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>