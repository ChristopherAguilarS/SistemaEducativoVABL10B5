<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                <th scope="col" style="width:5px">N°</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col" style="width:5px">Total</th>
                                <th scope="col" class="!text-center" style="width:5px">Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cuentas as $cuenta)
                                    <tr>                
                                        <td style="vertical-align:middle" class="font-medium">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td style="vertical-align:middle">
                                            {{ $cuenta->descripcion }}
                                        </td>
                                        <td style="text-align:center; vertical-align:middle">
                                            <b>{{ $cuenta->cant }}</b>
                                        </td>
                                        <td class="text-center">
                                        <button type="button" class="btn btn-info btn-animation waves-effect waves-light" wire:click="$dispatch('nuevo', [{{$cuenta->id}}])" data-text="Ver"><span>Ver</span></button>
                                           <!-- <button type="button" class="btn btn-info btn-animation waves-effect waves-light" data-text="Info"><span>Ver</span></button> -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
</div>
