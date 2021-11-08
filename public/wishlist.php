<?php
require_once("../private/initialize.php");
require_once(PRIVATE_PATH . "/shared/public_header.php");

?>




<?php if (true) { ?>
<!-- Wishlist-Page -->
<div class="page-wishlist u-s-p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Products-List-Wrapper -->
                <div class="table-wrapper u-s-m-b-60">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Unit Price</th>
                                <th>Stock Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="cart-anchor-image">
                                        <a href="single-product.php">
                                            <img src="images/product/product@1x.jpg" alt="Product">
                                            <h6>Casual Hoodie Full Cotton</h6>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-price">
                                        $55.00
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-stock">
                                        In Stock
                                    </div>
                                </td>
                                <td>
                                    <div class="action-wrapper">
                                        <button class="button button-outline-secondary">Add to Cart</button>
                                        <button class="button button-outline-secondary fas fa-trash"></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="cart-anchor-image">
                                        <a href="single-product.php">
                                            <img src="images/product/product@1x.jpg" alt="Product">
                                            <h6>Black Rock Dress with High Jewelery Necklace</h6>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-price">
                                        $55.00
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-stock">
                                        In Stock
                                    </div>
                                </td>
                                <td>
                                    <div class="action-wrapper">
                                        <button class="button button-outline-secondary">Add to Cart</button>
                                        <button class="button button-outline-secondary fas fa-trash"></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="cart-anchor-image">
                                        <a href="single-product.php">
                                            <img src="images/product/product@1x.jpg" alt="Product">
                                            <h6>Xiaomi Note 2 Black Color</h6>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-price">
                                        $55.00
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-stock">
                                        In Stock
                                    </div>
                                </td>
                                <td>
                                    <div class="action-wrapper">
                                        <button class="button button-outline-secondary">Add to Cart</button>
                                        <button class="button button-outline-secondary fas fa-trash"></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Products-List-Wrapper /- -->
            </div>
        </div>
    </div>
</div>
<!-- Wishlist-Page /- -->
<?php } else { ?>


<!-- Wishlist-Page -->
<div class="page-wishlist" style="margin-bottom:300px;">
    <div class="vertical-center">
        <div class="text-center">
            <h1>Em
                <i class="fas fa-child"></i>ty!
            </h1>
            <h5>No Products were added to the wishlist.</h5>
            <div class="redirect-link-wrapper u-s-p-t-25">
                <a class="redirect-link" href="shop-v1-root-category.html">
                    <span>Return to Shop</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Wishlist-Page /- -->

<?php } ?>

<?php
require_once(PRIVATE_PATH . "/shared/public_footer.php");
?>