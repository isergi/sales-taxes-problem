<?php

namespace SalesTaxesTool\Tax;

use  SalesTaxesTool\Exceptions\TaxException;

class RevivaTax implements iTax
{

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
            throw new TaxException('Unable to open config file for tax "' . $fileName . '"', TaxException::ERROR_CODE_UNABLE_TO_FIND_FILE);
        }
        $this->_config = json_decode(file_get_contents($fileName), true);
    }

    /**
     * Read config data for taxes.
     * 
     * @return float
     */
    public function getRate(string $productCategory, $isImported = false) : int
    {
        $rate = (in_array($productCategory, $this->_config['default']['exclude'])) ? 0 : $this->_config['default']['rate'];

        if ($isImported) {
            $rate += $this->_config['imported']['rate'];
        }
        
        return $rate;
    }
}
