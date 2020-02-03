<?php

namespace SalesTaxesTool\Exceptions;

/**
 * Generator issues exception.
 */
class GeneratorException extends \Exception
{

    /**
     * Return this code error when ubable to continiue create receipt because products was not implemented
     */
    const ERROR_CODE_NO_IMPLEMENTED_PRODUCTS = 120;

    /**
     * Return this code error when ubable to continiue create receipt because tax was not implemented
     */
    const ERROR_CODE_NO_IMPLEMENTED_TAX = 121;
}
