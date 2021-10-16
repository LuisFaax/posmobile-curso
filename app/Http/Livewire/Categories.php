<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\WithPagination;

use Livewire\Component;

class Categories extends Component
{
    use WithPagination;
    public $name = '', $selected_id = 0, $action = 'Gestionar Categorías', $componentName = 'Categorías', $search = '';
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
            $info = Category::where('name', 'like', "%{$this->search}%")->orderBy('name', 'asc')->paginate($this->pagination);
        else
            $info = Category::orderBy('name', 'asc')->paginate($this->pagination);

        return view('livewire.categories.component', [
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


    public function Edit(Category $category)
    {
        $this->selected_id = $category->id;
        $this->name = $category->name;
        $this->action = 'Editar';
        $this->noty('', 'open-modal', false);
    }

    public function Store()
    {
        sleep(2);

        $this->validate(Category::rules($this->selected_id), Category::$messages);

        $measure = Category::updateOrCreate(
            ['id' => $this->selected_id],
            ['name' => $this->name]
        );


        $this->noty($this->selected_id  < 1 ? 'Categoría Registrada' : 'Categoría Actualizada');
    }

    public function Destroy(Category  $category)
    {
        $category->delete();
        $this->noty('Se eliminó la categoría');
    }
}
