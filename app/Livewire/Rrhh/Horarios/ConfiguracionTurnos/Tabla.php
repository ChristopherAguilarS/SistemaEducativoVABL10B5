<?php

namespace App\Http\Livewire\Rrhh\Horarios\ConfiguracionTurnos;
use App\Models\Team;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Action;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

use App\Models\Rrhh\Turno;

class Tabla extends LivewireDatatable
{
    public $estado = 1;
    protected $listeners = ['renderizar' => 'refreshLivewireDatatable','rtabla' => 'rtabla'];
    //public $hideable = 'select';
    public $hideable = false;
    public $exportable = false;
    public $persistComplexQuery = true;
    public $afterTableSlot = 'components.selected';
   // public $vistaAccion = 'logistica.configuracion.catalogo-categorias.crud';


    public function builder(){
        if($this->estado){
            $almacen = Turno::query()
                ->where('estado', $this->estado);
        }else{
            $almacen = Persona::query();
        }
        return $almacen;
    }

    public function rtabla($est){
        $this->estado = $est;
        $this->refreshLivewireDatatable();
    }

    public function columns()
    {
        return [
            Column::name("descripcion")
                ->label('Nombre')
                ->searchable(),
            
            TimeColumn::name("horaInicio")
                ->label('Inicio')
                ->Width(20)
                ->searchable(),

            TimeColumn::name("horaFin")
                ->label('Fin')
                ->Width(20)
                ->searchable(),

            Column::callback(['estado'], function ($estado) {
                    return view('livewire.components.table.table-estados', ['estado' => $estado]);
                })->Width(160)
                ->label('Estado')
                ->unsortable()
                ->alignCenter(),
            Column::callback(['id'], function ($id) {
                    return view('livewire.rrhh.horarios.configuracion-turnos.components.table-acciones', ['id' => $id]);
                })->Width(160)
                ->label('Acciones')
                ->unsortable()
                ->alignCenter(),
        ];
    }
}
