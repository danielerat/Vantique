<?php

class Category extends DatabaseObject
{
    static protected $table_name = 'category';
    static protected $db_columns = ["id", "CategoryName"];

    public $id;
    public $CategoryName;

    public function __construct($args = [])
    {
        $this->CategoryName = $args['CategoryName'] ?? '';
    }
}