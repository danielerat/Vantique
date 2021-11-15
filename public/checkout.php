<?php
require_once("../private/initialize.php");
require_once(PRIVATE_PATH . "/shared/public_header.php");

if (is_post_request()) {
    $cartDb = ($session_user->is_logged_in()) ? Cart::find_by_user_id($session_user->username) : $cart->cart_items;
    print_r($_POST);
    $args = [];
    $orderId = 'VT' . uniqid(rand(1, 10));
    $_args['orderId'] = $orderId;
    $_args['username'] = $session_user->username ?? $_COOKIE["PHPSESSID"];
    $_args['deliveryMethod'] = $_POST['deliveryMethod'];
    $_args['deliveryNote'] = $_POST['deliveryNote'];
    $_args['payment'] = $_POST['payment'];
    $order = new UserOrder($_args);
    // Save the Order In the Order Table
    $result = $order->save();
    if ($result) {
        foreach ($cartDb as $p) {
            $orderItem = new OrderItem(["orderId" => $orderId, "productId" => $p->productId, "quantity" => $p->quantity]);
            $orderItem->save();
            // Delete Product From 
            $p->delete_by_cart_id($p->id);
        }
        redirect_to("orderConfirmation.php");
    }
}
?>

<!-- Checkout-Page -->
<link href="staff/vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">

