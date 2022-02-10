<?php

declare(strict_types = 1);

namespace Developez\Front\Purchase\Domain;

use DomainException;
use Throwable;

final class PurchaseEmptyException extends DomainException
{
    public function __construct($message = "Purchase can't be empty", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
