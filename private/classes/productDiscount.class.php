<?php

class ProductDiscount extends DatabaseObject
{
    static protected $table_name = 'productDiscount';
    static protected $db_columns = ["id", "productId", "discount_value", "valid_from", "valid_to", "addedOn", "active"];
    public $id;
    public $productId;
    public $discount_value;
    public $valid_from;
    public $valid_to;
    public $addedOn;
    public $active;
    public function __construct($args = [])
    {
        $this->productId = $args['productId'] ?? '';
        $this->discount_value = $args['discount_value'] ?? '';
        $this->valid_from = $args['valid_from'] ?? '';
        $this->valid_to = $args['valid_to'] ?? '';
        $this->addedOn = $args['addedOn'] ?? date('Y-m-d H:i:s');
        $this->active = $args['active'] ?? '';
    }
}