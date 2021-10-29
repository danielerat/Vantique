<?php

class Category extends DatabaseObject
{
    static protected $table_name = 'category';
    static protected $db_columns = ["id", "categoryName", "addedOn"];

    public $id;
    public $categoryName;
    public $addedOn;

    public function __construct($args = [])
    {
        $this->categoryName = $args['categoryName'] ?? '';
        $this->addedOn = $args['addedOn'] ?? date('Y-m-d H:i:s');
    }

    static public function find_product_category($id)
    {
        $sql = "SELECT category.id,category.categoryName from category inner join ProductCategory on ProductCategory.categoryId=category.id ";
        $sql .= " where ProductCategory.productId ='" . self::$db->escape_string($id) . "';";
        return static::find_by_sql($sql);
    }
    static public function find_categories_by_ids($ids)
    {
        $id_array = join(",", $ids);
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " WHERE id IN (" . self::$db->escape_string($id_array) . ");";

        return static::find_by_sql($sql);
    }


    // Create A Record
    protected function create()
    {
        $this->validate();
        if (!empty($this->errors)) {
            return false;
        }
        $attributes = $this->sanitize_attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(',', array_keys($attributes));
        $sql .= ") values('";
        $sql .= join("','", array_values($attributes));
        $sql .= "');";
        // echo $sql;
        $result = self::$db->query($sql);
        if ($result) {
            $this->id = self::$db->insert_id;
        }
        return true;
    }

    protected function validate()
    {
        $this->errors = [];
        if (is_blank($this->categoryName)) {
            $this->errors[] = "Category Must Have A name.";
        } elseif (!has_length($this->categoryName, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Category Name is too short";
        }
    }
}