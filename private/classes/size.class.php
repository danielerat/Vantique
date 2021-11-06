<?php

class Size extends DatabaseObject
{
    static protected $table_name = 'sizes';
    static protected $db_columns = ["id", "name", 'type', "addedOn"];

    public $id;
    public $name;
    public $type;
    public $addedOn;
    public function __construct($args = [])
    {
        $this->name = $args['name'] ?? '';
        $this->type = $args['type'] ?? '';
        $this->addedOn = $args['addedOn'] ?? date('Y-m-d H:i:s');
    }
    static public function find_by_type($id)
    {
        $sql = "SELECT * from sizes ";
        $sql .= " where type ='" . self::$db->escape_string($id) . "';";
        return static::find_by_sql($sql);
    }

    static public function find_product_category($id)
    {
        $sql = "SELECT sizes.id,sizes.name from sizes inner join productSize on productSize.sizeId=sizes.id ";
        $sql .= " where productSize.productId ='" . self::$db->escape_string($id) . "';";
        return static::find_by_sql($sql);
    }
}