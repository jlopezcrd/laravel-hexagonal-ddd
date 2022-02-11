<?php

declare(strict_types = 1);

namespace Developez\Front\Purchase\Application;

use Developez\Front\Cart\Application\CartDestroyer;
use Developez\Front\Cart\Domain\Cart;
use Developez\Front\Purchase\Domain\Purchase;
use Developez\Front\Purchase\Domain\PurchaseEmptyException;
use Developez\Front\Purchase\Domain\PurchaseRepository;

final class PurchaseCreator
{
    private $repository;
    private $destroyer;

    public function __construct(PurchaseRepository $repository, CartDestroyer $destroyer)
    {
        $this->repository = $repository;
        $this->destroyer = $destroyer;
    }

    public function __invoke(Cart $cart): Purchase
    {
        if ($cart->total() <= 0 || $cart->total() === 0.0) {
            throw new PurchaseEmptyException();
        }

        $purchase = Purchase::fromCart($cart);

        $this->repository->savePurchase($purchase);
        $this->destroyer->__invoke($cart);

        return $purchase;
    }
}
