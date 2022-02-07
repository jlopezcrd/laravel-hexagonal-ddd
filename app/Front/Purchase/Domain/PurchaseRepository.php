<?php
declare(strict_types = 1);

namespace Developez\Front\Purchase\Domain;

interface PurchaseRepository
{
    public function savePurchase(Purchase $purchase): void;
}
