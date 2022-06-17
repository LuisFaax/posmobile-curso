<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\SaleDetail;
use App\Traits\CartTrait;
use Illuminate\Support\Facades\DB;

class Sales extends Component
{
    use CartTrait;

    public $tabProducts = true, $tabSearch = false, $customerSelected = 'Seleccionar Cliente F8';
    public $searchByName, $itemsCart = 0, $totalCart = 0, $contentCart, $saleType = 'CASH', $amount, $statusSale = 'Paid';
    public $searchcustomer, $customers = [], $productsList = [];

    public $productIdSelected, $productChangesSelected, $productNameSelected, $changesProduct;
    public $orderDetails = [], $search, $cash, $discount, $currentStatatusOrder, $order_selected_id, $customer_id = null, $changes;

    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $this->loadCustomers();

        if (strlen($this->searchByName) > 0) {
            $this->productsList = Product::where('name', 'like', "%{$this->searchByName}%")
                ->orWhere('code', 'like', "%{$this->searchByName}%")
                ->orderBy('name', 'asc')
                ->take(10)->get();
        }

        $this->totalCart = $this->getTotalCart();
        $this->itemsCart = $this->getItemsCart();
        $this->contentCart = $this->getContentCart();

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


    public function add2Cart(Product $product)
    {
        $this->addProductToCart($product);
    }
    public function noty($msg, $eventName = 'noty', $type = 'success', $action = '')
    {
        $this->dispatchBrowserEvent($eventName, ['msg' => $msg, 'type' => $type, 'action' => $action]);
    }

    public function updateQty(Product $product, $cant = 1)
    {
        if ($cant <= 0)
            $this->removeProductCart($product->id);
        else
            $this->replaceQuantityCart($product->id, $cant);
    }

    public function removeFromCart($id)
    {
        $this->removeProductCart($id);
    }

    public function decreaseQty($id)
    {
        $this->decreaseQtyCart($id);
    }

    public function increaseQty(Product $product, $cant = 1)
    {
        $this->updateQtyCart($product, $cant);
    }


    public function resetUI()
    {
        $this->reset('tabProducts', 'cash', 'amount',  'tabSearch', 'search', 'searchcustomer', 'customer_id', 'customerSelected', 'totalCart', 'itemsCart', 'productIdSelected', 'productChangesSelected', 'productNameSelected', 'changesProduct');
    }

    public function cancelSale()
    {
        $this->clearCart();
        $this->resetUI();
    }

    public function Store($print = false)
    {
        sleep(2);

        if ($this->getTotalCart() <= 0) {
            $this->noty('AGREGA PRODUCTOS A LA VENTA', 'noty', 'error');
            return;
        }

        DB::beginTransaction();

        try {
            if ($this->customerSelected == 'Seleccionar Cliente F8') {
                $this->customer_id = User::join('customers as c', 'c.customer_id', 'users.id')
                    ->where('name', 'Publico General')
                    ->select('c.id')
                    ->get()->pluck('id')[0];
            }

            // save sale
            $sale = Sale::create([
                'user_id' => Auth()->user()->id,
                'customer_id' => $this->customer_id,
                'items' => $this->getItemsCart(),
                'total' => $this->getTotalCart(),
                'discount' => $this->discount,
                'status' => $this->statusSale,
                'mode' => 'Web',
                'type' => $this->saleType
            ]);

            //save details
            if ($sale) {
                $items = $this->getContentCart();
                foreach ($items as $item) {

                    SaleDetail::create([
                        'sale_id' => $sale->id,
                        'product_id' => $item->id,
                        'quantity' => $item->qty,
                        'price' => $item->price1
                    ]);
                    // update stock
                    Product::find($item->id)->decrement('stock', $item->qty);
                }
                // save payment
                if ($this->amount > 0) {
                    Payment::create([
                        'user_id' => Auth()->user()->id,
                        'sale_id' => $sale->id,
                        'amount' => $this->amount
                    ]);
                }
            }

            // confirm transaction
            DB::commit();
            $this->clearCart();
            $this->resetUI();

            // sale print

            if ($print) $this->saleTicket($sale);
            $this->noty('Venta registrada', 'noty', 'success', 'modalSaveSale');
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->noty('Error al guardar la venta' . $e->getMessage(), 'noty', 'error');
        }
    }
}
