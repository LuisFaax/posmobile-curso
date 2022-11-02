<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use function PHPUnit\Framework\returnSelf;

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

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function getPendingPayAttribute()
    {
        if ($this->type == 'CASH') return "0.00";

        $pays = $this->pays->sum('amount');
        $total = $this->total;
        $dif = $total - $pays;
        return  number_format($dif, 2);
    }
}
