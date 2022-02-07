<?php
declare(strict_types = 1);

namespace Developez\Front\Cart\Application;

use Developez\Front\Cart\Domain\Cart;
use Developez\Front\Cart\Domain\CartRepository;
use Developez\Front\Product\Domain\Product;

class CartUpdater
{
    private $repository;
    private $finder;

    public function __construct(CartRepository $repository, CartSessionFinder $finder)
    {
        $this->repository = $repository;
        $this->finder     = $finder;
    }

    public function __invoke(Product $product, int $quantity): Cart
    {
        $cart = $this->finder->__invoke();
        $cart->add($product);
        return $this->repository->updateCart($cart);
    }
}
