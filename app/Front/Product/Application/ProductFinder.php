<?php

declare(strict_types = 1);

namespace Developez\Front\Product\Application;

use Developez\Front\Product\Domain\Product;
use Developez\Front\Product\Domain\ProductNotFoundException;
use Developez\Front\Product\Domain\ProductRepository;

final class ProductFinder
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $productId): Product
    {
        $product = $this->repository->find($productId);

        if (null === $product) {
            throw new ProductNotFoundException();
        }

        return $product;
    }

    public function findBySlug(string $category, string $slug): Product
    {
        $product = $this->repository->findBySlug(strtoupper($category), $slug);

        if (null === $product) {
            throw new ProductNotFoundException();
        }

        return $product;
    }
}
