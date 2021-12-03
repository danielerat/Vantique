<?php

class Address extends DatabaseObject
{

    static protected $table_name = 'user_address';
    static protected $db_columns = ["id", "username", "province", "district", "sector", "street", "description", "active"];

    public $id;
    public $username;
    public $province;
    public $district;
    public $sector;
    public $street;
    public $description;
    public $active;
    public function __construct($args = [])
    {
        $this->username = $args['username'] ?? "";
        $this->province = $args['province'] ?? "";
        $this->district = $args['district'] ?? "";
        $this->sector = $args['sector'] ?? "";
        $this->street = $args['street'] ?? "";
        $this->description = $args['description'] ?? "";
        $this->active = $args['active'] ?? "0";
    }

    static public function find_address_by_username($username)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " where username='" . self::$db->escape_string($username) . "'";
        return static::find_by_sql($sql);
    }
    static public function find_last_address($username)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " where username='" . self::$db->escape_string($username) . "' order by id DESC limit 1";
        $object_array = static::find_by_sql($sql);
        if (!empty($object_array)) {
            // Since it's only one object then thre is no need to retrun a whole array with data 
            return array_shift($object_array);
        } else {
            return false;
        }
    }


    static public function set_primary_address($username, $id)
    {
        $sql = " UPDATE " . static::$table_name . " SET ";
        $sql .= " active='0' where username='" . self::$db->escape_string($username) . "';";
        $sql .= " UPDATE " . static::$table_name . " SET active=1 ";
        $sql .= " Where id='" . self::$db->escape_string($id) . "' and active='1' limit 1;";
        // $result = self::$db->query($sql);
        // return $result;
    }
}