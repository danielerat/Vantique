<?php

function url_for($script_path)
{
    // add the leading '/' if not present
    if ($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
}

function u($string = "")
{
    return urlencode($string);
}

function raw_u($string = "")
{
    return rawurlencode($string);
}

function h($string = "")
{
    return htmlspecialchars($string);
}

function error_404()
{
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    exit();
}

function error_500()
{
    header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
    exit();
}

function redirect_to($location)
{
    header("Location: " . $location);
    exit;
}

function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}








// Image Upload Functions
//Image Upload function
/*
function image_validation_check($target_file)
{
    $error = [];
    $mp = 0;
    $imageFileType = strtolower(pathinfo($_FILES["ProductThumb"]["name"], PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["ProductThumb"]["tmp_name"]);
    if ($check !== false) {
    } else {
        $error[] = "File is not an image.";
    }
    //  Check if file already exists
    //     if (file_exists($target_file)) {
    //         $error[]= "Sorry, file already exists.";
    //         $uploadOk = 0;
    //     }

    // Check file size
    if ($_FILES["ProductThumb"]["size"] > 10000000) {
        $error[] =  "Sorry, your file is too large.";
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $error[] =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
    return $error;
}
function upload_image()
{
    $newName = uniqid() . "-" . time();
    $filename   = PRIVATE_PATH . "/uploads/" . $newName; // 5dab1961e93a7-1571494241
    $imageFileType = strtolower(pathinfo($_FILES["ProductThumb"]["name"], PATHINFO_EXTENSION));
    $target_file = $filename . "." . $imageFileType;
    $errors = image_validation_check($target_file);

    // If there was an error with the file then return the  errors 
    if (!empty($errors)) {
        $sucessUpload = array("uploadStatus" => "false", "errors" => $errors);
        return $sucessUpload;
    } else {
        if (move_uploaded_file($_FILES["ProductThumb"]["tmp_name"], $target_file)) {
            $sucessUpload = array("uploadStatus" => "true", "filename" => "$newName" . "." . "$imageFileType");
            return $sucessUpload;
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    }
    $sucessUpload = array("uploadStatus" => "false", "errors" => $errors);
    return $sucessUpload;
}


*/




const IMAGE_HANDLERS = [
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


function createThumbnail($src, $dest, $targetWidth, $targetHeight = null)
{

    // 1. Load the image from the given $src
    // - see if the file actually exists
    // - check if it's of a valid image type
    // - load the image resource

    // get the type of the image
    // we need the type to determine the correct loader
    $type = exif_imagetype($src);

    // if no valid type or no handler found -> exit
    if (!$type || !IMAGE_HANDLERS[$type]) {
        return null;
    }

    // load the image with the correct loader
    $image = call_user_func(IMAGE_HANDLERS[$type]['load'], $src);

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
        IMAGE_HANDLERS[$type]['save'],
        $thumbnail,
        $dest,
        IMAGE_HANDLERS[$type]['quality']
    );
}



function image_validation_check($target_file = [], $imageNumber)
{
    $error = [];
    $mp = 0;
    $imageFileType = [];
    for ($i = 0; $i < $imageNumber; $i++) {
        $imageFileType = strtolower(pathinfo($_FILES["ProductThumb"]["name"][$i], PATHINFO_EXTENSION));

        // Check If Image Is In The Allowed Formats
        if (
            $imageFileType != "png"  && $imageFileType != "gif"
        ) {
            $error[] =  "Sorry, only  PNG & GIF files are allowed.";
        }
        // Check Check Is Selected File is An image
        $check = getimagesize($_FILES["ProductThumb"]["tmp_name"][$i]);
        if ($check == false) {
            $error[] = "Sorry, File " . ($i + 1) . " Is Not An Image File";
        }
        // Check If Image Size Is Not Bigger Than 10MB
        if ($_FILES["ProductThumb"]["size"][$i] > 10000000) {
            $error[] =  "Sorry, Image " . $i . " Is Way Too big .";
        }
    }
    return $error;
}


function upload_image()
{
    $imageNumber = count($_FILES["ProductThumb"]["name"]);
    $newName = uniqid() . "-" . time();

    $filename = [];
    for ($i = 0; $i < $imageNumber; $i++) {
        $filename[] = PRIVATE_PATH . "/uploads/" . $newName . $i; // Uploads/5dab1961e93a7-1571494241
    }
    $imageFileType = [];
    for ($i = 0; $i < $imageNumber; $i++) {
        $imageFileType[] = strtolower(pathinfo($_FILES["ProductThumb"]["name"][$i], PATHINFO_EXTENSION));
    }
    $target_file = [];
    for ($i = 0; $i < $imageNumber; $i++) {
        $target_file[] = $filename[$i] . "." . $imageFileType[$i]; //Uploads/323-32.jph
    }

    $erros =  image_validation_check($target_file, $imageNumber);

    if (!empty($erros)) {
        return ["formatError" => $erros];
    }

    $sucessUpload = [];
    for ($i = 0; $i < $imageNumber; $i++) {
        if (move_uploaded_file($_FILES["ProductThumb"]["tmp_name"][$i], $target_file[$i])) {
            $thumb_destination = str_replace("uploads", "uploads/thumb", $target_file[$i]);
            $thumb = createThumbnail($target_file[$i], $thumb_destination, 50, 50);
            $sucessUpload[] = str_replace(PRIVATE_PATH . "/uploads/", "", $target_file[$i]);
        } else {

            $sucessUpload[] = ["uploadStatus" => false];
        }
    }

    return $sucessUpload;;
}























//Function To Generate User Id 
//uses The php uniqid and prepend a random number and time  
function generate_uid()
{
    return uniqid(rand() . time());
}