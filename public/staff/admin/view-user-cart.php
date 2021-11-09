<?php
require_once('../../../private/initialize.php');
$page_title = "User Page";
include(SHARED_PATH . '/staff_header.php');

$user = $_GET['user'] ?? NULL;
echo display_session_message();
?>

<link href="../../css/bundle.skyblue.css" rel="stylesheet" type="text/css">

<div class="w-50 m-auto" aria-labelledby="searchDropdown">
    <form class="navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-1 small" placeholder="Type Your Search?"
                aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
</div>


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
                            $cartDb = Cart::find_by_user_id($user);
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
                                        <a href="view.php?id=<?php echo $product->id; ?>">
                                            <img src="<?php echo S_PRIVATE . '/uploads/thumb/' . $product->productThumb; ?>"
                                                alt="Product">
                                            <h6><?php echo ellipse_of($product->productName, 80); ?></h6>
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


<?php
include(SHARED_PATH . '/staff_footer.php');
?>