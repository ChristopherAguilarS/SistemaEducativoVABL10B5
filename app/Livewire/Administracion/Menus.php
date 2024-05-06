<?php

namespace App\Livewire\Administracion;

use App\Models\Cuenta;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Administracion\Menus as vMenus;
class Menus extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $menus = [], $modulo, $url, $prefix;
    public function mount(){
        $url = explode('/', trim($_SERVER["REQUEST_URI"])); 
        //dd($url);
        $modulo = $url[1];
        $menu1 = $url[2];
        if(isset($url[3])){
            $this->prefix = $modulo.'/'.$url[2];
        }else{
            $this->prefix = $modulo;
        }
        $this->url = $modulo;
        if($modulo == 'qr'){

        }else{
            $this->modulo = vMenus::where('raiz', $modulo)->where('tipo', 1)->first()->nombre;
        }
        
        $menus = vMenus::where('raiz', $modulo)->where('tipo', 2)->where('estado', 1)->orderby('pos', 'asc')->get();
        $sub_menus = vMenus::where('raiz', $modulo)->where('tipo', 3)->where('estado', 1)->orderby('pos', 'asc')->get();
        foreach ($menus as $menu) {
            $this->menus[$menu->id] = ['nombre' => $menu->nombre, 'icon' => $menu->icon, 'vista' => $menu->vista];
            $c = 0;
            foreach ($sub_menus->where('icon', $menu->id) as $sub_menu) {
                $this->menus[$menu->id]['detalle'][] = ['nombre' => $sub_menu->nombre, 'vista' => $sub_menu->vista];
                $c++;
            }
            if($c){
                $this->menus[$menu->id]['tipo'] = 1;
            }else{
                $this->menus[$menu->id]['tipo'] = 0;
            }
        }
    }
    public function render(){
        return view('livewire.administracion.menus');
    }
}
