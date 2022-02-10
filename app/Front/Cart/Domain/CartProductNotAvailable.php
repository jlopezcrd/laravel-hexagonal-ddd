<?php

declare(strict_types = 1);

namespace Developez\Front\Cart\Domain;

use DomainException;
use Throwable;

final class CartProductNotAvailable extends DomainException
{
    public function __construct($message = "Product not available for shopping", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
