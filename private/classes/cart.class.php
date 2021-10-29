<?php

class Cart extends DatabaseObject
{
    static protected $table_name = 'userCart';
    static protected $db_columns = ["id", "userId", "productId", "quantity"];
    public $id;
    public $userId;
    public $productId;
    public $quantity;
    public $errors = [];
    public function __construct($args = [])
    {
        $this->userId = $args['userId'] ?? "";
        $this->productId = $args['productId'] ?? "";
        $this->quantity = $args['quantity'] ?? 1;
    }


    // Cout the numbers of items in your cart


    protected function validate()
    {
        $result = is_same_product($this->userId, $this->productId);
        if (!$result['status'] == false && !$result['id'] == 0) {
            $this->id = (int) $result['id'];
        } else {
        }
    }

    static public function find_existance($userId, $productId)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " where userId='" . self::$db->escape_string($userId) . "' and ";
        $sql .= " productId='" . self::$db->escape_string($productId) . "'; ";
        $object_array = static::find_by_sql($sql);
        if (!empty($object_array)) {
            // Since it's only one object then thre is no need to retrun a whole array with data 
            return array_shift($object_array);
        } else {
            return false;
        }
    }



    // Create A Record
    protected function create()
    {
        $attributes = $this->sanitize_attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(',', array_keys($attributes));
        $sql .= ") values('";
        $sql .= join("','", array_values($attributes));
        $sql .= "');";
        $result = self::$db->query($sql);
        if ($result) {
            $this->id = self::$db->insert_id;
        }
        return true;
    }


    // Update A Record
    protected function update()
    {
        $attributes = $this->sanitize_attributes();
        $attribute_pairs = [];
        foreach ($attributes as $key => $values) {
            $attribute_pairs[] = "{$key}='{$values}'";
        }
        $sql = " UPDATE " . static::$table_name . " SET ";
        $sql .= join(",", $attribute_pairs);
        $sql .= " Where id='" . self::$db->escape_string($this->id) . "' LIMIT 1;";
        $result = self::$db->query($sql);
        return $result;
    }
    // Determin If it's an update or a delete
    public function save()
    {
        // Check if the Order Already Exist
        $this->validate();
        // Update if it does Now
        if (isset($this->id)) {
            return $this->update();
        } else { //Insert New One if it does now
            return $this->create();
        }
    }

    // Delete a row in a database
    public function delete()
    {
        $sql = "DELETE FROM " . static::$table_name;
        $sql .= " WHERE id='" . self::$db->escape_string($this->id) . "' ";
        $sql .= "Limit 1";
        $result = self::$db->query($sql);
        return $result;
        // After Deleting the instance of the object it will still 
        // Exist , even though the database record does not 
        // this can be useful , as in : 
        // we can still use this $user->first_name. was Deleted.
        // Despite not having the record 
        // But we can not call $user->update() after calling delete 
    }

    static public function find_by_user_id($id)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        echo $sql .= " where userId='" . self::$db->escape_string($id) . "';";
        return static::find_by_sql($sql);
    }
}