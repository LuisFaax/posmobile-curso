<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    use HasFactory;

    protected $fillable = ['name'];



    public static $messages = [
        'name.required' => 'Nombre requerido',
        'name.min' => 'El nombre debe tener al menos 3 caracteres',
        'name.max' => 'El nombre debe tener máximo 50 caracteres',
        'name.unique' => 'El nombre ya existe en sistema'
    ];

    public static function  rules($id)
    {
        if ($id <= 0) {
            return [
                'name' => 'required|min:3|max:50|unique:measures'
            ];
        } else {
            return [
                'name' => "required|min:3|max:50|unique:measures,name,{$id}"
            ];
        }
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
