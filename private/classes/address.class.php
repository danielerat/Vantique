<?php

class Address extends DatabaseObject
{

    static protected $table_name = 'user_address';
    static protected $db_columns = ["id", "username", "province", "district", "sector", "description"];

    public $id;
    public $username;
    public $province;
    public $district;
    public $sector;
    public $description;
    public function __construct($args = [])
    {
        $this->username = $args['username'] ?? "";
        $this->province = $args['province'] ?? "";
        $this->district = $args['district'] ?? "";
        $this->sector = $args['sector'] ?? "";
        $this->description = $args['description'] ?? "";
    }

    static public function find_address_by_username($username)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " where username='" . self::$db->escape_string($username) . "'";
        return static::find_by_sql($sql);
    }
}