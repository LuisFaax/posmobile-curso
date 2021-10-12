<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['model_id', 'model_type', 'file', 'description'];

    public function image() //imageable
    {
        return $this->morphTo();
    }
}
