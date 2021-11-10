<?php

class Cart extends DatabaseObject
{
    static protected $table_name = 'userCart';
    static protected $db_columns = ["id", "username", "productId", "quantity", "addedOn"];
    public $id;
    public $username;
    public $productId;
    public $quantity;
    public $addedOn;
    public $errors = [];
    public function __construct($args = [])
    {
        $this->username = $args['username'] ?? "";
        $this->productId = $args['productId'] ?? "";
        $this->quantity = $args['quantity'] ?? 1;
        $this->addedOn = $args['addedOn'] ?? date('Y-m-d H:i:s');
    }


    // Cout the numbers of items in your cart


    protected function validate()
    {
        $result = is_same_product($this->username, $this->productId);
        if (!$result['status'] == false && !$result['id'] == 0) {
            $this->id = (int) $result['id'];
        } else {
        }
    }

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








    // Delete a row in a database
    public function delete_by_cart_id($id)
    {
        $sql = "DELETE FROM " . static::$table_name;
        $sql .= " WHERE id='" . self::$db->escape_string($id) . "' limit 1;";
        $result = self::$db->query($sql);
        return $result;
    }

    public function clear_cart($username)
    {
        // Delete By user id in the db table
        $sql = "DELETE FROM " . static::$table_name;
        $sql .= " WHERE username='" . self::$db->escape_string($username) . "';";
        $result = self::$db->query($sql);
        return $result;
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

    static public function find_by_user_id($username)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " where username='" . self::$db->escape_string($username) . "';";
        return static::find_by_sql($sql);
    }
    static public function find_distinct_order()
    {
        $sql = "SELECT DISTINCT(username) FROM " . static::$table_name;
        $sql .= " where 1;";
        return static::find_by_sql($sql);
    }
}