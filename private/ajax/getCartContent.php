<?php
require_once('../initialize.php');
if ($session_user->is_logged_in()) {

    $cartDb = Cart::find_by_user_id($session_user->getUserId());
    $output = "<ul class='mini-cart-list'>";
    $total = (float) 0;
    foreach ($cartDb as $cart) {
        $product = Product::find_by_id($cart->productId);

        $total += (float) ($product->productPrice * $cart->quantity);
        $output .= "
                            <li class='clearfix'>
                                <a href='view-product.php?id={$product->id}'>";
        $output .= "<img src='" . S_PRIVATE . "/uploads/thumb/{$product->productThumb}' alt='Product'>
                                    <span class='mini-item-name'>" . ellipse_of(h($product->productName), 40) . "</span>
                                    <span class='mini-item-price'>Frw" . number_format($product->productPrice, 0) . "</span>
                                    <span class='mini-item-quantity'> x {$cart->quantity}</span>
                                </a>
                            </li>";
    }
    $output .= "</ul>
    <div class='mini-shop-total clearfix'>
        <span class='mini-total-heading float-left'>Total:</span>
        <span class='mini-total-price float-right'>Frw " . number_format($total, 2) . "</span>
    </div>

    <div class='mini-action-anchors'>
        <a href='cart.php' class='cart-anchor'>View Cart</a>
        <a href='checkout.php' class='checkout-anchor'>Checkout</a>
    </div>
";
    echo $output;
    // echo '<pre>';
    // print_r($cartDb);
    // echo '</pre>';
} else {

    if (isset($cart->cart_items) && !empty($cart->cart_items)) {

        // User Not Logged in yet , and has carts items in the cookie.
        $output = "<ul class='mini-cart-list'>";
        $total = (float) 0;
        foreach ($cart->cart_items as $cart) {
            $product = Product::find_by_id($cart['productId']);
            $total += (float) ($product->productPrice * $cart['quantity']);
            $output .= "
                            <li class='clearfix'>
                                <a href='view-product.php?id={$product->id}'>";
            $output .= "<img src='" . S_PRIVATE . "/uploads/thumb/{$product->productThumb}' alt='Product'>
                                    <span class='mini-item-name'>" . ellipse_of(h($product->productName), 40) . "</span>
                                    <span class='mini-item-price'>Frw " . number_format($product->productPrice, 0) . "</span>
                                    <span class='mini-item-quantity'>x " . $cart['quantity'] . "</span>
                                </a>
                            </li>";
        }
        $output .= "</ul>
    <div class='mini-shop-total clearfix'>
        <span class='mini-total-heading float-left'>Total:</span>
        <span class='mini-total-price float-right'>Frw " . number_format($total, 2) . "</span>
    </div>

    <div class='mini-action-anchors'>
        <a href='cart.php' class='cart-anchor'>View Cart</a>
        <a href='checkout.php' class='checkout-anchor'>Checkout</a>
    </div>
";
        echo $output;
    } else {

        echo "
        <div class='vertical-center'>
            <div class='text-center'>
                <h1>Em<i class='fas fa-child text-primary'></i>ty!
                </h1>
                <h5>No Products were added to Your Cart.</h5>
                <div class='redirect-link-wrapper u-s-p-t-25'>
                    <a class='redirect-link'>
                        <span>Return to Shop</span>
                    </a>
                </div>
            </div>
        </div>
    
    ";
    }
}