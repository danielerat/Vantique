<?php

class product extends DatabaseObject
{

    static protected $table_name = 'product';
    static protected $db_columns = ["id", "productName", "productPrice", "productDesc", "productThumb", "productUnlimited", "addedBy", "productUploadDate"];

    public $id;
    public $productName;
    public $productPrice;
    public $productCategory = [];
    public $productDesc;
    public $productThumb;
    public $productUnlimited;
    public $addedBy;
    public $productUploadDate;

    //Array Used to hold values from other Tables
    public $productThumbnails = [];
    public $productColor = [];
    public $productBrand = [];
    public $productSize = [];
    public $productSubCategory = [];
    public $productSubSubCategory = [];

    public const CONDITION_OPTIONS = [
        1 => 'Beat up',
        2 => 'Decent',
        3 => 'Good',
        4 => 'Great',
        5 => 'Like New'
    ];

    public function __construct($args = [])
    {
        $this->productName = $args['productName'] ?? '';
        $this->productCategory = $args['productCategory'] ?? "";
        $this->productSubCategory = $args['productSubCategory'] ?? "";
        $this->productSubSubCategory = $args['productSubSubCategory'] ?? "";
        $this->productColor = $args['productColor'] ?? "";
        $this->productBrand = $args['productBrand'] ?? "";
        $this->productSize = $args['productSize'] ?? "";
        $this->productPrice = $args['productPrice'] ?? '';
        $this->productDesc = $args['productDesc'] ?? '';
        $this->productThumb = $args['productThumb'] ?? '';
        $this->productUnlimited = $args['productUnlimited'] ?? 'x';
        $this->addedBy = $args['addedBy'] ?? 'administrator';
        $this->productUploadDate = $args['productUploadDate'] ?? date('Y-m-d H:i:s');
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



    // Update A Record
    protected function update()
    {
        //Get the sanitized version of our attributes 
        // $this->validate();
        // if (!empty($this->errors)) {
        //     return "False";
        // }

        $quantity = $this->productUnlimited;
        if ($this->productUnlimited === 'x' || !is_an_integer($this->productUnlimited)) {
            $this->productUnlimited = 1;
        } else {
            $this->productUnlimited = 0;
        }

        $attributes = $this->sanitize_attributes();
        $attribute_pairs = [];

        //Create a String like of attributes pairs
        foreach ($attributes as $key => $values) {
            $attribute_pairs[] = "{$key}='{$values}'";
        }

        $sql = " UPDATE " . static::$table_name . " SET ";
        //Joing them with , : brand='',model='',..... 
        $sql .= join(",", $attribute_pairs);
        $sql .= " Where id='" . self::$db->escape_string($this->id) . "'";
        $result = self::$db->query($sql);
        if ($result) {
            $stock = ProductStock::find_by_product_id($this->id);
            $stock->quantity = $quantity;
            $result = $stock->save();
            return $result;
        }
        return false;
    }

    // Create A Record
    protected function create()
    {
        $this->validate();
        if (!empty($this->errors)) {
            return False;
        }



        $quantity = $this->productUnlimited;
        if ($this->productUnlimited === 'x' || !is_an_integer($this->productUnlimited)) {
            $this->productUnlimited = 1;
        } else {
            $this->productUnlimited = 0;
        }


        $attributes = $this->sanitize_attributes();
        unset($attributes["productUploadDate"]); //Has A default in the database
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(',', array_keys($attributes));
        $sql .= ") values('";
        $sql .= join("','", array_values($attributes));
        $sql .= "');";

        $result = self::$db->query($sql);
        if ($result) {
            $this->id = self::$db->insert_id;
            $stock = new ProductStock(["productId" => $this->id, "quantity" => $quantity]);

            if ($stock->save()) {
                foreach ($this->productCategory as $test) {
                    $InsertCategory = new ProductCategory(["productId" => $this->id, "categoryId" => $test]);
                    $InsertCategory->save();
                }
                foreach ($this->productThumbnails as $thumb) {
                    $InsertThumbnail = new ProductImage(["productId" => $this->id, "image" => $thumb]);
                    $InsertThumbnail->save();
                }
                foreach ($this->productColor as $c) {
                    $productColor = new ProductColor(["productId" => $this->id, "colorId" => $c]);
                    $productColor->save();
                }

                foreach ($this->productBrand as $brand) {
                    $pb = new ProductBrand(["productId" => $this->id, "brandId" => $brand]);
                    $pb->save();
                }
                foreach ($this->productSize as $size) {
                    $ps = new ProductSize(["productId" => $this->id, "sizeId" => $brand]);
                    $ps->save();
                }
                foreach ($this->productSubCategory as $s) {
                    $productSub = new ProductSubCategory(["productId" => $this->id, "subCategoryId" => $s]);
                    $productSub->save();
                }
                foreach ($this->productSubSubCategory as $ss) {
                    $productSubSub = new ProductSubSubCategory(["productId" => $this->id, "subSubCategoryId" => $ss]);
                    $productSubSub->save();
                }
            }
        }
        return $result;
    }


    protected function validate()
    {
        $this->errors = [];
        if (is_blank($this->productName)) {
            $this->errors[] = "Name cannot be blank.";
        } elseif (!has_length($this->productName, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "product Name Must have A bigger length than 2";
        }
        if (is_blank($this->productPrice)) {
            $this->errors[] = "product Must Have A price";
        } elseif (!is_an_integer($this->productPrice)) {
            $this->errors[] = "Price Must Be Given As A number ";
        }
        if (is_blank($this->productDesc)) {
            $this->errors[] = "Must Have A description";
        } elseif (!has_length_greater_than($this->productDesc, 10)) {
            $this->errors[] = "product Name Must have A bigger Description at least 10 Characted";
        }
        if (is_blank($this->productUnlimited)) {
            $this->errors[] = "Must Have A Quantity";
        } elseif (!$this->productUnlimited === "x" && !is_an_integer($this->productUnlimited)) {
            $this->errors[] = "Quantity Must Be an Integer";
        }

        return $this->errors;
    }










    // Validation and image Processin Functions 
    public const IMAGE_HANDLERS = [
        IMAGETYPE_JPEG => [
            'load' => 'imagecreatefromjpeg',
            'save' => 'imagejpeg',
            'quality' => 0
        ],
        IMAGETYPE_PNG => [
            'load' => 'imagecreatefrompng',
            'save' => 'imagepng',
            'quality' => 9
        ],
        IMAGETYPE_GIF => [
            'load' => 'imagecreatefromgif',
            'save' => 'imagegif',
            'quality' => 0
        ]
    ];


    static function createThumbnail($src, $dest, $targetWidth, $targetHeight = null)
    {
        // 1. Load the image from the given $src
        // - see if the file actually exists
        // - check if it's of a valid image type
        // - load the image resource

        // get the type of the image
        // we need the type to determine the correct loader
        $type = exif_imagetype($src);

        // if no valid type or no handler found -> exit
        if (!$type || !self::IMAGE_HANDLERS[$type]) {
            return null;
        }

        // load the image with the correct loader
        $image = call_user_func(self::IMAGE_HANDLERS[$type]['load'], $src);

        // no image found at supplied location -> exit
        if (!$image) {
            return null;
        }


        // 2. Create a thumbnail and resize the loaded $image
        // - get the image dimensions
        // - define the output size appropriately
        // - create a thumbnail based on that size
        // - set alpha transparency for GIFs and PNGs
        // - draw the final thumbnail

        // get original image width and height
        $width = imagesx($image);
        $height = imagesy($image);

        // maintain aspect ratio when no height set
        if ($targetHeight == null) {

            // get width to height ratio
            $ratio = $width / $height;

            // if is portrait
            // use ratio to scale height to fit in square
            if ($width > $height) {
                $targetHeight = floor($targetWidth / $ratio);
            }
            // if is landscape
            // use ratio to scale width to fit in square
            else {
                $targetHeight = $targetWidth;
                $targetWidth = floor($targetWidth * $ratio);
            }
        }

        // create duplicate image based on calculated target size
        $thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);

        // set transparency options for GIFs and PNGs
        if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_PNG) {

            // make image transparent
            imagecolortransparent(
                $thumbnail,
                imagecolorallocate($thumbnail, 0, 0, 0)
            );

            // additional settings for PNGs
            if ($type == IMAGETYPE_PNG) {
                imagealphablending($thumbnail, false);
                imagesavealpha($thumbnail, true);
            }
        }

        // copy entire source image to duplicate image and resize
        imagecopyresampled(
            $thumbnail,
            $image,
            0,
            0,
            0,
            0,
            $targetWidth,
            $targetHeight,
            $width,
            $height
        );


        // 3. Save the $thumbnail to disk
        // - call the correct save method
        // - set the correct quality level

        // save the duplicate version of the image to disk
        return call_user_func(
            self::IMAGE_HANDLERS[$type]['save'],
            $thumbnail,
            $dest,
            self::IMAGE_HANDLERS[$type]['quality']
        );
    }

