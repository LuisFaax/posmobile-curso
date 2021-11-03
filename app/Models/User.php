<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
        'address',
        'sync'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function avatar()
    {
        return $this->morphOne(Image::class, 'model')->withDefault();
    }

    // validations
    public static function rules($id)
    {
        if ($id <= 0) {
            return [
                'name' => 'required|min:3|max:50|string|unique:users',
                'phone' => 'min:10|max:10|string',
                'email' => 'required|email|max:255|unique:users',
                'password' => ['required', 'min:3', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
                'status' => Rule::in(['Active', 'Locked']),
                'address' => 'max:255'
            ];
        } else {
            return [
                'name' => "required|min:3|max:50|string|unique:categories,name,{$id}",
                'phone' => 'min:10|max:10|string',
                'email' => "required|email|max:255|unique:users,email,{$id}",
                'status' => Rule::in(['Active', 'Locked']),
                'address' => 'max:255'
            ];
        }
    }

    public static $messages = [
        'name.required' => 'Nombre requerido',
        'name.min' => 'El nombre debe tener al menos 3 caracteres',
        'name.max' => 'El nombre debe tener máximo 50 caracteres',
        'name.unique' => 'El nombre de usuario ya existe en sistema',
        'phone.max' => 'El teléfono debe tener mínimo 10 caracteres',
        'phone.min' => 'El teléfono debe tener máximo 10 caracteres',
        'email.required' => 'EL email es requerido',
        'email.email' => 'EL email es inválido',
        'email.max' => 'EL email debe tener máximo 255 caracteres',
        'email.unique' => 'EL email ya existe en otro usuario',
        'password.required' => 'El password es requerido',
        'password.min' => 'El password debe tener mínimo 3 caracteres',
        'password.regex' => 'Debe tener al menos una mayúscula, una minúscula y un dígito',
        'status.required' => 'El estatus es requerido',
        'status.in' => 'El estatus solo puede ser Activo ó Bloqueado',
        'address.max' => 'La dirección debe tener máximo 255 caracteres'
    ];

    public function getImageAttribute()
    {
        $img = $this->avatar->file;
        if ($img != null) {
            if (file_exists('storage/avatars/' . $img))
                return 'storage/avatars/' . $img;
            else
                return 'storage/image-not-found.png';
        } else {
            return 'storage/noimg.jpg';
        }
    }
}
