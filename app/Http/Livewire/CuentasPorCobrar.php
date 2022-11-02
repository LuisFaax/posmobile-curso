<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use App\Models\Sale;
use App\Traits\printTrait;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class CuentasPorCobrar extends Component
{
    use WithPagination;
    use printTrait;

    public $selected_id = 0, $search, $amount, $balance_amount;

    public function paginationView()
    {
        return 'vendor.livewire.tailwind';
    }


    public function render()
    {
        return view('livewire.cuentas-por-cobrar', [
            'sales' => $this->getCreditSales()
        ])->extends('layouts.theme.app');
    }

    public function getCreditSales()
    {
        if (!empty($this->search) && strlen($this->search) > 0) {
            $info = Sale::join('customers as c', 'c.id', 'sales.customer_id')
                ->join('users as u', 'u.id', 'c.user_id')
                ->select('sales.*')
                ->where('sales.type', 'CREDIT')->where('sales.status', 'Pending')
                ->where('u.name', 'like', "%{$this->search}%")
                ->orderBy('id', 'asc')
                ->paginate(5);
        } else {
            $info = Sale::join('customers as c', 'c.id', 'sales.customer_id')
                ->join('users as u', 'u.id', 'c.user_id')
                ->select('sales.*')
                ->where('sales.type', 'CREDIT')->where('sales.status', 'Pending')
                ->orderBy('id', 'asc')
                ->paginate(5);
        }
        return $info;
    }


    public function modalPay(Sale $sale)
    {
        $this->selected_id = $sale->id;
        $this->balance_amount = $sale->pendingpay;
        $this->dispatchBrowserEvent('balance-modal-pay');
    }

    public function doPayment()
    {
        if ($this->amount > 0) {
            DB::beginTransaction();

            try {

                $pay = Payment::create([
                    'user_id' => Auth()->user()->id,
                    'sale_id' => $this->selected_id,
                    'amount' => $this->amount
                ]);

                if ($this->amount >= $this->balance_amount) {
                    Sale::find($this->selected_id)
                        ->update([
                            'status' => 'Paid'
                        ]);
                }

                DB::commit();
                $this->dispatchBrowserEvent('noty', ['msg' => 'Pago registrado con éxito', 'type' => 'success', 'action' => '']);
                $this->dispatchBrowserEvent('close-balance-modal-pay');
                $this->reset('search', 'selected_id', 'amount', 'balance_amount');
                //
                $this->payTicket($pay);
            } catch (\Throwable $th) {
                DB::rollBack();
                $this->dispatchBrowserEvent('noty', ['msg' => 'Error al registrar el pago' . $th->getMessage(), 'type' => 'error']);
            }
        } else {
            $this->dispatchBrowserEvent('noty', ['msg' => 'Ingresa un monto mayor a cero', 'type' => 'error']);
        }
    }

    public function balancePay(Sale $sale)
    {

        DB::beginTransaction();

        try {

            Payment::create([
                'user_id' => Auth()->user()->id,
                'sale_id' => $this->selected_id,
                'amount' => $this->amount
            ]);

            if ($this->amount >= $this->balance_amount) {
                Sale::find($this->selected_id)
                    ->update([
                        'status' => 'Paid'
                    ]);
            }

            DB::commit();
            $this->dispatchBrowserEvent('noty', ['msg' => 'Saldo liquidado con éxito', 'action' => '']);
            //
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('noty', ['msg' => 'Error al saldar el pago' . $th->getMessage(), 'type' => 'error']);
        }
    }
}
