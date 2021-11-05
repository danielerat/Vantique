<?php

class Brand extends DatabaseObject
{
    static protected $table_name = 'brands';
    static protected $db_columns = ["id", "name", "addedOn"];

    public $id;
    public $name;
    public $addedOn;
    public function __construct($args = [])
    {
        $this->name = $args['name'] ?? '';
        $this->addedOn = $args['addedOn'] ?? date('Y-m-d H:i:s');
    }
    static public function find_product_category($id)
    {
        $sql = "SELECT brands.id,brands.name from brands inner join productBrand on productBrand.brandId=brands.id ";
        $sql .= " where productBrand.productId ='" . self::$db->escape_string($id) . "';";
        return static::find_by_sql($sql);
    }
}