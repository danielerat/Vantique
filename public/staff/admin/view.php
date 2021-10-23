<?php
require_once('../../../private/initialize.php');

$page_title = "View Product";

include(SHARED_PATH . '/staff_header.php');


$id = $_GET['id'] ?? Null;
if ($id == null) {
    header("Location: products.php");
}
$product = Product::find_by_id($id);
if (empty($product)) {
    header("Location: products.php");
}
$product_category = Category::find_product_category($id);
$product_image = ProductImage::find_by_product_id($id);
$stock = ProductStock::find_by_product_id($id);
echo display_session_message();
?>
<!--Section: Block Content-->
<section class="mb-5">

    <a href="" class="btn btn-warning btn-icon-split float-right">
        <span class="icon text-white-50">
            <i class="fas fa-exclamation-triangle"></i>
        </span>
        <span class="text">Edit Item</span>
    </a>
    <div class="row  align-content-end ">
        <div class="col-md-5 mb-4 mb-md-0">

            <div id="mdb-lightbox-ui"></div>

            <div class="mdb-lightbox">

                <div class="row product-gallery mx-1">

                    <div class="col-10 mb-0">
                        <figure class="view border border-primary  overlay rounded z-depth-1 main-img">
                            <a href="#'; ?>" data-size="710x823">
                                <img src="<?php echo  S_PRIVATE . '/uploads/' . $product->productThumb; ?>"
                                    class="img-fluid z-depth-1">
                            </a>
                        </figure>

                    </div>
                    <div class="col-10 border">
                        <div class="row  justify-content-center">
                            <?php foreach ($product_image as $img) { ?>
                            <div class="col-3 align-self-center">
                                <div class="view overlay rounded z-depth-1 gallery-item">
                                    <img src="<?php echo S_PRIVATE . '/uploads/thumb/' . $img->image; ?>"
                                        class="img-fluid">
                                    <div class="mask rgba-white-slight"></div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-md-7">

            <h5>Fantasy T-shirt</h5>
            <p class="mb-2 text-muted text-uppercase small">
                <?php foreach ($product_category as $category) { ?>
                <span class="badge badge-primary p-2"><?php echo $category->categoryName; ?></span>
                <?php } ?>
            </p>

            <p><span class="mr-1"><strong>Frw
                        <?php echo number_format($product->productPrice, 2); ?></strong></span>
            </p>
            <p class="pt-1"><?php echo $product->productDesc; ?></p>
            <div class="table-responsive">
                <table class="table table-sm table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th class="pl-0 w-25" scope="row"><strong>Quantity Left</strong></th>
                            <td> <?php echo ($product->productUnlimited == 1) ? "Unlimited" : $stock->quantity; ?></td>
                        </tr>
                        <tr>
                            <th class="pl-0 w-25" scope="row"><strong>Added By</strong></th>
                            <td><?php echo $product->addedBy; ?></td>
                        </tr>
                        <tr>
                            <th class="pl-0 w-25" scope="row"><strong>Color</strong></th>
                            <td>Black</td>
                        </tr>
                        <tr>
                            <th class="pl-0 w-25" scope="row"><strong>Added</strong></th>
                            <td><?php echo $product->productUploadDate; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>

        </div>
    </div>

</section>

<?php
include(SHARED_PATH . '/staff_footer.php');
?>