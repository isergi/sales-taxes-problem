<?php

namespace Tests\Product;

use PHPUnit\Framework\TestCase;
use SalesTaxesTool\Product\Product;
use SalesTaxesTool\Product\Category;
use SalesTaxesTool\Exceptions\ProductException;

class ProductTest extends TestCase
{

    protected $_product;

    public function setUp()
    {
        $this->_product = new Product('book', '100', false);
    }

    public function testGettingProductCategory()
    {
        $this->assertEquals(Category::CATEGORY_NAME_BOOK, $this->_product->getProductCategory());
    }

    public function testGettingProductWithoutCategory()
    {
        $this->expectException(ProductException::class);
        $this->expectExceptionCode(ProductException::ERROR_CODE_UNABLE_FIND_CATEGORY);
        
        $this->_product->name = 'Product_Without_Category';
        $this->_product->getProductCategory();
    }
}
