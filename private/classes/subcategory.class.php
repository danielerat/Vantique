<?php

class SubCategory extends DatabaseObject
{
    static protected $table_name = 'subCategory';
    static protected $db_columns = ["id", "parentId", "name", 'addedOn'];

    public $id;
    public $parentId;
    public $name;
    public $addedOn;

    public function __construct($args = [])
    {
        $this->parentId = $args['parentId'] ?? '';
        $this->name = $args['name'] ?? '';
        $this->addedOn = $args['addedOn'] ?? date('Y-m-d H:i:s');
    }

    static public function find_by_parent($id)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " where parentId='" . self::$db->escape_string($id) . "' ";
        // $sql .= " and active=1;";
        return static::find_by_sql($sql);
    }

    static public function find_product_category($id)
    {

        $sql = "SELECT subCategory.id,subCategory.name from subCategory INNER JOIN productSubCategory ON productSubCategory.subCategoryId=subCategory.id ";
        $sql .= " where productId ='" . self::$db->escape_string($id) . "';";
        return static::find_by_sql($sql);
    }


    // Count The Number Of Sup Category
    static public function count_by_parent($id)
    {
        $sql = "SELECT count(*) FROM " . static::$table_name;
        $sql .= " WHERE parentId ='" . self::$db->escape_string($id) . "';";
        $result_set = self::$db->query($sql);
        $row = $result_set->fetch_array();
        return array_shift($row);
    }
    static public function count_product_by_cat($categoryId)
    {
        $sql = "SELECT count(*) FROM " . static::$table_name;
        $sql .= " WHERE categoryId ='" . self::$db->escape_string($categoryId) . "';";
        /* Since we are going to find a single row with a single valur
         No need to call the fancy find_by_sql function 
        Instead we are goin to use a fetch array on a resultset*/
        $result_set = self::$db->query($sql);
        $row = $result_set->fetch_array();
        return array_shift($row);
    }
}