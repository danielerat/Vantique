<?php

class ProductSize extends DatabaseObject
{
    static protected $table_name = 'productSize';
    static protected $db_columns = ["id", "productId", "sizeId", "addedOn"];

    public $id;
    public $productId;
    public $sizeId;
    public $addedOn;
    public function __construct($args = [])
    {
        $this->productId = $args['productId'] ?? '';
        $this->sizeId = $args['sizeId'] ?? '';
        $this->addedOn = $args['addedOn'] ?? date('Y-m-d H:i:s');
    }
}