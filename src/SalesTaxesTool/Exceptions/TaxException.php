<?php

namespace SalesTaxesTool\Exceptions;

/**
 * Tax issues exception.
 */
class TaxException extends \Exception
{
    /**
     * Return this code error when ubable to find the config of a tax file
     */
    const ERROR_CODE_UNABLE_TO_FIND_FILE = 210;
}
