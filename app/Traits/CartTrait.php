<?php

namespace App\Traits;

use App\Services\Cart;
use App\Models\Product;

trait CartTrait
{

    public function getContentCart()
    {
        $cart = new Cart;
        return $cart->getContent();
    }

    public function getTotalCart()
    {
        $cart = new Cart;
        return $cart->totalAmount();
    }

    public function countInCart($id)
    {
        $cart = new Cart;
        return $cart->countInCart($id);
    }

    public function getItemsCart()
    {
        $cart = new Cart;
        return $cart->totalItems();
    }

    public function updateQtyCart(Product $product, $cant = 1)
    {
        $cart = new Cart;
        $cart->updateQuantity($product->id, $cant);
        $this->noty("CANTIDAD ACTUALIZADA");
    }

    public function addProductToCart(Product $product, $cant = 1)
    {
        $cart = new Cart;

        if ($cart->existsInCart($product->id)) {
            $cart->updateQuantity($product->id, $cant);
            $this->noty('CANTIDAD ACTUALIZADA');
        } else {
            $cart->addProduct($product, $cant);
            $this->noty('PRODUCTO AGREGADO AL CARRITO');
        }
    }

    public function inCart($id)
    {
        $cart = new Cart;
        return $cart->existsInCart($id);
    }

    public function replaceQuantityCart($id, $cant = 1)
    {
        $cart = new Cart;
        $cart->replaceQuantity($id, $cant);
        $this->noty("CANTIDAD ACTUALIZADA");
    }

    public function decreaseQtyCart($id)
    {
        $cart = new Cart;
        $cart->decreaseQtyCart($id);
        $this->noty("CANTIDAD ACTUALIZADA");
    }

    public function removeProductCart($id)
    {
        $cart = new Cart;
        $cart->removeProduct($id);
    }

    public function clearCart()
    {
        $cart = new Cart;
        $cart->crear();
    }
}
