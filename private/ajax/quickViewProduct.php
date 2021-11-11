<?php
require_once('../initialize.php');
$id = $_POST['productId'] ?? Null;

$product = Product::find_by_id($id);
if (empty($product)) {
    echo "Error Loadint The product!!";
} else {
    $category = Category::find_product_category($id);
    $scategory = SubCategory::find_product_category($id);
    $sscategory = SubSubCategory::find_product_category($id);
    $colors = Color::find_product_category($id);
    $size = Size::find_product_category($id);

    $product_image = ProductImage::find_by_product_id($id);
    $stock = ProductStock::find_by_product_id($id);
?>



<div class='row'>
    <div class='col-lg-6 col-md-6 col-sm-12'>
        <!-- Product-zoom-area -->
        <div class='zoom-area'>
            <img id='zoom-pro-quick-view' class='img-fluid'
                src="<?php echo  S_PRIVATE . '/uploads/' . $product->productThumb; ?>"
                data-zoom-image="<?php echo  S_PRIVATE . '/uploads/' . $product->productThumb; ?>" alt='Zoom Image'>
            <div id='gallery-quick-view' class='u-s-m-t-10'>
                <?php foreach ($product_image as $img) { ?>
                <a class='active' data-image="<?php echo S_PRIVATE . '/uploads/' . $img->image; ?>"
                    data-zoom-image="<?php echo S_PRIVATE . '/uploads/' . $img->image; ?>">
                    <img src="<?php echo S_PRIVATE . '/uploads/thumb/' . $img->image; ?>" alt='Product'>
                </a>

                <?php } ?>
            </div>
        </div>
        <!-- Product-zoom-area /- -->
    </div>
    <div class='col-lg-6 col-md-6 col-sm-12'>
        <!-- Product-details -->
        <div class='all-information-wrapper'>
            <div class='section-1-title-breadcrumb-rating'>
                <div class='product-title'>
                    <h1>
                        <a href='single-product.php'>Casual Hoodie Full Cotton</a>
                    </h1>
                </div>
                <ul class='bread-crumb'>
                    <li class='has-separator'>
                        <a href='home.php'>Products</a>
                    </li>
                    <li class='has-separator'>
                        <a href='shop-v1-root-category.php'><?php
                                                                foreach ($category as $c) {
                                                                    echo $c->categoryName;
                                                                }
                                                                ?></a>
                    </li>
                    <li class='has-separator'>
                        <a href='shop-v2-sub-category.php'><?php
                                                                foreach ($scategory as $s) {
                                                                    echo $s->name;
                                                                } ?></a>
                    </li>
                    <li class='is-marked'>
                        <a href='shop-v3-sub-sub-category.php'>
                            <?php
                                foreach ($sscategory as $ss) {
                                    echo $ss->name;
                                }
                                ?></a>
                    </li>
                </ul>
                <div class='product-rating'>
                    <div class='star' title='4.5 out of 5 - based on 23 Reviews'>
                        <span style='width:67px'></span>
                    </div>
                    <span>(23)</span>
                </div>
            </div>
            <div class='section-2-short-description u-s-p-y-14'>
                <h6 class='information-heading u-s-m-b-8'>Description:</h6>
                <p><?php echo $product->productDesc; ?></p>
            </div>
            <div class='section-3-price-original-discount u-s-p-y-14'>
                <div class='price'>
                    <h4>Frw <?php echo number_format($product->productPrice, 2); ?></h4>
                </div>
                <!--<div class='original-price'>
                    <span>Original Price:</span>
                    <span>$60.00</span>
                </div>
                <div class='discount-price'>
                    <span>Discount:</span>
                    <span>8%</span>
                </div>
                <div class='total-save'>
                    <span>Save:</span>
                    <span>$5</span>
                </div>-->
            </div>
            <div class='section-4-sku-information u-s-p-y-14'>
                <h6 class='information-heading u-s-m-b-8'>Sku Information:</h6>
                <div class='availability'>
                    <span>Availability:</span>
                    <span><?php
                                if ($product->productUnlimited == 1) {
                                    echo "In Stock";
                                } elseif ($stock->quantity < 1) {
                                    echo "Out Of Stock";
                                } else {
                                    echo "In Stock";
                                }
                                ?>
                    </span>
                </div>
                <div class='left'>
                    <?php if ($stock->quantity === 'x') { ?>
                    <span class="text-success">Unlimited</span>
                    <?php } else { ?>
                    <span>Only:</span>
                    <span class="font-weight-bold text-primary"><?php echo $stock->quantity; ?> left</span>

                    <?php } ?>
                </div>
            </div>
            <div class='section-5-product-variants u-s-p-y-14'>
                <h6 class='information-heading u-s-m-b-8'>Product Variants:</h6>
                <?php if ($colors) { ?>
                <div class='color u-s-m-b-11'>
                    <span>Available Color:</span>
                    <div class='color-variant select-box-wrapper'>
                        <select class='select-box product-color'>
                            <?php foreach ($colors as $c) {
                                        echo  "<option value='$c->id'>$c->name</option>";
                                    }   ?>
                        </select>
                    </div>
                    <div><?php foreach ($colors as $c) {
                                        echo "<span style='color:$c->hex_value;'> <i class='bg-dark border fa fa-dot-circle fa-3x'></i></span>";
                                    }
                                    ?></div>
                </div>
                <?php } ?>
                <div class='sizes u-s-m-b-11'>
                    <span>Available Size:</span>
                    <div class='size-variant select-box-wrapper'>
                        <select class='select-box product-size'>
                            <?php foreach ($size as $s) {
                                    echo  "<option value='$s->id'>$s->name</option>";
                                }   ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class='section-6-social-media-quantity-actions u-s-p-y-14'>
                <form action='#' class='post-form'>

                    <div class='quantity-wrapper u-s-m-b-22'>
                        <span>Quantity:</span>
                        <div class='quantity'>
                            <input type='text' class='quantity-text-field' value='1'>
                            <a class='plus-a' data-max='1000'>&#43;</a>
                            <a class='minus-a' data-min='1'>&#45;</a>
                        </div>
                    </div>
                    <div>
                        <button class='button button-outline-secondary item-addCartBTN'
                            data-id='<?php echo $product->id; ?>'>Add to
                            cart</button>
                        <button class='button button-outline-secondary far fa-heart u-s-m-l-6 item-addWishlistBTN'
                            data-id='<?php echo $product->id; ?>'></button>
                        <button class='button button-outline-secondary far fa-envelope u-s-m-l-6'></button>
                    </div>
                    <div class='quick-social-media-wrapper u-s-m-b-22'>
                        <span>Share:</span>
                        <ul class='social-media-list'>
                            <li>
                                <a href='#'>
                                    <i class='fab fa-facebook-f'></i>
                                </a>
                            </li>
                            <li>
                                <a href='#'>
                                    <i class='fab fa-twitter'></i>
                                </a>
                            </li>
                            <li>
                                <a href='#'>
                                    <i class='fab fa-google-plus-g'></i>
                                </a>
                            </li>
                            <li>
                                <a href='#'>
                                    <i class='fas fa-rss'></i>
                                </a>
                            </li>
                            <li>
                                <a href='#'>
                                    <i class='fab fa-pinterest'></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
        <!-- Product-details /- -->
    </div>
</div>


<?php } ?>
<script>
$('.item-addCartBTN').click(function() {
    var productId = $(this).data('id');
    // getting the new value of the current cart so that we can increment it

    $.ajax({
        url: '../private/ajax/add_to_cart.php',
        type: 'post',
        data: {
            productId: productId,
            quantity: 1
        },
        success: function(response) {
            $('#quick-view-product').modal('hide');
            if (response == true) {
                // Custom function to display toasts
                swaltoast("success", "Item Added To Your Cart List");
                var currentCount = parseInt($('.cartItemCounterUpdate').text());
                var newCount = parseInt(currentCount + 1);
                $('.cartItemCounterUpdate').html(newCount);
            } else if (response === 'Auth') {
                swaltoast("info", "Please Login First ");
            } else if (response === 'Exist') {
                swaltoast("info", "Item is Alread In Your Cart List :)");
            } else {
                swaltoast("error", "Error Adding Your Product, try again later ");
            }
        }
    });
});

// Add Item to The wishlist
$('.item-addwishlistBTN').click(function() {
    var productId = $(this).data('id');
    $.ajax({
        url: '../private/ajax/add_to_wishlist.php',
        type: 'post',
        data: {
            productId: productId
        },
        success: function(response) {

            if (response == true) {
                // Custom function to display toasts
                swaltoast("success", "Item Added To Your Wish List");
            } else if (response === 'Auth') {
                swaltoast("info", "Please Login First ");
            } else if (response === 'Exist') {
                swaltoast("info", "Item is Alread In Your Wish List :)");
            } else {
                swaltoast("error", "Error Adding Your Product, try again later ");
            }
        }
    });
});
// Add Item
</script>