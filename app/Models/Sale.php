<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'user_id', 'items', 'total', 'discount', 'status', 'mode', 'sync', 'type'];

    public function details()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function pays()
    {
        return $this->hasMany(Payment::class);
    }
}
