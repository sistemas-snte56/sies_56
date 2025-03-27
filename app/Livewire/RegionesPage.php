<?php

namespace App\Livewire;

use App\Models\Region;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;


use Livewire\WithPagination;
use Livewire\Attributes\Layout;
// use Livewire\Attributes\Title;

// #[Layout('adminlte::page')]
// #[Title('Regiones')]
class RegionesPage extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    // public $regiones = [];
    public $region, $regionId, $sede;

    public $totalRegions;
    
    #[Url]
    public $search;

    // public function mount()
    // {
    //     // $this->totalRegions = Region::paginate(8);
    //     $this->regiones = Region::paginate(8);
    // }


    public function render()
    {
        // info($this->search);

        return view('livewire.regiones-page', [
            'regiones' =>Region::where("region",  "like", "%$this->search%")
                                ->orWhere("sede", "like", "%$this->search%")
                                ->paginate(25)
        ]);
    }

    // Componente para guardar 
    public function submit()
    {
        // Validación de los input
        $this->validate([
            'region' => 'required',
            'sede' => 'required'
        ]);
 
        // Para el tiempo de visualización de wire:loading
        sleep(1);

        Region::create([
            'region' => strtoupper($this->region),
            'sede' => strtoupper($this->sede),
        ]);

        // Emitir el evento para cerrar el modal
        $this->dispatch('closeModal');


        $this->clear();
    }

    public function edit($id)
    {
        # Borramos los errores de la validación
        $this->resetErrorBag();

        $this->regionId = $id;
        $region = Region::find($id);
        $this->region = $region->region;
        $this->sede = $region->sede;
    }

    public function update()
    {

        $this->validate([
            'region' => 'required',
            'sede' => 'required'
        ]);

        Region::find($this->regionId)->update([
            'region' => strtoupper($this->region),
            'sede' => strtoupper($this->sede),
        ]);

        $this->clear();

        # Emitir el evento para cerrar el modal
        $this->dispatch('closeModal');
    }

    public function clear()
    {
        $this->reset(['regionId','region', 'sede']);
        $this->resetErrorBag();
        
    }


    public function regionDelete($regionId)
    {
        // info($regionId);
        $this->dispatch("confirm", id:$regionId);
    }

    #[On('delete')]
    public function delete($id)
    {
        $region = Region::findOrFail($id);

        // Eliminar la región
        $region->delete();
        // Refrescar la lista de regiones
        $this->totalRegions = Region::all();
    }

}
