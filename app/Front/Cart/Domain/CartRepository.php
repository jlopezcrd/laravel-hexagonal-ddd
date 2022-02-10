<?php

declare(strict_types = 1);

namespace Developez\Front\Cart\Domain;

use Developez\Shared\Domain\OrderId;

interface CartRepository
{
    public function initCart(OrderId $orderId): Cart;

    public function getSessionCart(): ?Cart;

    public function updateCart(Cart $cart): Cart;

    public function saveCart(Cart $cart): Cart;

    public function deleteCart(Cart $cart): bool;
}
