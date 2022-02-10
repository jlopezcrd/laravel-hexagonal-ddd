<?php

declare(strict_types = 1);

namespace Developez\Front\Cart\Application;

use Developez\Front\Cart\Domain\Cart;
use Developez\Front\Cart\Domain\CartQuantityInvalid;
use Developez\Front\Cart\Domain\CartRepository;
use Developez\Front\Product\Domain\Product;

final class CartUpdater
{
    private $repository;
    private $finder;

    public function __construct(CartRepository $repository, CartSessionFinder $finder)
    {
        $this->repository = $repository;
        $this->finder = $finder;
    }

    public function __invoke(Product $product, int $quantity): Cart
    {
        if ($quantity < 1 || $quantity > 10) {
            throw new CartQuantityInvalid();
        }

        $cart = $this->finder->__invoke();
        $cart->add($product);

        return $this->repository->updateCart($cart);
    }
}
