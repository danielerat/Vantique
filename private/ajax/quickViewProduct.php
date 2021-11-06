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
                    <span>In Stock</span>
                </div>
                <div class='left'>
                    <span>Only:</span>
                    <span>50 left</span>
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
                                        echo  "<option value='$c->name'>$c->name</option>";
                                    }   ?>
                        </select>
                    </div>
                </div>
                <?php } ?>
                <!--<div class='sizes u-s-m-b-11'>
                    <span>Available Size:</span>
                    <div class='size-variant select-box-wrapper'>
                        <select class='select-box product-size'>
                            <option value=''>Male 2XL</option>
                            <option value=''>Male 3XL</option>
                            <option value=''>Kids 4</option>
                            <option value=''>Kids 6</option>
                            <option value=''>Kids 8</option>
                            <option value=''>Kids 10</option>
                            <option value=''>Kids 12</option>
                            <option value=''>Female Small</option>
                            <option value=''>Male Small</option>
                            <option value=''>Female Medium</option>
                            <option value=''>Male Medium</option>
                            <option value=''>Female Large</option>
                            <option value=''>Male Large</option>
                            <option value=''>Female XL</option>
                            <option value=''>Male XL</option>
                        </select>
                    </div>
                </div> -->
            </div>
            <div class='section-6-social-media-quantity-actions u-s-p-y-14'>
                <form action='#' class='post-form'>
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
                    <div class='quantity-wrapper u-s-m-b-22'>
                        <span>Quantity:</span>
                        <div class='quantity'>
                            <input type='text' class='quantity-text-field' value='1'>
                            <a class='plus-a' data-max='1000'>&#43;</a>
                            <a class='minus-a' data-min='1'>&#45;</a>
                        </div>
                    </div>
                    <div>
                        <button class='button button-outline-secondary' type='submit'>Add to
                            cart</button>
                        <button class='button button-outline-secondary far fa-heart u-s-m-l-6'></button>
                        <button class='button button-outline-secondary far fa-envelope u-s-m-l-6'></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Product-details /- -->
    </div>
</div>


<?php } ?>