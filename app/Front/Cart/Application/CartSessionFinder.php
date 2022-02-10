<?php

declare(strict_types = 1);

namespace Developez\Front\Cart\Application;

use Developez\Front\Cart\Domain\Cart;
use Developez\Front\Cart\Domain\CartRepository;

final class CartSessionFinder
{
    private $repository;
    private $creator;

    public function __construct(CartRepository $repository, CartCreator $creator)
    {
        $this->repository = $repository;
        $this->creator = $creator;
    }

    public function __invoke(): Cart
    {
        $cart = $this->repository->getSessionCart();

        if (null === $cart) {
            $cart = $this->creator->__invoke();
        }

        return $cart;
    }
}
