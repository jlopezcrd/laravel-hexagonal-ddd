<?php
declare(strict_types = 1);

namespace Developez\Shared\Infrastructure;

use Developez\Shared\Domain\OrderIdGenerator;
use Illuminate\Support\ServiceProvider;

class DependencyInjection extends ServiceProvider
{
    public $bindings = [
        OrderIdGenerator::class => TimeOrderIdGenerator::class,
    ];
}
