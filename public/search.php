<?php
require_once("../private/initialize.php");
require_once(PRIVATE_PATH . "/shared/public_header.php");


$keyword = $_GET["search"] ?? null;
$cat = ($_GET["category"]) ?? null;
$scat = ($_GET["sub-category"]) ?? null;
$sscat = ($_GET["sub-sub-category"]) ?? null;



// if there is no search then get items accordingly to the selected items
if (!isset($keyword)) {
    if (isset($cat) && !isset($scat)) {
        $product = Product::find_all_by_Category([$cat]);
    } else if (isset($scat) && !isset($sscat)) {
        $product = Product::find_all_by_subCategory([$scat]);
    } else if (isset($sscat)) {
        $product = Product::find_all_by_subSubCategory([$sscat]);
    } else {
        $product = Product::find_all();
    }
} else {
    $product = Product::search($keyword);
}

?>
<!-- Shop-Page -->
<div class="page-shop u-s-p-t-30">
    <div class="container">
        <!-- Search-Results -->
        <div class="search-results-wrapper u-s-m-l-100 u-s-p-b-30">
            <h4>WE FOUND RESULTS FOR
                <i>“<?php echo $keyword; ?>”</i>
            </h4>
            <h4>Related searches:
                <a href="shop-v1-root-category.html">men's clothing</a> ,
                <a href="shop-v1-root-category.html">mobiles & tablets</a> ,
                <a href="shop-v1-root-category.html">books & audible</a>
            </h4>
        </div>
        <!-- Search-Results /- -->
        <div class="row">
            <!-- Shop-Left-Side-Bar-Wrapper -->
            <div class="col-lg-3 col-md-3 col-sm-12">
                <!-- Fetch-Categories-from-Root-Category  -->
                <div class="fetch-categories">
                    <h3 class="title-name">Browse Categories</h3>
                    <ul>
                        <?php

                        $category = Category::find_all();

                        foreach ($category as $c) { ?>
                            <li>
                                <a href="search.php?category=<?php echo $c->id; ?>"><?php echo $c->categoryName; ?></a>
                                <button class="button-icon ion ion-md-add js-open"></button>
                                <ul class="<?php echo ($cat == $c->id) ? 'd-block' : ''; ?>">
                                    <?php

                                    foreach (SubCategory::find_by_parent($c->id) as $s) {
                                    ?>
                                        <li>
                                            <a href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id ?>'><?php echo $s->name; ?></a>
                                            <button class="button-icon ion ion-md-add js-open"></button>
                                            <ul class="<?php echo ($scat == $s->id) ? 'd-block' : ''; ?>">
                                                <?php foreach (SubSubCategory::find_by_parent($s->id) as $ss) { ?>
                                                    <li>
                                                        <a class="<?php echo ($sscat == $ss->id) ? 'text-primary font-weight-bold' : ''; ?>" href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $s->id . "&sub-sub-category=" . $ss->id; ?>'><?php echo $ss->name; ?></a>
                                                    </li>
                                                <?php } ?>

                                            </ul>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                    </ul>
                </div>
                <!-- Fetch-Categories-from-Root-Category  /- -->
                <!-- Filters -->
                <!-- Filter-Price -->
                <div class="facet-filter-by-price">
                    <h3 class="title-name">Price</h3>
                    <form class="facet-form" action="#" method="post">
                        <!-- Final-Result -->
                        <div class="amount-result clearfix">
                            <div class="price-from">$0</div>
                            <div class="price-to">$3000</div>
                        </div>
                        <!-- Final-Result /- -->
                        <!-- Range-Slider  -->
                        <div class="price-filter"></div>
                        <!-- Range-Slider /- -->
                        <!-- Range-Manipulator -->
                        <div class="price-slider-range" data-min="0" data-max="5000" data-default-low="0" data-default-high="3000" data-currency="$"></div>
                        <!-- Range-Manipulator /- -->
                        <button type="submit" class="button button-primary">Filter</button>
                    </form>
                </div>
                <!-- Filter-Price /- -->





                <!-- Filters /- -->
            </div>
            <!-- Shop-Left-Side-Bar-Wrapper /- -->
            <!-- Shop-Right-Wrapper -->
            <div class="col-lg-9 col-md-9 col-sm-12">
                <!-- Page-Bar -->
                <div class="page-bar clearfix">
                    <div class="shop-settings">
                        <a id="list-anchor" class="active">
                            <i class="fas fa-th-list"></i>
                        </a>
                        <a id="grid-anchor">
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
                <div class="row product-container list-style">


                    <?php foreach ($product as $p) {
                        $id = $p->id;
                        $category = Category::find_product_category($id);
                        $scategory = SubCategory::find_product_category($id);
                        $sscategory = SubSubCategory::find_product_category($id);
                        $colors = Color::find_product_category($id);
                        $size = Size::find_product_category($id); ?>


                        <div class="product-item col-lg-4 col-md-6 col-sm-6">
                            <div class="item">
                                <div class="image-container">
                                    <a class="item-img-wrapper-link" href="view-product.php?id=<?php echo $p->id; ?>" style="overflow:hidden; height:280px;">
                                        <img class="img-fluid" src="<?php echo  S_PRIVATE . '/uploads/' . $p->productThumb; ?>" alt="Product">
                                    </a>
                                    <div class="item-action-behaviors">
                                        <a class="item-quick-look quick-view-product" data-id='<?php echo $p->id; ?>'>Quick
                                            Look</a>
                                        <!-- <a class="item-mail" href="javascript:void(0)">Mail</a> -->
                                        <a class="item-addwishlist" data-id='<?php echo $p->id; ?>'>Add to Wishlist</a>
                                        <a class="item-addCart item-addCartBTN " data-id='<?php echo $p->id; ?>'>Add to Cart</a>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <div class="what-product-is">
                                        <ul class="bread-crumb">
                                            <?php foreach ($category as $c) { ?>
                                                <li class="has-separator">
                                                    <a href="search.php?category=<?php echo $c->id; ?>"><?php echo  ellipse_of(strtoupper($c->categoryName), 20); ?></a>
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
                                            <a href="view-product.php?id=<?php echo $p->id; ?>"><?php echo ellipse_of($p->productName, 90); ?></a>
                                        </h6>
                                        <div class="item-description">
                                            <p><?php echo  ellipse_of($p->productDesc, 200); ?>
                                            </p>
                                        </div>
                                        <div class="item-stars">
                                            <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                <span style='width:0'></span>
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
            </div>
            <!-- Shop-Right-Wrapper /- -->
            <!-- Shop-Pagination -->
            <div class="pagination-area">
                <div class="pagination-number">
                    <ul>
                        <li style="display: none">
                            <a href="shop-v1-root-category.html" title="Previous">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        <li class="active">
                            <a href="shop-v1-root-category.html">1</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">2</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">3</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">...</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">10</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html" title="Next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Shop-Pagination /- -->
        </div>
    </div>
</div>
<!-- Shop-Page /- -->
<?php
require_once(PRIVATE_PATH . "/shared/public_footer.php");

?>