<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class Cart
{

    protected Collection $cart;

    // constructor
    public function  __construct()
    {
        if (session()->has("cart")) {
            $this->cart = session("cart");
        } else {
            $this->cart = new Collection;
        }
    }

    // obtener carrito
    public function getContent(): Collection
    {
        return $this->cart->sortBy(['name', ['name', 'acs']]);
    }

    // guardar carrito en sesion
    protected function save(): void
    {
        session()->put("cart", $this->cart);
        session()->save();
    }

    // agregar producto al carrito
    public function addProduct(Product $product, $cant = 1): void
    {
        $pre = Arr::add($product, 'qty', 1);
        $this->validate($pre);
        $this->cart->push($pre);
        $this->save();
    }

    public function existsInCart(int $id): bool
    {
        $mycart = $this->getContent();
        $cont = $mycart->where('id', $id)->count();
        $res = $cont > 0 ? true : false;
        return $res;
    }

    // obtener la cantidad de un producto determinado en carrito
    public function countInCart(int $id): int
    {
        $mycart = $this->getContent();
        $cont = $mycart->where('id', $id)->sum('qty');
        return $cont;
    }

    // incrementar cantidad de un producto en carrito
    public function updateQuantity(int $id, $cant = 1): void
    {
        $mycart = $this->getContent();
        $oldItem = $mycart->where('id', $id)->first();
        $newItem = $oldItem;
        $newItem->qty += $cant;
        $this->removeProduct($id);
        $this->addProduct($newItem);
    }

    // decrementar cantidad de un producto dado en arrito
    public function decreaseQuantity(int $id, $cant = 1): void
    {
        $mycart = $this->getContent();
        $oldItem = $mycart->where('id', $id)->first();
        $newItem = $oldItem;
        $newItem->qty -= $cant;
        $this->removeProduct($id);
        if ($newItem->qty > 0) $this->addProduct($newItem);
    }
    // reemplazar cantidad de un producto en carrito
    public function replaceQuantity(int $id, $cant = 1): void
    {
        $mycart = $this->getContent();
        $oldItem = $mycart->where('id', $id)->first();
        $newItem = $oldItem;
        $newItem->qty = $cant;
        $this->validate($newItem);
        $this->removeProduct($id);
        $this->addProduct($newItem);
    }

    // eliminar producto del carrito
    public function removeProduct(int $id): void
    {
        $this->cart = $this->cart->reject(function (Product $product) use ($id) {
            return $product->id === $id;
        });
        $this->save();
    }

    // obtener suma total en carrito
    public function totalAmount()
    {
        $amount = $this->cart->sum(function ($product) {
            return ($product->price1 * $product->qty);
        });
        return $amount;
    }

    // obtener cantidad de productos distintos en carrito
    public function hasProducts(): int
    {
        return $this->cart->count();
    }

    // obtener sumatoria de la cantida de cada producto en carrito
    public function totalItems(): int
    {
        $items = $this->cart->sum(function ($product) {
            return $product->qty;
        });
        return $items;
    }

    // eliminar contenido del carrito
    public function clear(): void
    {
        $this->cart = new Collection;
        $this->save();
    }

    // validar antes de agregar item al carrito
    public function validate($item)
    {
        $validator = Validator::make($item->toArray(), [
            'id' => 'required',
            'price1' => 'required|numeric',
            'qty' => 'required|numeric|min:1',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            throw new \ErrorException($validator->messages());
        }
    }
}
