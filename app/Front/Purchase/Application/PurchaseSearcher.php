<?php

declare(strict_types = 1);

namespace Developez\Front\Purchase\Application;

use Developez\Front\Purchase\Domain\PurchaseRepository;
use Developez\Shared\Domain\Collection;

final class PurchaseSearcher
{
    private $repository;

    public function __construct(PurchaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $orderId = null): Collection
    {
        return $this->repository->findAll();
    }
}
