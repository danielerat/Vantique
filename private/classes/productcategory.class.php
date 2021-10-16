<?php

class ProductCategory extends DatabaseObject
{
    static protected $table_name = 'ProductCategory';
    static protected $db_columns = ["id", "productId", "CategoryId"];

    public $id;
    public $productId;
    public $CategoryId;

    public function __construct($args = [])
    {
        $this->productId = $args['productId'] ?? '';
        $this->CategoryId = $args['CategoryId'] ?? '';
    }
}