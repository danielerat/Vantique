<?php

class OrderItem extends DatabaseObject
{

    static protected $table_name = 'orderItem';
    static protected $db_columns = ["id", "orderId", 'productId', 'quantity', "addedOn"];

    public $id;
    public $orderId;
    public $productId;
    public $quantity;
    public $addedOn;
    public function __construct($args = [])
    {
        $this->orderId = $args['orderId'] ?? "VT" . rand();
        $this->productId = $args['productId'] ?? "";
        $this->quantity = $args['quantity'] ?? "";
        $this->addedOn = $args['addedOn'] ?? date('Y-m-d H:i:s');
    }


    static public function find_all_item($id)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " Where orderId='" . self::$db->escape_string($id) . "';";
        return static::find_by_sql($sql);
    }
}