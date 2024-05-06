<?php
namespace App\Livewire\Biblioteca\Fotochecks;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use \Mpdf\Mpdf as PDF; 
use Illuminate\Support\Facades\Storage;
class Filtro extends Component{
    public $f_tipo, $f_condicion, $f_area, $mes;
    public function verFotocheck(){
        $empresa = env('APP_EMPRESA');
        $documentFileName = "fun.pdf";
        $document = new PDF([
            'mode' => 'utf-8',
            'format' => [80, 100], // Ancho: 80mm, Altura: 100mm (ajusta según tus necesidades)
            'margin_header' => '0',
            'margin_top' => '0',
            'margin_left' => '0',
            'margin_right' => '0',
            'margin_bottom' => '0',
            'margin_footer' => '0',
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
                        <b style="text-align:center">FOTOCHECK</b>
                    </td>
                </tr>
            </table>';
        $document->WriteHTML($html1);
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }
    public function render(){
        return view('livewire.biblioteca.fotochecks.filtro');
    }
}