<?php

namespace SalesTaxesTool\Generator;

use SalesTaxesTool\Product\aProduct;

interface iGenerator
{
    
    /**
     * Add product to the Generator
     * 
     * @return iGenerator
     */
    public function addProduct(aProduct $product, int $qty) : void; 

    /**
     * Write data into a new report.
     * 
     * @return iGenerator
     */
    public function generate() : iGenerator;
}
