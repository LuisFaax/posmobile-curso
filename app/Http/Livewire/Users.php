<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Image;
use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;


class Users extends Component
{
    use WithPagination;
    public $name = '', $phone = '', $status = 'Active', $email = '', $password = '', $hiddenpwd = '', $address = '', $photo = '', $selected_id = 0;
    public $componentName = 'Usuarios', $search = '';
    private $pagination = 3;

    public function paginationView()
    {
        return 'vendor.livewire.tailwind';
    }

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
        $this->resetValidation();
        $this->resetPage();
        $this->reset([
            'name', 'phone', 'status', 'email', 'password', 'address', 'photo', 'selected_id', 'search', 'hiddenpwd'
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if (strlen($this->seearch) > 0)
            $info = User::whereNotIn('id', Customer::select('user_id'))
                ->select('users.*')->orderBy('name', 'asc')
                ->where('name', 'like', "%{$this->search}%")
                ->paginate($this->pagination);
        else
            $info = User::whereNotIn('id', Customer::select('user_id'))
                ->select('users.*')->orderBy('name', 'asc')
                ->paginate($this->pagination);

        return view('livewire.users.component', [
            'users' => $info
        ])->extends('layouts.theme.app');
    }

    public function Edit(User $user)
    {
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->status = $user->status;
        $this->cost = $user->cost;
        $this->email = $user->email;
        $this->address = $user->address;
        $this->photo = null;
        $this->password = null;
        $this->hiddenpwd = $user->password;
        $this->selected_id = $user->id;
        $this->noty('', 'open-modal', false);
    }


    public function Store()
    {
        sleep(3);

        $this->validate(User::rules($this->selected_id), User::$messages);

        $user = User::updateOrCreate(
            ['id' => $this->selected_id],
            [
                'name' => $this->name,
                'phone' => $this->phone,
                'status' => $this->status,
                'email' => $this->email,
                'password' => strlen($this->password) > 0 ? bcrypt($this->password) : $this->hiddenpwd,
                'address' => $this->address
            ]
        );

        if (!empty($this->photo)) {
            // delete all images in drive
            $tempImg = $user->avatar->file;
            if ($tempImg != null && file_exists('storage/avatars/' . $tempImg)) {
                unlink('storage/avatars/' . $tempImg);
            }
            // delete relationships image from dv
            $user->avatar()->delete();

            // save new image
            $customFileName = uniqid() . '_.' . $this->photo->extension();
            $this->photo->storeAs('public/avatars', $customFileName);

            // save image record
            $img = Image::create([
                'model_id' => $user->id,
                'model_type' => 'App\Models\User',
                'file' => $customFileName
            ]);

            // save relationship
            $user->avatar()->save($img);
        }

        $this->noty($this->selected_id < 1 ? 'Usuario Registrado' : 'Usuario Actualizado');
    }

    public function Destroy(User $user)
    {
        // delete all images in drive
        $tempImg = $user->avatar->file;
        if ($tempImg != null && file_exists('storage/avatars/' . $tempImg)) {
            unlink('storage/avatars/' . $tempImg);
        }

        // delete relationship image from db
        $user->avatar()->delete();

        // delete from db
        $user->delete();
        $this->noty('Se eliminó el usuario');
    }
}
