<?php
declare(strict_types = 1);

namespace Developez\Shared\Infrastructure;

use Developez\Shared\Domain\OrderIdGenerator;

class TimeOrderIdGenerator implements OrderIdGenerator
{
    public function __construct()
    {
    }

    public function generate(): int
    {
        return time();
    }
}
