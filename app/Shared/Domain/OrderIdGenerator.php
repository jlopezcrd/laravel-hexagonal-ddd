<?php
declare(strict_types = 1);

namespace Developez\Shared\Domain;

interface OrderIdGenerator
{
    public function generate(): string;
}
