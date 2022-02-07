<?php

declare(strict_types = 1);

namespace Developez\Front\Product\Application;

use Developez\Front\Product\Domain\GalleryCollection;
use Developez\Front\Product\Domain\ProductRepository;

final class ProductGalleryFinder
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): GalleryCollection
    {
        return $this->repository->gallery();
    }
}
