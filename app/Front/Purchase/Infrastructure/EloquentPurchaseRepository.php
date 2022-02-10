<?php
declare(strict_types = 1);

namespace Developez\Front\Purchase\Infrastructure;

use Developez\Front\Cart\Domain\Cart;
use Developez\Front\Purchase\Domain\Purchase;
use Developez\Front\Purchase\Domain\PurchaseRepository;
use Developez\Shared\Domain\Collection;
use Illuminate\Support\Facades\DB;

class EloquentPurchaseRepository implements PurchaseRepository
{
    public function savePurchase(Purchase $purchase): void
    {
        DB::table('purchases')->insert($purchase->toDB());
    }

    public function findAll(): Collection
    {
        $purchases = DB::table('purchases')->get()->map(function($item) {
            return Purchase::fromArray((array) $item);
        });

        return new Collection($purchases->toArray());
    }
}
