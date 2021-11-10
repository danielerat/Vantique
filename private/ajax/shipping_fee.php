<?php

require_once("../initialize.php");

if (is_post_request()) {
    $cart = Cart::find_by_user_id($session_user->username);
    $total = (float) 0;

    foreach ($cart as $c) {
        // Loop throw 
        $product = Product::find_by_id($c->productId);
        $total += (float) ($product->productPrice * $c->quantity);
    }
    $shippingFee = (float) 0;
    switch ($_POST['type']) {
        case 1:
            $shippingFee += 2000;
            break;
        case 2:
            $shippingFee += 1500;
            break;
        case 3:
            $shippingFee += 800;
            break;
        default:
            $shippingFee += 0;
            break;
    }

    $total += $shippingFee;
    $total = number_format($total, 2) . " Frw";
    $shippingFee = number_format($shippingFee, 2) . " Frw";
    $result = ["fee" => $shippingFee, "total" => $total];
    echo json_encode($result);
}