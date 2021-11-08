<?php
require_once("../private/initialize.php");

require_once(PRIVATE_PATH . "/shared/public_header.php");

?>

<?php
if ($session_user->is_logged_in() || isset($cart->cart_items)) {

?>

<div class="page-cart u-s-p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- Products-List-Wrapper -->
                <div class="table-wrapper u-s-m-b-60">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $cartDb = ($session_user->is_logged_in()) ? Cart::find_by_user_id($session_user->username) : $cart->cart_items;
                                $total = (float) 0;
                                // Since What's Kept in the cart cookit is not an object , we have to make the convertion 
                                // The Easiest way is to encode and decode back again in a json format ...lol 
                                if (!$session_user->is_logged_in()) {
                                    $cartDb = json_encode($cartDb);
                                    $cartDb = json_decode($cartDb);
                                }
                                foreach ($cartDb as $cart) {
                                    $product = Product::find_by_id($cart->productId);
                                    $total += (float) ($product->productPrice * $cart->quantity);
                                    $Stock = ProductStock::find_by_product_id($product->id);
                                    $remainingStock = ($Stock->quantity === 'x') ? "10000" : "{$Stock->quantity}";
                                ?>
                            <tr class="animate__animated singleItemRow_<?php echo $product->id; ?> ">

                                <td>
                                    <div class="cart-anchor-image">
                                        <a href="view-product.php?id=<?php echo $product->id; ?>">
                                            <img src="<?php echo S_PRIVATE . '/uploads/thumb/' . $product->productThumb; ?>"
                                                alt="Product">
                                            <h6><?php echo $product->productName; ?></h6>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-price">
                                        <?php echo "Frw " . number_format($product->productPrice, 0); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-quantity">
                                        <div class="quantity">
                                            <input type="text" class="quantity-text-field"
                                                value="<?php echo $cart->quantity; ?>">
                                            <a class="plus-a" data-max="<?php echo $remainingStock; ?>">&#43;</a>
                                            <a class="minus-a" data-min="1">&#45;</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-wrapper">
                                        <!-- <button class="button button-outline-secondary fas fa-sync"></button> -->
                                        <button class="button  button-outline-secondary fas fa-trash"
                                            onclick="delete_cart_item(<?php echo $product->id; ?>)"></button>
                                    </div>
                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- Products-List-Wrapper /- -->
                <!-- Coupon -->
                <div class="coupon-continue-checkout u-s-m-b-60">
                    <div class="coupon-area">
                        <h6>Enter your coupon code if you have one.</h6>
                        <div class="coupon-field">
                            <label class="sr-only" for="coupon-code">Apply Coupon</label>
                            <input id="coupon-code" type="text" class="text-field" placeholder="Coupon Code">
                            <button type="submit" class="button">Apply Coupon</button>
                        </div>
                        <a href="checkout.html" class="checkout">Proceed to Checkout</a>

                    </div>
                    <div class="button-area">
                        <a href="shop-v1-root-category.html" class="continue">Continue Shopping</a>
                        <a href="checkout.php" class="checkout">Proceed to Checkout</a>
                    </div>
                </div>
                <!-- Coupon /- -->

                <!-- Billing -->
                <div class="calculation u-s-m-b-60">
                    <div class="table-wrapper-2">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2">Cart Totals</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h3 class="calc-h3 u-s-m-b-0">Subtotal</h3>
                                    </td>
                                    <td>
                                        <span class="calc-text">Frw <?php echo number_format($total, 2); ?></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h3 class="calc-h3 u-s-m-b-0" id="tax-heading">Tax</h3>
                                        <span> (No tax given )</span>
                                    </td>
                                    <td>
                                        <span class="calc-text">Frw 0.00</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3 class="calc-h3 u-s-m-b-0">Total</h3>
                                    </td>
                                    <td>
                                        <span class="calc-text">Frw <?php echo number_format($total, 2); ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Billing /- -->
            </div>
        </div>
    </div>
</div>
<?php } else {
?>
<!-- Cart-Page -->
<div class="page-wishlist  my-5">
    <div class="">
        <div class="text-center">
            <h1 class=" ">Em<i class="display-1 text-warning fas fa-people-carry"></i>ty!
            </h1>
            <h5>No Products were Found In Your Cart ! <i class="fas fa-sad-tear"></i></h5>
            <div class="redirect-link-wrapper u-s-p-t-25">
                <a class="redirect-link" href="shop-v1-root-category.html">
                    <span>Return to Shop</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Cart-Page /- -->
<?php

}
?>

<script>
function delete_cart_item(id) {
    function wait(ms) {
        var start = new Date().getTime();
        var end = start;
        while (end < start + ms) {
            end = new Date().getTime();
        }
    }

    Swal.fire({
        text: "Do you Really Want to remove it from your card ?",
        icon: 'warning',
        timer: 10000,
        toast: true,
        timerProgressBar: true,
        position: 'top-end',
        showCancelButton: true,
        confirmButtonColor: 'var(--success)',
        cancelButtonColor: 'var(--danger)',
        confirmButtonText: 'Yes !'
    }).then((result) => {
        if (result.isConfirmed) {

            let action = "../private/ajax/delete_cart_product.php";
            var parent = document.querySelector(".singleItemRow_" + id);
            // console.log("Parent is: " + parent)
            var xhr = new XMLHttpRequest();
            xhr.open('POST', action, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let result = xhr.responseText;
                    console.log('Result: ' + result);
                    let json = JSON.parse(result);
                    if (json.hasOwnProperty('errors') && json.errors.length > 0) {
                        Swal.fire(
                            'Eroor!',
                            'Please Try Again Later.',
                            'error'
                        )
                    } else {
                        parent.classList.add("animate__zoomOutLeft");


                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            toast: true,
                            title: 'Record Deleted Successfully',
                            showConfirmButton: false,
                            timer: 1000
                        }).then((result) => {
                            wait(500);

                            parent.classList.add("d-none");

                        })

                        var currentCount = parseInt($('.cartItemCounterUpdate').text());
                        var newCount = parseInt(currentCount - 1);
                        $('.cartItemCounterUpdate').html(newCount);


                    }
                }
            };
            xhr.send("productId=" + id);
        }
    })
}
</script>

<?php
require_once(PRIVATE_PATH . "/shared/public_footer.php");

?>