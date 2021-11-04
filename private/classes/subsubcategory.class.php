<?php

class SubSubCategory extends SubCategory
{
    static protected $table_name = 'subSubCategory';
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
}