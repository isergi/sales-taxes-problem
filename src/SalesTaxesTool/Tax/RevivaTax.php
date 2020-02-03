<?php

namespace SalesTaxesTool\Tax;

use  SalesTaxesTool\Excpeptions\TaxExcpeption;

class RevivaTax implements iTax
{

    /**
     * Return this code error when ubable to create a hande to the sitemap file
     */
    const ERROR_CODE_UNABLE_OPEN_FILE = 210;

    /**
     * Config for tax
     * Structure:
     *     [default] => Array
     *     (
     *        [rate] => ...
     *        [exclude] => Array
     *         (
     *         ...
     *         )
     *     )
     *     [imported] => Array
     *     (
     *            [rate] => ...
     *     )
     */
    private $_config = [];

    /**
     * Import configuration to the RevivaTax structure
     * 
     * @param string        $fileName  a path to the json config file
     * 
     * @throws GeneratorException  if unable to write a data into the file
     */
    public function __construct(string $fileName)
    {
        if (!file_exists($fileName)) {
            throw new TaxException('Unable to open config file for tax "' . $fileName . '"', self::ERROR_CODE_UNABLE_OPEN_FILE);
        }
        $this->_config = json_decode(file_get_contents($fileName), true);
    }

    /**
     * Read config data for taxes.
     * 
     * @return float
     */
    public function getRate(string $productType, $isImported = false) : int
    {
        $rate = 0;

        if (in_array($productType, $this->_config['default']['exclude'])) {
            ;
        }

        return 10;
    }
}
