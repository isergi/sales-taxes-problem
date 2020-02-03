<?php

namespace SalesTaxesTool\Exceptions;

/**
 * Main Tool issues exception.
 */
class SalesTaxesException extends \Exception
{
    /**
     * Error code when an input file could not be find
     */
    const ERROR_CODE_FIND_INPUT_FILE = 404;

    /**
     * Error code when an input file could not be opened
     */
    const ERROR_CODE_OPEN_INPUT_FILE = 403;
}
