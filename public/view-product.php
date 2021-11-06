<?php
require_once("../private/initialize.php");
require_once(PRIVATE_PATH . "/shared/public_header.php");
$id = $_GET['id'] ?? Null;
$product = Product::find_by_id($id);
if (empty($product)) {
    header("Location: 404.php");
}
$product_category = Category::find_product_category($id);

$product_image = ProductImage::find_by_product_id($id);
$stock = ProductStock::find_by_product_id($id);
$colors = Color::find_product_category($id);
$size = Size::find_product_category($id);

?>
<!-- Main-Slider -->

<!-- Single-Product-Full-Width-Page -->
<div class="page-detail u-s-p-t-80">
    <div class="container">
        <!-- Product-Detail -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <!-- Product-zoom-area -->
                <div class="zoom-area">
                    <img id="zoom-pro" class="img-fluid"
                        src="<?php echo  S_PRIVATE . '/uploads/' . $product->productThumb; ?>"
                        data-zoom-image="<?php echo  S_PRIVATE . '/uploads/' . $product->productThumb; ?>"
                        alt="Zoom Image">
                    <div id="gallery" class="u-s-m-t-10">
                        <?php foreach ($product_image as $img) { ?>
                        <a class="" data-image="<?php echo S_PRIVATE . '/uploads/' . $img->image; ?>"
                            data-zoom-image="<?php echo S_PRIVATE . '/uploads/' . $img->image; ?>">
                            <img src="<?php echo S_PRIVATE . '/uploads/thumb/' . $img->image; ?>" alt="Product">
                        </a>
                        <?php } ?>

                    </div>
                </div>
                <!-- Product-zoom-area /- -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <!-- Product-details -->
                <div class="all-information-wrapper">
                    <div class="section-1-title-breadcrumb-rating">
                        <div class="product-title">
                            <h1>
                                <a href="single-product.html"><?php echo $product->productName; ?></a>
                            </h1>
                        </div>
                        <ul class="bread-crumb">
                            <?php foreach ($product_category as $category) { ?>

                            <li class="has-separator">
                                <a href="search.php"><?php echo strtoupper($category->categoryName); ?></a>
                            </li>
                            <?php } ?>
                        </ul>
                        <div class="product-rating">
                            <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                <span style='width:67px'></span>
                            </div>
                            <span>(23)</span>
                        </div>
                    </div>
                    <div class="section-2-short-description u-s-p-y-14">
                        <h6 class="information-heading u-s-m-b-8">Description:</h6>
                        <p><?php echo $product->productDesc; ?></p>
                    </div>
                    <div class="section-3-price-original-discount u-s-p-y-14">
                        <div class="price">
                            <h4>Frw <?php echo number_format($product->productPrice, 2); ?></h4>
                        </div>
                        <div class="original-price">
                            <span>Original Price:</span>
                            <span>Frw <?php echo number_format($product->productPrice, 2); ?></span>
                        </div>
                        <div class="discount-price">
                            <span>Discount:</span>
                            <span>0%</span>
                        </div>
                        <div class="total-save">
                            <span>Save:</span>
                            <span>Frw 0,000</span>
                        </div>
                    </div>
                    <div class="section-4-sku-information u-s-p-y-14">
                        <h6 class="information-heading u-s-m-b-8">Sku Information:</h6>
                        <div class="availability">
                            <span>Availability:</span>
                            <span>
                                <?php
                                if ($product->productUnlimited !== 1 && $stock->quantity < 1) {
                                    echo "Out Of Stock";
                                } else {
                                    echo "In Stock";
                                }
                                ?> </span>
                        </div>
                        <div class="left">
                            <?php if ($stock->quantity === 'x') { ?>
                            <span class="text-success">Unlimited</span>
                            <?php } else { ?>
                            <span>Only:</span>
                            <span class="font-weight-bold text-primary"><?php echo $stock->quantity; ?> left</span>

                            <?php } ?>
                        </div>
                    </div>
                    <div class="section-5-product-variants u-s-p-y-14">
                        <h6 class="information-heading u-s-m-b-8">Product Variants:</h6>
                        <div class="color u-s-m-b-11">
                            <span>Available Color:</span>
                            <div class="color-variant select-box-wrapper">
                                <select class="select-box product-color">
                                    <option value="1">Heather Grey</option>
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
                        <?php if ($size) { ?>
                        <div class="sizes u-s-m-b-11">
                            <span>Available Size:</span>
                            <div class="size-variant select-box-wrapper">
                                <select class="select-box product-size">
                                    <?php foreach ($size as $s) {
                                            echo  "<option value='$s->id'>$s->name</option>";
                                        }   ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                        <form action="#" class="post-form">

                            <div class="quantity-wrapper u-s-m-b-22">
                                <span>Quantity:</span>
                                <div class="quantity">
                                    <input type="text" class="quantity-text-field" value="1">
                                    <a class="plus-a" data-max="<?php echo $stock->quantity; ?>">&#43;</a>
                                    <a class="minus-a" data-min="1">&#45;</a>
                                </div>
                            </div>
                            <div>
                                <button class="button button-outline-secondary" type="submit">Add to cart</button>
                                <button class="button button-outline-secondary far fa-heart u-s-m-l-6"></button>
                                <button class="button button-outline-secondary far fa-envelope u-s-m-l-6"></button>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- Product-details /- -->
            </div>
        </div>
        <!-- Product-Detail /- -->
        <!-- Detail-Tabs -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="detail-tabs-wrapper u-s-p-t-80">
                    <div class="detail-nav-wrapper u-s-m-b-30">
                        <ul class="nav single-product-nav justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#description">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#specification">Specifications</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#review">Reviews (15)</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <!-- Description-Tab -->
                        <div class="tab-pane fade active show" id="description">
                            <div class="description-whole-container">
                                <p class="desc-p u-s-m-b-26">This hoodie is full cotton. It includes a muff sewn onto
                                    the lower front, and (usually) a drawstring to adjust the hood opening. Throughout
                                    the U.S., it is common for middle-school, high-school, and college students to wear
                                    this sweatshirts—with or without hoods—that display their respective school names or
                                    mascots across the chest, either as part of a uniform or personal preference.
                                </p>
                                <img class="desc-img img-fluid u-s-m-b-26" src="images/product/product@3x.jpg"
                                    alt="Product">
                                <iframe class="desc-iframe u-s-m-b-45" width="710" height="400"
                                    src="images/product/iframe-youtube.jpg" allowfullscreen></iframe>
                            </div>
                        </div>
                        <!-- Description-Tab /- -->
                        <!-- Specifications-Tab -->
                        <div class="tab-pane fade" id="specification">
                            <div class="specification-whole-container">
                                <div class="spec-ul u-s-m-b-50">
                                    <h4 class="spec-heading">Key Features</h4>
                                    <ul>
                                        <li>Heather Grey</li>
                                        <li>Black</li>
                                        <li>White</li>
                                    </ul>
                                </div>
                                <div class="u-s-m-b-50">
                                    <h4 class="spec-heading">What's in the Box?</h4>
                                    <h3 class="spec-answer">1 x hoodie</h3>
                                </div>
                                <div class="spec-table u-s-m-b-50">
                                    <h4 class="spec-heading">General Information</h4>
                                    <table>
                                        <tr>
                                            <td>Sku</td>
                                            <td>AY536FA08JT86NAFAMZ</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="spec-table u-s-m-b-50">
                                    <h4 class="spec-heading">Product Information</h4>
                                    <table>
                                        <tr>
                                            <td>Main Material</td>
                                            <td>Cotton</td>
                                        </tr>
                                        <tr>
                                            <td>Color</td>
                                            <td>Heather Grey, Black, White</td>
                                        </tr>
                                        <tr>
                                            <td>Sleeves</td>
                                            <td>Long Sleeve</td>
                                        </tr>
                                        <tr>
                                            <td>Top Fit</td>
                                            <td>Regular</td>
                                        </tr>
                                        <tr>
                                            <td>Print</td>
                                            <td>Not Printed</td>
                                        </tr>
                                        <tr>
                                            <td>Neck</td>
                                            <td>Round Neck</td>
                                        </tr>
                                        <tr>
                                            <td>Pieces Count</td>
                                            <td>1 piece</td>
                                        </tr>
                                        <tr>
                                            <td>Occasion</td>
                                            <td>Casual</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping Weight (kg)</td>
                                            <td>0.5</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Specifications-Tab /- -->
                        <!-- Reviews-Tab ------------------------------>
                        <div class="tab-pane fade" id="review">
                            <div class="review-whole-container">
                                <div class="row r-1 u-s-m-b-26 u-s-p-b-22">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="total-score-wrapper">
                                            <h6 class="review-h6">Average Rating</h6>
                                            <div class="circle-wrapper">
                                                <h1>4.5</h1>
                                            </div>
                                            <h6 class="review-h6">Based on 23 Reviews</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="total-star-meter">
                                            <div class="star-wrapper">
                                                <span>5 Stars</span>
                                                <div class="star">
                                                    <span style='width:0'></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                            <div class="star-wrapper">
                                                <span>4 Stars</span>
                                                <div class="star">
                                                    <span style='width:67px'></span>
                                                </div>
                                                <span>(23)</span>
                                            </div>
                                            <div class="star-wrapper">
                                                <span>3 Stars</span>
                                                <div class="star">
                                                    <span style='width:0'></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                            <div class="star-wrapper">
                                                <span>2 Stars</span>
                                                <div class="star">
                                                    <span style='width:0'></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                            <div class="star-wrapper">
                                                <span>1 Star</span>
                                                <div class="star">
                                                    <span style='width:0'></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row r-2 u-s-m-b-26 u-s-p-b-22">
                                    <div class="col-lg-12">
                                        <div class="your-rating-wrapper">
                                            <h6 class="review-h6">Your Review is matter.</h6>
                                            <h6 class="review-h6">Have you used this product before?</h6>
                                            <div class="star-wrapper u-s-m-b-8">
                                                <div class="star">
                                                    <span id="your-stars" style='width:0'></span>
                                                </div>
                                                <label for="your-rating-value"></label>
                                                <input id="your-rating-value" type="text" class="text-field"
                                                    name="Review[star]" placeholder="0.0">
                                                <span id="star-comment"></span>
                                            </div>
                                            <form method="post" id="submitReview"
                                                action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                                <label for="your-name">Name
                                                    <span class="astk"> *</span>
                                                </label>
                                                <input id="your-name" type="email" class="text-field"
                                                    name="Review[names]" placeholder="Your Name">
                                                <label for="your-email">Email
                                                    <span class="astk"> *</span>
                                                </label>
                                                <input id="your-email" type="text" class="text-field"
                                                    name="Review[email]" placeholder="Your Email">
                                                <label for="review-title">Review Title
                                                    <span class="astk"> *</span>
                                                </label>
                                                <input id="review-title" type="text" class="text-field"
                                                    name="Review[title]" placeholder="Review Title">
                                                <label for="review-text-area">Review
                                                    <span class="astk"> *</span>
                                                </label>
                                                <textarea class="text-area u-s-m-b-8" id="review-text-area"
                                                    name="Review[review]" placeholder="Review"></textarea>
                                                <input type='submit' class="button button-outline-secondary"
                                                    value="Submit Review">
                                                </input>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Get-Reviews -->
                                <div class="get-reviews u-s-p-b-22">
                                    <!-- Review-Options -->
                                    <div class="review-options u-s-m-b-16">
                                        <div class="review-option-heading">
                                            <h6>Reviews
                                                <span> (15) </span>
                                            </h6>
                                        </div>
                                        <div class="review-option-box">
                                            <div class="select-box-wrapper">
                                                <label class="sr-only" for="review-sort">Review Sorter</label>
                                                <select class="select-box" id="review-sort">
                                                    <option value="">Sort by: Best Rating</option>
                                                    <option value="">Sort by: Worst Rating</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Review-Options /- -->
                                    <!-- All-Reviews -->
                                    <div class="reviewers">
                                        <div class="review-data">
                                            <div class="reviewer-name-and-date">
                                                <h6 class="reviewer-name">John</h6>
                                                <h6 class="review-posted-date">10 May 2018</h6>
                                            </div>
                                            <div class="reviewer-stars-title-body">
                                                <div class="reviewer-stars">
                                                    <div class="star">
                                                        <span style='width:67px'></span>
                                                    </div>
                                                    <span class="review-title">Good!</span>
                                                </div>
                                                <p class="review-body">
                                                    Good Quality...!
                                                </p>
                                            </div>
                                        </div>
                                        <div class="review-data">
                                            <div class="reviewer-name-and-date">
                                                <h6 class="reviewer-name">Doe</h6>
                                                <h6 class="review-posted-date">10 June 2018</h6>
                                            </div>
                                            <div class="reviewer-stars-title-body">
                                                <div class="reviewer-stars">
                                                    <div class="star">
                                                        <span style='width:67px'></span>
                                                    </div>
                                                    <span class="review-title">Well done!</span>
                                                </div>
                                                <p class="review-body">
                                                    Cotton is good.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="review-data">
                                            <div class="reviewer-name-and-date">
                                                <h6 class="reviewer-name">Tim</h6>
                                                <h6 class="review-posted-date">10 July 2018</h6>
                                            </div>
                                            <div class="reviewer-stars-title-body">
                                                <div class="reviewer-stars">
                                                    <div class="star">
                                                        <span style='width:67px'></span>
                                                    </div>
                                                    <span class="review-title">Well done!</span>
                                                </div>
                                                <p class="review-body">
                                                    Excellent condition
                                                </p>
                                            </div>
                                        </div>
                                        <div class="review-data">
                                            <div class="reviewer-name-and-date">
                                                <h6 class="reviewer-name">Johnny</h6>
                                                <h6 class="review-posted-date">10 March 2018</h6>
                                            </div>
                                            <div class="reviewer-stars-title-body">
                                                <div class="reviewer-stars">
                                                    <div class="star">
                                                        <span style='width:67px'></span>
                                                    </div>
                                                    <span class="review-title">Bright!</span>
                                                </div>
                                                <p class="review-body">
                                                    Cotton
                                                </p>
                                            </div>
                                        </div>
                                        <div class="review-data">
                                            <div class="reviewer-name-and-date">
                                                <h6 class="reviewer-name">Alexia C. Marshall</h6>
                                                <h6 class="review-posted-date">12 May 2018</h6>
                                            </div>
                                            <div class="reviewer-stars-title-body">
                                                <div class="reviewer-stars">
                                                    <div class="star">
                                                        <span style='width:67px'></span>
                                                    </div>
                                                    <span class="review-title">Well done!</span>
                                                </div>
                                                <p class="review-body">
                                                    Good polyester Cotton
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- All-Reviews /- -->
                                    <!-- Pagination-Review -->
                                    <div class="pagination-review-area">
                                        <div class="pagination-review-number">
                                            <ul>
                                                <li style="display: none">
                                                    <a href="single-product.html" title="Previous">
                                                        <i class="fas fa-angle-left"></i>
                                                    </a>
                                                </li>
                                                <li class="active">
                                                    <a href="single-product.html">1</a>
                                                </li>
                                                <li>
                                                    <a href="single-product.html">2</a>
                                                </li>
                                                <li>
                                                    <a href="single-product.html">3</a>
                                                </li>
                                                <li>
                                                    <a href="single-product.html">...</a>
                                                </li>
                                                <li>
                                                    <a href="single-product.html">10</a>
                                                </li>
                                                <li>
                                                    <a href="single-product.html" title="Next">
                                                        <i class="fas fa-angle-right"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Pagination-Review /- -->
                                </div>
                                <!-- Get-Reviews /- -->
                            </div>
                        </div>
                        <!-- Reviews-Tab /- -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Detail-Tabs /- -->
        <!-- Different-Product-Section -->
        <div class="detail-different-product-section u-s-p-t-80">
            <!-- Similar-Products -->
            <section class="section-maker">
                <div class="container">
                    <div class="sec-maker-header text-center">
                        <h3 class="sec-maker-h3">Similar Products</h3>
                    </div>
                    <div class="slider-fouc">
                        <div class="products-slider owl-carousel" data-item="4">
                            <div class="item">
                                <div class="image-container">
                                    <a class="item-img-wrapper-link" href="single-product.html">
                                        <img class="img-fluid" src="images/product/product@3x.jpg" alt="Product">
                                    </a>
                                    <div class="item-action-behaviors">
                                        <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                        <a class="item-mail" href="javascript:void(0)">Mail</a>
                                        <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                        <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <div class="what-product-is">
                                        <ul class="bread-crumb">
                                            <li class="has-separator">
                                                <a href="shop-v1-root-category.html">Men's</a>
                                            </li>
                                            <li class="has-separator">
                                                <a href="shop-v2-sub-category.html">Tops</a>
                                            </li>
                                            <li>
                                                <a href="shop-v3-sub-sub-category.html">Hoodies</a>
                                            </li>
                                        </ul>
                                        <h6 class="item-title">
                                            <a href="single-product.html">Casual Hoodie Full Cotton</a>
                                        </h6>
                                        <div class="item-stars">
                                            <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                <span style='width:0'></span>
                                            </div>
                                            <span>(0)</span>
                                        </div>
                                    </div>
                                    <div class="price-template">
                                        <div class="item-new-price">
                                            $55.00
                                        </div>
                                        <div class="item-old-price">
                                            $60.00
                                        </div>
                                    </div>
                                </div>
                                <div class="tag new">
                                    <span>NEW</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="image-container">
                                    <a class="item-img-wrapper-link" href="single-product.html">
                                        <img class="img-fluid" src="images/product/product@3x.jpg" alt="Product">
                                    </a>
                                    <div class="item-action-behaviors">
                                        <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                        <a class="item-mail" href="javascript:void(0)">Mail</a>
                                        <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                        <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <div class="what-product-is">
                                        <ul class="bread-crumb">
                                            <li class="has-separator">
                                                <a href="shop-v1-root-category.html">Men's</a>
                                            </li>
                                            <li class="has-separator">
                                                <a href="shop-v2-sub-category.html">Outwear</a>
                                            </li>
                                            <li>
                                                <a href="shop-v3-sub-sub-category.html">Jackets</a>
                                            </li>
                                        </ul>
                                        <h6 class="item-title">
                                            <a href="single-product.html">Fern Green Men's Jacket</a>
                                        </h6>
                                        <div class="item-stars">
                                            <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                <span style='width:0'></span>
                                            </div>
                                            <span>(0)</span>
                                        </div>
                                    </div>
                                    <div class="price-template">
                                        <div class="item-new-price">
                                            $55.00
                                        </div>
                                        <div class="item-old-price">
                                            $60.00
                                        </div>
                                    </div>
                                </div>
                                <div class="tag hot">
                                    <span>HOT</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="image-container">
                                    <a class="item-img-wrapper-link" href="single-product.html">
                                        <img class="img-fluid" src="images/product/product@3x.jpg" alt="Product">
                                    </a>
                                    <div class="item-action-behaviors">
                                        <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                        <a class="item-mail" href="javascript:void(0)">Mail</a>
                                        <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                        <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <div class="what-product-is">
                                        <ul class="bread-crumb">
                                            <li class="has-separator">
                                                <a href="shop-v1-root-category.html">Men's</a>
                                            </li>
                                            <li class="has-separator">
                                                <a href="shop-v2-sub-category.html">Sunglasses</a>
                                            </li>
                                            <li>
                                                <a href="shop-v3-sub-sub-category.html">Round</a>
                                            </li>
                                        </ul>
                                        <h6 class="item-title">
                                            <a href="single-product.html">Brown Dark Tan Round Double Bridge
                                                Sunglasses</a>
                                        </h6>
                                        <div class="item-stars">
                                            <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                <span style='width:0'></span>
                                            </div>
                                            <span>(0)</span>
                                        </div>
                                    </div>
                                    <div class="price-template">
                                        <div class="item-new-price">
                                            $55.00
                                        </div>
                                        <div class="item-old-price">
                                            $60.00
                                        </div>
                                    </div>
                                </div>
                                <div class="tag hot">
                                    <span>HOT</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="image-container">
                                    <a class="item-img-wrapper-link" href="single-product.html">
                                        <img class="img-fluid" src="images/product/product@3x.jpg" alt="Product">
                                    </a>
                                    <div class="item-action-behaviors">
                                        <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                        <a class="item-mail" href="javascript:void(0)">Mail</a>
                                        <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                        <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <div class="what-product-is">
                                        <ul class="bread-crumb">
                                            <li class="has-separator">
                                                <a href="shop-v1-root-category.html">Men's</a>
                                            </li>
                                            <li class="has-separator">
                                                <a href="shop-v2-sub-category.html">Sunglasses</a>
                                            </li>
                                            <li>
                                                <a href="shop-v3-sub-sub-category.html">Round</a>
                                            </li>
                                        </ul>
                                        <h6 class="item-title">
                                            <a href="single-product.html">Black Round Double Bridge Sunglasses</a>
                                        </h6>
                                        <div class="item-stars">
                                            <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                <span style='width:0'></span>
                                            </div>
                                            <span>(0)</span>
                                        </div>
                                    </div>
                                    <div class="price-template">
                                        <div class="item-new-price">
                                            $55.00
                                        </div>
                                        <div class="item-old-price">
                                            $60.00
                                        </div>
                                    </div>
                                </div>
                                <div class="tag hot">
                                    <span>HOT</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Similar-Products /- -->
            <!-- Recently-View-Products  -->
            <section class="section-maker">
                <div class="container">
                    <div class="sec-maker-header text-center">
                        <h3 class="sec-maker-h3">Recently View</h3>
                    </div>
                    <div class="slider-fouc">
                        <div class="products-slider owl-carousel" data-item="4">
                            <div class="item">
                                <div class="image-container">
                                    <a class="item-img-wrapper-link" href="single-product.html">
                                        <img class="img-fluid" src="images/product/product@3x.jpg" alt="Product">
                                    </a>
                                    <div class="item-action-behaviors">
                                        <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                        <a class="item-mail" href="javascript:void(0)">Mail</a>
                                        <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                        <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <div class="what-product-is">
                                        <ul class="bread-crumb">
                                            <li class="has-separator">
                                                <a href="shop-v1-root-category.html">Men's</a>
                                            </li>
                                            <li class="has-separator">
                                                <a href="shop-v2-sub-category.html">Outwear</a>
                                            </li>
                                            <li>
                                                <a href="shop-v3-sub-sub-category.html">Jackets</a>
                                            </li>
                                        </ul>
                                        <h6 class="item-title">
                                            <a href="single-product.html">Maire Battlefield Jeep Men's Jacket</a>
                                        </h6>
                                        <div class="item-stars">
                                            <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                <span style='width:0'></span>
                                            </div>
                                            <span>(0)</span>
                                        </div>
                                    </div>
                                    <div class="price-template">
                                        <div class="item-new-price">
                                            $55.00
                                        </div>
                                        <div class="item-old-price">
                                            $60.00
                                        </div>
                                    </div>
                                </div>
                                <div class="tag hot">
                                    <span>HOT</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Recently-View-Products /- -->
        </div>
        <!-- Different-Product-Section /- -->
    </div>
</div>
<!-- Single-Product-Full-Width-Page /- -->

<script type='text/javascript'>
$('#addReview').click(function() {
    var form = $(this);
    var productId = $(this).data('id');
    $.ajax({
        url: '../private/ajax/addReview.php',
        type: 'post',
        data: form.serialize(),
        success: function(response) {
            alert(response);
        }
    });
});
</script>

<?php
require_once(PRIVATE_PATH . "/shared/public_footer.php"); ?>