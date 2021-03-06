<?php

class ProductSubSubCategory extends DatabaseObject
{
    static protected $table_name = 'productSubSubCategory';
    static protected $db_columns = ["id", "productId", "subSubCategoryId"];

    public $id;
    public $productId;
    public $subSubCategoryId;
    public function __construct($args = [])
    {
        $this->productId = $args['productId'] ?? '';
        $this->subSubCategoryId = $args['subSubCategoryId'] ?? '';
    }





    static public function count_product_by_cat($categoryId)
    {
        $sql = "SELECT count(*) FROM " . static::$table_name;
        $sql .= " WHERE subSubCategoryId ='" . self::$db->escape_string($categoryId) . "';";
        /* Since we are going to find a single row with a single valur
         No need to call the fancy find_by_sql function 
        Instead we are goin to use a fetch array on a resultset*/
        $result_set = self::$db->query($sql);
        $row = $result_set->fetch_array();
        return array_shift($row);
    }
}