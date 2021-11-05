<?php

class ProductColor extends DatabaseObject
{
    static protected $table_name = 'productColor';
    static protected $db_columns = ["id", "productId", "colorId", "addedOn"];

    public $id;
    public $productId;
    public $colorId;
    public $addedOn;
    public function __construct($args = [])
    {
        $this->productId = $args['productId'] ?? '';
        $this->colorId = $args['colorId'] ?? '';
        $this->addedOn = $args['addedOn'] ?? date('Y-m-d H:i:s');
    }


    //For the stock Table we will need to update the Quantity Only
    // protected function update()
    // {
    //     $sql = " UPDATE " . static::$table_name . " SET ";
    //     $sql .= " quantity='" . self::$db->escape_string($this->quantity) . "'";
    //     $sql .= " Where id='" . self::$db->escape_string($this->id) . "' limit 1";
    //     $result = self::$db->query($sql);
    //     return $result;
    // }
}