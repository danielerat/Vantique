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
    static public function find_by_id($id)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " where productId='" . self::$db->escape_string($id) . "'";
        return static::find_by_sql($sql);
    }

    public function delete_by_product($id)
    {
        $sql = "DELETE FROM " . static::$table_name;
        $sql .= " WHERE productId='" . self::$db->escape_string($id) . "' ";
        $result = self::$db->query($sql);
        return $result;
    }
}