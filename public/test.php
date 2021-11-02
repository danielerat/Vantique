<?php
require_once("../private/initialize.php");
// require_once(PRIVATE_PATH . "/shared/public_header.php");
echo "<pre>";



// $item = ['user' => $_COOKIE["PHPSESSID"], 'productId' => 2, 'quantity' => 1];
// $cart->setCart(['item' => $item]);
// $cart->clearCart();

// $item = ['user' => $_COOKIE["PHPSESSID"], 'productId' => 9, 'quantity' => 2];
// $cart->setCart(['item' => $item]);
// $item = ['user' => $_COOKIE["PHPSESSID"], 'productId' => 2, 'quantity' => 1];
// $cart->setCart(['item' => $item]);

// $item = ['user' => $_COOKIE["PHPSESSID"], 'productId' => 5, 'quantity' => 2];
// $cart->setCart(['item' => $item]);

// $cart->getCart();
// $cart->clearCart();

// echo " Cart Items:<br>";
// print_r($cart->cart_items);

// echo Cart::$cart_items[0][0][0]['user'];


// $cart->deleteItem(4);

// $cart->clearCart();


print_r($cart->cartCount());
print_r($cart->cart_items);

echo "<br>Total Products:" . $cart->cartCount();
echo "<hr>";
print_r($_COOKIE);

// require_once(PRIVATE_PATH . "/shared/public_header.php");