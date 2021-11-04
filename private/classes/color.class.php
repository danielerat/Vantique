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
}