<?php

declare(strict_types = 1);

namespace Developez\Front\Cart\Domain;

use Developez\Front\Product\Domain\Product;
use Developez\Shared\Domain\OrderId;
use Developez\Shared\Domain\Serializable;

final class Cart implements Serializable
{
    private $orderId;
    private $items;

    public function __construct(OrderId $orderId)
    {
        $this->orderId = $orderId;
        $this->items   = [];
    }

    public function add(Product $product): void
    {
        $this->items[] = $product;
    }

    public function orderId(): OrderId
    {
        return $this->orderId;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }

    public function toArray(): array
    {
        return [
            'orderId' => $this->orderId->value(),
            'items'   => array_map(static function ($item) {
                return $item->toArray();
            }, $this->items)
        ];
    }

    public static function fromJson(string $serialized): Cart
    {
        $serialized = json_decode($serialized, true, 512, JSON_THROW_ON_ERROR);
        return self::fromArray($serialized);
    }

    public static function fromArray(array $data): Cart
    {
        $cart = new self(new OrderId($data['orderId']));

        foreach($data['items'] as $item) {
            $cart->add(Product::fromArray($item));
        }

        return $cart;
    }
}
