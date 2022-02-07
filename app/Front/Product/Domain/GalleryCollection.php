<?php

declare(strict_types = 1);

namespace Developez\Front\Product\Domain;

final class GalleryCollection
{
    private $items;
    private $categories;

    public function __construct(array $items, array $categories)
    {
        $this->items = $items;
        $this->categories = $categories;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function toArray(): array
    {
        return array_map(static function($item) {
            return $item->toArray();
        }, $this->items);
    }

    public function categories(): array
    {
        return $this->categories;
    }
}
