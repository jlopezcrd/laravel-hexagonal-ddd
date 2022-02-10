<?php

declare(strict_types = 1);

namespace Developez\Front\Cart\Domain;

use DomainException;
use Throwable;

final class CartQuantityInvalid extends DomainException
{
    public function __construct($message = "Quantity Invalid", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
