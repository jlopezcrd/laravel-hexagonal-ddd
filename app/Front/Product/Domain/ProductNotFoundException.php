<?php

declare(strict_types = 1);

namespace Developez\Front\Product\Domain;

use Exception;
use Throwable;

class ProductNotFoundException extends Exception
{
    public function __construct($message = "Product Not Found", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
