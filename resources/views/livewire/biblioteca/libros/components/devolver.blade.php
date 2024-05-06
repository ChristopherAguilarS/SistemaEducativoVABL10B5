<div>
    <div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">¿Qué te ha parecido el título?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <hr>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xxl-12">
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label"><b>Tu Valoración:</b></label>
                                        <br>
                                        @foreach(range(1, 5) as $star)
                                            <span wire:click="setRating({{ $star }})" wire:key="{{ $loop->index }}" class="cursor-pointer">
                                                @if($rating >= $star)
                                                    <i class="mdi mdi-star text-warning" style="font-size:36px"></i>
                                                @else
                                                <i class="mdi mdi-star-outline" style="font-size:36px"></i>
                                                @endif
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label"><b>Tu Opinión:</b></label>
                                        <textarea class="form-control" wire:model="descripcion"></textarea>
                                        @error('descripcion')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><b>CANCELAR</b></button>
                    <button type="button" class="btn btn-warning " wire:click="guardar" wire:loading.attr="disabled">
                        <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="guardar" style="display:none"></span>
                        <b>GUARDAR VALORACIÓN</b>
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
    $('#basic-rater').on('click', function () {
        Livewire.emit('ratingChanged', $(this).data('rating'));
    });
});
    </script>
@endpush
</div>
