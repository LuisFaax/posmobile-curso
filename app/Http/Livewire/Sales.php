<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Product;

class Sales extends Component
{
    public $tabProducts = true, $tabSearch = false, $customerSelected = 'Seleccionar Cliente F8';
    public $searchByName, $itemsCart = 0, $totalCart = 0, $saleType = 'CASH', $amount, $statusSale = 'Paid';
    public $searchcustomer, $customers = [], $productsList = [];



    public function render()
    {
        $this->loadCustomers();

        if (strlen($this->searchByName) > 0) {
            $this->productsList = Product::where('name', 'like', "%{$this->searchByName}%")
                ->orWhere('code', 'like', "%{$this->searchByName}%")
                ->orderBy('name', 'asc')
                ->take(10)->get();
        }

        //$this->totalCart =

        return view('livewire.sales.component')->extends('layouts.theme.app');
    }

    public function loadCustomers()
    {
        if (strlen($this->searchcustomer) > 0) {
            $this->customers = Customer::join('users as u', 'u.id', 'customers.user_id')
                ->select('u.name', 'customers.id')
                ->where('name', 'like', "%{$this->searchcustomer}%")
                ->where('name', '<>', 'Publico General')
                ->orderBy('name', 'asc')->take(5)->get();
        } else {
            $this->customers = Customer::join('users as u', 'u.id', 'customers.user_id')
                ->select('u.name', 'customers.id')
                ->where('name', '<>', 'Publico General')
                ->orderBy('name', 'asc')->take(5)->get();
        }
    }

    public function setTabActive($tabName)
    {
        if ($tabName == 'tabProducts') {
            $this->tabProducts = true;
            $this->tabSearch = false;
        } else {
            $this->tabProducts = false;
            $this->tabSearch = true;
        }
    }

    public function setCustomer($customer_name, $customer_id)
    {
        $this->customer_id = $customer_id;
        $this->customerSelected = $customer_name;
        $this->dispatchBrowserEvent('close-customer-modal');
    }
    public function Store()
    {
        sleep(5);
    }
}
