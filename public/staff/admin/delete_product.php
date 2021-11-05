<?php
require_once('../../../private/initialize.php');

$page_title = "Do you Really Want To delete This Product? ";

include(SHARED_PATH . '/staff_header.php');

$id = $_GET['id'] ?? Null;
if ($id == null) {
    header("Location: products.php");
}

if (is_post_request()) {
    $product = Product::find_by_id($id);
    if ($product->delete()) { //Delete The Product Record from product Table
        $category = new ProductCategory;
        // Delete All Sub Categories Colors And Brands
        $scategory = new ProductSubCategory;
        $scategory->delete_by_product($id);
        $sscategory = new ProductSubSubCategory;
        $sscategory->delete_by_product($id);
        $colors = new ProductColor;
        $colors->delete_by_product($id);
        $Brand = new ProductBrand;
        $Brand->delete_by_product($id);

        if ($category->delete_by_product($id)) { // Delete ALl Categories assigned to it
            $product_image = new ProductImage;
            $stock = new ProductStock;
            $images = []; //Empty Array to hold our images
            foreach (ProductImage::find_by_id($id)  as $file) {
                $images[] = $file->image; //Add the images to our array
            }
            $product_image->delete_product_images($images); //Delete All file images in the upload dir

            if ($product_image->delete_by_product($id)) { // Delete All the images from the table

                if ($stock->delete_by_product($id)) {
                    $session_admin->message("The Product Was Successfully Deleted");
                    header("Location: products.php");
                    exit();
                }
            }
        }
    } else {
        header("Location: products.php");
    }
} else {

    $product = Product::find_by_id($id);
    if (empty($product)) {
        header("Location: products.php");
    }
    $category = Category::find_product_category($id);
    $scategory = SubCategory::find_product_category($id);
    $sscategory = SubSubCategory::find_product_category($id);
    $colors = Color::find_product_category($id);
    $brands = Brand::find_product_category($id);
    $product_image = ProductImage::find_by_product_id($id);
}
echo display_session_message();
?>
<!--Section: Block Content-->
<section class="mb-5">

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . "?id=" . $product->id; ?>"
        class="btn btn-danger btn-icon-split float-right">
        <span class="icon text-white-50">
            <i class="fas fa-trash"></i>
        </span>
        <input type="submit" name="delete" value="Delete Item" class=" text bg-transparent text-white "
            style=" border:none">
    </form>
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
                <?php foreach ($category as $category) { ?>
                <span class="badge badge-primary p-2"><?php echo $category->categoryName; ?></span>
                <?php } ?>/
                <?php foreach ($scategory as $category) { ?>
                <span class="badge badge-warning p-2"><?php echo $category->name; ?></span>
                <?php } ?>/
                <?php foreach ($sscategory as $category) { ?>
                <span class="badge badge-danger p-2"><?php echo $category->name; ?></span>
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
                            <td> <?php echo ($product->productUnlimited == 1) ? "Unlimited" : "54"; ?></td>
                        </tr>
                        <tr>
                            <th class="pl-0 w-25" scope="row"><strong>Added By</strong></th>
                            <td><?php echo $product->addedBy; ?></td>
                        </tr>
                        <tr>
                            <th class="pl-0 w-25" scope="row"><strong>Color</strong></th>
                            <td>
                                <?php foreach ($colors as $c) {

                                    echo "<span class='badge p-2 border border-dark ' style='background-color:{$c->hex_value};'>{$c->name}</span>";
                                } ?>
                            </td>

                        </tr>
                        <tr>
                            <th class="pl-0 w-25" scope="row"><strong>Brands</strong></th>
                            <td>
                                <?php foreach ($brands as $b) {
                                    echo "<span class='btn btn-info btn-info p-2 border border-dark '>{$b->name}</span>";
                                } ?>
                            </td>

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