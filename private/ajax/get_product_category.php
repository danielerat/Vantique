<?php

include("../initialize.php");

$category = NULL;
$subCategory = NULL;
if (isset($_GET['category'])) {
    $category = $_GET['category'];
}
if (isset($_GET['subCategory'])) {
    $subCategory = $_GET['subCategory'];
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