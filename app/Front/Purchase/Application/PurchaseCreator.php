<?php
declare(strict_types = 1);

namespace Developez\Front\Purchase\Application;

use Developez\Front\Cart\Domain\Cart;
use Developez\Front\Purchase\Domain\Purchase;
use Developez\Front\Purchase\Domain\PurchaseRepository;

class PurchaseCreator
{
    private $repository;

    public function __construct(PurchaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Cart $cart): Purchase
    {
        $purchase = Purchase::fromCart($cart);

        $this->repository->savePurchase($purchase);

        return $purchase;
    }
}
