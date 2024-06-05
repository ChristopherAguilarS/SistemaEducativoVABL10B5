<?php
namespace App\Livewire\Biblioteca\Fotochecks;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Biblioteca\Carne;
use \Mpdf\Mpdf as PDF; 
use Illuminate\Support\Facades\Storage;
class Filtro extends Component{
    public $f_tipo, $f_condicion, $f_area, $mes;
    public function verFotocheck(Request $request){
        $carnet = Carne::find($request->id);
        $documentFileName = "fun.pdf";
        $document = new PDF([ 
            'mode' => 'utf-8',
            'format' => [86, 112], // Ancho: 80mm, Altura: 100mm (ajusta según tus necesidades)
            'margin_header' => '0',
            'margin_top' => '0',
            'margin_left' => '0',
            'margin_right' => '0',
            'margin_bottom' => '0',
            'margin_footer' => '0',
        ]);
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$documentFileName.'"'
        ];

        $fontStyle = '
            <style>
                body {
                    font-family: Arial, sans-serif; /* Cambia "Arial" al tipo de letra que desees */
                }
            </style>';
        $document->WriteHTML($fontStyle);
        $html1='
            <div style="border: 1px solid black; margin-left:2px; margin-right:2px; margin-top:2px; height: 5.4cm;overflow: hidden; border-radius: 10px;">
                <table style="width:100%;  border-spacing: 0px; border-collapse: separate; padding: 10px; font-size:14px; ">
                    <tr>
                        <td style="text-align:center">
                            X
                        </td>
                        <td style="text-align:center; font-size:8px">
                            X
                        </td>
                        <td style="text-align:center">
                            X
                        </td>
                    </tr>
                </table>
                <table style="width:100%;font-size:14px; margin-top: -10px">
                    <tr>
                        <td style="text-align:center;">
                            <font style="font-size:10px">Escuela de Educacion Superior Pedagogico Publico</font><br>
                            <b style="font-size:10px">"VÍCTOR ANDRÉS BELAUNDE"</b><br><font style="font-size:8px">Jaen</font><br><b style="font-size:14px">CARNET DE BIBLIOTECA</b>
                        </td>
                    </tr>
                </table>
                <table style="width:100%;  border-spacing: 0px; border-collapse: separate; padding: 15px; font-size:14px;">
                    <tr>
                        <td style="width:102px">
                                
                        </td>
                        <td style="text-align:right; font-size:8px">
                            <b>
                                '.$carnet->nombres.' <br>DNI '.$carnet->documento.'
                            </b>  <br><font style="font-size:8px" >'.$carnet->etiqueta.'</font>
                            
                        </td>
                        <td style="width:80px">
                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" style="font-size:10px"><br><br>
                            Periodo de Vigencia: '.$carnet->periodo.'-'.($carnet->periodo+4).'
                        </td>
                        <td style="font-size:10px; text-align:center"><br><br>
                            '.str_pad($carnet->id, 6, "0", STR_PAD_LEFT).'
                        </td>
                    </tr>
                </table>
            </div>
            ';
        $html2='
            <div style="border: 1px solid black; margin-left:2px; margin-right:2px; margin-top:4px; height: 5.4cm;overflow: hidden; border-radius: 10px; font-size:10px; text-align:center">
            <br><br><br><br><br><br><br><br><br><b>ESCUELA LICENCIADA</b><br>RM 316-2020-MINEDU<br>RM 644-2023-MINEDU
            </div>
            ';
            $document->WriteHTML($html1);
            $document->WriteHTML($html2);
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }
    public function render(){
        return view('livewire.biblioteca.fotochecks.filtro');
    }
}