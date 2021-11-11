<?php
require_once("../private/initialize.php");
require_once(PRIVATE_PATH . "/shared/public_header.php");
?>

<!-- Header /- -->

<!-- Custom-Deal-Page -->
<div class="page-deal u-s-p-t-80">
    <div class="container">
        <div class="deal-page-wrapper">
            <h1 class="deal-heading">Best Current Deals </h1>
            <h6 class="deal-has-total-items">Make An order and Enojy Free Delivery on any of these products!!!</h6>
        </div>
        <!-- Page-Bar -->
        <div class="page-bar clearfix">
            <div class="shop-settings">
                <a id="list-anchor">
                    <i class="fas fa-th-list"></i>
                </a>
                <a id="grid-anchor" class="active">
                    <i class="fas fa-th"></i>
                </a>
            </div>
            <!-- Toolbar Sorter 1  -->
            <div class="toolbar-sorter">
                <div class="select-box-wrapper">
                    <label class="sr-only" for="sort-by">Sort By</label>
                    <select class="select-box" id="sort-by">
                        <option selected="selected" value="">Sort By: Best Selling</option>
                        <option value="">Sort By: Latest</option>
                        <option value="">Sort By: Lowest Price</option>
                        <option value="">Sort By: Highest Price</option>
                        <option value="">Sort By: Best Rating</option>
                    </select>
                </div>
            </div>
            <!-- //end Toolbar Sorter 1  -->
            <!-- Toolbar Sorter 2  -->
            <div class="toolbar-sorter-2">
                <div class="select-box-wrapper">
                    <label class="sr-only" for="show-records">Show Records Per Page</label>
                    <select class="select-box" id="show-records">
                        <option selected="selected" value="">Show: 8</option>
                        <option value="">Show: 16</option>
                        <option value="">Show: 28</option>
                    </select>
                </div>
            </div>
            <!-- //end Toolbar Sorter 2  -->
        </div>
        <!-- Page-Bar /- -->
        <!-- Row-of-Product-Container -->
        <div class="row product-container grid-style">

            <?php
            $product = Product::find_all();
            foreach ($product as $p) {
                $id = $p->id;
                $category = Category::find_product_category($id);
                $scategory = SubCategory::find_product_category($id);
                $sscategory = SubSubCategory::find_product_category($id);
                $colors = Color::find_product_category($id);
                $size = Size::find_product_category($id);

            ?>



            <div class="product-item col-lg-3 col-md-6 col-sm-6">
                <div class="item">
                    <div class="image-container">
                        <a class="item-img-wrapper-link" href="view-product.php?id=<?php echo $p->id; ?>"
                            style="overflow:hidden; height:280px;">
                            <img class="img-fluid" src="<?php echo  S_PRIVATE . '/uploads/' . $p->productThumb; ?>"
                                alt="Product">
                        </a>
                        <div class="item-action-behaviors">
                            <a class="item-quick-look quick-view-product" data-id='<?php echo $p->id; ?>'>Quick Look</a>
                            <!-- <a class="item-mail" href="javascript:void(0)">Mail</a> -->
                            <a class="item-addwishlist item-addwishlistBTN" data-id='<?php echo $p->id; ?>'>Add to
                                Wishlist</a>
                            <a class="item-addCart item-addCartBTN" data-id='<?php echo $p->id; ?>'>Add to Cart</a>
                        </div>
                    </div>
                    <div class="item-content">
                        <div class="what-product-is">
                            <ul class="bread-crumb">
                                <?php foreach ($category as $c) { ?>
                                <li class="has-separator">
                                    <a
                                        href="search.php"><?php echo  ellipse_of(strtoupper($c->categoryName), 20); ?></a>
                                </li>
                                <?php } ?>
                                <?php foreach ($scategory as $s) { ?>
                                <li class="has-separator">
                                    <a href="search.php"><?php echo ellipse_of(strtoupper($s->name), 20); ?></a>
                                </li>
                                <?php } ?>

                                <?php foreach ($sscategory as $ss) { ?>
                                <li class="">
                                    <a href="search.php"><?php echo ellipse_of(strtoupper($ss->name), 20); ?></a>
                                </li>
                                <?php } ?>
                            </ul>
                            <h6 class="item-title">
                                <a
                                    href="view-product.php?id=<?php echo $p->id; ?>"><?php echo ellipse_of($p->productName, 90); ?></a>
                            </h6>
                            <div class="item-description">
                                <p><?php echo  $p->productDesc; ?>
                                </p>
                            </div>
                            <div class="item-stars">
                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                    <span style='width:67px'></span>
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
            </div>


            <?php } ?>




        </div>
        <!-- Row-of-Product-Container /- -->
        <!-- Shop-Pagination -->
        <div class="pagination-area">
            <div class="pagination-number">
                <ul>
                    <li style="display: none">
                        <a href="shop-v1-root-category.php" title="Previous">
                            <i class="fa fa-angle-left"></i>
                        </a>
                    </li>
                    <li class="active">
                        <a href="shop-v1-root-category.php">1</a>
                    </li>
                    <li>
                        <a href="shop-v1-root-category.php">2</a>
                    </li>
                    <li>
                        <a href="shop-v1-root-category.php">3</a>
                    </li>
                    <li>
                        <a href="shop-v1-root-category.php">...</a>
                    </li>
                    <li>
                        <a href="shop-v1-root-category.php">10</a>
                    </li>
                    <li>
                        <a href="shop-v1-root-category.php" title="Next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Shop-Pagination /- -->
    </div>
</div>
<!-- Custom-Deal-Page -->






<?php
require_once(PRIVATE_PATH . "/shared/public_footer.php");

?>