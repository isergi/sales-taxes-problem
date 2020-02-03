<?php

namespace SalesTaxesTool\Product;

/**
 * Just a class keeping names of categories. Should be moved in database storage.
 */
class Category
{
    const CATEGORY_NAME_BOOK     = 'books',
          CATEGORY_NAME_FOOD     = 'food',
          CATEGORY_NAME_PERFUME  = 'perfume',
          CATEGORY_NAME_MEDICAL  = 'medical',
          CATEGORY_NAME_MUSIC    = 'music';
    
    /**
     * @TODO: Should be removed in real life. Because it's too hardcoded for the example.
     *        And should be changed in database storage. 
     * 
     * @structure [%PRODUCT_NAME% => %CATEGORY_NAME%]
     */
    static $productCategoriesByName = [
        'book'                       => self::CATEGORY_NAME_BOOK,
        'music CD'                   => self::CATEGORY_NAME_MUSIC,
        'chocolate bar'              => self::CATEGORY_NAME_FOOD,
        'imported box of chocolates' => self::CATEGORY_NAME_FOOD,
        'imported bottle of perfume' => self::CATEGORY_NAME_PERFUME,
        'bottle of perfume'          => self::CATEGORY_NAME_PERFUME,
        'packet of headache pills'   => self::CATEGORY_NAME_MEDICAL,
        'box of imported chocolates' => self::CATEGORY_NAME_FOOD,
    ];
}