<?php

class Product extends DatabaseObject
{

    static protected $table_name = 'product';
    static protected $db_columns = ["id", "ProductName", "ProductPrice", "ProductDesc", "ProductThumb", "ProductUnlimited", "ProductUploadDate"];

    public $id;
    public $ProductName;
    public $ProductPrice;
    public $ProductCategory = [];
    public $ProductDesc;
    public $ProductThumb;
    public $ProductUnlimited;
    public $ProductUploadDate;

    //Used TO hold All Thumbnails
    public $ProductThumbnails = [];

    public const CONDITION_OPTIONS = [
        1 => 'Beat up',
        2 => 'Decent',
        3 => 'Good',
        4 => 'Great',
        5 => 'Like New'
    ];

    public function __construct($args = [])
    {
        $this->ProductName = $args['ProductName'] ?? '';
        $this->ProductPrice = $args['ProductPrice'] ?? '';
        $this->ProductDesc = $args['ProductDesc'] ?? '';
        $this->ProductThumb = $args['ProductThumb'] ?? '';
        $this->ProductUnlimited = $args['ProductUnlimited'] ?? '1';
        $this->ProductUploadDate = $args['ProductUploadDate'] ?? date('Y-m-d H:i:s');
        // Caution: allows private/protected properties to be set
        // foreach($args as $k => $v) {
        //   if(property_exists($this, $k)) {
        //     $this->$k = $v;
        //   }
        // }
    }

    // public function name()
    // {
    //     return "{$this->brand} {$this->model} {$this->year}";
    // }
    // public function weight_kg()
    // {
    //     return number_format($this->weight_kg, 2) . ' kg';
    // }

    // public function set_weight_kg($value)
    // {
    //     $this->weight_kg = floatval($value);
    // }

    // public function weight_lbs()
    // {
    //     $weight_lbs = floatval($this->weight_kg) * 2.2046226218;
    //     return number_format($weight_lbs, 2) . ' lbs';
    // }

    // public function set_weight_lbs($value)
    // {
    //     $this->weight_kg = floatval($value) / 2.2046226218;
    // }

    // public function condition()
    // {
    //     if ($this->condition_id > 0) {
    //         return self::CONDITION_OPTIONS[$this->condition_id];
    //     } else {
    //         return "Unknown";
    //     }
    // }



    // Create A Record
    protected function create()
    {
        $this->validate();
        if (!empty($this->errors)) {
            return False;
        }
        $attributes = $this->sanitize_attributes();
        unset($attributes["ProductUploadDate"]);
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(',', array_keys($attributes));
        $sql .= ") values('";
        $sql .= join("','", array_values($attributes));
        $sql .= "');";

        $result = self::$db->query($sql);
        if ($result) {
            $this->id = self::$db->insert_id;
            foreach ($this->ProductCategory as $test) {
                $InsertCategory = new ProductCategory(["productId" => $this->id, "CategoryId" => $test]);
                $InsertCategory->save();
            }
            foreach ($this->ProductThumbnails as $thumb) {
                $InsertCategory = new ProductImage(["productId" => $this->id, "image" => $thumb]);
                $InsertCategory->save();
            }
        }
        return $result;
    }





    protected function validate()
    {
        $this->errors = [];
        if (is_blank($this->ProductName)) {
            $this->errors[] = "Name cannot be blank.";
        } elseif (!has_length($this->ProductName, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Product Name Must have A bigger length than 2";
        }
        if (is_blank($this->ProductPrice)) {
            $this->errors[] = "Product Must Have A price";
        } elseif (!is_an_integer($this->ProductPrice)) {
            $this->errors[] = "Price Must Be Given As A number ";
        }
        if (is_blank($this->ProductDesc)) {
            $this->errors[] = "Must Have A description";
        } elseif (!has_length_greater_than($this->ProductDesc, 10)) {
            $this->errors[] = "Product Name Must have A bigger Description at least 10 Characted";
        }

        return $this->errors;
    }
}