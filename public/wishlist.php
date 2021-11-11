<?php
require_once("../private/initialize.php");
require_once(PRIVATE_PATH . "/shared/public_header.php");

?>




<?php if ($session_user->is_logged_in()) { ?>
<!-- Wishlist-Page -->
<div class="page-wishlist u-s-p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                    $wish = Wishlist::find_by_username($session_user->username);

                    if (!empty($wish)) { ?>
                <!-- Products-List-Wrapper -->
                <div class="table-wrapper u-s-m-b-60">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Unit Price</th>
                                <th>Stock Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                    foreach ($wish as $p) {
                                        $p = Product::find_by_id($p->productId);
                                    ?>
                            <tr class="animate__animated singleItemRow_<?php echo $p->id; ?>">
                                <td>
                                    <div class="cart-anchor-image">
                                        <a href="view-product.php?id=<?php echo $p->id; ?>">
                                            <img src="<?php echo S_PRIVATE . '/uploads/thumb/' . $p->productThumb; ?>"
                                                alt="Product">
                                            <h6><?php echo ellipse_of($p->productName, 100); ?></h6>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-price">
                                        <?php echo "Fr " . number_format($p->productPrice, 0); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-stock">
                                        <?php
                                                    $stock = ProductStock::find_by_product_id($p->id);
                                                    if ($p->productUnlimited == 1) {
                                                        echo "In Stock";
                                                    } elseif ($stock->quantity < 1) {
                                                        echo "Out Of Stock";
                                                    } else {
                                                        echo "In Stock";
                                                    }
                                                    ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="action-wrapper">
                                        <button class="button button-outline-secondary item-addCartBTN"
                                            data-id='<?php echo $p->id; ?>'>Add to
                                            Cart</button>
                                        <button class="button button-outline-secondary fas fa-trash"
                                            onclick="delete_cart_item(<?php echo $p->id; ?>)"></button>
                                    </div>
                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- Products-List-Wrapper /- -->
                <?php  } else { ?>

                <div class="page-wishlist" style="margin-bottom:300px;">
                    <div class="vertical-center">
                        <div class="text-center">
                            <h1>Em
                                <i class="fas fa-child"></i>ty!
                            </h1>
                            <h5>Your Wish List is currently Emply , please add some products to your wishlist :(</h5>
                            <div class="redirect-link-wrapper u-s-p-t-25">
                                <a class="redirect-link" href="custom-del-page.php">
                                    <span>Return to Shop</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- Wishlist-Page /- -->
<?php } else { ?>


<!-- User is not logged in , tell him to do so to add things in the wishlist  -->
<div class="page-wishlist" style="margin-bottom:300px;">
    <div class="vertical-center">
        <div class="text-center">
            <h1>Em
                <i class="fas fa-child"></i>ty!
            </h1>
            <h5>You Need To Login To be Able to Add Items to your wishlist :(</h5>
            <div class="redirect-link-wrapper u-s-p-t-25">
                <a class="redirect-link" href="custom-del-page.php">
                    <span>Return to Shop</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Wishlist-Page /- -->

<?php } ?>


<script type="text/javascript">
function delete_cart_item(id) {
    function wait(ms) {
        var start = new Date().getTime();
        var end = start;
        while (end < start + ms) {
            end = new Date().getTime();
        }
    }

    Swal.fire({
        text: "Do you Really Want to remove it from your Wishlist ?",
        icon: 'warning',
        timer: 10000,
        toast: true,
        timerProgressBar: true,
        position: 'top-end',
        showCancelButton: true,
        confirmButtonColor: 'var(--success)',
        cancelButtonColor: 'var(--danger)',
        confirmButtonText: 'Yes !'
    }).then((result) => {
        if (result.isConfirmed) {

            let action = "../private/ajax/delete_wishlist_product.php";
            var parent = document.querySelector(".singleItemRow_" + id);
            // console.log("Parent is: " + parent)
            var xhr = new XMLHttpRequest();
            xhr.open('POST', action, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let result = xhr.responseText;
                    console.log('Result: ' + result);
                    let json = JSON.parse(result);
                    if (json.hasOwnProperty('errors') && json.errors.length > 0) {
                        Swal.fire(
                            'Eroor!',
                            'Please Try Again Later.',
                            'error'
                        )
                    } else {
                        parent.classList.add("animate__zoomOutLeft");


                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            toast: true,
                            title: 'Record Deleted Successfully',
                            showConfirmButton: false,
                            timer: 1000
                        }).then((result) => {
                            wait(500);

                            parent.classList.add("d-none");

                        })



                    }
                }
            };
            xhr.send("productId=" + id);
        }
    })
}
</script>
<?php
require_once(PRIVATE_PATH . "/shared/public_footer.php");
?>