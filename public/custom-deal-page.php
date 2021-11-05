<?php
require_once("../private/initialize.php");
require_once(PRIVATE_PATH . "/shared/public_header.php");

?>
<!-- Header /- -->
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>New Arrivals</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="index.php">Home</a>
                </li>
                <li class="is-marked">
                    <a href="custom-deal-page.php">New Arrivals</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
<!-- Custom-Deal-Page -->
<div class="page-deal u-s-p-t-80">
    <div class="container">
        <div class="deal-page-wrapper">
            <h1 class="deal-heading">New Arrivals</h1>
            <h6 class="deal-has-total-items">27 Items</h6>
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
            <div class="product-item col-lg-3 col-md-6 col-sm-6">
                <div class="item">
                    <div class="image-container">
                        <a class="item-img-wrapper-link" href="single-product.php">
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
                                    <a href="shop-v1-root-category.php">Men's</a>
                                </li>
                                <li class="has-separator">
                                    <a href="shop-v2-sub-category.php">Tops</a>
                                </li>
                                <li>
                                    <a href="shop-v3-sub-sub-category.php">Hoodies</a>
                                </li>
                            </ul>
                            <h6 class="item-title">
                                <a href="single-product.php">Casual Hoodie Full Cotton</a>
                            </h6>
                            <div class="item-description">
                                <p>This hoodie is full cotton. It includes a muff sewn onto the lower front, and
                                    (usually) a drawstring to adjust the hood opening. Throughout the U.S., it is common
                                    for middle-school, high-school, and college students to wear this sweatshirts—with
                                    or without hoods—that display their respective school names or mascots across the
                                    chest, either as part of a uniform or personal preference.
                                </p>
                            </div>
                            <div class="item-stars">
                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                    <span style='width:67px'></span>
                                </div>
                                <span>(23)</span>
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
            </div>
            <div class="product-item col-lg-3 col-md-6 col-sm-6">
                <div class="item">
                    <div class="image-container">
                        <a class="item-img-wrapper-link" href="single-product.php">
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
                                    <a href="shop-v1-root-category.php">Men's</a>
                                </li>
                                <li class="has-separator">
                                    <a href="shop-v2-sub-category.php">Tops</a>
                                </li>
                                <li>
                                    <a href="shop-v3-sub-sub-category.php">T-Shirts</a>
                                </li>
                            </ul>
                            <h6 class="item-title">
                                <a href="single-product.php">Mischka Plain Men T-Shirt</a>
                            </h6>
                            <div class="item-description">
                                <p>T-shirts with bold slogans were popular in the UK in the 1980s. T-shirts were
                                    originally worn as undershirts, but are now worn frequently as the only piece of
                                    clothing on the top half of the body, other than possibly a brassiere or, rarely, a
                                    waistcoat (vest). T-shirts have also become a medium for self-expression and
                                    advertising, with any imaginable combination of words, art and photographs on
                                    display.</p>
                            </div>
                            <div class="item-stars">
                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                    <span style='width:67px'></span>
                                </div>
                                <span>(23)</span>
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
                </div>
            </div>
            <div class="product-item col-lg-3 col-md-6 col-sm-6">
                <div class="item">
                    <div class="image-container">
                        <a class="item-img-wrapper-link" href="single-product.php">
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
                                    <a href="shop-v1-root-category.php">Men's</a>
                                </li>
                                <li class="has-separator">
                                    <a href="shop-v2-sub-category.php">Tops</a>
                                </li>
                                <li>
                                    <a href="shop-v4-filter-as-category.php">T-Shirts</a>
                                </li>
                            </ul>
                            <h6 class="item-title">
                                <a href="single-product.php">Black Bean Plain Men T-Shirt</a>
                            </h6>
                            <div class="item-description">
                                <p>T-shirts with bold slogans were popular in the UK in the 1980s. T-shirts were
                                    originally worn as undershirts, but are now worn frequently as the only piece of
                                    clothing on the top half of the body, other than possibly a brassiere or, rarely, a
                                    waistcoat (vest). T-shirts have also become a medium for self-expression and
                                    advertising, with any imaginable combination of words, art and photographs on
                                    display.</p>
                            </div>
                            <div class="item-stars">
                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                    <span style='width:67px'></span>
                                </div>
                                <span>(23)</span>
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
                </div>
            </div>
            <div class="product-item col-lg-3 col-md-6 col-sm-6">
                <div class="item">
                    <div class="image-container">
                        <a class="item-img-wrapper-link" href="single-product.php">
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
                                    <a href="shop-v1-root-category.php">Men's</a>
                                </li>
                                <li class="has-separator">
                                    <a href="shop-v2-sub-category.php">Bottoms</a>
                                </li>
                                <li>
                                    <a href="shop-v3-sub-sub-category.php">Jeans</a>
                                </li>
                            </ul>
                            <h6 class="item-title">
                                <a href="single-product.php">Regular Rock Blue Men Jean</a>
                            </h6>
                            <div class="item-description">
                                <p>Traditionally, jeans were dyed to a blue color using natural indigo dye. Most denim
                                    is now dyed using synthetic indigo. Approximately 20 thousand tons of indigo are
                                    produced annually for this purpose, though only a few grams of the dye are required
                                    for each pair. For other colors of denim other dyes must be used. Currently, jeans
                                    are produced in any color that can be achieved with cotton.
                                </p>
                            </div>
                            <div class="item-stars">
                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                    <span style='width:67px'></span>
                                </div>
                                <span>(23)</span>
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
            </div>
            <div class="product-item col-lg-3 col-md-6 col-sm-6">
                <div class="item">
                    <div class="image-container">
                        <a class="item-img-wrapper-link" href="single-product.php">
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
                                    <a href="shop-v1-root-category.php">Men's</a>
                                </li>
                                <li class="has-separator">
                                    <a href="shop-v2-sub-category.php">Tops</a>
                                </li>
                                <li>
                                    <a href="shop-v3-sub-sub-category.php">Suits</a>
                                </li>
                            </ul>
                            <h6 class="item-title">
                                <a href="single-product.php">Black Maire Full Men Suit</a>
                            </h6>
                            <div class="item-description">
                                <p>British dandy Beau Brummell redefined and adapted this style, then popularised it,
                                    leading European men to wearing well-cut, tailored clothes, adorned with carefully
                                    knotted neckties. The simplicity of the new clothes and their sombre colours
                                    contrasted strongly with the extravagant, foppish styles just before. Brummell's
                                    influence introduced the modern era of men's clothing which now includes the modern
                                    suit and necktie.</p>
                            </div>
                            <div class="item-stars">
                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                    <span style='width:67px'></span>
                                </div>
                                <span>(23)</span>
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
                    <div class="tag sale">
                        <span>SALE</span>
                    </div>
                </div>
            </div>
            <div class="product-item col-lg-3 col-md-6 col-sm-6">
                <div class="item">
                    <div class="image-container">
                        <a class="item-img-wrapper-link" href="single-product.php">
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
                                    <a href="shop-v1-root-category.php">Men's</a>
                                </li>
                                <li class="has-separator">
                                    <a href="shop-v2-sub-category.php">Outwear</a>
                                </li>
                                <li>
                                    <a href="shop-v3-sub-sub-category.php">Jackets</a>
                                </li>
                            </ul>
                            <h6 class="item-title">
                                <a href="single-product.php">Woodsmoke Rookie Parka Jacket</a>
                            </h6>
                            <div class="item-description">
                                <p>A parka or anorak is a type of coat with a hood, often lined with fur or faux fur.
                                    The Caribou Inuit invented this kind of garment, originally made from caribou or
                                    seal skin, for hunting and kayaking in the frigid Arctic. Some Inuit anoraks require
                                    regular coating with fish oil to retain their water resistance.</p>
                            </div>
                            <div class="item-stars">
                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                    <span style='width:67px'></span>
                                </div>
                                <span>(23)</span>
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
                </div>
            </div>
            <div class="product-item col-lg-3 col-md-6 col-sm-6">
                <div class="item">
                    <div class="image-container">
                        <a class="item-img-wrapper-link" href="single-product.php">
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
                                    <a href="shop-v1-root-category.php">Men's</a>
                                </li>
                                <li class="has-separator">
                                    <a href="shop-v2-sub-category.php">Accessories</a>
                                </li>
                                <li>
                                    <a href="shop-v3-sub-sub-category.php">Ties</a>
                                </li>
                            </ul>
                            <h6 class="item-title">
                                <a href="single-product.php">Blue Zodiac Boxes Reg Tie
                                </a>
                            </h6>
                            <div class="item-description">
                                <p>A necktie, or simply a tie, is a long piece of cloth, worn usually by men, for
                                    decorative purposes around the neck, resting under the shirt collar and knotted at
                                    the throat.</p>
                            </div>
                            <div class="item-stars">
                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                    <span style='width:67px'></span>
                                </div>
                                <span>(23)</span>
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
                </div>
            </div>
            <div class="product-item col-lg-3 col-md-6 col-sm-6">
                <div class="item">
                    <div class="image-container">
                        <a class="item-img-wrapper-link" href="single-product.php">
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
                                    <a href="shop-v1-root-category.php">Men's</a>
                                </li>
                                <li class="has-separator">
                                    <a href="shop-v2-sub-category.php">Bottoms</a>
                                </li>
                                <li>
                                    <a href="shop-v3-sub-sub-category.php">Shoes</a>
                                </li>
                            </ul>
                            <h6 class="item-title">
                                <a href="single-product.php">Zambezi Carved Leather Business Casual Shoes
                                </a>
                            </h6>
                            <div class="item-description">
                                <p>Dress shoes are characterized by smooth and supple leather uppers, leather soles, and
                                    narrow sleek figure. Casual shoes are characterized by sturdy leather uppers,
                                    non-leather outsoles, and wide profile. Some designs of dress shoes can be worn by
                                    either gender. The majority of dress shoes have an upper covering, commonly made of
                                    leather, enclosing most of the lower foot, but not covering the ankles.</p>
                            </div>
                            <div class="item-stars">
                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                    <span style='width:67px'></span>
                                </div>
                                <span>(23)</span>
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
                    <div class="tag discount">
                        <span>-15%</span>
                    </div>
                </div>
            </div>
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