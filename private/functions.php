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




function ellipse_of($str, $size)
{
    $out = strlen($str) > $size ? substr($str, 0, $size) . "..." : $str;
    return $out;
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




























//Function To Generate User Id 
//uses The php uniqid and prepend a random number and time  
function generate_uid()
{
    return uniqid(rand() . time());
}