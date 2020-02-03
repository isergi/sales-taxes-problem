<?php

namespace SalesTaxesTool\Exceptions;

/**
 * Product issues exception.
 */
class ProductException extends \Exception
{
    /**
     * Error code when a product without a link to the category
     */
    const ERROR_CODE_UNABLE_FIND_CATEGORY = 601;
}