    static public function image_validation_check($target_file = [], $imageNumber)
    {
        $error = [];
        $imageFileType = [];
        for ($i = 0; $i < $imageNumber; $i++) {
            $imageFileType = strtolower(pathinfo($_FILES["productThumb"]["name"][$i], PATHINFO_EXTENSION));

            // Check If Image Is In The Allowed Formats
            if (
                $imageFileType != "png"  && $imageFileType != "gif"
            ) {
                $error[] =  "Sorry, only  PNG & GIF files are allowed.";
            }
            // Check Check Is Selected File is An image
            $check = getimagesize($_FILES["productThumb"]["tmp_name"][$i]);
            if ($check == false) {
                $error[] = "Sorry, File " . ($i + 1) . " Is Not An Image File";
            }
            // Check If Image Size Is Not Bigger Than 10MB
            if ($_FILES["productThumb"]["size"][$i] > 10000000) {
                $error[] =  "Sorry, Image " . $i . " Is Way Too big .";
            }
        }
        return $error;
    }


    static public function upload_image()
    {
        $imageNumber = count($_FILES["productThumb"]["name"]);
        $newName = uniqid() . "-" . time();

        $filename = [];
        for ($i = 0; $i < $imageNumber; $i++) {
            $filename[] = PRIVATE_PATH . "/uploads/" . $newName . $i; // Uploads/5dab1961e93a7-1571494241
        }
        $imageFileType = [];
        for ($i = 0; $i < $imageNumber; $i++) {
            $imageFileType[] = strtolower(pathinfo($_FILES["productThumb"]["name"][$i], PATHINFO_EXTENSION));
        }
        $target_file = [];
        for ($i = 0; $i < $imageNumber; $i++) {
            $target_file[] = $filename[$i] . "." . $imageFileType[$i]; //Uploads/323-32.jph
        }

        $erros =  self::image_validation_check($target_file, $imageNumber);

        if (!empty($erros)) {
            return ["formatError" => $erros];
        }

        $sucessUpload = [];
        for ($i = 0; $i < $imageNumber; $i++) {
            if (move_uploaded_file($_FILES["productThumb"]["tmp_name"][$i], $target_file[$i])) {
                $thumb_destination = str_replace("uploads", "uploads/thumb", $target_file[$i]);
                $thumb = self::createThumbnail($target_file[$i], $thumb_destination, 50, 50);
                $sucessUpload[] = str_replace(PRIVATE_PATH . "/uploads/", "", $target_file[$i]);
            } else {
                $sucessUpload[] = ["uploadStatus" => false];
            }
        }
        return $sucessUpload;
    }


