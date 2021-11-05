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
}