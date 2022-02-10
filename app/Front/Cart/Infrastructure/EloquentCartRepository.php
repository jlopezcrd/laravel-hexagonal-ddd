<?php

declare(strict_types = 1);

namespace Developez\Front\Cart\Infrastructure;

use Developez\Front\Cart\Domain\Cart;
use Developez\Front\Cart\Domain\CartRepository;
use Developez\Shared\Domain\OrderId;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EloquentCartRepository implements CartRepository
{
    public function initCart(OrderId $orderId): Cart
    {
        $cart = new Cart($orderId);

        Session::put('cart', $cart);

        return $cart;
    }

    public function getSessionCart(): ?Cart
    {
        return Session::get('cart');
    }

    public function updateCart(Cart $cart): Cart
    {
        Session::put('cart', $cart);

        return $cart;
    }

    public function saveCart(Cart $cart): Cart
    {
        $cartDb          = $cart->toArray();
        $cartDb['items'] = json_encode($cartDb['items'], JSON_THROW_ON_ERROR);

        DB::table('purchases')->insert($cartDb);

        return $cart;
    }
}
