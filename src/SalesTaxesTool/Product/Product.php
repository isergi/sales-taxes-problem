<?php

namespace SalesTaxesTool\Product;

class Product extends aProduct
{

    /**
     * @TODO: Should be removed in real life. Because it's too hardcoded for the example.
     * 
     * Returns a category of an item. 
     */
    public function getProductCategory() : string
    {

        return 'test';
    }
}
