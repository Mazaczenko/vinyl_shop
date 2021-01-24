<?php

namespace App\Helpers;

class Cart
{
    private $cart = [
        'records' => [],
        'totalQty' => 0,
        'totalPrice' => 0
    ];

    public function __construct()
    {
        if (session()->get('cart')) {
            $this->cart = session()->get('cart');
        }
    }

    // add a record to the cart
    public function add($item)
    {
        session()->put('cart', $this->cart);  // save the session
    }

    public function delete($item)
    {
        session()->put('cart', $this->cart);
    }

    public function empty()
    {
        session()->forget('cart');
    }

    public function getCart()
    {
        return $this->cart;
    }

    public function getRecords()
    {
        return $this->cart['records'];
    }

    public function getOneRecord($key)
    {
        if (array_key_exists($key, $this->cart['records'])) {
            return $this->cart['records'][$key];
        }
    }

    // Get all the record keys
    public function getKeys()
    {
        return array_keys($this->cart['records']);
    }

    // Get the number of items
    public function getTotalQty()
    {
        return $this->cart['totalQty'];
    }

    // Get the total price
    public function getTotalPrice()
    {
        return $this->cart['totalPrice'];
    }

    // Calculate the number of items and total price
    private function updateTotal()
    {
        // calculate logic comes here
    }

}
