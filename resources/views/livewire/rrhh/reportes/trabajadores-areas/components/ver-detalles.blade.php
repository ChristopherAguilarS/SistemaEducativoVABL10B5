<div>
    <div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Listado de Trabajadores</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <hr>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-2">
                                <input type="text" class="form-control" wire:model="area" disabled>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table class="table table-nowrap table-striped-columns mb-4">
                                @if(!is_null($trabajadores))
                                    @foreach($trabajadores as $trabajador)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$trabajador['nombres']}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="col-lg-12"><center><b>Sin Trabajadores</b></center></div>
                                @endif
                            </table>
                        </div>
                        
                    </div>
                </div>
                <hr>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
