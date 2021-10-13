<?php

class Bicycle extends DatabaseObject
{

    static protected $table_name = 'product';
    static protected $db_columns = ["ProductId", "ProductName", "ProductCategory", "ProductPrice", "productDesc", "ProductThumb", "ProductUnlimited", "ProductUploadDate"];

    public $ProductId;
    public $ProductName;
    public $ProductCategory;
    public $ProductPrice;
    public $productDesc;
    public $ProductThumb;
    public $ProductUnlimited;
    public $ProductUploadDate;








    public const CATEGORIES = ['Road', 'Mountain', 'Hybrid', 'Cruiser', 'City', 'BMX'];

    public const GENDERS = ['Mens', 'Womens', 'Unisex'];

    public const CONDITION_OPTIONS = [
        1 => 'Beat up',
        2 => 'Decent',
        3 => 'Good',
        4 => 'Great',
        5 => 'Like New'
    ];

    public function __construct($args = [])
    {
        $this->ProductName = $args['model'] ?? '';
        $this->ProductCategory = $args['year'] ?? '';
        $this->ProductPrice = $args['category'] ?? '';
        $this->productDesc = $args['color'] ?? '';
        $this->ProductThumb = $args['description'] ?? '';
        $this->ProductUnlimited = $args['gender'] ?? '';
        $this->ProductUploadDate = $args['price'] ?? 0;
        $this->weight_kg = $args['weight_kg'] ?? 0.0;
        $this->condition_id = $args['condition_id'] ?? 3;

        // Caution: allows private/protected properties to be set
        // foreach($args as $k => $v) {
        //   if(property_exists($this, $k)) {
        //     $this->$k = $v;
        //   }
        // }
    }

    public function name()
    {
        return "{$this->brand} {$this->model} {$this->year}";
    }
    public function weight_kg()
    {
        return number_format($this->weight_kg, 2) . ' kg';
    }

    public function set_weight_kg($value)
    {
        $this->weight_kg = floatval($value);
    }

    public function weight_lbs()
    {
        $weight_lbs = floatval($this->weight_kg) * 2.2046226218;
        return number_format($weight_lbs, 2) . ' lbs';
    }

    public function set_weight_lbs($value)
    {
        $this->weight_kg = floatval($value) / 2.2046226218;
    }

    public function condition()
    {
        if ($this->condition_id > 0) {
            return self::CONDITION_OPTIONS[$this->condition_id];
        } else {
            return "Unknown";
        }
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->brand)) {
            $this->errors[] = "Brand cannot be blank.";
        }
        if (is_blank($this->model)) {
            $this->errors[] = "Model cannot be blank.";
        }
        return $this->errors;
    }
}