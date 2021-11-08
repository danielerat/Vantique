<?php

include("../initialize.php");
if (is_post_request()) {
    if ($session_user->is_logged_in()) {
        // User is logged in 
        $username = $session_user->username;
        $product = $_POST['productId'];
        // Check If the product Does not exit already in the  db
        if (!Wishlist::find_existance($username, $product)) {
            $wishlist = new Wishlist(['username' => $username, 'productId' => $product]);
            if ($wishlist->save()) {
                echo true;
                exit;
            } else {
                echo false;
                exit;
            }
        } else {
            echo 'Exist';
            exit;
        }
    } else {
        // user Is not logged in then dont add anything
        echo 'Auth';
        exit;
    }
}