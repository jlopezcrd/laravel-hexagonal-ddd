<?php

declare(strict_types = 1);

namespace Developez\Shared\Infrastructure;

use Developez\Front\AboutUs\Domain\AboutUsRepository;
use Developez\Front\AboutUs\Infrastructure\EloquentAboutUsRepository;
use Developez\Front\Cart\Domain\CartRepository;
use Developez\Front\Cart\Infrastructure\EloquentCartRepository;
use Developez\Front\HomePage\Domain\HomePageRepository;
use Developez\Front\HomePage\Infrastructure\EloquentHomePageRepository;
use Developez\Front\Product\Domain\ProductRepository;
use Developez\Front\Product\Infrastructure\EloquentProductRepository;
use Developez\Front\Purchase\Domain\PurchaseRepository;
use Developez\Front\Purchase\Infrastructure\EloquentPurchaseRepository;
use Developez\Shared\Domain\OrderIdGenerator;
use Illuminate\Support\ServiceProvider;

final class DependencyInjection extends ServiceProvider
{
    public $bindings = [
        HomePageRepository::class => EloquentHomePageRepository::class,
        AboutUsRepository::class => EloquentAboutUsRepository::class,
        CartRepository::class => EloquentCartRepository::class,
        ProductRepository::class => EloquentProductRepository::class,
        PurchaseRepository::class => EloquentPurchaseRepository::class,
        OrderIdGenerator::class => TimeOrderIdGenerator::class,
        //OrderIdGenerator::class   => UuIdGenerator::class
    ];
}
