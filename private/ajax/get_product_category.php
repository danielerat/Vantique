<?php

include("../initialize.php");

$category = NULL;
$subCategory = NULL;
$size = NULL;
if (isset($_GET['category'])) {
    $category = $_GET['category'];
}
if (isset($_GET['subCategory'])) {
    $subCategory = $_GET['subCategory'];
}
if (isset($_GET['size'])) {
    $size = $_GET['size'];
}

// Fetch state list by Province
if (isset($category)) {

    $output = "<option value='' disabled='disabled'>Select category</option>";
    $subCategory = SubCategory::find_by_parent($category);
    foreach ($subCategory as $s) {
        $output .= "<option value='" . $s->id . "'>" . $s->name . "</option>";
    }
    echo $output;
    exit;
}

// Fetch city list by category
if (isset($subCategory)) {
    $output = "<option value='' disabled='disabled'>Select subCategory</option>";
    $SubCategory = SubSubCategory::find_by_parent($subCategory);
    foreach ($SubCategory as $s) {
        $output .= "<option value='" . $s->id . "'>" . $s->name . "</option>";
    }
    echo $output;
    exit;
}
if (isset($size)) {
    if ($size == 14) {
        $size = Size::find_by_type(1);
    } else {
        $size = Size::find_by_type(2);
    }
    $output = "<option value='' disabled='disabled'>Select A size </option>";
    foreach ($size as $s) {
        $output .= "<option value='" . $s->id . "'>" . $s->name . "</option>";
    }
    echo $output;
    exit;
}