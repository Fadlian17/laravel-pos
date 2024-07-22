<?php

namespace App\Http\Services;

use Cart;

class CartService
{
    public function getContent()
    {
        return \Cart::getContent();
    }

    public function delContent()
    {
        return \Cart::clear();
    }
}