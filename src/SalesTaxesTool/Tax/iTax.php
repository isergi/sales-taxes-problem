<?php

namespace SalesTaxesTool\Tax;

interface iTax
{

    /**
     * Read config data for taxes.
     * 
     * @return float
     */
    public function getRate(string $productType, $isImported = false) : int;
}
