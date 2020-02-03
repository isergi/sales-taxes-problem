<?php

namespace Tests\Product;

use PHPUnit\Framework\TestCase;
use SalesTaxesTool\Generator\Receipt;
use SalesTaxesTool\Product\Product;
use SalesTaxesTool\Tax\RevivaTax;
use SalesTaxesTool\Exceptions\GeneratorException;

class ReceiptGeneratorTest extends TestCase
{

    const CONFIG_PATH = __DIR__ . '/taxes.test.config.json';

    const RESULT_RECEIPT_TEXT = '1 book: 100.00:100.00' . PHP_EOL .
                                '2 book: 100.00:210.00' . PHP_EOL .
                                '3 bottle of perfume: 50.00:165.00' . PHP_EOL .
                                '4 bottle of perfume: 50.00:230.00' . PHP_EOL .
                                'Sales Taxes: 55.00' . PHP_EOL .
                                'Total: 705.00' . PHP_EOL;

    protected $_receiptGenerator;

    protected $_products;

    protected $_taxes;

    public function setUp()
    {

        $this->_receiptGenerator = new Receipt();

        $this->_taxes = new RevivaTax(self::CONFIG_PATH);

        $this->_products[] = new Product('book', '100', false);
        $this->_products[] = new Product('book', '100', true);
        $this->_products[] = new Product('bottle of perfume', '50', false);
        $this->_products[] = new Product('bottle of perfume', '50', true);
    }

    public function testGettingReceiptWithoutTaxes()
    {
        $this->expectException(GeneratorException::class);
        $this->expectExceptionCode(GeneratorException::ERROR_CODE_NO_IMPLEMENTED_TAX);
        
        $this->_receiptGenerator->generate(false);
    }

    public function testGettingReceiptWithoutProducts()
    {
        $this->expectException(GeneratorException::class);
        $this->expectExceptionCode(GeneratorException::ERROR_CODE_NO_IMPLEMENTED_PRODUCTS);
        
        $this->_receiptGenerator->setTax($this->_taxes);

        $this->_receiptGenerator->generate(false);
    }

    public function testGeneratingRceipt()
    {

        $this->_receiptGenerator->setTax($this->_taxes);

        foreach ($this->_products as $k => $product) {
            $this->_receiptGenerator->addProduct($product, $k+1);
        }

        $receipt = $this->_receiptGenerator->generate(false);

        $this->assertEquals($receipt, self::RESULT_RECEIPT_TEXT);
    }
}
