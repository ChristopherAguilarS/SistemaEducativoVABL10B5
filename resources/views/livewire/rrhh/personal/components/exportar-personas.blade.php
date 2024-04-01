<div>
    <table>
        <thead>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="font-size: 10px; border: 1px solid black; text-align: right;background-color: #0376b3; color: white">
                    <b>Usuario</b>
                </td>
                <td colspan="3" style="border: 1px solid black; text-align: left">
                    {{auth()->user()->name}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="font-size: 10px; border: 1px solid black; text-align: right;background-color: #0376b3; color: white">
                    <b>Fecha</b>
                </td>
                <td colspan="3" style="border: 1px solid black; text-align: left">
                    {{date('d/m/Y h:i a')}}
                </td>
            </tr>
        </thead>
    </table>
    <table>
        <thead>
            <tr>
                <td style="text-align: center;background-color: #0376b3;color: white; font-size:20px" height="70" colspan="10">
                    <br><b>REPORTE DE PERSONAS</b><br>
                </td>
            </tr>
            <tr>
                <th
                    style="width: 60px; background-color: #fdda4b"
                    class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                >
                    <b>#</b>
                </th>
                <th
                    style="width: 100px; background-color: #fdda4b"
                    class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                >
                    <b>Nro. Documento</b>
                </th>
                <th
                    style="width: 400px; background-color: #fdda4b"
                    class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                >
                    <b>Apellidos y Nombres</b>
                </th>
                <th
                    style="width: 100px; background-color: #fdda4b"
                    class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                >
                    <b>Genero</b>
                </th>
                <th
                    style="width: 200px; background-color: #fdda4b"
                    class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                >
                    <b>Estado Civil</b>
                </th>
                <th
                    style="width: 200px; background-color: #fdda4b"
                    class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                >
                    <b>Fecha Nacimiento</b>
                </th>
                <th
                    style="width: 140px; background-color: #fdda4b"
                    class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                >
                    <b>Telefono(s)</b>
                </th>
                <th
                    style="width: 160px; background-color: #fdda4b"
                    class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                >
                    <b>Lugar Nacimiento</b>
                </th>
                <th
                    style="width: 200px; background-color: #fdda4b"
                    class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                >
                    <b>Correo</b>
                </th>
                <th
                    style="width: 400px; background-color: #fdda4b"
                    class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                >
                    <b>Direccion</b>
                </th>
            </tr>
        </thead>
        <tbody>
            @if(!is_null($posts))
                @foreach ($posts as $data)
                    <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">
                            {{$loop->iteration}}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            {{$data->numeroDocumento}}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            {{$data->apellidoPaterno.' '.$data->apellidoMaterno.' '.$data->nombres}}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            @if($data->sexo == 1)
                                Masculino
                            @elseif($data->sexo == 2)
                                Femenino
                            @else
                                N\E
                            @endif                        
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            @if($data->estadoCivil == 1)
                                Soltero
                            @elseif($data->estadoCivil == 2)
                                Casado
                            @else
                                N\E
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            {{date('d/m/Y', strtotime($data->fechaNacimiento))}}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            {{$data->telefonos}}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            {{$data->lugar_nacimiento}}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            {{$data->email}}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            {{$data->direccion}}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
