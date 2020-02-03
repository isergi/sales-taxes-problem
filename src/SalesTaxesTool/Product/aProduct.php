<?php

namespace SalesTaxesTool\Product;

abstract class aProduct
{
    /**
     * Price of the item
     */
    public $name;

    /**
     * Price of the item
     */
    public $price;

    /**
     * Property imported or no the item
     */
    public $is_imported = false;

    /**
     * Init aProduct class. Serts price and name
     */
    public function __construct(string $name, float $price, bool $isImported)
    {
        $this->name          = $name;
        $this->price         = $price;
        $this->is_imported   = $isImported;
    }

    /**
     * Returns a category of an item. 
     */
    abstract function getProductCategory() : string;
}