<div class="page-checkout u-s-p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <?php if (!$session_user->is_logged_in()) { ?>
                <!-- First-Accordion -->
                <div>
                    <div class="message-open u-s-m-b-24">
                        Returning customer?
                        <strong>
                            <a class="u-c-brand" data-toggle="collapse" href="#showlogin">Click here to login
                            </a>
                        </strong>
                    </div>
                    <div class="collapse u-s-m-b-24" id="showlogin">
                        <h6 class="collapse-h6">Welcome back! Sign in to your account.</h6>
                        <h6 class="collapse-h6">If you have shopped with us before, please enter your details in the
                            boxes below. If you are a new customer, please proceed to the Billing & Shipping section.
                        </h6>
                        <form form method="POST" action="<?php echo S_PRIVATE . "/user_auth_login.php"; ?>"
                            id="login_form">
                            <div class="group-inline u-s-m-b-13">
                                <div class="group-1 u-s-p-r-16">
                                    <label for="user-name-email">Username or Email
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="user-name-email" class="text-field" value="" name="username"
                                        placeholder="Username / Email" required>
                                </div>
                                <div class="group-2">
                                    <label for="password">Password
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="password" id="login-password" class="text-field" value=""
                                        name="password" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="u-s-m-b-13">
                                <button class="button button-outline-secondary w-100" id="signin">Login</button>

                                <input type="checkbox" class="check-box" id="remember-me-token">
                                <label class="label-text" for="remember-me-token">Remember me</label>
                            </div>
                            <div class="page-anchor">
                                <a href="#" class="u-c-brand">Lost your password?</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- First-Accordion /- -->
                <?php } ?>
                <!-- Second Accordion -->
                <div>
                    <div class="message-open u-s-m-b-24">
                        Have a coupon?
                        <strong>
                            <a class="u-c-brand" data-toggle="collapse" href="#showcoupon">Click here to enter your
                                code</a>
                        </strong>
                    </div>
                    <div class="collapse u-s-m-b-24" id="showcoupon">
                        <h6 class="collapse-h6">
                            Enter your coupon code if you have one.
                        </h6>
                        <div class="coupon-field">
                            <label class="sr-only" for="coupon-code">Apply Coupon</label>
                            <input id="coupon-code" type="text" class="text-field" placeholder="Coupon Code">
                            <button type="submit" class="button">Apply Coupon</button>
                        </div>
                    </div>
                </div>
                <!-- Second Accordion /- -->
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="row">
                        <!-- Billing-&-Shipping-Details -->
                        <?php if (!$session_user->is_logged_in()) { //The user is not logged in  
                        ?>
                        <div class="col-lg-6">
                            <h4 class="section-h4">Billing Details</h4>
                            <!-- Form-Fields -->
                            <div class="group-inline u-s-m-b-13">
                                <div class="group-1 u-s-p-r-16">
                                    <label for="first-name">First Name
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="first-name" class="text-field">
                                </div>
                                <div class="group-2">
                                    <label for="last-name">Last Name
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="last-name" class="text-field">
                                </div>
                            </div>
                            <div class="group-inline u-s-m-b-13">
                                <div class="group-1 u-s-p-r-16">
                                    <label for="email">Email address
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="email" class="text-field">
                                </div>
                                <div class="group-2">
                                    <label for="phone">Phone
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="phone" class="text-field">
                                </div>
                            </div>
                            <!-- <div class="group-inline u-s-m-b-13">
                                <div class="group-1 u-s-p-r-16">
                                    <label for="email">Email address
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="email" class="text-field">
                                </div>
                                <div class="group-2">
                                    <label for="phone">Phone
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="phone" class="text-field">
                                </div>
                            </div> -->




                            <div class="message-open u-s-m-b-24">
                                <input type="checkbox" data-toggle="collapse" href="#showloginpass" class="check-box"
                                    id="create-account">
                                <label class="label-text" for="create-account">Create An Account</label>
                            </div>


                            <div class="collapse u-s-m-b-24" id="showloginpass">
                                <div class="group-inline u-s-m-b-13">
                                    <div class="group-1 u-s-p-r-16">
                                        <label for="email">Username
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="email" class="text-field">
                                    </div>
                                    <div class="group-2">
                                        <label for="phone">Password
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="phone" class="text-field">
                                    </div>
                                </div>
                            </div>



                            <!-- Form-Fields /- -->
                            <h4 class="section-h4">Shipping Details</h4>
                            <div class="u-s-m-b-24">
                                <input type="checkbox" class="check-box" id="ship-to-different-address"
                                    data-toggle="collapse" data-target="#showdifferent">
                                <label class="label-text" for="ship-to-different-address">Ship to a different
                                    address?</label>
                            </div>
                            <div class="collapse" id="showdifferent">
                                <!-- Form-Fields -->
                                <div class="group-inline u-s-m-b-13">
                                    <div class="group-1 u-s-p-r-16">
                                        <label for="first-name-extra">First Name
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="first-name-extra" class="text-field">
                                    </div>
                                    <div class="group-2">
                                        <label for="last-name-extra">Last Name
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="last-name-extra" class="text-field">
                                    </div>
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="select-country-extra">Country
                                        <span class="astk">*</span>
                                    </label>
                                    <div class="select-box-wrapper">
                                        <select class="select-box" id="select-country-extra">
                                            <option selected="selected" value="">Choose your country...</option>
                                            <option value="">United Kingdom (UK)</option>
                                            <option value="">United States (US)</option>
                                            <option value="">United Arab Emirates (UAE)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="street-address u-s-m-b-13">
                                    <label for="req-st-address-extra">Street Address
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="req-st-address-extra" class="text-field"
                                        placeholder="House name and street name">
                                    <label class="sr-only" for="opt-st-address-extra"></label>
                                    <input type="text" id="opt-st-address-extra" class="text-field"
                                        placeholder="Apartment, suite unit etc. (optional)">
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="town-city-extra">Town / City
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="town-city-extra" class="text-field">
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="select-state-extra">State / Country
                                        <span class="astk"> *</span>
                                    </label>
                                    <div class="select-box-wrapper">
                                        <select class="select-box" id="select-state-extra">
                                            <option selected="selected" value="">Choose your state...</option>
                                            <option value="">Alabama</option>
                                            <option value="">Alaska</option>
                                            <option value="">Arizona</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="postcode-extra">Postcode / Zip
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="postcode-extra" class="text-field">
                                </div>
                                <div class="group-inline u-s-m-b-13">
                                    <div class="group-1 u-s-p-r-16">
                                        <label for="email-extra">Email address
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="email-extra" class="text-field">
                                    </div>
                                    <div class="group-2">
                                        <label for="phone-extra">Phone
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="phone-extra" class="text-field">
                                    </div>
                                </div>
                                <!-- Form-Fields /- -->
                            </div>
                            <div>
                                <label for="order-notes">Order Notes</label>
                                <textarea class="text-area" id="order-notes"
                                    placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>
                        <?php } else {
                            //User Is Logged in  
                            $has_address = Address::find_address_by_username($_SESSION['username']);
                            if ($has_address) { //U ser Is logged in ANd has An Address
                                $user = User::find_by_username($session_user->username);
                                $add = Address::find_last_address($session_user->username);
                            ?>
                        <div class="col-lg-6">

                            <div class="p-1 rounded bg-success ">
                                <div class="card h-100">
                                    <div style="position: absolute; top:10px;right:10px;">
                                        <i class="fas fa-home fa-3x text-success"></i>
                                    </div>
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-12 mr-2">
                                                <div class="mt-2 mb-0 text-muted text-xs">
                                                    <span><?php  ?></span>
                                                </div>
                                                <div class="text-secondary font-weight-bold  text-uppercase mb-1">
                                                    Shipping To This Address
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-dark">
                                                    <?php echo $user->first_name . ' ' . $user->last_name; ?></div>
                                                <div class="mt-2 mb-0 text-muted text-xs">
                                                    <span class="text-success mr-2"><i class="fas fa-envelope-open"></i>
                                                        Email:</span>
                                                    <span><?php echo $user->email; ?></span>
                                                </div>
                                                <div class="mt-2 mb-0 text-muted text-xs">
                                                    <span class="text-success mr-2"><i class="fas fa-phone"></i>
                                                        Phone:</span>
                                                    <span><?php echo $user->phone; ?></span>
                                                </div>
                                                <div class="mt-2 mb-0 text-muted text-xs">
                                                    <span class="text-success mr-2"><i
                                                            class="fas fa-map-marker-alt"></i> Address:</span>
                                                    <?php echo  Rwanda::find_Rw($add->province, 'Rw_province')->Name . '<span class="text-primary font-weight-bold"> / </span>' .
                                                                Rwanda::find_Rw($add->district, 'Rw_district')->Name . '<span class="text-primary font-weight-bold"> / </span>' .
                                                                Rwanda::find_Rw($add->sector, 'Rw_sector')->Name; ?>
                                                </div>
                                                <div class="mt-2 mb-0 text-muted text-xs">
                                                    <span class="text-success mr-2"><i class="fa fa-road"></i> Street:
                                                    </span>
                                                    <?php echo $add->street; ?>
                                                </div>
                                                <div class="mt-2 mb-0 text-muted text-xs">
                                                    <span class="text-success mr-2"><i
                                                            class="fa fa-road"></i>Location:</span>
                                                    <?php echo ellipse_of($add->description, 30); ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Choose Shipping Methods -->
                            <div class="group-inline u-s-m-b-13 mt-5">
                                <div class="group1 u-s-m-b-16">
                                    <label for="changeDeliveryMethod">Delivery Method
                                        <span class="astk"> *</span>
                                    </label>
                                    <div class="select-box-wrapper">
                                        <select class="select-box" name="deliveryMethod" id="changeDeliveryMethod"
                                            required>
                                            <option disabled="disabled">Choose A Delivery Method...</option>
                                            <option value="0">Within 5 Days (Free)</option>
                                            <option value="1">Emergency, Within 30Minutes (2,000frw)</option>
                                            <option value="2">Within an hour (1,500frw)</option>
                                            <option value="3">Next Day(800frw)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Comment to let us know more about how they want the product to be delivered -->
                            <div class="group-inline u-s-m-b-13">
                                <div class="group-2">
                                    <label for="exampleFormControlTextarea1">Note:</label><br>
                                    <textarea class="text-area"
                                        placeholder="Any Specification? Comment or somethings you would like us to know before the delivery? Please , don't bother"
                                        id="exampleFormControlTextarea1" rows="2" name='deliveryNote'></textarea>
                                </div>
                            </div>

                        </div>





                        <?php } else { //User Is logged In but has no Address , allow him to add one  
                            ?>
                        <div class="col-lg-6">
                            <h4 class=" mb-5 lead "><span class="astk">*</span>Select Your Shiping Address</h4>
                            <div class="group-inline u-s-m-b-13">
                                <div class="group-1 u-s-p-r-16">
                                    <div class="form-group  ">
                                        <label for="selectProvince"><span class="astk">*</span> Please Select Your
                                            Province
                                        </label><br>
                                        <select class="select2-single-placeholder form-control" name="address[province]"
                                            id="selectProvince" required>
                                            <option value="">Select</option>
                                            <?php $province = Rwanda::find_province();
                                                    foreach ($province as $p) {
                                                        $output = "<option value='" . $p->id . "'>" . $p->Name . "</option>";
                                                        echo $output;
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="group-2 ">
                                    <div class="form-group  ">
                                        <label for="SelectDistrict"><span class="astk">*</span> Please Select Your
                                            District </label><br>
                                        <select class="select2-single-placeholder form-control" name="address[district]"
                                            id="SelectDistrict" required>
                                            <option value="">Select Your Province First</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="group-inline u-s-m-b-13">
                                <div class="group-1 u-s-p-r-16">
                                    <div class="form-group  ">
                                        <label for="selectSector"><span class="astk">*</span> Please Select Your Sector
                                        </label><br>
                                        <select class="select2-single-placeholder form-control" name="address[sector]"
                                            id="selectSector">
                                            <option value="">Select Your District First</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="group-2 ">

                                    <div class="">
                                        <label for="exampleFormControlTextarea1"> Descriptive Address</label><br>
                                        <textarea class="text-area border border-secondary"
                                            placeholder="Ex: Near CST OR (KN 23 Street), Feel Free be as descriptive as you can"
                                            id="exampleFormControlTextarea1" rows="2"
                                            name='address[description]'></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="group-inline u-s-m-b-13">
                                <div class="group1 u-s-m-b-16">
                                    <label for="select-state-extra">Delivery Method
                                        <span class="astk"> *</span>
                                    </label>
                                    <div class="select-box-wrapper">
                                        <select class="select-box" name="delivery['method']" id="select-state-extra"
                                            required>
                                            <option disabled="disabled">Choose A Delivery Method...</option>
                                            <option value="1">Emergency, Within 30Minutes (2,000frw)</option>
                                            <option value="2">Within an hour (1,500frw)</option>
                                            <option value="3">Next Day(800frw)</option>
                                            <option value="4">Within 5 Days (Free)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="group-inline u-s-m-b-13">
                                <div class="group-2">
                                    <label for="exampleFormControlTextarea1">Note:</label><br>
                                    <textarea class="text-area"
                                        placeholder="Any Specification? Comment or somethings you would like us to know before the delivery? let us know more for a smooth delivery"
                                        id="exampleFormControlTextarea1" rows="2" name='delivery[note]'></textarea>
                                </div>
                            </div>



                        </div>
                        <?php   }
                        }
                        ?>

                        <!-- Billing-&-Shipping-Details /- -->
                        <!-- Checkout -->
                        <div class="col-lg-6">
                            <h4 class="section-h4">Your Order</h4>
                            <div class="order-table">
                                <table class="u-s-m-b-13">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cartDb = ($session_user->is_logged_in()) ? Cart::find_by_user_id($session_user->username) : $cart->cart_items;
                                        $total = (float) 0;
                                        // Since What's Kept in the cart cookit is not an object , we have to make the convert
                                        // The Easiest way is to encode and decode back again in a json format ...lol 
                                        if (!$session_user->is_logged_in()) {
                                            $cartDb = json_encode($cartDb);
                                            $cartDb = json_decode($cartDb);
                                        }

                                        if ($cartDb) {
                                            foreach ($cartDb as $cart) {
                                                $product = Product::find_by_id($cart->productId);
                                                $total += (float) ($product->productPrice * $cart->quantity);
                                                $Stock = ProductStock::find_by_product_id($product->id);
                                        ?>
                                        <tr>
                                            <td>
                                                <h6 class="order-h6"><?php echo $product->productName; ?></h6>
                                                <span class="order-span-quantity">x
                                                    <?php echo $cart->quantity; ?></span>
                                            </td>
                                            <td>
                                                <h6 class="order-h6">
                                                    <?php echo number_format($product->productPrice * $cart->quantity, 0) . " Frw"; ?>
                                                </h6>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Subtotal</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3 text-truncate">
                                                    <?php echo number_format($total, 2) . " Frw"; ?>
                                                </h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="">
                                                <h3 class="order-h3">Shipping</h3>
                                            </td>
                                            <td class="">
                                                <h3 class="order-h3 ThippingFee">Frw 0.00</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Tax</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3">$0.00</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Total</h3>
                                            </td>
                                            <td>=
                                                <style>

                                                </style>
                                                <h3 class="order-h3 text-truncate TotalFee">
                                                    <?php echo number_format($total, 1) . ' Frw'; ?>
                                                </h3>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div>
                                    <div class="u-s-m-b-13 =">
                                        <input type="radio" class="radio-box" name="payment" id="cash-on-delivery"
                                            value="1" checked>
                                        <label class="label-text" for="cash-on-delivery"><i
                                                class="fas fa-money-bill-wave-alt text-success"></i> Cash on
                                            Delivery</label>
                                    </div>
                                    <div class="u-s-m-b-13">
                                        <input type="radio" class="radio-box" name="payment" value="2"
                                            id="credit-card-stripe" disabled="">
                                        <label class="label-text" for="credit-card-stripe"><i
                                                class="fas fa-money-bill-wave-alt"
                                                style="color: linear-gradient(red, orange, yellow);"></i>
                                            Momo
                                            Or
                                            Airtel</label>
                                    </div>
                                    <div class="u-s-m-b-13">
                                        <input type="radio" class="radio-box" name="payment" value="3" id="paypal"
                                            disabled>
                                        <label class="label-text" for="paypal">
                                            <i class="fab fa-paypal  text-primary"> </i> Paypal</label>
                                    </div>
                                </div>
                                <div class="u-s-m-b-13">
                                    <input type="checkbox" class="check-box" id="accept" checked disabled="">
                                    <label class="label-text no-color" for="accept">I’ve read and accept the
                                        <a href="terms-and-conditions.html" class="u-c-brand">terms & conditions</a>
                                    </label>
                                </div>
                                <input type="submit" class="button button-outline-secondary" value="Confirm Order">
                            </div>
                        </div>
                        <!-- Checkout /- -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Checkout-Page /- -->

<?php

require_once(PRIVATE_PATH . "/shared/public_footer.php"); ?>

<script src="staff/vendor/select2/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2-single').select2();
    // Select2 Single  with Placeholder
    $('.select2-single-placeholder').select2({

        allowClear: false
    });

});


<?php if (!$has_address) { ?>
province = document.querySelector("#selectProvince")
province.onchange = () => {
    var selected = province.options[province.selectedIndex].value;
    // As soon as the value of the province is changed , then do something about it 
    if (selected) {
        url = "../private/ajax/address_user.php?district=" + selected;
        let xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let result = xhr.responseText;
                let target = document.querySelector("#SelectDistrict");
                target.innerHTML = result;
            }
        }
        xhr.send();
    }
}
district = document.querySelector("#SelectDistrict")
district.onchange = () => {
    var selectedD = district.options[district.selectedIndex].value;
    // As soon as the value of the province is changed , then do something about it 
    if (selectedD) {
        url = "../private/ajax/address_user.php?sector=" + selectedD;
        let xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let result = xhr.responseText;
                let target = document.querySelector("#selectSector");
                target.innerHTML = result;
            }
        }
        xhr.send();
    }
}

