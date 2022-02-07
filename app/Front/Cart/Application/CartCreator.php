<?php
declare(strict_types = 1);

namespace Developez\Front\Cart\Application;

use Developez\Front\Cart\Domain\Cart;
use Developez\Front\Cart\Domain\CartRepository;
use Developez\Shared\Domain\OrderId;
use Developez\Shared\Domain\OrderIdGenerator;

class CartCreator
{
    private $repository;
    private $orderIdGenerator;

    public function __construct(CartRepository $repository, OrderIdGenerator $orderIdGenerator)
    {
        $this->repository = $repository;
        $this->orderIdGenerator = $orderIdGenerator;
    }

    public function __invoke(): Cart
    {
        return $this->repository->initCart(
            new OrderId($this->orderIdGenerator->generate())
        );
    }
}
