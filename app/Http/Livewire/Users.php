<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;


class Users extends Component
{
    use WithPagination;

    public $componentName = 'Usuarios';
    public function render()
    {
        return view('livewire.users.component', [
            'users' => User::paginate(5)
        ])
            ->extends('layouts.theme.app');
    }
}
