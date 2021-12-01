<?php
require_once("../private/initialize.php");
require_once(PRIVATE_PATH . "/shared/public_header.php");


?>
<!-- Main-Slider -->
<script>
document.querySelector('.full-layer-bottom-header .v-menu').classList.remove('v-close');
</script>

<div class="default-height ph-item">
    <div class="slider-main owl-carousel">
        <div class="bg-image one">
            <div class="slide-content slide-animation">
                <h1>Casual Clothing</h1>
                <h2>lifestyle / clothing / hype</h2>
            </div>
        </div>
        <div class="bg-image two">
            <div class="slide-content-2 slide-animation">
                <h2 class="slide-2-h2-a">The Baso</h2>
                <h2 class="slide-2-h2-b">Collection</h2>
                <h1>2021</h1>
            </div>
        </div>
        <div class="bg-image three">
            <div class="slide-content slide-animation">
                <h1>Tech
                    <span style="color:#333">Deals</span>
                </h1>
                <h2 style="color:#333"># shopping</h2>
            </div>
        </div>
    </div>
</div>
<!-- Main-Slider /- -->
<!-- Banner-Layer -->
<div class="banner-layer">
    <div class="container">
        <div class="image-banner">
            <a href="search.php?category=6" class="mx-auto banner-hover effect-dark-opacity ">
                <img class="img-fluid w-25" src="images/banners/book.png" alt="Winter Season Banner">
                <h2 class="slide-content slide-animation">Explore Our Book Collection!</h2>
            </a>
        </div>
    </div>
