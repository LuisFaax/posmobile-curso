<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;



    protected $fillable = [
        'code', 'name', 'description', 'cost', 'price1', 'price2', 'stock', 'minstock', 'category_id', 'measure_id'
    ];

    // relationships
    public function sales()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    //Get the product's most recent image.
    public function latestImage()
    {
        return $this->morphOne(Image::class, 'model')->latestOfMany();
    }

    //accessors
    public function getPhotoAttribute()
    {
        if (count($this->images)) {
            return  "storage/products/" . $this->images->last()->file;
        } else {
            return 'storage/noimg.jpg';
        }
    }

    /*
    public function getCostoAttribute($value)
    {
        return  '$' . number_format($value, 2);
    }

    public function getPrice11Attribute($value)
    {
        return  '$' . number_format($value, 2);
    }
    public function getPrice22Attribute($value)
    {
        return  '$' . number_format($value, 2);
    }

    */
    //mutrators    
    public function setCostoAttribute($value)
    {
        return floatval(str_replace(array(',', '$'), "", $value));
    }


    public function getCurrentStockAttribute()
    {
        return $this->stock;
    }









    // validations
    public static function rules($id)
    {
        if ($id <= 0) {
            return [
                'name' => 'required|min:3|max:50|unique:products',
                'code' => 'nullable|max:25|unique:products',
                'description' => 'nullable|max:255',
                'cost' => 'required',
                'price1' => 'required|numeric',
                'price2' => 'required|numeric',
                'stock' => 'required',
                'minstock' => 'required',
                'categoryid' => 'required|not_in:Elegir',
                'measureid' => 'required|not_in:Elegir',
            ];
        } else {
            return [
                'name' => "required|min:3|max:50|unique:products,name,{$id}",
                'code' => "nullable|max:25|unique:products,code,{$id}",
                'description' => 'nullable|max:255',
                'cost' => 'required',
                'price1' => 'required|numeric',
                'price2' => 'required|numeric',
                'stock' => 'required',
                'minstock' => 'required',
                'categoryid' => 'required|not_in:Elegir',
                'measureid' => 'required|not_in:Elegir',
            ];
        }
    }

    public static $messages = [
        'name.required' => 'Nombre requerido',
        'name.min' => 'El nombre debe tener al menos 3 caracteres',
        'name.max' => 'El nombre debe tener máximo 50 caracteres',
        'name.unique' => 'El nombre ya existe en sistema',
        'code.max' => 'El code debe tener máximo 25 caracteres',
        'code.unique' => 'El code ya existe',
        'description.max' => 'La descripción debe tener máximo 255 caracteres',
        'cost.required' => 'El costo es requerido',
        'cost.numeric' => 'El costo debe ser numérico',
        'price1.required' => 'El precio general es requerido',
        'price1.numeric' => 'El precio general debe ser numérico',
        'price2.required' => 'El precio de mayoreo es requerido',
        'price2.numeric' => 'El precio de mayoreo debe ser numérico',
        'stock.required' => 'El stock es requerido',
        'stock.integer' => 'El stock debe ser un valor entero',
        'minstock.required' => 'El minstock es requerido',
        'minstock.integer' => 'El minstock debe ser un valor entero',
        'categoryid.required' => 'Elige la categoría',
        'categoryid.not_in' => 'Elige una categoría válida',
        'measureid.required' => 'Elige la unidad de medida',
        'measureid.not_in' => 'Elige una unidad de medida válida',
    ];
}
