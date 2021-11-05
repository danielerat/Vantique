<?php

class productBrand extends DatabaseObject
{
    static protected $table_name = 'productBrand';
    static protected $db_columns = ["id", "productId", "brandId", "addedOn"];

    public $id;
    public $productId;
    public $brandId;
    public $addedOn;
    public function __construct($args = [])
    {
        $this->productId = $args['productId'] ?? '';
        $this->brandId = $args['brandId'] ?? '';
        $this->addedOn = $args['addedOn'] ?? date('Y-m-d H:i:s');
    }
}