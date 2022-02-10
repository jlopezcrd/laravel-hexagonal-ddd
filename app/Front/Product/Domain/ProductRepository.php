<?php

declare(strict_types = 1);

namespace Developez\Front\Product\Domain;

use Developez\Shared\Domain\Collection;
use Developez\Shared\Domain\Query;

interface ProductRepository
{
    public function find(string $uuid): ?Product;
    public function findBySlug(string $category, string $slug): ?Product;
    public function search(Query $query): Collection;
    public function findAll(): Collection;
    public function gallery(): GalleryCollection;
    public function saveProduct(Product $product): Product;
}
