<?php
declare(strict_types = 1);

namespace Developez\Front\Product\Application;

use Developez\Front\Product\Domain\ProductRepository;
use Developez\Shared\Domain\Collection;
use Developez\Shared\Domain\Query;
use Developez\Shared\Domain\QueryFinder;

class ProductGallerySearcher
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(array $filter, array $query): Collection
    {
        return $this->repository->search(
            new Query($filter, $query)
        );

        /*if (count($query) > 0) {
            return $this->repository->search(
                //'on_gallery' => 1
                new Query([], $query)
            );
        }

        if (count($filter) > 0) {
            return $this->repository->search(
                //'on_gallery' => 1
                new Query($filter)
            );
        }

        return $this->repository->search(
            new Query(['on_gallery' => 1])
        );*/
    }
}
