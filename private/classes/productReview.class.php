<?php

class ProductReview extends DatabaseObject
{
    static protected $table_name = 'productReview';
    static protected $db_columns = ["id", "star", "productId", "names", "email", "title", "review", "addedOn"];


    public $id;
    public $star;
    public $productId;
    public $names;
    public $email;
    public $title;
    public $review;
    public $addedOn;
    public function __construct($args = [])
    {

        $this->star = $args['star'] ?? '4';
        $this->productId = $args['productId'] ?? '';
        $this->names = $args['names'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->title = $args['title'] ?? '';
        $this->review = $args['review'] ?? '';
        $this->addedOn = $args['addedOn'] ?? date('Y-m-d H:i:s');
    }

    static public function count_by_product($id)
    {
        $sql = "SELECT count(*) as count FROM " . static::$table_name;
        $sql .= " WHERE productId ='" . self::$db->escape_string($id) . "' ";
        $result_set = self::$db->query($sql);
        $row = $result_set->fetch_array();
        $result_set->free();
        return array_shift($row);
    }
}