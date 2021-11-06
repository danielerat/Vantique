<?php

require_once("../initialize.php");

$id = $_POST['productId'] ?? null;
$value = $_POST['value'] ?? null;

if (is_post_request()) {
    if (Product::ChangeFeatureImage($value, $id)) {
        echo true;
    } else {
        echo false;
    }
}