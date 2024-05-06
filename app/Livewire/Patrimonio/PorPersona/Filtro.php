<?php
namespace App\Livewire\Patrimonio\PorPersona;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Rrhh\Trabajadores\TrabajadoresExport;
use Illuminate\Support\Facades\Storage;
use App\Models\RecursosHumanos\VinculoLaboral;
use App\Models\Patrimonio\ComisionInventariado;
use App\Models\Patrimonio\EquipoInventario;
use DB;
use \Mpdf\Mpdf as PDF; 

class Filtro extends Component{
    public $f_tipo, $f_condicion, $f_area, $mes;
    public function mount(){
       // $this->anio = date('Y');
    }
    public function verInventariado(){
        $empresa = env('APP_EMPRESA');
        $trabajador = VinculoLaboral::leftjoin('rrhh_catalogo_cargos as c', 'rrhh_vinculo_laboral.catalogo_cargo_id', '=', 'c.id')
            ->join('rrhh_personas as p', 'rrhh_vinculo_laboral.persona_id', '=', 'p.id')
            ->select('p.numeroDocumento as Numero', 'p.id', 'c.descripcion', DB::raw("CONCAT(p.apellidoPaterno, ' ',p.apellidoMaterno, ', ',p.nombres) AS nombres"),'rrhh_vinculo_laboral.catalogo_tipo_trabajador_id')
            ->where('p.id', request()->persona)->first();

        $comisiones = ComisionInventariado::select('personaDni', 'personaNombres', 'tipo')
            ->where('anio', request()->anio)->get();

        $equipos = EquipoInventario::join('log_equipos as e', 'e.id', 'log_equipos_inventariados.equipo_id')
            ->select('e.id', 'DESCRIPCION', 'CODIGO_ACTIVO', 'MARCA', 'MODELO', 'NRO_SERIE', 'COLOR', 'ESTADO_CONSERV', 'OBSERVACIONES')
        ->where('log_equipos_inventariados.persona_id', request()->persona)
        ->where('log_equipos_inventariados.anio', request()->anio)->WHERE('log_equipos_inventariados.estado', 1)->get();
        $b = 1;
        $arr2 = '';
        foreach ($comisiones as $comision) {
            $tp = '';
            if ($comision->tipo ==1) {
                $tp = 'PRESIDENTE';
            }elseif ($comision->tipo ==2) {
                $tp = 'MIEMBRO';
            }else{
                $tp = 'INVENTARIADOR';
            }
            $arr2.= '<br>'.$tp.' - '.$comision->personaNombres.'<br>';
        }
        $documentFileName = "fun.pdf";
        $document = new PDF( [
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'margin_header' => '3',
            'margin_top' => '4',
            'margin_left' => '4',
            'margin_right' => '4',
            'margin_bottom' => '4',
            'margin_footer' => '8',
        ]);
        $document->setFooter('página: {PAGENO} de {nbpg}');
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$documentFileName.'"'
        ];

        $html1='
            <table style="width:100%;  border-spacing: 0px; border-collapse: separate; padding: 15px; font-size:14px; " cellpadding="5">
                <tr>
                    <td colspan="2" style="text-align:center">
                        <b style="text-align:center">FORMATO DE FICHA DE LEVANTAMIENTO DE INFORMACIÓN <br> INVENTARIO PATRIMONIAL '.request()->anio.'</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>'.$empresa.'</b>
                        <br><br>
                        <u><b>USUARIO</b></u>
                        <br>
                        '.$trabajador->Numero.' - '.$trabajador->nombres.'
                        <br><br>
                        <b>UBICACION:</b>___________________ <b>DEPENDENCIA:</b>___________________
                    </td>
                    <td>
                        '.date('d/m/Y').' <br><br>
                        <u><b>PERSONAL INVENTARIADOR</b></u>
                        '.$arr2.'
                    </td>
                </tr>
            </table>';
        $document->WriteHTML($html1);
        
