<?php
require_once('../../../private/initialize.php');

include(SHARED_PATH . '/staff_header.php');


$id = $_GET['id'] ?? Null;
if ($id == null) {
    header("Location: products.php");
}


$product = Product::find_by_id($id);
$category_all = Category::find_all();
$images = ProductImage::find_by_product_id($id);
$stock = ProductStock::find_by_product_id($id);

// Get All Selected Categories 
$chosencat = [];
foreach (Category::find_product_category($id) as $cat) {
    $chosencat[] = $cat->id;
}

if (is_post_request() && isset($_POST['updateform'])) {
    // Error While Doing the uploading things
    $errors = [];
    $args = $_POST['product'];
    if (empty($errors)) {
        $product->merge_attributes($args);
        // At this poing our Bicycle object will have the form values not the db values anymore 
        $result = $product->save(); // save the values to the database
        if ($result === true) {
            $new_id = $product->id;
            $session->message("Product Was Successfully Updated !");
            //Everything went well , reset back the session variables   
            // $$_SESSION['upload_status'] = false;
            // redirect_to("edit_product.php?id=" . $product->id);
        } else {
            //Not Inserted 
            echo display_errors($product->errors);
        }
    } else {
        $product = new Product($args);
        echo display_errors($errors);
    }
}

if (is_post_request() && isset($_POST['category'])) {
    $category = $_POST["productCategory"];
    $productCategory = new ProductCategory;
    $productCategory->delete_by_product($id);
    foreach ($category as $cat) {
        $InsertCategory = new ProductCategory(["productId" => $product->id, "categoryId" => $cat]);
        $InsertCategory->save();
    }
    foreach (Category::find_product_category($id) as $cat) {
        $chosencat[] = $cat->id;
    }
}

echo display_session_message();

?>
<!-- Select2 -->
<link href="../vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">


<!-- <div class="text-center">
    <img src="img/think.svg" style="max-height: 90px">
    <h4 class="pt-3">save your <b>imagination</b> here!</h4>
</div> -->


<section class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Basic</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $product->id; ?>"
                        enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" id="productName"
                                value="<?php echo $product->productName; ?>" name="product[productName]"
                                placeholder="*Your Product Name (Min:12Chars)" required>
                        </div>





                        <div class="form-group">
                            <label for="tarea">Product Description</label>
                            <textarea class="form-control" id="tarea" name="product[productDesc]" rows="4"
                                required><?php echo $product->productDesc; ?></textarea>
                        </div>




                        <div class="input-group my-4">
                            <div class="w-50"><label for="ppr">Product Price
                                    (FRW)</label>
                            </div>
                            <div class="input-group-prepend">
                                <span class="input-group-text">Frw</span>
                            </div>
                            <input type="text" id="ppr" name="product[productPrice]"
                                value="<?php echo $product->productPrice; ?>" class="form-control"
                                aria-label="Amount (to the nearest Rwandan)" placeholder="*Price in Rwf" required>
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        <table class="py-3  d-flex align-items-baseline">
                            <tr>
                                <td class="w-25">
                                    <label>Product Unlimited</label>
                                    <div class="custom-control custom-switch align-self-center">
                                        <input type="checkbox" class="custom-control-input" id="customSwitchUlimited"
                                            onclick="showquantitybox()">
                                        <label class="custom-control-label" for="customSwitchUlimited"> *Is
                                            Unlimited</label>
                                    </div>
                                </td>

                                <td class="w-25 unlimitedinput ">
                                    <div class="form-group ">
                                        <label for="productQuantity" class="  mr-3">Quantity</label>
                                        <input type="text" class="form-control" id="productQuantity"
                                            value="<?php echo $stock->quantity; ?>" name="product[productUnlimited]"
                                            placeholder="*Quantity" required>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <button type="submit" name="updateform" class="btn btn-primary float-right mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">

            <div class="w-75 m-3 ">
                <div class="card">
                    <div class="col-auto">
                        <i class="fas fa-plus-circle  text-success">Add New Images</i>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">

                                <div class="h6  font-weight-bold text-gray-800">
                                    <form method="post" id="addImage" class=" bg-light"
                                        action="<?php echo $_SERVER["PHP_SELF"] ?>" autocomplete="off">
                                        <div class="form-group">
                                            <input type="file" class="form-control" value=""
                                                name="category[categoryName]" placeholder="*Select Images " required>
                                            <button type="submit" class="btn float-right mt-2 btn-primary">Add</button>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="w-75 m-3  ">
                <div class="card">
                    <div class="col-auto">
                        <i class="fas fa-plus-circle  text-warning">Change Category</i>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">

                                <div class="h6  font-weight-bold text-gray-800">
                                    <form method="post" id="addCategoryForm" class=" bg-light"
                                        action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $product->id; ?>"
                                        autocomplete="off">
                                        <div class="form-group">
                                            <label for="sl2mul">Product Category</label>
                                            <select class="select2-multiple form-control" name="productCategory[]"
                                                multiple="multiple" id="sl2mul">
                                                <option disabled="disabled">Select A Category</option>
                                                <?php
                                                foreach ($category_all as $cat) {
                                                    if (in_array($cat->id, $chosencat)) {
                                                        $category = "<option value={$cat->id} selected>" . $cat->categoryName . "</option>";
                                                    } else {
                                                        $category = "<option value={$cat->id}>" . $cat->categoryName . "</option>";
                                                    }
                                                    echo $category;
                                                } ?>
                                            </select>
                                            <button type="submit" name='category'
                                                class="btn float-right mt-2 btn-warning">Add</button>

                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row border">
        <div class="col-12">
            <h4>Images</h4>
            <div class="row gx-5 justify-content-around">
                <?php foreach ($images as $img) {
                ?>
                <div class="col card">
                    <div class="card-body  p-0 overflow-hidden" style="height:230px;  ">
                        <img src="<?php echo S_PRIVATE . '/uploads/' . $img->image; ?>" class=" img-fluid ">
                    </div>
                    <div class="card-footer justify-content-around">
                        <?php if ($product->productThumb === $img->image) { ?>

                        <button class="btn btn-success  btn-sm" disabled>
                            <i class="fas fa-flag"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" disabled>
                            <i class="fas fa-trash"></i>
                        </button>
                        <?php

                            } else { ?>
                        <button class="btn btn-primary btn-sm setFeatured">
                            <i class="fas fa-flag"></i>
                        </button>
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                        <?php } ?>
                    </div>
                </div>

                <?php } ?>

            </div>
        </div>
    </div>

