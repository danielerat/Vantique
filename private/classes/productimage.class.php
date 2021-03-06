<?php

class ProductImage extends DatabaseObject
{
    static protected $table_name = 'productImage';
    static protected $db_columns = ["id", "productId", "image"];

    public $id;
    public $productId;
    public $image;

    public function __construct($args = [])
    {
        $this->productId = $args['productId'] ?? '';
        $this->image = $args['image'] ?? '';
    }





    public function delete_product_images($files)
    {
        $errors = [];
        foreach ($files as $file) {
            if (file_exists(PRIVATE_PATH . "/uploads/" . $file)) {
                if (file_exists(PRIVATE_PATH . "/uploads/thumb/" . $file)) {
                    if (unlink(PRIVATE_PATH . "/uploads/" . $file) && unlink(PRIVATE_PATH . "/uploads/thumb/" . $file)) {
                    } else {
                        $errors[] = "Permission Denied on File " . $file;
                    }
                }
            } else {
                $errors[] = "File " . $file . ' Was Not Deleted!';
            }
        }
        if (empty($errors)) {
            return true;
        }
        return $errors;
    }
}