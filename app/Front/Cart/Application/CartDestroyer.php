<?php

declare(strict_types = 1);

namespace Developez\Front\Cart\Application;

use Developez\Front\Cart\Domain\Cart;
use Developez\Front\Cart\Domain\CartRepository;

final class CartDestroyer
{
    private $repository;

    public function __construct(CartRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Cart $cart): bool
    {
        return $this->repository->deleteCart($cart);
    }
}
