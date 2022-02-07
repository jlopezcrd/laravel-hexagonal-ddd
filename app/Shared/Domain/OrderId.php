<?php
declare(strict_types = 1);

namespace Developez\Shared\Domain;

class OrderId
{
    private $value;

    public function __construct(int $timestamp)
    {
        $this->value = $timestamp;
    }

    public function value(): int
    {
        return $this->value;
    }
}
