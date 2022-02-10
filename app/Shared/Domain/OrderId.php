<?php

declare(strict_types = 1);

namespace Developez\Shared\Domain;

final class OrderId
{
    private $value;

    public function __construct(string $orderId)
    {
        $this->value = $orderId;
    }

    public function value(): string
    {
        return $this->value;
    }
}
