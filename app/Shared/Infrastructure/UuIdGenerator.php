<?php

declare(strict_types = 1);

namespace Developez\Shared\Infrastructure;

use Developez\Shared\Domain\OrderIdGenerator;
use Illuminate\Support\Str;

final class UuIdGenerator implements OrderIdGenerator
{
    public function __construct()
    {
    }

    public function generate(): string
    {
        return Str::uuid()->toString();
    }
}
