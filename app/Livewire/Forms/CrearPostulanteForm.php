<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearPostulanteForm extends Form
{
    #[Rule('required')]
    public $nombres = null;
    #[Rule('required')]
    public $ape_pat = null;
    #[Rule('required')]
    public $ape_mat = null;
    public $tipo_documento  = null;
    public $nro_documento  = null;
    public $sexo  = null;    
    public $telefono  = null;
    public $correo_electronico  = null;
    public $nombre_institucion_formadora  = null;
    public $pais_id_formadora  = null;
    public $departamento_id_formadora  = null;
    public $provincia_id_formadora  = null;
    public $distrito_id_formadora  = null;
    public $tipo_funcion  = null;
    public $año_egreso  = null;
    public $carrera_profesional_id  = null;
    public $ejerce_docencia  = null;
    public $modalidad_nivel  = null;
    public $nombre_institucion_trabaja  = null;
    public $pais_id_trabajo  = null;
    public $departamento_id_trabajo  = null;
    public $provincia_id_trabajo  = null;
    public $distrito_id_trabajo  = null;
    public $nombrado  = null;
    public $escala_magisterial  = null;
    public $otro_trabajo  = null;
    public $certificado_estudios  = null;
    public $ruta_certificado_estudios  = null;
    public $copia_titulo  = null;
    public $ruta_copia_titulo  = null;
    public $copia_dni  = null;
    public $ruta_copia_dni  = null;
    public $declaracion_jurada  = null;
    public $ruta_declaracion_jurada  = null;
    public $tipo_comprobante_pago  = null;
    public $nro_comprobante_pago  = null;
    public $fecha_emision_comprobante_pago  = null;
    public $monto_comprobante_pago  = null;
    public $ruta_comprobante_pago  = null;
    #[Rule('required')]
    public $programa_estudio_id  = null;
    public $estado  = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