<?php } ?>

$('#changeDeliveryMethod').change(function() {

    select = document.querySelector("#changeDeliveryMethod")

    var selected = select.options[select.selectedIndex].value;
    // getting the new value of the current cart so that we can increment it

    $.ajax({
        url: '../private/ajax/shipping_fee.php',
        type: 'post',
        data: {
            type: selected
        },
        success: function(response) {

            var result = JSON.parse(response);
            if (result['total'] && result['fee']) {
                document.querySelector(".TotalFee").innerHTML = result['total'];
                document.querySelector(".ThippingFee").innerHTML = result['fee'];
            }
        }
    });
});
</script>



<script>
var button = document.querySelector("#signin");


function disableSubmitButton() {
    button.disabled = true;
    button.classList.add("bg-danger");
    button.innerHTML = 'Authenticationg...';
}

function enableSubmitButton() {
    button.disabled = false;
    button.innerHTML = 'Login';
    button.classList.remove("bg-danger");
}

function displayErrors(errors) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-right',
        showCloseButton: true,
        showConfirmButton: false,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    Toast.fire({
        icon: 'error',
        title: 'Unknown Username Or Password'
    })
}

function successlogin() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    Toast.fire({
        icon: 'success',
        title: 'Signed in successfully'
    }).then(function() {
        window.location = "cart.php";
    });
}




function login_user() {
    disableSubmitButton();
    var form = document.querySelector("#login_form");
    var action = form.getAttribute("action");
    // gather form data
    var form_data = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', action, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var result = xhr.responseText;
            console.log('Result: ' + result);
            var json = JSON.parse(result);
            if (json.hasOwnProperty('Errors') && json.Errors.length > 0) {
                displayErrors(json['Errors']);
                enableSubmitButton();
            } else {
                enableSubmitButton();
                successlogin();
            }
        }
    };
    xhr.send(form_data);
}

button.addEventListener("click", function(event) {
    event.preventDefault();
    login_user();
});
</script>