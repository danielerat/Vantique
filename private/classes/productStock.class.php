<?php

class ProductStock extends DatabaseObject
{
    static protected $table_name = 'productStock';
    static protected $db_columns = ["id", "productId", "quantity"];

    public $id;
    public $productId;
    public $quantity;
    public function __construct($args = [])
    {
        $this->productId = $args['productId'] ?? '';
        $this->quantity = $args['quantity'] ?? '';
    }
    static public function find_by_id($id)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " where productId='" . self::$db->escape_string($id) . "'";

        $object_array = static::find_by_sql($sql);
        if (!empty($object_array)) {
            // Since it's only one object then thre is no need to retrun a whole array with data 
            return array_shift($object_array);
        } else {
            return false;
        }
    }
}