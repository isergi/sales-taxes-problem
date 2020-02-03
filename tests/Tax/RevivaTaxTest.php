<?php

namespace Tests\Tax;

use PHPUnit\Framework\TestCase;
use SalesTaxesTool\Product\Product;
use SalesTaxesTool\Tax\RevivaTax;
use SalesTaxesTool\Exceptions\TaxException;

class RevivaTaxTest extends TestCase
{

    const CONFIG_PATH = __DIR__ . '/taxes.test.config.json';
    
    protected $_tax;

    protected $_product;

    protected $_productOther;

    public function setUp()
    {
        $this->_tax = new RevivaTax(self::CONFIG_PATH);

        $this->_product = new Product('book', '100', false);

        $this->_productOther = new Product('bottle of perfume', '50', false);
    }

    public function testTaxWithIncorrectConfigPath()
    {
        $this->expectException(TaxException::class);
        $this->expectExceptionCode(TaxException::ERROR_CODE_UNABLE_TO_FIND_FILE);

        $wrongConfigTax = new RevivaTax('no_file_exists.path');
    }

    public function testProductGetRate()
    {
        $this->assertEquals($this->_tax->getRate($this->_product->getProductCategory()), 0);
        $this->assertEquals($this->_tax->getRate($this->_product->getProductCategory(), true), 5);

        $this->assertEquals($this->_tax->getRate($this->_productOther->getProductCategory()), 10);
        $this->assertEquals($this->_tax->getRate($this->_productOther->getProductCategory(), true), 15);
    }
}
