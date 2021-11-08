<?php

class Wishlist extends DatabaseObject
{
    static protected $table_name = 'wishlist';
    static protected $db_columns = ["id", "username", "productId", "addedOn"];
    public $id;
    public $username;
    public $productId;
    public $addedOn;
    public $errors = [];
    public function __construct($args = [])
    {
        $this->username = $args['username'] ?? "";
        $this->productId = $args['productId'] ?? "";
        $this->addedOn = $args['addedOn'] ?? 1;
    }


    // Cout the numbers of items in your cart

    static public function find_existance($username, $productId)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " where username='" . self::$db->escape_string($username) . "' and ";
        $sql .= " productId='" . self::$db->escape_string($productId) . "'; ";
        $object_array = static::find_by_sql($sql);
        if (!empty($object_array)) {
            // Since it's only one object then thre is no need to retrun a whole array with data 
            return array_shift($object_array);
        } else {
            return false;
        }
    }




    static public function count_all()
    {
        $sql = "SELECT count(*) FROM " . static::$table_name;
        $sql .= " WHERE username ='" . self::$db->escape_string($_SESSION['username']) . "' ";
        $result_set = self::$db->query($sql);
        $row = $result_set->fetch_array();
        $result_set->free();
        return array_shift($row);
    }

    static public function find_by_user_id($id)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " where username='" . self::$db->escape_string($id) . "';";
        return static::find_by_sql($sql);
    }
}