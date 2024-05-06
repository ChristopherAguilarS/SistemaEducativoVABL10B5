
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">Nro.</th>
                                    <th style="width: 10px;">Codigo</th>
                                    <th>Denominación</th>
                                    <th style="width: 10px;">Acc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->grupo.$data->clase.$data->familia}}</td>
                                        <td>{{$data->denominacion}}</td>
                                        <td>
                                            <button type="button" wire:click="$dispatch('ver', [{{$data->id}}, '{{$data->denominacion}}'])" class="btn btn-danger w-sm waves-effect waves-light">Ver</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $posts->links() }}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
