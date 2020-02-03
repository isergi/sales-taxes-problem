<?php

namespace SalesTaxesTool\Product;

use SalesTaxesTool\Exceptions\ProductException;

class Product extends aProduct
{
    /**
     * Returns a category of an item. 
     */
    public function getProductCategory() : string
    {

        if (!isset(Category::$productCategoriesByName[ $this->name ])) {
            throw new ProductException('Unable to find category for the product "' . $this->name . '"', ProductException::ERROR_CODE_UNABLE_FIND_CATEGORY);
        }

        return Category::$productCategoriesByName[ $this->name ];
    }
}
