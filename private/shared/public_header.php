<?php
echo display_user_session_message();

if ($session_user->is_logged_in()) {
    if (!empty($cart->cart_items)) {
        foreach ($cart->cart_items as $item) {
            $addToCart = new Cart(["username" => $session_user->username, "productId" => $item['productId'], "quantity" => $item['quantity']]);

            $addToCart->save();
        }
        $cart->clearCart();
    }
}


// cons of the select menu
function find_right_icon($icon)
{
    switch ($icon) {
        case "Men's Clothing":
            echo '<i class="ion ion-md-shirt"></i>';
            break;
        case "Women's Clothing":
            echo '<i class="ion ion-ios-shirt"></i>';
            break;
        case "Rc Toys & Hobbies":
            echo '<i class="ion ion-md-rocket"></i>';
            break;
        case "Mobiles & Tablets":
            echo '<i class="ion ion-md-phone-portrait"></i>';
            break;
        case "Consumer Electonics":
            echo '<i class="ion ion-md-tv"></i>';
            break;
        case "Books & Audible":
            echo '<i class="ion ion-ios-book"></i>';
            break;
        case "Beauty & Health":
            echo '<i class="ion ion-md-heart"></i>';
            break;
        case "Furniture Home & office":
            echo '<i class="ion ion-md-easel"></i>';
            break;

        default:
            echo '<i class="ion ion-md-easel"></i>';
            break;
    }
}












?>
<!DOCTYPE html>
<html class="no-js" lang="en-US">

