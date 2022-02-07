<?php
declare(strict_types = 1);

namespace Developez\Front\Product\Application;

use Developez\Front\Product\Domain\ProductRepository;
use Developez\Shared\Domain\Collection;
use Developez\Shared\Domain\Query;
use Developez\Shared\Domain\QueryFinder;

class ProductSearcher
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(array $filter): Collection
    {
        if(count($filter) > 0) {
            return $this->repository->search(
                new Query($filter)
            );
        }

        return $this->repository->findAll();
    }
}
