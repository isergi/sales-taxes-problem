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
     * @return iGenerator
     * 
     * @throws GeneratorException  if unable to write a data into the file
     */
    public function generate() : iGenerator
    {

        $salesTaxes  = '';
        $total       = 0;

        if (is_null($this->_tax)) {
            throw new GeneratorException('Tax for Receipt not implemented', GeneratorException::ERROR_CODE_NO_IMPLEMENTED_TAX);
        }

        if (empty($this->_cart)) {
            throw new GeneratorException('Products for Receipt not implemented', GeneratorException::ERROR_CODE_NO_IMPLEMENTED_PRODUCTS);
        }

        foreach ($this->_cart as $cartItem) {
            $total += $cartItem['product']->price;
            echo $cartItem['qty'], ' ', $cartItem['product']->name, ': ', $cartItem['product']->price, PHP_EOL;
            $salesTaxes .= '__' . $this->_tax->getRate($cartItem['product']->getProductCategory(), $cartItem['product']->is_imported);
        }

        echo 'Sales Taxes: ', $salesTaxes, PHP_EOL,
             'Total: ', $total, PHP_EOL;

        return $this;
    }
}