</div>
<!-- Banner-Layer /- -->
<!-- Men-Clothing -->
<section class="section-maker">
    <div class="container">
        <div class="sec-maker-header text-center">
            <h3 class="sec-maker-h3">Our Best Sell By Category</h3>
            <ul class="nav tab-nav-style-1-a justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#Clothing-feature-products">Clothing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#Pharmaceutical-feature-products">pharmaceutical</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#Accessory-feature-products">Accessories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#Books-featured-products">Books</a>
                </li>
            </ul>
        </div>
        <div class="wrapper-content">
            <div class="outer-area-tab">
                <div class="tab-content">
                    <div class="tab-pane active show fade" id="Clothing-feature-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">



                                <!-- Get all the Clothing from the database  -->
                                <?php
                                $clothing = Product::find_all_by_Category([1, 2]);

                                foreach ($clothing as $p) {
                                    $category = Category::find_product_category($p->id);
                                    $scategory = SubCategory::find_product_category($p->id);
                                    $sscategory = SubSubCategory::find_product_category($p->id);

                                    $stock = ProductStock::find_by_product_id($p->id);
                                    $colors = Color::find_product_category($p->id);
                                    $size = Size::find_product_category($p->id);
                                ?>

                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link"
                                            href="view-product.php?id=<?php echo $p->id; ?>"
                                            style="overflow:hidden; height:280px;">
                                            <img class="img-fluid"
                                                src="<?php echo  S_PRIVATE . '/uploads/' . $p->productThumb; ?>"
                                                alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look quick-view-product"
                                                data-id='<?php echo $p->id; ?>'>Quick
                                                Look</a>
                                            <!-- <a class="item-mail" href="javascript:void(0)">Mail</a> -->
                                            <a class="item-addwishlist item-addwishlistBTN"
                                                data-id='<?php echo $p->id; ?>'>Add to
                                                Wishlist</a>
                                            <a class="item-addCart item-addCartBTN " data-id='<?php echo $p->id; ?>'
                                                data-id='<?php echo $p->id; ?>'>Add to
                                                Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <?php foreach ($category as $c) { ?>
                                                <li class="has-separator">
                                                    <a
                                                        href="search.php?category=<?php echo $c->id; ?>"><?php echo  ellipse_of(strtoupper($c->categoryName), 5); ?></a>
                                                </li>
                                                <?php } ?>
                                                <?php foreach ($scategory as $s) { ?>
                                                <li class="has-separator">
                                                    <a
                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id ?>'><?php echo ellipse_of(strtoupper($s->name), 8); ?></a>
                                                </li>
                                                <?php } ?>

                                                <?php foreach ($sscategory as $ss) { ?>
                                                <li class="">
                                                    <a
                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id . "&sub-sub-category=" . $ss->id ?>'><?php echo ellipse_of(strtoupper($ss->name), 10); ?></a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                            <h6 class="item-title">
                                                <a
                                                    href="view-product.php?id=<?php echo $p->id; ?>"><?php echo ellipse_of($p->productName, 30); ?></a>
                                            </h6>

                                            <div class="item-stars">
                                                <div class=' star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width: 65px;'></span>
                                                </div>
                                                <span>(<?php echo (productReview::count_by_product($p->id)); ?>)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Frw <?php echo number_format($p->productPrice, 2); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        // If there is a review on a product , then display that it's New
                                        if (productReview::count_by_product($p->id) >= 1) {
                                            echo "<div class='tag new'><span>New</span></div>";
                                        } elseif ($p->productPrice <= 10000) {
                                            echo "<div class='tag hot'><span>HOT</span></div>";
                                        } ?>
                                </div>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Pharmaceutical-feature-products">
                        <!-- Product Not Found -->
                        <div class="product-not-found">
                            <div class="not-found">
                                <h2>SORRY!</h2>
                                <h6>No Pharmaceutical products in our store for now lol </h6>
                            </div>
                        </div>
                        <!-- Product Not Found /- -->
                    </div>
                    <div class="tab-pane fade" id="Accessory-feature-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                <!-- Get all the Clothing from the database  -->
                                <?php
                                $accessory = Product::find_all_by_Category([4]);

                                foreach ($accessory as $p) {
                                    $category = Category::find_product_category($p->id);
                                    $scategory = SubCategory::find_product_category($p->id);
                                    $sscategory = SubSubCategory::find_product_category($p->id);

                                    $stock = ProductStock::find_by_product_id($p->id);
                                    $colors = Color::find_product_category($p->id);
                                    $size = Size::find_product_category($p->id);
                                ?>

                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link"
                                            href="view-product.php?id=<?php echo $p->id; ?>"
                                            style="overflow:hidden; height:280px;">
                                            <img class="img-fluid"
                                                src="<?php echo  S_PRIVATE . '/uploads/' . $p->productThumb; ?>"
                                                alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look quick-view-product"
                                                data-id='<?php echo $p->id; ?>'>Quick
                                                Look</a>
                                            <!-- <a class="item-mail" href="javascript:void(0)">Mail</a> -->
                                            <a class="item-addwishlist item-addwishlistBTN"
                                                data-id='<?php echo $p->id; ?>'>Add to
                                                Wishlist</a>
                                            <a class="item-addCart item-addCartBTN " data-id='<?php echo $p->id; ?>'
                                                data-id='<?php echo $p->id; ?>'>Add to
                                                Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <?php foreach ($category as $c) { ?>
                                                <li class="has-separator">
                                                    <a
                                                        href="search.php?category=<?php echo $c->id; ?>"><?php echo  ellipse_of(strtoupper($c->categoryName), 5); ?></a>
                                                </li>
                                                <?php } ?>
                                                <?php foreach ($scategory as $s) { ?>
                                                <li class="has-separator">
                                                    <a
                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id ?>'><?php echo ellipse_of(strtoupper($s->name), 8); ?></a>
                                                </li>
                                                <?php } ?>

                                                <?php foreach ($sscategory as $ss) { ?>
                                                <li class="">
                                                    <a
                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id . "&sub-sub-category=" . $ss->id ?>'><?php echo ellipse_of(strtoupper($ss->name), 10); ?></a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                            <h6 class="item-title">
                                                <a
                                                    href="view-product.php?id=<?php echo $p->id; ?>"><?php echo ellipse_of($p->productName, 30); ?></a>
                                            </h6>

                                            <div class="item-stars">
                                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width: 65px;'></span>
                                                </div>
                                                <span>(<?php echo (productReview::count_by_product($p->id)); ?>)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Frw <?php echo number_format($p->productPrice, 2); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        // If there is a review on a product , then display that it's New
                                        if (productReview::count_by_product($p->id) >= 1) {
                                            echo "<div class='tag new'><span>New</span></div>";
                                        } elseif ($p->productPrice <= 10000) {
                                            echo "<div class='tag hot'><span>HOT</span></div>";
                                        } ?>
                                </div>

                                <?php } ?>



                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Books-featured-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">

                                <!-- Get all the books from the database  -->
                                <?php
                                $books = Product::find_all_by_Category([6]);

                                foreach ($books as $p) {
                                    $category = Category::find_product_category($p->id);
                                    $scategory = SubCategory::find_product_category($p->id);
                                    $sscategory = SubSubCategory::find_product_category($p->id);

                                    $stock = ProductStock::find_by_product_id($p->id);
                                    $colors = Color::find_product_category($p->id);
                                    $size = Size::find_product_category($p->id);
                                ?>

                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link"
                                            href="view-product.php?id=<?php echo $p->id; ?>"
                                            style="overflow:hidden; height:280px;">
                                            <img class="img-fluid"
                                                src="<?php echo  S_PRIVATE . '/uploads/' . $p->productThumb; ?>"
                                                alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look quick-view-product"
                                                data-id='<?php echo $p->id; ?>'>Quick
                                                Look</a>
                                            <!-- <a class="item-mail" href="javascript:void(0)">Mail</a> -->
                                            <a class="item-addwishlist item-addwishlistBTN">Add to Wishlist</a>
                                            <a class="item-addCart item-addCartBTN " data-id='<?php echo $p->id; ?>'>Add
                                                to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <?php foreach ($category as $c) { ?>
                                                <li class="has-separator">
                                                    <a
                                                        href="search.php"><?php echo  ellipse_of(strtoupper($c->categoryName), 5); ?></a>
                                                </li>
                                                <?php } ?>
                                                <?php foreach ($scategory as $s) { ?>
                                                <li class="has-separator">
                                                    <a
                                                        href="search.php"><?php echo ellipse_of(strtoupper($s->name), 8); ?></a>
                                                </li>
                                                <?php } ?>

                                                <?php foreach ($sscategory as $ss) { ?>
                                                <li class="">
                                                    <a
                                                        href="search.php"><?php echo ellipse_of(strtoupper($ss->name), 10); ?></a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                            <h6 class="item-title">
                                                <a
                                                    href="view-product.php?id=<?php echo $p->id; ?>"><?php echo ellipse_of($p->productName, 30); ?></a>
                                            </h6>

                                            <div class="item-stars">
                                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width: 65px;'></span>
                                                </div>
                                                <span>(<?php echo (productReview::count_by_product($p->id)); ?>)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Frw <?php echo number_format($p->productPrice, 2); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        // If there is a review on a product , then display that it's New
                                        if (productReview::count_by_product($p->id) >= 1) {
                                            echo "<div class='tag new'><span>New</span></div>";
                                        } elseif ($p->productPrice <= 10000) {
                                            echo "<div class='tag hot'><span>HOT</span></div>";
                                        } ?>
                                </div>

                                <?php } ?>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Men-Clothing-Timing-Section -->
<section class="section-maker">
    <div class="container">
        <div class="sec-maker-header text-center">
            <span class="sec-maker-span-text">Some Of Our Electronic Devices</span>
            <h3 class="sec-maker-h3 u-s-m-b-22">Hot Deals</h3>
            <span class="sec-maker-span-text">Ends in</span>
            <!-- Timing-Box -->
            <div class="section-timing-wrapper dynamic">
                <span class="fictitious-seconds" style="display:none;">18000</span>
                <div class="section-box-wrapper box-days">
                    <div class="section-box">
                        <span class="section-key">120</span>
                        <span class="section-value">Days</span>
                    </div>
                </div>
                <div class="section-box-wrapper box-hrs">
                    <div class="section-box">
                        <span class="section-key">54</span>
                        <span class="section-value">HRS</span>
                    </div>
                </div>
                <div class="section-box-wrapper box-mins">
                    <div class="section-box">
                        <span class="section-key">3</span>
                        <span class="section-value">MINS</span>
                    </div>
                </div>
                <div class="section-box-wrapper box-secs">
                    <div class="section-box">
                        <span class="section-key">32</span>
                        <span class="section-value">SEC</span>
                    </div>
                </div>
            </div>
            <!-- Timing-Box /- -->
        </div>
        <!-- Carousel -->
        <div class="slider-fouc">
            <div class="products-slider owl-carousel" data-item="4">

                <!-- Get all the Electronic Devicess from the database  -->
                <?php
                $clothing = Product::find_all_by_Category([3, 4, 5]);

                foreach ($clothing as $p) {
                    $category = Category::find_product_category($p->id);
                    $scategory = SubCategory::find_product_category($p->id);
                    $sscategory = SubSubCategory::find_product_category($p->id);

                    $stock = ProductStock::find_by_product_id($p->id);
                    $colors = Color::find_product_category($p->id);
                    $size = Size::find_product_category($p->id);
                ?>

                <div class="item">
                    <div class="image-container">
                        <a class="item-img-wrapper-link" href="view-product.php?id=<?php echo $p->id; ?>"
                            style="overflow:hidden; height:280px;">
                            <img class="img-fluid" src="<?php echo  S_PRIVATE . '/uploads/' . $p->productThumb; ?>"
                                alt="Product">
                        </a>
                        <div class="item-action-behaviors">
                            <a class="item-quick-look quick-view-product" data-id='<?php echo $p->id; ?>'>Quick
                                Look</a>
                            <!-- <a class="item-mail" href="javascript:void(0)">Mail</a> -->
                            <a class="item-addwishlist item-addwishlistBTN" data-id='<?php echo $p->id; ?>'>Add to
                                Wishlist</a>
                            <a class="item-addCart item-addCartBTN " data-id='<?php echo $p->id; ?>'
                                data-id='<?php echo $p->id; ?>'>Add
                                to
                                Cart</a>
                        </div>
                    </div>
                    <div class="item-content">
                        <div class="what-product-is">
                            <ul class="bread-crumb">
                                <?php foreach ($category as $c) { ?>
                                <li class="has-separator">
                                    <a
                                        href="search.php?category=<?php echo $c->id; ?>"><?php echo  ellipse_of(strtoupper($c->categoryName), 5); ?></a>
                                </li>
                                <?php } ?>
                                <?php foreach ($scategory as $s) { ?>
                                <li class="has-separator">
                                    <a
                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id ?>'><?php echo ellipse_of(strtoupper($s->name), 8); ?></a>
                                </li>
                                <?php } ?>

                                <?php foreach ($sscategory as $ss) { ?>
                                <li class="">
                                    <a
                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id . "&sub-sub-category=" . $ss->id ?>'><?php echo ellipse_of(strtoupper($ss->name), 10); ?></a>
                                </li>
                                <?php } ?>
                            </ul>
                            <h6 class="item-title">
                                <a
                                    href="view-product.php?id=<?php echo $p->id; ?>"><?php echo ellipse_of($p->productName, 25); ?></a>
                            </h6>

                            <div class="item-stars">
                                <div class=' star' title="4.5 out of 5 - based on 23 Reviews">
                                    <span style='width: 65px;'></span>
                                </div>
                                <span>(<?php echo (productReview::count_by_product($p->id)); ?>)</span>
                            </div>
                        </div>
                        <div class="price-template">
                            <div class="item-new-price">
                                Frw <?php echo number_format($p->productPrice, 2); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        // If there is a review on a product , then display that it's New
                        if (productReview::count_by_product($p->id) >= 1) {
                            echo "<div class='tag new'><span>New</span></div>";
                        } elseif ($p->productPrice <= 10000) {
                            echo "<div class='tag hot'><span>HOT</span></div>";
                        } ?>
                </div>

                <?php } ?>

            </div>
        </div>
        <!-- Carousel /- -->
    </div>
</section>
<!-- Men-Clothing-Timing-Section /- -->
<!-- Banner-Image & View-more -->
<div class="banner-image-view-more">
    <div class="container">
        <div class="image-banner u-s-m-y-40">
            <a href="search.php" class="mx-auto banner-hover effect-dark-opacity">
                <img class="img-fluid" src="images/banners/banner-home.jpg" alt="Banner Image">
            </a>
        </div>
        <div class="redirect-link-wrapper text-center u-s-p-t-25 u-s-p-b-80">
            <a class="redirect-link" href="search.php">
                <span>View more on this category</span>
            </a>
        </div>
    </div>
</div>
<!-- Banner-Image & View-more /- -->
<!-- Men-Clothing /- -->
<!-- Women-Clothing -->

<!-- Toys-Hobbies-&-Robots -->
<section class="section-maker">
    <div class="container">
        <div class="sec-maker-header text-center">
            <h3 class="sec-maker-h3">Toys Hobbies & Robots</h3>
            <ul class="nav tab-nav-style-1-a justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#toys-latest-products">Latest
                        Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#toys-best-selling-products">Best Selling</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#toys-top-rating-products">Top Rating</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#toys-featured-products">Featured Products</a>
                </li>
            </ul>
        </div>
        <div class="wrapper-content">
            <div class="outer-area-tab">
                <div class="tab-content">
                    <div class="tab-pane active show fade" id="toys-latest-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">



                                <!-- Get all the Clothing from the database  -->
                                <?php
                                $clothing = Product::find_all_by_Category([3]);


                                foreach ($clothing as $p) {
                                    $category = Category::find_product_category($p->id);
                                    $scategory = SubCategory::find_product_category($p->id);
                                    $sscategory = SubSubCategory::find_product_category($p->id);

                                    $stock = ProductStock::find_by_product_id($p->id);
                                    $colors = Color::find_product_category($p->id);
                                    $size = Size::find_product_category($p->id);
                                ?>

                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link"
                                            href="view-product.php?id=<?php echo $p->id; ?>"
                                            style="overflow:hidden; height:280px;">
                                            <img class="img-fluid"
                                                src="<?php echo  S_PRIVATE . '/uploads/' . $p->productThumb; ?>"
                                                alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look quick-view-product"
                                                data-id='<?php echo $p->id; ?>'>Quick
                                                Look</a>
                                            <!-- <a class="item-mail" href="javascript:void(0)">Mail</a> -->
                                            <a class="item-addwishlist item-addwishlistBTN"
                                                data-id='<?php echo $p->id; ?>'>Add to
                                                Wishlist</a>
                                            <a class="item-addCart item-addCartBTN " data-id='<?php echo $p->id; ?>'
                                                data-id='<?php echo $p->id; ?>'>Add to
                                                Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <?php foreach ($category as $c) { ?>
                                                <li class="has-separator">
                                                    <a
                                                        href="search.php?category=<?php echo $c->id; ?>"><?php echo  ellipse_of(strtoupper($c->categoryName), 5); ?></a>
                                                </li>
                                                <?php } ?>
                                                <?php foreach ($scategory as $s) { ?>
                                                <li class="has-separator">
                                                    <a
                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id ?>'><?php echo ellipse_of(strtoupper($s->name), 8); ?></a>
                                                </li>
                                                <?php } ?>

                                                <?php foreach ($sscategory as $ss) { ?>
                                                <li class="">
                                                    <a
                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id . "&sub-sub-category=" . $ss->id ?>'><?php echo ellipse_of(strtoupper($ss->name), 10); ?></a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                            <h6 class="item-title">
                                                <a
                                                    href="view-product.php?id=<?php echo $p->id; ?>"><?php echo ellipse_of($p->productName, 30); ?></a>
                                            </h6>

                                            <div class="item-stars">
                                                <div class=' star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width: 65px;'></span>
                                                </div>
                                                <span>(<?php echo (productReview::count_by_product($p->id)); ?>)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Frw <?php echo number_format($p->productPrice, 2); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        // If there is a review on a product , then display that it's New
                                        if (productReview::count_by_product($p->id) >= 1) {
                                            echo "<div class='tag new'><span>New</span></div>";
                                        } elseif ($p->productPrice <= 10000) {
                                            echo "<div class='tag hot'><span>HOT</span></div>";
                                        } ?>
                                </div>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="toys-best-selling-products">
                        <!-- Product Not Found -->
                        <div class="product-not-found">
                            <div class="not-found">
                                <h2>SORRY!</h2>
                                <h6>There is not any product in specific catalogue.</h6>
                            </div>
                        </div>
                        <!-- Product Not Found /- -->
                    </div>
                    <div class="tab-pane fade" id="toys-top-rating-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">



                                <!-- Get all the Clothing from the database  -->
                                <?php
                                $clothing = Product::find_all_by_Category([3]);


                                foreach ($clothing as $p) {
                                    $category = Category::find_product_category($p->id);
                                    $scategory = SubCategory::find_product_category($p->id);
                                    $sscategory = SubSubCategory::find_product_category($p->id);

                                    $stock = ProductStock::find_by_product_id($p->id);
                                    $colors = Color::find_product_category($p->id);
                                    $size = Size::find_product_category($p->id);
                                ?>

                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link"
                                            href="view-product.php?id=<?php echo $p->id; ?>"
                                            style="overflow:hidden; height:280px;">
                                            <img class="img-fluid"
                                                src="<?php echo  S_PRIVATE . '/uploads/' . $p->productThumb; ?>"
                                                alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look quick-view-product"
                                                data-id='<?php echo $p->id; ?>'>Quick
                                                Look</a>
                                            <!-- <a class="item-mail" href="javascript:void(0)">Mail</a> -->
                                            <a class="item-addwishlist item-addwishlistBTN"
                                                data-id='<?php echo $p->id; ?>'>Add to
                                                Wishlist</a>
                                            <a class="item-addCart item-addCartBTN " data-id='<?php echo $p->id; ?>'
                                                data-id='<?php echo $p->id; ?>'>Add to
                                                Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <?php foreach ($category as $c) { ?>
                                                <li class="has-separator">
                                                    <a
                                                        href="search.php?category=<?php echo $c->id; ?>"><?php echo  ellipse_of(strtoupper($c->categoryName), 5); ?></a>
                                                </li>
                                                <?php } ?>
                                                <?php foreach ($scategory as $s) { ?>
                                                <li class="has-separator">
                                                    <a
                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id ?>'><?php echo ellipse_of(strtoupper($s->name), 8); ?></a>
                                                </li>
                                                <?php } ?>

                                                <?php foreach ($sscategory as $ss) { ?>
                                                <li class="">
                                                    <a
                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id . "&sub-sub-category=" . $ss->id ?>'><?php echo ellipse_of(strtoupper($ss->name), 10); ?></a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                            <h6 class="item-title">
                                                <a
                                                    href="view-product.php?id=<?php echo $p->id; ?>"><?php echo ellipse_of($p->productName, 30); ?></a>
                                            </h6>

                                            <div class="item-stars">
                                                <div class=' star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width: 65px;'></span>
                                                </div>
                                                <span>(<?php echo (productReview::count_by_product($p->id)); ?>)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Frw <?php echo number_format($p->productPrice, 2); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        // If there is a review on a product , then display that it's New
                                        if (productReview::count_by_product($p->id) >= 1) {
                                            echo "<div class='tag new'><span>New</span></div>";
                                        } elseif ($p->productPrice <= 10000) {
                                            echo "<div class='tag hot'><span>HOT</span></div>";
                                        } ?>
                                </div>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="toys-featured-products">
                        <!-- Product Not Found -->
                        <div class="product-not-found">
                            <div class="not-found">
                                <h2>SORRY!</h2>
                                <h6>There is not any product in specific catalogue.</h6>
                            </div>
                        </div>
                        <!-- Product Not Found /- -->
                    </div>
                </div>
            </div>
        </div>
        <div class="redirect-link-wrapper text-center u-s-p-t-25 u-s-p-b-80">
            <a class="redirect-link" href="search.php">
                <span>View more on this category</span>
            </a>
        </div>
    </div>
</section>

<section class="section-maker">
    <div class="container">
        <div class="sec-maker-header text-center">
            <h3 class="sec-maker-h3">Consumer Electronics</h3>
            <ul class="nav tab-nav-style-1-a justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#consumer-latest-products">Latest
                        Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#consumer-best-selling-products">Best
                        Selling</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#consumer-top-rating-products">Top Rating</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#consumer-featured-products">Featured
                        Products</a>
                </li>
            </ul>
            <span class="sec-maker-span-text u-s-m-b-8 d-block">Select products in specific category</span>
        </div>
        <div class="wrapper-content">
            <div class="outer-area-tab">
                <div class="tab-content">
                    <div class="tab-pane active show fade" id="consumer-latest-products">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-12">
                                <ul class="nav tab-nav-style-2-a">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#laptops" title="Laptops">
                                            <i class="ion ion-md-laptop"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#pc-and-accessories"
                                            title="PC & Accessories">
                                            <i class="ion ion-ios-settings"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#phones" title="Phones">
                                            <i class="ion ion-ios-phone-portrait"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#cam-corder"
                                            title="Camera & Camcorders">
                                            <i class="ion ion-md-camera"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#audio-amplifiers"
                                            title="Audio & Amplifiers">
                                            <i class="ion ion-md-microphone"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-11 col-md-12">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="laptops">
                                        <div class="slider-fouc">
                                            <div class="products-slider owl-carousel" data-item="4">
                                                <!-- Get all the Clothing from the database  -->
                                                <?php
                                                $accessory = Product::find_all_by_subCategory([25]);

                                                foreach ($accessory as $p) {
                                                    $category = Category::find_product_category($p->id);
                                                    $scategory = SubCategory::find_product_category($p->id);
                                                    $sscategory = SubSubCategory::find_product_category($p->id);

                                                    $stock = ProductStock::find_by_product_id($p->id);
                                                    $colors = Color::find_product_category($p->id);
                                                    $size = Size::find_product_category($p->id);
                                                ?>

                                                <div class="item">
                                                    <div class="image-container">
                                                        <a class="item-img-wrapper-link"
                                                            href="view-product.php?id=<?php echo $p->id; ?>"
                                                            style="overflow:hidden; height:280px;">
                                                            <img class="img-fluid"
                                                                src="<?php echo  S_PRIVATE . '/uploads/' . $p->productThumb; ?>"
                                                                alt="Product">
                                                        </a>
                                                        <div class="item-action-behaviors">
                                                            <a class="item-quick-look quick-view-product"
                                                                data-id='<?php echo $p->id; ?>'>Quick
                                                                Look</a>
                                                            <!-- <a class="item-mail" href="javascript:void(0)">Mail</a> -->
                                                            <a class="item-addwishlist item-addwishlistBTN"
                                                                data-id='<?php echo $p->id; ?>'>Add to
                                                                Wishlist</a>
                                                            <a class="item-addCart item-addCartBTN "
                                                                data-id='<?php echo $p->id; ?>'
                                                                data-id='<?php echo $p->id; ?>'>Add to
                                                                Cart</a>
                                                        </div>
                                                    </div>
                                                    <div class="item-content">
                                                        <div class="what-product-is">
                                                            <ul class="bread-crumb">
                                                                <?php foreach ($category as $c) { ?>
                                                                <li class="has-separator">
                                                                    <a
                                                                        href="search.php?category=<?php echo $c->id; ?>"><?php echo  ellipse_of(strtoupper($c->categoryName), 5); ?></a>
                                                                </li>
                                                                <?php } ?>
                                                                <?php foreach ($scategory as $s) { ?>
                                                                <li class="has-separator">
                                                                    <a
                                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id ?>'><?php echo ellipse_of(strtoupper($s->name), 8); ?></a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php foreach ($sscategory as $ss) { ?>
                                                                <li class="">
                                                                    <a
                                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id . "&sub-sub-category=" . $ss->id ?>'><?php echo ellipse_of(strtoupper($ss->name), 10); ?></a>
                                                                </li>
                                                                <?php } ?>
                                                            </ul>
                                                            <h6 class="item-title">
                                                                <a
                                                                    href="view-product.php?id=<?php echo $p->id; ?>"><?php echo ellipse_of($p->productName, 30); ?></a>
                                                            </h6>

                                                            <div class="item-stars">
                                                                <div class='star'
                                                                    title="4.5 out of 5 - based on 23 Reviews">
                                                                    <span style='width: 65px;'></span>
                                                                </div>
                                                                <span>(<?php echo (productReview::count_by_product($p->id)); ?>)</span>
                                                            </div>
                                                        </div>
                                                        <div class="price-template">
                                                            <div class="item-new-price">
                                                                Frw <?php echo number_format($p->productPrice, 2); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        // If there is a review on a product , then display that it's New
                                                        if (productReview::count_by_product($p->id) >= 1) {
                                                            echo "<div class='tag new'><span>New</span></div>";
                                                        } elseif ($p->productPrice <= 10000) {
                                                            echo "<div class='tag hot'><span>HOT</span></div>";
                                                        } ?>
                                                </div>

                                                <?php } ?>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pc-and-accessories">
                                        <!-- Product Not Found -->
                                        <div class="product-not-found">
                                            <div class="not-found">
                                                <h2>SORRY!</h2>
                                                <h6>There is not any product in specific catalogue.</h6>
                                            </div>
                                        </div>
                                        <!-- Product Not Found /- -->
                                    </div>
                                    <div class="tab-pane fade" id="phones">
                                        <div class="slider-fouc">
                                            <div class="products-slider owl-carousel" data-item="4">
                                                <!-- Get all the Clothing from the database  -->
                                                <?php
                                                $accessory = Product::find_all_by_subCategory([22, 24]);

                                                foreach ($accessory as $p) {
                                                    $category = Category::find_product_category($p->id);
                                                    $scategory = SubCategory::find_product_category($p->id);
                                                    $sscategory = SubSubCategory::find_product_category($p->id);

                                                    $stock = ProductStock::find_by_product_id($p->id);
                                                    $colors = Color::find_product_category($p->id);
                                                    $size = Size::find_product_category($p->id);
                                                ?>

                                                <div class="item">
                                                    <div class="image-container">
                                                        <a class="item-img-wrapper-link"
                                                            href="view-product.php?id=<?php echo $p->id; ?>"
                                                            style="overflow:hidden; height:280px;">
                                                            <img class="img-fluid"
                                                                src="<?php echo  S_PRIVATE . '/uploads/' . $p->productThumb; ?>"
                                                                alt="Product">
                                                        </a>
                                                        <div class="item-action-behaviors">
                                                            <a class="item-quick-look quick-view-product"
                                                                data-id='<?php echo $p->id; ?>'>Quick
                                                                Look</a>
                                                            <!-- <a class="item-mail" href="javascript:void(0)">Mail</a> -->
                                                            <a class="item-addwishlist item-addwishlistBTN"
                                                                data-id='<?php echo $p->id; ?>'>Add to
                                                                Wishlist</a>
                                                            <a class="item-addCart item-addCartBTN "
                                                                data-id='<?php echo $p->id; ?>'
                                                                data-id='<?php echo $p->id; ?>'>Add to
                                                                Cart</a>
                                                        </div>
                                                    </div>
                                                    <div class="item-content">
                                                        <div class="what-product-is">
                                                            <ul class="bread-crumb">
                                                                <?php foreach ($category as $c) { ?>
                                                                <li class="has-separator">
                                                                    <a
                                                                        href="search.php?category=<?php echo $c->id; ?>"><?php echo  ellipse_of(strtoupper($c->categoryName), 5); ?></a>
                                                                </li>
                                                                <?php } ?>
                                                                <?php foreach ($scategory as $s) { ?>
                                                                <li class="has-separator">
                                                                    <a
                                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id ?>'><?php echo ellipse_of(strtoupper($s->name), 8); ?></a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php foreach ($sscategory as $ss) { ?>
                                                                <li class="">
                                                                    <a
                                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id . "&sub-sub-category=" . $ss->id ?>'><?php echo ellipse_of(strtoupper($ss->name), 10); ?></a>
                                                                </li>
                                                                <?php } ?>
                                                            </ul>
                                                            <h6 class="item-title">
                                                                <a
                                                                    href="view-product.php?id=<?php echo $p->id; ?>"><?php echo ellipse_of($p->productName, 30); ?></a>
                                                            </h6>

                                                            <div class="item-stars">
                                                                <div class='star'
                                                                    title="4.5 out of 5 - based on 23 Reviews">
                                                                    <span style='width: 65px;'></span>
                                                                </div>
                                                                <span>(<?php echo (productReview::count_by_product($p->id)); ?>)</span>
                                                            </div>
                                                        </div>
                                                        <div class="price-template">
                                                            <div class="item-new-price">
                                                                Frw <?php echo number_format($p->productPrice, 2); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        // If there is a review on a product , then display that it's New
                                                        if (productReview::count_by_product($p->id) >= 1) {
                                                            echo "<div class='tag new'><span>New</span></div>";
                                                        } elseif ($p->productPrice <= 10000) {
                                                            echo "<div class='tag hot'><span>HOT</span></div>";
                                                        } ?>
                                                </div>

                                                <?php } ?>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="cam-corder">
                                        <div class="slider-fouc">
                                            <div class="products-slider owl-carousel" data-item="4">
                                                <!-- Get all the Clothing from the database  -->
                                                <?php
                                                $accessory = Product::find_all_by_subCategory([28]);

                                                foreach ($accessory as $p) {
                                                    $category = Category::find_product_category($p->id);
                                                    $scategory = SubCategory::find_product_category($p->id);
                                                    $sscategory = SubSubCategory::find_product_category($p->id);

                                                    $stock = ProductStock::find_by_product_id($p->id);
                                                    $colors = Color::find_product_category($p->id);
                                                    $size = Size::find_product_category($p->id);
                                                ?>

                                                <div class="item">
                                                    <div class="image-container">
                                                        <a class="item-img-wrapper-link"
                                                            href="view-product.php?id=<?php echo $p->id; ?>"
                                                            style="overflow:hidden; height:280px;">
                                                            <img class="img-fluid"
                                                                src="<?php echo  S_PRIVATE . '/uploads/' . $p->productThumb; ?>"
                                                                alt="Product">
                                                        </a>
                                                        <div class="item-action-behaviors">
                                                            <a class="item-quick-look quick-view-product"
                                                                data-id='<?php echo $p->id; ?>'>Quick
                                                                Look</a>
                                                            <!-- <a class="item-mail" href="javascript:void(0)">Mail</a> -->
                                                            <a class="item-addwishlist item-addwishlistBTN"
                                                                data-id='<?php echo $p->id; ?>'>Add to
                                                                Wishlist</a>
                                                            <a class="item-addCart item-addCartBTN "
                                                                data-id='<?php echo $p->id; ?>'
                                                                data-id='<?php echo $p->id; ?>'>Add to
                                                                Cart</a>
                                                        </div>
                                                    </div>
                                                    <div class="item-content">
                                                        <div class="what-product-is">
                                                            <ul class="bread-crumb">
                                                                <?php foreach ($category as $c) { ?>
                                                                <li class="has-separator">
                                                                    <a
                                                                        href="search.php?category=<?php echo $c->id; ?>"><?php echo  ellipse_of(strtoupper($c->categoryName), 5); ?></a>
                                                                </li>
                                                                <?php } ?>
                                                                <?php foreach ($scategory as $s) { ?>
                                                                <li class="has-separator">
                                                                    <a
                                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id ?>'><?php echo ellipse_of(strtoupper($s->name), 8); ?></a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php foreach ($sscategory as $ss) { ?>
                                                                <li class="">
                                                                    <a
                                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id . "&sub-sub-category=" . $ss->id ?>'><?php echo ellipse_of(strtoupper($ss->name), 10); ?></a>
                                                                </li>
                                                                <?php } ?>
                                                            </ul>
                                                            <h6 class="item-title">
                                                                <a
                                                                    href="view-product.php?id=<?php echo $p->id; ?>"><?php echo ellipse_of($p->productName, 30); ?></a>
                                                            </h6>

                                                            <div class="item-stars">
                                                                <div class='star'
                                                                    title="4.5 out of 5 - based on 23 Reviews">
                                                                    <span style='width: 65px;'></span>
                                                                </div>
                                                                <span>(<?php echo (productReview::count_by_product($p->id)); ?>)</span>
                                                            </div>
                                                        </div>
                                                        <div class="price-template">
                                                            <div class="item-new-price">
                                                                Frw <?php echo number_format($p->productPrice, 2); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        // If there is a review on a product , then display that it's New
                                                        if (productReview::count_by_product($p->id) >= 1) {
                                                            echo "<div class='tag new'><span>New</span></div>";
                                                        } elseif ($p->productPrice <= 10000) {
                                                            echo "<div class='tag hot'><span>HOT</span></div>";
                                                        } ?>
                                                </div>

                                                <?php } ?>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="audio-amplifiers">
                                        <!-- Product Not Found -->
                                        <div class="product-not-found">
                                            <div class="not-found">
                                                <h2>SORRY!</h2>
                                                <h6>There is not any product in specific catalogue.</h6>
                                            </div>
                                        </div>
                                        <!-- Product Not Found /- -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="consumer-best-selling-products">
                        <!-- Best Consumer Electronics product -->

                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                <!-- Get all the Consumer electronics from the database  -->
                                <?php
                                $accessory = Product::find_all_by_Category([5]);

                                foreach ($accessory as $p) {
                                    $category = Category::find_product_category($p->id);
                                    $scategory = SubCategory::find_product_category($p->id);
                                    $sscategory = SubSubCategory::find_product_category($p->id);

                                    $stock = ProductStock::find_by_product_id($p->id);
                                    $colors = Color::find_product_category($p->id);
                                    $size = Size::find_product_category($p->id);
                                ?>

                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link"
                                            href="view-product.php?id=<?php echo $p->id; ?>"
                                            style="overflow:hidden; height:280px;">
                                            <img class="img-fluid"
                                                src="<?php echo  S_PRIVATE . '/uploads/' . $p->productThumb; ?>"
                                                alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look quick-view-product"
                                                data-id='<?php echo $p->id; ?>'>Quick
                                                Look</a>
                                            <!-- <a class="item-mail" href="javascript:void(0)">Mail</a> -->
                                            <a class="item-addwishlist item-addwishlistBTN"
                                                data-id='<?php echo $p->id; ?>'>Add to
                                                Wishlist</a>
                                            <a class="item-addCart item-addCartBTN " data-id='<?php echo $p->id; ?>'
                                                data-id='<?php echo $p->id; ?>'>Add to
                                                Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <?php foreach ($category as $c) { ?>
                                                <li class="has-separator">
                                                    <a
                                                        href="search.php?category=<?php echo $c->id; ?>"><?php echo  ellipse_of(strtoupper($c->categoryName), 5); ?></a>
                                                </li>
                                                <?php } ?>
                                                <?php foreach ($scategory as $s) { ?>
                                                <li class="has-separator">
                                                    <a
                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id ?>'><?php echo ellipse_of(strtoupper($s->name), 8); ?></a>
                                                </li>
                                                <?php } ?>

                                                <?php foreach ($sscategory as $ss) { ?>
                                                <li class="">
                                                    <a
                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id . "&sub-sub-category=" . $ss->id ?>'><?php echo ellipse_of(strtoupper($ss->name), 10); ?></a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                            <h6 class="item-title">
                                                <a
                                                    href="view-product.php?id=<?php echo $p->id; ?>"><?php echo ellipse_of($p->productName, 30); ?></a>
                                            </h6>

                                            <div class="item-stars">
                                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width: 65px;'></span>
                                                </div>
                                                <span>(<?php echo (productReview::count_by_product($p->id)); ?>)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Frw <?php echo number_format($p->productPrice, 2); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        // If there is a review on a product , then display that it's New
                                        if (productReview::count_by_product($p->id) >= 1) {
                                            echo "<div class='tag new'><span>New</span></div>";
                                        } elseif ($p->productPrice <= 10000) {
                                            echo "<div class='tag hot'><span>HOT</span></div>";
                                        } ?>
                                </div>

                                <?php } ?>



                            </div>
                        </div>



                    </div>
                    <div class="tab-pane fade" id="consumer-top-rating-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                <!-- Get all the Clothing from the database  -->
                                <?php
                                $accessory = Product::find_all_by_Category([4, 5]);

                                foreach ($accessory as $p) {
                                    $category = Category::find_product_category($p->id);
                                    $scategory = SubCategory::find_product_category($p->id);
                                    $sscategory = SubSubCategory::find_product_category($p->id);

                                    $stock = ProductStock::find_by_product_id($p->id);
                                    $colors = Color::find_product_category($p->id);
                                    $size = Size::find_product_category($p->id);
                                ?>

                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link"
                                            href="view-product.php?id=<?php echo $p->id; ?>"
                                            style="overflow:hidden; height:280px;">
                                            <img class="img-fluid"
                                                src="<?php echo  S_PRIVATE . '/uploads/' . $p->productThumb; ?>"
                                                alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look quick-view-product"
                                                data-id='<?php echo $p->id; ?>'>Quick
                                                Look</a>
                                            <!-- <a class="item-mail" href="javascript:void(0)">Mail</a> -->
                                            <a class="item-addwishlist item-addwishlistBTN"
                                                data-id='<?php echo $p->id; ?>'>Add to
                                                Wishlist</a>
                                            <a class="item-addCart item-addCartBTN " data-id='<?php echo $p->id; ?>'
                                                data-id='<?php echo $p->id; ?>'>Add to
                                                Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <?php foreach ($category as $c) { ?>
                                                <li class="has-separator">
                                                    <a
                                                        href="search.php?category=<?php echo $c->id; ?>"><?php echo  ellipse_of(strtoupper($c->categoryName), 5); ?></a>
                                                </li>
                                                <?php } ?>
                                                <?php foreach ($scategory as $s) { ?>
                                                <li class="has-separator">
                                                    <a
                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id ?>'><?php echo ellipse_of(strtoupper($s->name), 8); ?></a>
                                                </li>
                                                <?php } ?>

                                                <?php foreach ($sscategory as $ss) { ?>
                                                <li class="">
                                                    <a
                                                        href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id . "&sub-sub-category=" . $ss->id ?>'><?php echo ellipse_of(strtoupper($ss->name), 10); ?></a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                            <h6 class="item-title">
                                                <a
                                                    href="view-product.php?id=<?php echo $p->id; ?>"><?php echo ellipse_of($p->productName, 30); ?></a>
                                            </h6>

                                            <div class="item-stars">
                                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width: 65px;'></span>
                                                </div>
                                                <span>(<?php echo (productReview::count_by_product($p->id)); ?>)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Frw <?php echo number_format($p->productPrice, 2); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        // If there is a review on a product , then display that it's New
                                        if (productReview::count_by_product($p->id) >= 1) {
                                            echo "<div class='tag new'><span>New</span></div>";
                                        } elseif ($p->productPrice <= 10000) {
                                            echo "<div class='tag hot'><span>HOT</span></div>";
                                        } ?>
                                </div>

                                <?php } ?>



                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="consumer-featured-products">
                        <!-- Product Not Found -->
                        <div class="products-slider owl-carousel" data-item="4">
                            <!-- Get all the Clothing from the database  -->
                            <?php
                            $accessory = Product::find_all_by_Category([4, 5]);

                            foreach ($accessory as $p) {
                                $category = Category::find_product_category($p->id);
                                $scategory = SubCategory::find_product_category($p->id);
                                $sscategory = SubSubCategory::find_product_category($p->id);

                                $stock = ProductStock::find_by_product_id($p->id);
                                $colors = Color::find_product_category($p->id);
                                $size = Size::find_product_category($p->id);
                            ?>

                            <div class="item">
                                <div class="image-container">
                                    <a class="item-img-wrapper-link" href="view-product.php?id=<?php echo $p->id; ?>"
                                        style="overflow:hidden; height:280px;">
                                        <img class="img-fluid"
                                            src="<?php echo  S_PRIVATE . '/uploads/' . $p->productThumb; ?>"
                                            alt="Product">
                                    </a>
                                    <div class="item-action-behaviors">
                                        <a class="item-quick-look quick-view-product"
                                            data-id='<?php echo $p->id; ?>'>Quick
                                            Look</a>
                                        <a class="item-addwishlist item-addwishlistBTN"
                                            data-id='<?php echo $p->id; ?>'>Add to
                                            Wishlist</a>
                                        <a class="item-addCart item-addCartBTN " data-id='<?php echo $p->id; ?>'
                                            data-id='<?php echo $p->id; ?>'>Add to
                                            Cart</a>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <div class="what-product-is">
                                        <ul class="bread-crumb">
                                            <?php foreach ($category as $c) { ?>
                                            <li class="has-separator">
                                                <a
                                                    href="search.php?category=<?php echo $c->id; ?>"><?php echo  ellipse_of(strtoupper($c->categoryName), 5); ?></a>
                                            </li>
                                            <?php } ?>
                                            <?php foreach ($scategory as $s) { ?>
                                            <li class="has-separator">
                                                <a
                                                    href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id ?>'><?php echo ellipse_of(strtoupper($s->name), 8); ?></a>
                                            </li>
                                            <?php } ?>

                                            <?php foreach ($sscategory as $ss) { ?>
                                            <li class="">
                                                <a
                                                    href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id . "&sub-sub-category=" . $ss->id ?>'><?php echo ellipse_of(strtoupper($ss->name), 10); ?></a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                        <h6 class="item-title">
                                            <a
                                                href="view-product.php?id=<?php echo $p->id; ?>"><?php echo ellipse_of($p->productName, 30); ?></a>
                                        </h6>

                                        <div class="item-stars">
                                            <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                <span style='width: 65px;'></span>
                                            </div>
                                            <span>(<?php echo (productReview::count_by_product($p->id)); ?>)</span>
                                        </div>
                                    </div>
                                    <div class="price-template">
                                        <div class="item-new-price">
                                            Frw <?php echo number_format($p->productPrice, 2); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    // If there is a review on a product , then display that it's New
                                    if (productReview::count_by_product($p->id) >= 1) {
                                        echo "<div class='tag new'><span>New</span></div>";
                                    } elseif ($p->productPrice <= 10000) {
                                        echo "<div class='tag hot'><span>HOT</span></div>";
                                    } ?>
                            </div>

                            <?php } ?>



                        </div>
                        <!-- Product Not Found /- -->
                    </div>
                </div>
            </div>
        </div>
        <div class="redirect-link-wrapper text-center u-s-p-t-25 u-s-p-b-80">
            <a class="redirect-link" href="search.php">
                <span>View more on this category</span>
            </a>
        </div>
    </div>
</section>
<!-- Consumer-Electronics /- -->
<!-- Continue-Link -->
<div class="continue-link-wrapper u-s-p-b-80">
    <a class="continue-link" href="search.php" title="View all products on site">
        <i class="ion ion-ios-more"></i>
    </a>
</div>
<!-- Continue-Link /- -->
<!-- Brand-Slider -->
<div class="brand-slider u-s-p-b-80">
    <div class="container">
        <div class="brand-slider-content owl-carousel" data-item="5">
            <div class="brand-pic">
                <a href="#">
                    <img src="images/brand-logos/1.png" alt="Brand Logo 1">
                </a>
            </div>
            <div class="brand-pic">
                <a href="#">
                    <img src="images/brand-logos/2.png" alt="Brand Logo 2">
                </a>
            </div>
            <div class="brand-pic">
                <a href="#">
                    <img src="images/brand-logos/3.png" alt="Brand Logo 3">
                </a>
            </div>
            <div class="brand-pic">
                <a href="#">
                    <img src="images/brand-logos/1.png" alt="Brand Logo 5">
                </a>
            </div>
            <div class="brand-pic">
                <a href="#">
                    <img src="images/brand-logos/2.png" alt="Brand Logo 6">
                </a>
            </div>
            <div class="brand-pic">
                <a href="#">
                    <img src="images/brand-logos/3.png" alt="Brand Logo 7">
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Brand-Slider /- -->
<!-- Site-Priorities -->
<section class="app-priority">
    <div class="container">
        <div class="priority-wrapper u-s-p-b-80">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-md-star"></i>
                        </div>
                        <h2>
                            Great Value
                        </h2>
                        <p>We offer competitive prices on our 100 million plus product range</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-md-cash"></i>
                        </div>
                        <h2>
                            Shop with Confidence
                        </h2>
                        <p>Our Protection covers your purchase from click to delivery</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-ios-card"></i>
                        </div>
                        <h2>
                            Safe Payment
                        </h2>
                        <p>Pay with the world’s most popular and secure payment methods</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-md-contacts"></i>
                        </div>
                        <h2>
                            24/7 Help Center
                        </h2>
                        <p>Round-the-clock assistance for a smooth shopping experience</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Site-Priorities /- -->

<div id="quick-view" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="button dismiss-button ion ion-ios-close" data-dismiss="modal"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <!-- Product-zoom-area -->
                        <div class="zoom-area">
                            <img id="zoom-pro-quick-view" class="img-fluid" src="images/product/product@4x.jpg"
                                data-zoom-image="images/product/product@4x.jpg" alt="Zoom Image">
                            <div id="gallery-quick-view" class="u-s-m-t-10">
                                <a class="active" data-image="images/product/product@4x.jpg"
                                    data-zoom-image="images/product/product@4x.jpg">
                                    <img src="images/product/product@2x.jpg" alt="Product">
                                </a>
                                <a data-image="images/product/product@4x.jpg"
                                    data-zoom-image="images/product/product@4x.jpg">
                                    <img src="images/product/product@2x.jpg" alt="Product">
                                </a>
                                <a data-image="images/product/product@4x.jpg"
                                    data-zoom-image="images/product/product@4x.jpg">
                                    <img src="images/product/product@2x.jpg" alt="Product">
                                </a>
                                <a data-image="images/product/product@4x.jpg"
                                    data-zoom-image="images/product/product@4x.jpg">
                                    <img src="images/product/product@2x.jpg" alt="Product">
                                </a>
                                <a data-image="images/product/product@4x.jpg"
                                    data-zoom-image="images/product/product@4x.jpg">
                                    <img src="images/product/product@2x.jpg" alt="Product">
                                </a>
                                <a data-image="images/product/product@4x.jpg"
                                    data-zoom-image="images/product/product@4x.jpg">
                                    <img src="images/product/product@2x.jpg" alt="Product">
                                </a>
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
                                        <a href="single-product.php">Casual Hoodie Full Cotton</a>
                                    </h1>
                                </div>
                                <ul class="bread-crumb">
                                    <li class="has-separator">
                                        <a href="home.php">Home</a>
                                    </li>
                                    <li class="has-separator">
                                        <a href="shop-v1-root-category.php">Men's Clothing</a>
                                    </li>
                                    <li class="has-separator">
                                        <a href="shop-v2-sub-category.php">Tops</a>
                                    </li>
                                    <li class="is-marked">
                                        <a href="shop-v3-sub-sub-category.php">Hoodies</a>
                                    </li>
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
                                <p>This hoodie is full cotton. It includes a muff sewn onto the lower front, and
                                    (usually) a drawstring to adjust the hood opening. Throughout the U.S., it
                                    is common for middle-school, high-school, and college students to wear this
                                    sweatshirts—with or without hoods—that display their respective school names
                                    or mascots across the chest, either as part of a uniform or personal
                                    preference.
                                </p>
                            </div>
                            <div class="section-3-price-original-discount u-s-p-y-14">
                                <div class="price">
                                    <h4>$55.00</h4>
                                </div>
                                <div class="original-price">
                                    <span>Original Price:</span>
                                    <span>$60.00</span>
                                </div>
                                <div class="discount-price">
                                    <span>Discount:</span>
                                    <span>8%</span>
                                </div>
                                <div class="total-save">
                                    <span>Save:</span>
                                    <span>$5</span>
                                </div>
                            </div>
                            <div class="section-4-sku-information u-s-p-y-14">
                                <h6 class="information-heading u-s-m-b-8">Sku Information:</h6>
                                <div class="availability">
                                    <span>Availability:</span>
                                    <span>In Stock</span>
                                </div>
                                <div class="left">
                                    <span>Only:</span>
                                    <span>50 left</span>
                                </div>
                            </div>
                            <div class="section-5-product-variants u-s-p-y-14">
                                <h6 class="information-heading u-s-m-b-8">Product Variants:</h6>
                                <div class="color u-s-m-b-11">
                                    <span>Available Color:</span>
                                    <div class="color-variant select-box-wrapper">
                                        <select class="select-box product-color">
                                            <option value="1">Heather Grey</option>
                                            <option value="3">Black</option>
                                            <option value="5">White</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="sizes u-s-m-b-11">
                                    <span>Available Size:</span>
                                    <div class="size-variant select-box-wrapper">
                                        <select class="select-box product-size">
                                            <option value="">Male 2XL</option>
                                            <option value="">Male 3XL</option>
                                            <option value="">Kids 4</option>
                                            <option value="">Kids 6</option>
                                            <option value="">Kids 8</option>
                                            <option value="">Kids 10</option>
                                            <option value="">Kids 12</option>
                                            <option value="">Female Small</option>
                                            <option value="">Male Small</option>
                                            <option value="">Female Medium</option>
                                            <option value="">Male Medium</option>
                                            <option value="">Female Large</option>
                                            <option value="">Male Large</option>
                                            <option value="">Female XL</option>
                                            <option value="">Male XL</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                                <form action="#" class="post-form">
                                    <div class="quick-social-media-wrapper u-s-m-b-22">
                                        <span>Share:</span>
                                        <ul class="social-media-list">
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-google-plus-g"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fas fa-rss"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-pinterest"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="quantity-wrapper u-s-m-b-22">
                                        <span>Quantity:</span>
                                        <div class="quantity">
                                            <input type="text" class="quantity-text-field" value="1">
                                            <a class="plus-a" data-max="1000">&#43;</a>
                                            <a class="minus-a" data-min="1">&#45;</a>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="button button-outline-secondary" type="submit">Add to
                                            cart</button>
                                        <button class="button button-outline-secondary far fa-heart u-s-m-l-6"></button>
                                        <button
                                            class="button button-outline-secondary far fa-envelope u-s-m-l-6"></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Product-details /- -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick-view-Modal /- -->
<?php
require_once(PRIVATE_PATH . "/shared/public_footer.php");
?>