        $document->WriteHTML('<table style="width:100%; border:1px solid; border-spacing: 0px; border-collapse: separate;font-size:9px;">');
        $document->WriteHTML('<tr>
                      <td style="width:30px;border:1px solid; text-align:center;background-color:#ededd5">
                          <b>N° ORDEN</b>
                      </td>
                      <td style="border:1px solid; text-align:center; background-color:#ededd5">
                          <b>CÓDIGO <br> PATRIMONIAL</b>
                      </td>
                      <td style="border:1px solid; text-align:center; background-color:#ededd5">
                          <b>CÓDIGO <br> BARRAS</b>
                      </td>
                      <td style="border:1px solid; text-align:center; background-color:#ededd5">
                          <b>DENOMINACIÓN</b>
                      </td>
                      <td style="border:1px solid; text-align:center; background-color:#ededd5">
                          <b>MARCA</b>
                      </td>
                      <td style="border:1px solid; text-align:center; background-color:#ededd5">
                          <b>MODELO</b>
                      </td>
                      <td style="border:1px solid; text-align:center; background-color:#ededd5">
                          <b>TIPO</b>
                      </td>
                      <td style="border:1px solid; text-align:center; background-color:#ededd5">
                          <b>COLOR</b>
                      </td>
                      <td style="border:1px solid; text-align:center; background-color:#ededd5">
                          <b>SERIE</b>
                      </td>
                      <td style="border:1px solid; text-align:center; background-color:#ededd5">
                          <b>OTROS</b>
                      </td>
                      <td style="border:1px solid; text-align:center; background-color:#ededd5">
                          <b>SITUACIÓN</b>
                      </td>
                      <td style="border:1px solid; text-align:center; background-color:#ededd5">
                          <b>ESTADO DE <br> CONSERVACIÓN</b>
                      </td>
                      <td style="border:1px solid; text-align:center; background-color:#ededd5">
                          <b>OBSERVACIÓN</b>
                      </td>
                  </tr>');
        foreach ($equipos as $lista) {
            $est = '';
            if($lista->ESTADO_CONSERV==1){
                $est = 'Bueno';
            }elseif($lista->ESTADO_CONSERV==2){
                $est = 'Regular';
            }elseif($lista->ESTADO_CONSERV==3){
                $est = 'Malo';
            }elseif($lista->ESTADO_CONSERV==4){
                $est = 'Muy Malo';
            }elseif($lista->ESTADO_CONSERV==5){
                $est = 'Nuevo';
            }elseif($lista->ESTADO_CONSERV==6){
                $est = 'Chatarra';
            }elseif($lista->ESTADO_CONSERV==7){
                $est = 'RAEE';
            }
            $document->WriteHTML('
                <tr>
                    <td style="border:1px solid; text-align:center; font-size:10px">'.$b.'</td>
                    <td style="border:1px solid; text-align:center; font-size:10px">'.$lista->CODIGO_ACTIVO.'</td>
                    <td style="border:1px solid; text-align:center; font-size:10px">'.$lista->id.'</td>
                    <td style="border:1px solid; text-align:justify; font-size:10px">'.$lista->DESCRIPCION.'</td>
                    <td style="border:1px solid; text-align:justify; font-size:10px">'.$lista->MARCA.'</td>
                    <td style="border:1px solid; text-align:justify; font-size:10px">'.$lista->MODELO.'</td>
                    <td style="border:1px solid; text-align:justify; font-size:10px"></td>
                    <td style="border:1px solid; text-align:justify; font-size:10px">'.$lista->COLOR.'</td>
                    <td style="border:1px solid; text-align:justify; font-size:10px">'.$lista->NRO_SERIE.'</td>
                    <td style="border:1px solid; text-align:justify; font-size:10px"></td>
                    <td style="border:1px solid; text-align:justify; font-size:10px"></td>
                    <td style="border:1px solid; text-align:justify; font-size:10px">'.$est.'</td>
                    <td style="border:1px solid; text-align:justify; font-size:10px">'.$lista->OBSERVACIONES.'</td>
                </tr>');
            $b++;
        }
        $document->WriteHTML('</table>');
            ;
       $html5 = '<font style="font-size:09px"><br>
       (1) Uso (U), Desuso (D) <br> (2) El estado es consignado en base a la siguiente escala: Bueno, Regular, Malo, Chatarra y RAEE. En caso de semovientes, utilizar escala deacuerdo a su naturaleza.<br><br><u><b>CONSIDERACIONES:<ul style="font-size:12px"><li> El usuario declara haber mostrado todos los bienes muebles que se encuentran bajo su responsabilidad y no contar con más bienes muebles materia de inventario.</li><li> El usuario es responsable de la permanencia y conservación de cada uno de los bienes muebles descritos, recomendandose tomar precauciones del caso para evitar sustraccione, deterioros, etc. </li><li> Cualquier necesidad de traslado del bien mueble dentro o fuera del local de la Entidad u Organización de la Entidad, es previamente comunicado al encargado de la OCP. </li></ul></b></u></font>
       <table style="width:100%">
            <tr>
            <td style="text-align:center"><br><br><br><br>
                _____________________________ <br> Usuario
            </td>
            <td style="text-align:center"><br><br><br><br><br>
                _____________________________ <br> Personal Inventariador
            </td>
            </tr>
            </table>';
        
        
        $document->WriteHTML($html5);
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }
    public function updTable(){
        $this->dispatch('updTable', $this->f_tipo, $this->f_condicion, $this->f_area);
    }
    public function agregar(){
        $this->dispatch('agregar');
    }
    public function descargar(){
        return Excel::download(new TrabajadoresExport(), 'Trabajadores al '.date('d-m-Y').'.xlsx');
    }
    public function render(){
        return view('livewire.patrimonio.por-persona.filtro');
    }
}