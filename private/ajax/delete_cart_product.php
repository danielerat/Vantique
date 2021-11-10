<?php

require_once("../initialize.php");



$errors = "";
$id = $_POST['productId'] ?? "";
if ($id == '') {
    $errors = 'Error No id Data!';
}

if (!empty($errors)) {
    if (is_ajax_request()) {
        $result_array = array('errors' => $errors);
        echo json_encode($result_array);
    }
    exit;
}

if (is_ajax_request() && empty($errors)) {

    if ($session_user->is_logged_in()) {
        // User Is logged in , then remove it from db table
        $cart = new Cart;

        if ($cart->delete_by_cart_id($id)) {
            echo json_encode(array('deleted' => "Success"));
            exit();
        } else {
            $errors = "Error Deleting Data! Please Try again";
            echo json_encode(array('errors' => $errors));
            exit();
        }
    } else if (!empty($cart->cart_items)) {
        // User Not login , remove it from the cookie whatever
        if ($cart->deleteItem($id)) {
            echo json_encode(array('deleted' => "Success"));
            exit();
        } else {
            $errors = "Error Deleting Data! Please Try again";
            echo json_encode(array('errors' => $errors));
            exit();
        }
    } else {
        $errors = "Error Deleting Data! Please Try again";
        echo json_encode(array('errors' => $errors));
    }
}