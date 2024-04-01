<?php
    namespace App\Exports\Rrhh\Personas;
    use Illuminate\Contracts\View\View;
    use Maatwebsite\Excel\Concerns\ShouldAutoSize;
    use Maatwebsite\Excel\Concerns\FromView;
    use App\Models\RecursosHumanos\Persona;
    USE DB;
    class PersonasExport implements FromView, ShouldAutoSize
    {
        public $inicio, $fin, $lugar, $almacen = 0;
        public function  __construct(){
            
        }

        public function view(): View {
            $data = Persona::query();

            return view('livewire.rrhh.personal.components.exportar-personas', ['posts' => $data->get()]);
        }
    }