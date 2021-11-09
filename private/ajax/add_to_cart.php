<?php

include("../initialize.php");
if (is_post_request()) {

    if ($session_user->is_logged_in()) {
        // User Is logged in , add it to the database
        $username = $session_user->username;
        $product = $_POST['productId'];
        $quantity = $_POST['quantity'];
        if (Cart::find_existance($username, $product)) {
            echo 'Exist';
            exit;
        } else {
            $cart = new Cart(["username" => $session_user->username, "productId" => $product, "quantity" => $quantity]);
            if ($cart->save()) {
                echo true;
                exit;
            } else {
                echo false;
                exit;
            }
        }
    } else {
        // User is not logged in then add it to the cookie istead 

        $username = $_COOKIE["PHPSESSID"];
        $product = $_POST['productId'];
        $quantity = $_POST['quantity'];

        $item = ['user' => $username, 'productId' => $product, 'quantity' => $quantity];
        print_r($item);
        echo "status" . $cart->setCart(['item' => $item]);

        // if ($cart->setCart(['item' => $item])) {
        //     echo true;
        //     exit;
        // } else if ($cart->setCart(['item' => $item]) == "Exist") {
        //     echo "Exist";
        // } else {
        //     echo false;
        //     exit;
        // }
    }
}