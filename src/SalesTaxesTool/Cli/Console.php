<?php

namespace SalesTaxesTool\Cli;

/**
 * "Console" is a tool of a command line interface.
 */
class Console extends \Commando\Command
{
    /**
     * Make initialization of a base commands and flags. 
     * Make a description and usage of a Sales Taxes tool.
     */
    public function __construct()
    {
        // Base description and usage of the tool
        $this->setHelp(
            '      A simple tool that prints out the receipt details' . 
            PHP_EOL . PHP_EOL . PHP_EOL .
            'USAGE: ' . 
            PHP_EOL . PHP_EOL . '      ./sales-taxes-tool -i [file ..] print out the receipt' . PHP_EOL . 
            'OPTIONS:'
        );
        
        $this->option('i')
             ->aka('input')
             ->describedAs('Path to the input file.')
             ->require();

        parent::__construct();
    }
}
