<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'credit'];

    // relationships
    public function purchasings()
    {
        return $this->hasMany(Sale::class);
    }

    public function credit_purchasings()
    {
        return $this->hasMany(Sale::class)->where('type', 'CREDIT');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    // ACCESORS & APPENDS
    protected $appends = ['pending_pay', 'credit_purchasings', 'history_purchasings'];

    // total de compras de todo el historial del cliente
    public function getHistoryPurchasingsAttribute()
    {
        $ps = $this->purchasings();

        if ($ps->count() > 0) {
            return $ps->sum('total');
        } else {
            return 0;
        }
    }

    // total de compras a crédito del cliente
    public function getCreditPurchasingsAttribute()
    {
        $ps = $this->credit_purchasings();

        if ($ps->count() > 0) {
            return $ps->sum('total');
        } else {
            return 0;
        }
    }


    public function getPendingPayAttribute()
    {
        $ps = $this->credit_purchasings();
        if ($ps->count() > 0) {
            $pays = $this->payments();
            if ($pays) {
                $paySum = $pays->sum('amount');
                return $ps->sum('total') - $paySum;
            } else {
                return $ps->sum('total');
            }
        } else {
            return 0;
        }
    }
}