    static public function ChangeFeatureImage($thumb, $id)
    {
        $sql = " UPDATE " . static::$table_name . " SET ";
        $sql .= "productThumb='" . self::$db->escape_string($thumb) . "'";
        $sql .= " Where id='" . self::$db->escape_string($id) . "' limit 1;";
        $result = self::$db->query($sql);
        return $result;
    }

    static public function find_same_category($id)
    {
        $sql = "SELECT product.id, product.productName, product.productPrice, product.productDesc, product.productThumb, product.productUnlimited, product.addedBy, product.productUploadDate from product inner join productSubSubCategory on productSubSubCategory.productId=product.id ";
        $sql .= " where productSubSubCategory.subSubCategoryId ='" . self::$db->escape_string($id) . "';";
        return static::find_by_sql($sql);
    }
    static public function find_all_by_Category($id = [])
    {
        $sql = "SELECT product.id, product.productName, product.productPrice, product.productDesc, product.productThumb, product.productUnlimited, product.addedBy, product.productUploadDate from product inner join productCategory on productCategory.productId=product.id ";
        $sql .= " where productCategory.categoryId in (";
        $sql .= join(",", $id);
        $sql .= ");";
        return static::find_by_sql($sql);
    }
    // find product by a sub category
    static public function find_all_by_SubCategory($id = [])
    {
        $sql = "SELECT product.id, product.productName, product.productPrice, product.productDesc, product.productThumb, product.productUnlimited, product.addedBy, product.productUploadDate from product inner join productSubCategory on productSubCategory.productId=product.id ";
        $sql .= " where productSubCategory.subCategoryId in (";
        $sql .= join(",", $id);
        $sql .= ");";
        return static::find_by_sql($sql);
    }

    // find product by a given sub sub category 
    static public function find_all_by_subSubCategory($id = [])
    {
        $sql = "SELECT product.id, product.productName, product.productPrice, product.productDesc, product.productThumb, product.productUnlimited, product.addedBy, product.productUploadDate from product inner join productSubSubCategory on productSubSubCategory.productId=product.id ";
        $sql .= " where productSubSubCategory.subSubCategoryId in (";
        $sql .= join(",", $id);
        $sql .= ");";
        return static::find_by_sql($sql);
    }

    static public function find_all_randomly()
    {
        $sql = "SELECT * FROM " . static::$table_name . " ORDER BY RAND()";
        return static::find_by_sql($sql);
    }
    static public function search($keyword)
    {
        $sql = "SELECT * FROM product
        WHERE MATCH (productName,productDesc)
        AGAINST ('" . self::$db->escape_string($keyword) . "' IN NATURAL LANGUAGE MODE);";
        return static::find_by_sql($sql);
    }
}