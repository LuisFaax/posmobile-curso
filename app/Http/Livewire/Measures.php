<?php

namespace App\Http\Livewire;

use App\Models\Measure;
use Livewire\WithPagination;

use Livewire\Component;

class Measures extends Component
{
    use WithPagination;
    public $name = '', $selected_id = 0, $action = 'Gestionar Unidades', $componentName = 'Unidades de Medida', $search = '';
    private $pagination = 5;

    public function mount()
    {
        $this->resetUI();
    }

    public function paginationView()
    {
        return 'vendor.livewire.tailwind';
    }


    public function render()
    {

        if (strlen($this->search) > 0)
            $info = Measure::where('name', 'like', "%{ $this->search }%")->orderBy('name', 'asc')->paginate($this->pagination);
        else
            $info = Measure::orderBy('name', 'asc')->paginate($this->pagination);

        return view('livewire.measures.component', [
            'data' => $info
        ])->extends('layouts.theme.app');
    }


    // listeners
    public $listeners = ['resetUI'];

    //
    public function noty($msg, $eventName = 'noty', $reset = true)
    {
        $this->dispatchBrowserEvent($eventName, ['msg' => $msg, 'type' => 'success']);
        if ($reset) $this->resetUI();
    }

    public function AddNew()
    {
        $this->resetUI();
        $this->noty(null, 'open-modal');
    }

    public function resetUI()
    {
        $this->reset('name', 'selected_id', 'search');
        $this->resetValidation();
        $this->resetPage();
    }


    public function Edit(Measure $measure)
    {
        $this->selected_id = $measure->id;
        $this->name = $measure->name;
        $this->action = 'Editar';
        $this->noty('', 'open-modal', false);
    }

    public function Store()
    {
        $this->validate(Measure::rules($this->selected_id), Measure::$messages);

        $measure = Measure::updateOrCreate(
            ['id' => $this->selected_id],
            ['name' => $this->name]
        );


        $this->noty($this->selected_id  < 1 ? 'Unidad Registrada' : 'Unidad Actualizada');
    }

    public function Destroy(Measure  $measure)
    {
        $measure->delete();
        $this->noty('Se eliminó la unidad');
    }
}
