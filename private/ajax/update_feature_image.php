<?php

require_once("../initialize.php");



$id = $_POST['product'] ?? null;
$id = $_POST['value'] ?? null;

if (is_post_request()) {
    print_r($_POST);
}