</section>

<?php
include(SHARED_PATH . '/staff_footer.php');
?>
<!-- Select2 -->
<script src="../vendor/select2/dist/js/select2.min.js"></script>
<!-- Bootstrap Datepicker -->
<script src="../vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap Touchspin -->
<script src="../vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
<!-- ClockPicker -->
<script src="../vendor/clock-picker/clockpicker.js"></script>
<!-- RuangAdmin Javascript -->
<script src="../js/ruang-admin.min.js"></script>
<!-- Javascript for this page -->
<script>
function showquantitybox() {
    var unlimited = document.querySelector(".unlimitedinput");
    unlimited.classList.toggle('d-none');
    if (!unlimited.classList.contains('d-none')) {
        document.querySelector("#productQuantity").value = 100;
    } else {
        document.querySelector("#productQuantity").value = "x";
    }
}


$(document).ready(function() {


    $('.select2-single').select2();

    // Select2 Single  with Placeholder
    $('.select2-single-placeholder').select2({
        placeholder: "Select a Province",
        allowClear: true
    });

    // Select2 Multiple
    $('.select2-multiple').select2();

    // Bootstrap Date Picker
    $('#simple-date1 .input-group.date').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,
    });

    $('#simple-date2 .input-group.date').datepicker({
        startView: 1,
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
        todayBtn: 'linked',
    });

    $('#simple-date3 .input-group.date').datepicker({
        startView: 2,
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
        todayBtn: 'linked',
    });

    $('#simple-date4 .input-daterange').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
        todayBtn: 'linked',
    });

    // TouchSpin

    $('#touchSpin1').TouchSpin({
        min: 0,
        max: 100,
        boostat: 5,
        maxboostedstep: 10,
        initval: 0
    });

    $('#touchSpin2').TouchSpin({
        min: 0,
        max: 100,
        decimals: 2,
        step: 0.1,
        postfix: '%',
        initval: 0,
        boostat: 5,
        maxboostedstep: 10
    });

    $('#touchSpin3').TouchSpin({
        min: 0,
        max: 100,
        initval: 0,
        boostat: 5,
        maxboostedstep: 10,
        verticalbuttons: true,
    });

    $('#clockPicker1').clockpicker({
        donetext: 'Done'
    });

    $('#clockPicker2').clockpicker({
        autoclose: true
    });

    let input = $('#clockPicker3').clockpicker({
        autoclose: true,
        'default': 'now',
        placement: 'top',
        align: 'left',
    });

    $('#check-minutes').click(function(e) {
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
    });

});
</script>