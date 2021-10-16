<?php

class ProductImage extends DatabaseObject
{
    static protected $table_name = 'product_images';
    static protected $db_columns = ["id", "productId", "image"];

    public $id;
    public $productId;
    public $image;

    public function __construct($args = [])
    {
        $this->productId = $args['productId'] ?? '';
        $this->image = $args['image'] ?? '';
    }
}