<head>
    <meta charset="UTF-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Vantique - Online Shopping for Electronics, Apparel, Computers, Books, DVDs & more</title>
    <!-- Standard Favicon -->
    <link href="staff/img/logo/logo2.png" rel="icon">
    <!-- Base Google Font for Web-app -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <!-- Google Fonts for Banners only -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,800" rel="stylesheet">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- Ion-Icons 4 -->
    <link rel="stylesheet" href="css/ionicons.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">

    <link rel="stylesheet" href="css/ansimate.min.css" />


    <!-- Jquey min -->
    <script type="text/javascript" src="staff/vendor/jquery/jquery.min.js"></script>
    <!-- Owl-Carousel -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Jquery-Ui-Range-Slider -->
    <link rel="stylesheet" href="css/jquery-ui-range-slider.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="staff/vendor/sweetalert2/dist/sweetalert2.min.css">
    <!-- Utility -->
    <link rel="stylesheet" href="css/utility.css">
    <!-- Main -->
    <link rel="stylesheet" href="css/bundle.skyblue.css">
    <!-- Custom Css -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <!-- app -->
    <div id="app">
        <!-- Header -->
        <header>
            <!-- Top-Header -->
            <div class="full-layer-outer-header">
                <div class="container clearfix">
                    <nav>
                        <ul class="primary-nav g-nav">
                            <li>
                                <a href="tel:+250783305114">
                                    <i class="fas fa-phone u-c-brand u-s-m-r-9"></i>

                                    Telephone:+250783305114</a>
                            </li>
                            <li>
                                <a href="mailto:support@vantique.com">
                                    <i class="fas fa-envelope u-c-brand u-s-m-r-9"></i>
                                    E-mail: vantique@vantique.com
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <nav>
                        <ul class="secondary-nav g-nav">
                            <?php if ($session_user->is_logged_in()) {
                            ?>

                            <li>
                                <a> <?php echo $session_user->first_name; ?>
                                    <i class="fas fa-user"></i>
                                    <i class="fas fa-chevron-down u-s-m-l-9"></i>
                                </a>
                                <ul class="g-dropdown" style="width:200px">
                                    <li>
                                        <a href="cart.php">
                                            <i class="fas fa-cog u-s-m-r-9"></i>
                                            My Cart</a>
                                    </li>
                                    <li>
                                        <a href="wishlist.php">
                                            <i class="far fa-heart u-s-m-r-9"></i>
                                            My Wishlist</a>
                                    </li>
                                    <li>
                                        <a href="checkout.php">
                                            <i class="far fa-check-circle u-s-m-r-9"></i>
                                            Checkout</a>
                                    </li>
                                    <li>
                                        <a href="logout.php">
                                            <i class="fas fa-sign-out-alt u-s-m-r-9"></i>
                                            Logout</a>
                                    </li>
                                </ul>
                            </li>

                            <?php } else { ?>

                            <li>
                                <a>My Account
                                    <i class="fas fa-user"></i>
                                    <i class="fas fa-chevron-down u-s-m-l-9"></i>
                                </a>
                                <ul class="g-dropdown" style="width:200px">
                                    <li>
                                        <a href="cart.php">
                                            <i class="fas fa-cog u-s-m-r-9"></i>
                                            My Cart</a>
                                    </li>
                                    <li>
                                        <a href="wishlist.php">
                                            <i class="far fa-heart u-s-m-r-9"></i>
                                            My Wishlist</a>
                                    </li>
                                    <li>
                                        <a href="checkout.php">
                                            <i class="far fa-check-circle u-s-m-r-9"></i>
                                            Checkout</a>
                                    </li>
                                    <li>
                                        <a href="account.php">
                                            <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                            Login / Signup</a>
                                    </li>
                                </ul>
                            </li>
                            <?php } ?>
                            <!-- <li>
                                <a>USD
                                    <i class="fas fa-chevron-down u-s-m-l-9"></i>
                                </a>
                                <ul class="g-dropdown" style="width:90px">
                                    <li>
                                        <a href="#" class="u-c-brand">($) USD</a>
                                    </li>
                                    <li>
                                        <a href="#">(£) GBP</a>
                                    </li>
                                </ul>
                            </li> -->
                            <li>
                                <a>ENG
                                    <i class="fas fa-chevron-down u-s-m-l-9"></i>
                                </a>
                                <ul class="g-dropdown" style="width:70px">
                                    <li>
                                        <a href="#" class="u-c-brand">ENG</a>
                                    </li>
                                    <li>
                                        <a href="#">KNY</a>
                                    </li>
                                </ul>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Top-Header /- -->
            <!-- Mid-Header -->
            <div class="full-layer-mid-header">
                <div class="container">
                    <div class="row clearfix align-items-center">
                        <div class="col-lg-3 col-md-9 col-sm-6">
                            <div class="brand-logo text-lg-center">
                                <a href="index.php">
                                    <img src="images/main-logo/vantique-Brand.png" alt="Vantique-brandLogo"
                                        class="app-brand-logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 u-d-none-lg">
                            <form method='GET' action="search.php" class="form-searchbox">
                                <label class="sr-only" for="search-landscape">Search</label>
                                <input id="search-landscape" type="text" name='search' class="text-field"
                                    placeholder="Search everything">
                                <div class="select-box-position">
                                    <div class="select-box-wrapper select-hide">
                                        <label class="sr-only" for="select-category">Choose category for search</label>
                                        <select class="select-box" id="select-category">
                                            <option selected="selected" value="">
                                                All
                                            </option>
                                            <?php foreach (Category::find_all() as $c) { ?>
                                            <option value=""><?php echo $c->categoryName; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <button id="btn-search" type="submit"
                                    class="button button-primary fas fa-search"></button>
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <nav>
                                <ul class="mid-nav g-nav">
                                    <li class="u-d-none-lg">
                                        <a href="index.php">
                                            <i class="ion ion-md-home u-c-brand"></i>
                                        </a>
                                    </li>
                                    <li class="u-d-none-lg">
                                        <a href="wishlist.php">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a id="mini-cart-trigger" onclick="getCartContent()">
                                            <i class="ion ion-md-basket"></i>
                                            <span
                                                class="item-counter cartItemCounterUpdate"><?php echo (!$session_user->is_logged_in()) ? $cart->cartCount() : Cart::count_all(); ?></span>
                                            <!-- <span class="item-price">Cart</span> -->
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mid-Header /- -->
            <!-- Responsive-Buttons -->
            <div class="fixed-responsive-container">
                <div class="fixed-responsive-wrapper">
                    <button type="button" class="button fas fa-search" id="responsive-search"></button>
                </div>
                <div class="fixed-responsive-wrapper">
                    <a href="wishlist.php">
                        <i class="far fa-heart"></i>
                        <span class="fixed-item-counter"><?php echo Wishlist::count_all() ?></span>
                    </a>
                </div>
            </div>
            <!-- Responsive-Buttons /- -->
            <!-- Mini Cart -->
            <div class="mini-cart-wrapper">
                <div class="mini-cart">
                    <div class="mini-cart-header">
                        YOUR CART
                        <button type="button" class="button ion ion-md-close" id="mini-cart-close"></button>
                    </div>
                    <div class="gotCartContent">

                    </div>
                </div>
            </div>
            <!-- Mini Cart /- -->
            <!-- Bottom-Header -->

            <div class="full-layer-bottom-header">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <div class="v-menu v-close">
                                <span class="v-title">
                                    <i class="ion ion-md-menu"></i>
                                    All Categories
                                    <i class="fas fa-angle-down"></i>
                                </span>
                                <nav>
                                    <div class="v-wrapper">
                                        <ul class="v-list animated fadeIn">
                                            <!-- Find All Categories From the database -->

                                            <?php foreach (category::find_all() as $c) {
                                                $show_banner = false;
                                            ?>
                                            <li class="js-backdrop">
                                                <a href="search.php?category=<?php echo $c->id; ?>">
                                                    <?php echo find_right_icon("{$c->categoryName}") ?>
                                                    <?php echo $c->categoryName; ?>
                                                    <i class="ion ion-ios-arrow-forward"></i>
                                                </a>
                                                <button class="v-button ion ion-md-add"></button>
                                                <div class="v-drop-right" style="width: 700px;">



                                                    <div class="row">
                                                        <!-- Find All Sub Categories Accordingly to the Category -->
                                                        <?php foreach (SubCategory::find_by_parent($c->id) as $subC) {

                                                                if ($c->categoryName == "Rc Toys & Hobbies" && $subC->id > 15) {
                                                                    // Display A toy Picture in the List
                                                                    break;
                                                                }
                                                            ?>
                                                        <div class="col-lg-4">
                                                            <ul class="v-level-2">
                                                                <li>
                                                                    <a
                                                                        href=search.php?<?php echo "category=" . $c->id . "&sub-category=" . $subC->id ?>><?php echo $subC->name; ?></a>
                                                                    <ul>

                                                                        <!-- Find All Sub Categories Accordingly to the Category -->
                                                                        <?php foreach (SubSubCategory::find_by_parent($subC->id) as $subSubC) { ?>
                                                                        <li>
                                                                            <a
                                                                                href='search.php?<?php echo "category=" . $c->id . "&sub-category=" . $subC->id . "&sub-sub-category=" . $subSubC->id; ?>'><?php echo $subSubC->name; ?></a>
                                                                        </li>
                                                                        <?php } ?>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <?php if ($c->categoryName == "Rc Toys & Hobbies") { ?>
                                                        <div class="v-image w-50"
                                                            style="bottom: 0;right: 0px ;z-index:-2;">
                                                            <a href="#" class="d-block">
                                                                <img src="images/banners/mega-3.png"
                                                                    class="img-fluid  img-responsive" alt="Product">
                                                            </a>
                                                        </div>

                                                        <?php
                                                                }
                                                            } ?>
                                                    </div>



                                                </div>
                                            </li>
                                            <?php } ?>


                                            <li>
                                                <a class="v-more">
                                                    <i class="ion ion-md-add"></i>
                                                    <span>View More</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <ul class="bottom-nav g-nav u-d-none-lg">
                                <li>
                                    <a href="new-arival.php">New Arrivals
                                        <span class="superscript-label-new">NEW</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="custom-deal-page.php">Exclusive Deals
                                        <span class="superscript-label-hot">HOT</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="custom-deal-page.php">Flash Deals
                                    </a>
                                </li>
                                <li class="mega-position">
                                    <a>Pages
                                        <i class="fas fa-chevron-down u-s-m-l-9"></i>
                                    </a>
                                    <div class="mega-menu mega-3-colm">
                                        <ul>
                                            <li class="menu-title">Home & Static Pages</li>
                                            <li>
                                                <a href="index.php" class="u-c-brand">Home</a>
                                            </li>
                                            <li>
                                                <a href="about.php">About</a>
                                            </li>
                                            <li>
                                                <a href="contact.php">Contact</a>
                                            </li>
                                            <li>
                                                <a href="faq.php">FAQ</a>
                                            </li>
                                            <li>
                                                <a href="store-directory.php">Store Directory</a>
                                            </li>
                                            <li>
                                                <a href="terms-and-conditions.php">Terms & Conditions</a>
                                            </li>
                                            <li>
                                                <a href="404.php">404</a>
                                            </li>
                                            <li class="menu-title">Single Product Page</li>
                                            <li>
                                                <a href="single-product.php">Single Product Fullwidth</a>
                                            </li>
                                            <li class="menu-title">Blog</li>
                                            <li>
                                                <a href="blog.php">Blog Page</a>
                                            </li>
                                            <li>
                                                <a href="blog-detail.php">Blog Details</a>
                                            </li>
                                        </ul>
                                        <ul>
                                            <li class="menu-title">Ecommerce Pages</li>
                                            <li>
                                                <a href="shop-v2-sub-category.php">Shop</a>
                                            </li>
                                            <li>
                                                <a href="cart.php">Cart</a>
                                            </li>
                                            <li>
                                                <a href="checkout.php">Checkout</a>
                                            </li>
                                            <li>
                                                <a href="account.php">My Account</a>
                                            </li>
                                            <li>
                                                <a href="wishlist.php">Wishlist</a>
                                            </li>
                                            <li>
                                                <a href="track-order.php">Track your Order</a>
                                            </li>
                                            <li class="menu-title">Cart Variations</li>
                                            <li>
                                                <a href="cart-empty.php">Cart Ver 1 Empty</a>
                                            </li>
                                            <li>
                                                <a href="cart.php">Cart Ver 2 Full</a>
                                            </li>
                                            <li class="menu-title">Wishlist Variations</li>
                                            <li>
                                                <a href="wishlist-empty.php">Wishlist Ver 1 Empty</a>
                                            </li>
                                            <li>
                                                <a href="wishlist.php">Wishlist Ver 2 Full</a>
                                            </li>
                                        </ul>
                                        <ul>
                                            <li class="menu-title">Shop Variations</li>
                                            <li>
                                                <a href="shop-v1-root-category.php">Shop Ver 1 Root Category</a>
                                            </li>
                                            <li>
                                                <a href="shop-v2-sub-category.php">Shop Ver 2 Sub Category</a>
                                            </li>
                                            <li>
                                                <a href="shop-v3-sub-sub-category.php">Shop Ver 3 Sub Sub Category</a>
                                            </li>
                                            <li>
                                                <a href="shop-v4-filter-as-category.php">Shop Ver 4 Filter as
                                                    Category</a>
                                            </li>
                                            <li>
                                                <a href="shop-v5-product-not-found.php">Shop Ver 5 Product Not Found</a>
                                            </li>
                                            <li>
                                                <a href="shop-v6-search-results.php">Shop Ver 6 Search Results</a>
                                            </li>
                                            <li class="menu-title">My Account Variation</li>
                                            <li>
                                                <a href="lost-password.php">Lost Your Password ?</a>
                                            </li>
                                            <li class="menu-title">Checkout Variation</li>
                                            <li>
                                                <a href="confirmation.php">Checkout Confirmation</a>
                                            </li>
                                            <li class="menu-title">Custom Deals Page</li>
                                            <li>
                                                <a href="custom-deal-page.php">Custom Deal Page</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="custom-deal-page.php">Super Sale
                                        <span class="superscript-label-discount">-15%</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bottom-Header /- -->
        </header>
        <!-- Header /- -->