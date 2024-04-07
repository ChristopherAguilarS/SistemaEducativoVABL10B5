<?php

namespace App\Livewire\FinancieroContable\Compras\Compras\Components;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\FinancieroContable\CompraDetalleTemp;
use DB;
class VerRecurso extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $state = ['partida_id' =>0, 'com_igv' => 1], $showModal = false, $idR, $nombre, $cantidad, $pedido, $medida, $ver, $idSel;
    public $edita = 0;
    #[On('verRecurso')]
    public function ver($arr, $tp = 0){
        $this->ver = $tp;
        $this->idSel = $arr['id'];
        if(!$arr['porcentaje_igv']){
            $arr['porcentaje_igv'] = 18;
        }
        $this->state = $arr;
        if($arr['mod_cant']){
            $this->state['cant'] = $arr['mod_cant'];
            $this->cantidad = $arr['mod_cant'];
        }else{
            $this->cantidad = $this->state['cant'];
        }
        $this->nombre = $arr['nom'];
        $this->medida = $arr['medida'];
        $this->dispatch('verModal', ['id' => 'form3', 'accion' => 'show']);
    }
    public function guardar(){
        $igv = '1.'.$this->state['porcentaje_igv'];
        if(!$this->state['com_sin_igv']){$this->state['com_sin_igv'] = 0;}
        if(!$this->state['com_con_igv']){$this->state['com_con_igv'] = 0;}
        if(!$this->state['com_par_sin_igv']){$this->state['com_par_sin_igv'] = 0;}
        if(!$this->state['com_par_con_igv']){$this->state['com_par_con_igv'] = 0;}

        if(!$this->state['com_sin_igv'] && !$this->state['com_con_igv'] && !$this->state['com_par_con_igv'] && !$this->state['com_par_sin_igv']){
            $this->dispatch('alert_danger', ['mensaje' => 'No se puede guardar en blanco']);
        }else{
            $precio = 0;
            $com_con_igv = 0;
            $com_par_con_igv = 0;
            $com_par_sin_igv = 0;

            if($this->state['com_sin_igv']){
                $precio = $this->state['com_sin_igv'];
                if(!$this->state['com_con_igv']){
                    if($this->state['com_igv']){
                       $com_con_igv = number_format($this->state['com_sin_igv']*$igv, 4, '.', '');
                    }else{
                       $com_con_igv = number_format($this->state['com_sin_igv']*$igv, 4, '.', '');
                    }
                }
                if(!$this->state['com_par_sin_igv']){
                    $com_par_sin_igv = number_format($precio*$this->cantidad, 4, '.', '');
                }
                if(!$this->state['com_par_con_igv']){
                    $com_con_igv = str_replace(',','', $com_con_igv);
                    $com_par_con_igv = number_format($com_con_igv*$this->cantidad, 4, '.', '');
                }
            }
            if($this->state['com_con_igv']){
                $com_con_igv =$this->state['com_con_igv'];
                if(!$this->state['com_sin_igv']){
                    if($this->state['com_igv']){
                        $precio = number_format($this->state['com_con_igv']/$igv, 4, '.', '');
                    }else{
                        $precio = number_format($this->state['com_con_igv']/$igv, 4, '.', '');
                    }
                }
                if(!$this->state['com_par_sin_igv']){
                    $com_par_sin_igv = number_format($precio*$this->cantidad, 4, '.', '');
                }
                if(!$this->state['com_par_con_igv']){
                    $com_par_con_igv = number_format($com_con_igv*$this->cantidad, 4, '.', '');
                }
            }
            if($this->state['com_par_sin_igv']){
                $com_par_sin_igv = $this->state['com_par_sin_igv'];
                if(!$this->state['com_sin_igv']){
                    $precio = number_format($this->state['com_par_sin_igv']/$this->cantidad, 4, '.', '');
                }
                if(!$this->state['com_con_igv']){
                    $com_con_igv = number_format(($this->state['com_par_sin_igv']*$igv)/$this->cantidad, 4, '.', '');
                }
                if(!$this->state['com_par_con_igv']){
                    $com_par_con_igv = number_format($precio * $this->cantidad * $igv, 4, '.', '');
                }
            }
            if($this->state['com_par_con_igv']){
                $com_par_con_igv = $this->state['com_par_con_igv'];
                if(!$this->state['com_sin_igv']){
                    $precio = number_format(($this->state['com_par_con_igv']/$igv)/$this->cantidad, 4, '.', '');
                }
                if(!$this->state['com_con_igv']){
                    $com_con_igv = number_format($this->state['com_par_con_igv']/$this->cantidad, 4, '.', '');
                }
                if(!$this->state['com_par_sin_igv']){
                    $com_par_sin_igv =  number_format($this->state['com_par_con_igv'] / $igv, 4, '.', '');
                }
            }
            
            $this->state['com_sin_igv'] = str_replace(',', '', $precio);
            $this->state['com_con_igv'] = str_replace(',', '', $com_con_igv);
            $this->state['com_par_con_igv'] = str_replace(',', '', $com_par_con_igv);
            $this->state['com_par_sin_igv'] = str_replace(',', '', $com_par_sin_igv);
            try{
                DB::beginTransaction();
                    if($this->ver == 1){
                        $sav = CompraDetalleTemp::where('id', $this->idSel)->update([
                            'com_igv'=> $this->state['com_igv'],
                            'com_sin_igv'=> $this->state['com_sin_igv'],
                            'com_con_igv'=> $this->state['com_con_igv'],
                            'com_par_con_igv'=> $this->state['com_par_con_igv'],
                            'com_par_sin_igv'=> $this->state['com_par_sin_igv'],
                            'porcentaje_igv'=> $this->state['porcentaje_igv']
                        ]);
                        $this->dispatch('rTab');
                    }else{
                        $this->dispatch('savItem', $this->state);
                    }
                DB::commit();
                $this->dispatch('alert_info', ['mensaje' => 'Recurso editado correctamente.']);
                $this->dispatch('verModal', ['id' => 'form3', 'accion' => 'hide']);
            }catch(\Exception $e){
                DB::rollback();
                dd($e);
                $this->dispatch('alert_danger', ['mensaje' => 'Ocurrio un error inesperado.']);
            }
        }
    }
    public function render(){
            return view('livewire.financiero-contable.compras.compras.components.ver-recurso');       
    }
}
