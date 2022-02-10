<?php

declare(strict_types = 1);

namespace Developez\Shared\Domain;

final class Collection
{
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
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
}
