<?php

class Color extends DatabaseObject
{
    static protected $table_name = 'colors';
    static protected $db_columns = ["id", "name", "hex_value", "addedOn"];

    public $id;
    public $name;
    public $hex_value;
    public $addedOn;
    public function __construct($args = [])
    {
        $this->name = $args['name'] ?? '';
        $this->colorId = $args['hex_value'] ?? '';
        $this->addedOn = $args['addedOn'] ?? date('Y-m-d H:i:s');
    }
    static public function find_product_category($id)
    {
        $sql = "SELECT colors.id,colors.name,colors.hex_value from colors inner join productColor on productColor.colorId=colors.id ";
        $sql .= " where productColor.productId ='" . self::$db->escape_string($id) . "';";
        return static::find_by_sql($sql);
    }
}