<?php

namespace SalesTaxesTool\Generator;

use SalesTaxesTool\Exceptions\GeneratorException;
use SalesTaxesTool\Tax\iTax;
use SalesTaxesTool\Product\aProduct;

/**
 * Musement generator.
 *
 * The **Receipt** class is a generator of a calculate receipt
 *
 */
class Receipt implements iGenerator
{
    /**
     * Collected products data in cart
     */
    private $_cart  = [];

    /**
     * Tax class
     */
    private $_tax       = null;

    /**
     * Setup a tax class for a products
     * 
     * @param iTax          $iTax initiated a list of taxes
     * 
     * @return iGenerator
     */
    public function setTax(iTax $iTax) : iGenerator 
    {
        $this->_tax = $iTax;

        return $this;
    }

    /**
     * Add product to the Generator
     * 
     * @param aProduct     $product implemented of an abstract product class
     * @param int          $qty amount of a product in the cart.
     * 
     * @return iGenerator
     */
    public function addProduct(aProduct $product, int $qty) : void 
    {
        $this->_cart[] = [
            'product' => $product,
            'qty'     => $qty
        ];
    }

    /**
     * Write data about cities into a new sitemap file.
     * Write data about activities into a new sitemap file.
     * 
     * @param bool     $isPrint should generator prints result or just return
     * 
     * @return iGenerator
     * 
     * @throws GeneratorException  if unable to write a data into the file
     */
    public function generate(bool $isPrint = true) : string
    {

        $receipt     = '';
        $salesTaxes  = 0;
        $total       = 0;

        // Check if Receipt has attached taxes
        if (is_null($this->_tax)) {
            throw new GeneratorException('Tax for Receipt not implemented', GeneratorException::ERROR_CODE_NO_IMPLEMENTED_TAX);
        }

        // Check if Receipt has products
        if (empty($this->_cart)) {
            throw new GeneratorException('Products for Receipt not implemented', GeneratorException::ERROR_CODE_NO_IMPLEMENTED_PRODUCTS);
        }

        // Calculate total prices and taxes
        foreach ($this->_cart as $cartItem) {
            $calculatedPrice     = $cartItem['product']->price * $cartItem['qty'];
            $productTaxRate      = ($this->_tax->getRate($cartItem['product']->getProductCategory(), $cartItem['product']->is_imported));
            $productSalesTaxes   = round(($calculatedPrice * $productTaxRate / 100), 2);
            $salesTaxes          += $productSalesTaxes;
            $calculatedPrice     += $productSalesTaxes;
            $total               += $calculatedPrice;

            $receipt .= $cartItem['qty'] . ' ' . 
                        $cartItem['product']->name . ': ' . 
                        $this->_getPriceFormat($cartItem['product']->price, false) . ':' . 
                        $this->_getPriceFormat($calculatedPrice) . 
                        PHP_EOL;
        }

        // Finilaze total data
        $receipt .= 'Sales Taxes: ' . $this->_getPriceFormat($salesTaxes) . PHP_EOL .
                    'Total: ' . $this->_getPriceFormat($total) . PHP_EOL;

        if ($isPrint) {
            echo $receipt;
        }

        return $receipt;
    }

    /**
     * Gets price format for a receipt
     * 
     * @param float          $price number that shold be modified to the price format
     * 
     * @return float
     */
    private function _getPriceFormat(float $price) : string
    {
        return (string)number_format((float)$price, 2, '.', '');
    }
}
