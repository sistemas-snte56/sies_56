<?php

namespace App\Livewire;

use App\Models\Region;
use Livewire\Component;

class RegionForm extends Component
{
    public $mensaje = 'Hola Mundo';

    public $regiones = [];

    public function mount()
    {
        $this->regiones = Region::all();
    }
    public function render()
    {
        return view('livewire.region-form');
    }

    public function CambiarMensaje()
    {
        $this->mensaje = 'Mensaje Cambiado';
    }
}
