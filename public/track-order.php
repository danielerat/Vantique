<?php
require_once("../private/initialize.php");
require_once(PRIVATE_PATH . "/shared/public_header.php");
?>
<div class="page-track-order u-s-p-t-80">
    <div class="container">
        <div class="track-order-wrapper">
            <h2 class="track-order-h2 u-s-m-b-20 text-center">Track Your Order</h2>
            <h6 class="track-order-h6 u-s-m-b-30">To track your order please enter your Order ID in the box below and
                press the "Track" button. This was given to you on your receipt and in the confirmation email you should
                have received.</h6>
            <form>
                <div class="u-s-m-b-30">
                    <label for="order-id">Order ID
                        <span class="astk">*</span>
                    </label>
                    <input type="text" id="order-id" class="text-field"
                        placeholder="Found in your order confirmation email">
                </div>
                <div class="u-s-m-b-30">
                    <label for="billing-email">Billing Email
                        <span class="astk">*</span>
                    </label>
                    <input type="text" id="billing-email" class="text-field"
                        placeholder="Email you used during checkout.">
                </div>
                <div class="u-s-m-b-30">
                    <button class="button button-outline-secondary w-100">TRACK</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Track-Order-Page /- -->
<?php
require_once(PRIVATE_PATH . "/shared/public_footer.php");
?>