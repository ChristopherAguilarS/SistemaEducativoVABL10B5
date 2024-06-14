<?php

namespace App\Livewire\Academico\PostulanteFC;

use App\Livewire\Forms\CrearPostulanteForm;
use App\Models\AñoAcademico;
use App\Models\Postulante;
use App\Models\ProgramaEstudio;
use App\Models\TipoPostulante;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $mensaje;
    public $postulanteId;
    public $postulanteT;
    public $titulo;
    public $tipo_postulantes;
    public $año_academicos;
    public $postulante_id;
    public $año_academico_id;
    public CrearPostulanteForm $form;
    public $programas_estudio;

    public function mount(){
        $this->programas_estudio = ProgramaEstudio::where('estado',1)->get();
    }

    #[On('agregar')]
    public function agregar(){
        $this->postulanteId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nueva Postulante';
        $this->dispatch('anularSeleccion');
        $this->dispatch('anularSeleccionAño');
    }

    public function editar($id){
        $Postulante = Postulante::find($id);
        $this->titulo = 'Editar Postulante - '.optional($Postulante)->descripcion;
        $this->postulanteId = $id; 
        $this->form->nombres = $Postulante->nombres;
        $this->form->ape_pat = $Postulante->ape_pat;
        $this->form->ape_mat = $Postulante->ape_mat;
        $this->form->tipo_documento = $Postulante->tipo_documento;
        $this->form->nro_documento = $Postulante->nro_documento;
        $this->form->sexo = $Postulante->sexo;
        $this->form->telefono = $Postulante->telefono;
        $this->form->correo_electronico = $Postulante->correo_electronico;
        $this->form->nombre_institucion_formadora = $Postulante->nombre_institucion_formadora;
        $this->form->pais_id_formadora = $Postulante->pais_id_formadora;
        $this->form->departamento_id_formadora = $Postulante->departamento_id_formadora;        
        $this->form->provincia_id_formadora = $Postulante->provincia_id_formadora;
        $this->form->distrito_id_formadora = $Postulante->distrito_id_formadora;
        $this->form->tipo_funcion = $Postulante->tipo_funcion;
        $this->form->año_egreso = $Postulante->año_egreso;
        $this->form->carrera_profesional_id = $Postulante->carrera_profesional_id;
        $this->form->ejerce_docencia = $Postulante->ejerce_docencia;
        $this->form->modalidad_nivel = $Postulante->modalidad_nivel;
        $this->form->nombre_institucion_trabaja = $Postulante->nombre_institucion_trabaja;
        $this->form->pais_id_trabajo = $Postulante->pais_id_trabajo;
        $this->form->departamento_id_trabajo = $Postulante->departamento_id_trabajo;
        $this->form->provincia_id_trabajo = $Postulante->provincia_id_trabajo;
        $this->form->distrito_id_trabajo = $Postulante->distrito_id_trabajo;
        $this->form->nombrado = $Postulante->nombrado;
        $this->form->escala_magisterial = $Postulante->escala_magisterial;
        $this->form->otro_trabajo = $Postulante->otro_trabajo;
        $this->form->certificado_estudios = $Postulante->certificado_estudios;
        $this->form->ruta_certificado_estudios = $Postulante->ruta_certificado_estudios;
        $this->form->copia_titulo = $Postulante->copia_titulo;
        $this->form->ruta_copia_titulo = $Postulante->ruta_copia_titulo;
        $this->form->copia_dni = $Postulante->copia_dni;
        $this->form->ruta_copia_dni = $Postulante->ruta_copia_dni;
        $this->form->declaracion_jurada = $Postulante->declaracion_jurada;
        $this->form->ruta_declaracion_jurada = $Postulante->ruta_declaracion_jurada;
        $this->form->tipo_comprobante_pago = $Postulante->tipo_comprobante_pago;
        $this->form->nro_comprobante_pago = $Postulante->nro_comprobante_pago;
        $this->form->fecha_emision_comprobante_pago = $Postulante->fecha_emision_comprobante_pago;
        $this->form->ruta_comprobante_pago = $Postulante->ruta_comprobante_pago;
        $this->form->programa_estudio_id = $Postulante->programa_estudio_id;
        $this->form->estado = $Postulante->estado;
        
    }

    public function cambiarEstado($id){
        $Postulante = Postulante::find($id);
        $Postulante->estado = !$Postulante->estado;
        $Postulante->save();
        $this->mensajedeExitoCambioEstado();
    }

    public function limpiarCampos(){
        $this->form->limpiarCampos();
    }

    #[Js] 
    public function cerrarModal()
    {
       
        $this->js(<<<'JS'
            $('#myModal').modal('hide')
        JS);
    }

    #[Js] 
    public function mensajedeExitoCambioEstado()
    {
        $this->js(<<<'JS'
            Toastify({
                avatar: "",
                text: "Cambio de estado exitosamente",
                className: "info"
            }).showToast();
        JS);
    }

    #[Js] 
    public function mensajedeExito()
    {
        if($this->postulanteId == null){
            $this->mensaje = "Postulante registrado exitosamente";
        }
        else{
            $this->mensaje = "Postulante actualizado exitosamente";
        }
        $this->js(<<<'JS'
            Toastify({
                text: $wire.mensaje,
                className: "info"
            }).showToast();
        JS);
    }

    #[Js] 
    public function mensajedeError()
    {
        $this->js(<<<'JS'
            Toastify({
                text: "No se pudo registrar el Postulante",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }



    public function guardar(){
        $this->form->validate();
        try {
            $tipo = Postulante::updateOrCreate(
                [
                    'id'=>$this->postulanteId,
                ],
                [
                    'nombres' => $this->form->nombres,
                    'ape_pat' => $this->form->ape_pat,
                    'ape_mat' => $this->form->ape_mat,
                    'tipo_documento' => $this->form->tipo_documento,
                    'nro_documento' => $this->form->nro_documento,
                    'sexo' => $this->form->sexo,
                    'telefono' => $this->form->telefono,
                    'correo_electronico' => $this->form->correo_electronico,
                    'nombre_institucion_formadora' => $this->form->nombre_institucion_formadora,
                    'pais_id_formadora' => $this->form->pais_id_formadora,
                    'departamento_id_formadora' => $this->form->departamento_id_formadora,
                    'provincia_id_formadora' => $this->form->provincia_id_formadora,
                    'distrito_id_formadora' => $this->form->distrito_id_formadora,
                    'tipo_funcion' => $this->form->tipo_funcion,
                    'año_egreso' => $this->form->año_egreso,
                    'carrera_profesional_id' => $this->form->carrera_profesional_id,
                    'ejerce_docencia' => $this->form->ejerce_docencia,
                    'modalidad_nivel' => $this->form->modalidad_nivel,
                    'nombre_institucion_trabaja' => $this->form->nombre_institucion_trabaja,
                    'pais_id_trabajo' => $this->form->pais_id_trabajo,
                    'departamento_id_trabajo' => $this->form->departamento_id_trabajo,
                    'provincia_id_trabajo' => $this->form->provincia_id_trabajo,
                    'distrito_id_trabajo' => $this->form->distrito_id_trabajo,
                    'nombrado' => $this->form->nombrado,
                    'escala_magisterial' => $this->form->escala_magisterial,
                    'otro_trabajo' => $this->form->distrito_id_trabajo,
                    'certificado_estudios' => $this->form->certificado_estudios,
                    'ruta_certificado_estudios' => $this->form->ruta_certificado_estudios,
                    'copia_titulo' => $this->form->copia_titulo,
                    'copia_dni' => $this->form->copia_dni,
                    'ruta_copia_dni' => $this->form->ruta_copia_dni,
                    'ruta_declaracion_jurada' => $this->form->declaracion_jurada,
                    'tipo_comprobante_pago' => $this->form->tipo_comprobante_pago,
                    'nro_comprobante_pago' => $this->form->nro_comprobante_pago,
                    'fecha_emision_comprobante_pago' => $this->form->fecha_emision_comprobante_pago,
                    'ruta_comprobante_pago' => $this->form->ruta_comprobante_pago,
                    'programa_estudio_id' => $this->form->programa_estudio_id,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            $this->mensajedeExito();  
            $this->limpiarCampos();  
            $this->cerrarModal();
        } catch (\Exception $e) {
            dd($e);
           $this->mensajedeError();
        }
        
    }

    public function render()
    {
        $postulantes = Postulante::paginate(10);
        return view('livewire.academico.postulante-fc.table',['postulantes'=>$postulantes]);
    }
}
