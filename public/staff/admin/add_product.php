<?php
require_once('../../../private/initialize.php');

include(SHARED_PATH . '/staff_header.php');
$category = Category::find_all();
if (is_post_request()) {
    // Error While Doing the uploading things
    $errors = [];
    $args = $_POST['product'];
    $args["productCategory"] = $_POST['productCategory'];
    $category = Category::find_categories_by_ids($_POST['productCategory']);
    $args['productThumb'] = "default.png";
    $args['addedBy'] = $_SESSION['username'] ?? "administrator";
    //Check if really there was a file uploaded otherwise it will just get a random name and assign it to the user profile
    if ((has_presence($_FILES['productThumb']['name'][0]) && has_presence($_FILES['productThumb']['type'][0])) && $_FILES['productThumb']['error'][0] != 4) {
        $result = Product::upload_image();
        if (isset($result["formatError"])) {
            $errors = $result["formatError"];
        } else {
            if (!empty($result) && has_presence($result[0])) {
                $args['productThumb'] = $result[0];
            } elseif ($result[0]["uploadStatus"] === false) {
                $errors[] = "Error Uploading The Images..!";
            }
        }
    }
    // At first , nothing have been added in the product table

    if (empty($errors)) {

        $args['productThumb'] = $result[0];
        $product = new Product($args);
        //Get All Uploaded Thumbnails and save them to the array
        $product->productThumbnails = $result;
        //Inset the Data
        $result = $product->save();
        if ($result === true) {
            $new_id = $product->id;
            $session->message("Product Was Successfully Added !");
            //Everything went well , reset back the session variables   
            // $$_SESSION['upload_status'] = false;
            redirect_to("view.php?id=" . $product->id);
        } else {
            //Not Inserted 
            echo display_errors($product->errors);
        }
    } else {
        $product = new Product($args);
        echo display_errors($errors);
    }
} else {
    $product = new Product;
}
echo display_session_message();
?>
<!-- Select2 -->
<link href="../vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
<link href="../../css/bundle.skyblue.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../../css/utility.css">

<!-- <div class="text-center">
    <img src="img/think.svg" style="max-height: 90px">
    <h4 class="pt-3">save your <b>imagination</b> here!</h4>
</div> -->


<section class="container">
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Add New Product</h6>
                    </div>
                    <div class="card-body">
                        <div class="group-inline u-s-m-b-10">
                            <div class="group-1 u-s-p-r-16 form-group">
                                <label for="productName">Product Name</label>
                                <input type="text" class="form-control" id="productName"
                                    value="<?php echo $product->productName; ?>" name="product[productName]"
                                    placeholder="*Your Product Name (Min:12Chars)" required>
                            </div>
                        </div>
                        <div class="group-inline u-s-m-b-10 mt-4">
                            <div class="group-2 u-s-p-r-16 form-group">
                                <label for="sl2mul">Product Category</label>
                                <select class="select2-multiple form-control" name="productCategory[]"
                                    multiple="multiple" id="sl2mul">
                                    <option disabled="disabled">Select A Category</option>
                                    <?php foreach ($category as $cat) {
                                        if (!empty($product->productCategory)) {
                                            $category = "<option value={$cat->id} selected>" . $cat->categoryName . "</option>";
                                        } else {
                                            $category = "<option value={$cat->id}>" . $cat->categoryName . "</option>";
                                        }
                                        echo $category;
                                    } ?>
                                </select>
                            </div>
                            <div class="group-2 u-s-p-r-16 form-group ">
                                <label for="sl2mul2">Sub Category</label>
                                <select class="select2-multiple form-control" name="productCategory[]"
                                    multiple="multiple" id="sl2mul2">
                                    <option disabled="disabled">Select A Category First</option>
                                </select>
                            </div>

                        </div>

                        <div class="group-inline u-s-m-b-10  mt-4">
                            <div class="group-1 u-s-p-r-16 form-group">
                                <label for="sl2mul3">Sub Sub Category</label>
                                <select class="select2-multiple form-control" name="productCategory[]"
                                    multiple="multiple" id="sl2mul3">
                                    <option disabled="disabled">Select A Category First</option>
                                </select>
                            </div>
                            <div class="group-2 u-s-p-r-16 form-group">
                                <label for="sl2mul4">Product Color</label>
                                <select class="select2-multiple form-control" name="productCategory[]"
                                    multiple="multiple" id="sl2mul4">
                                    <option disabled="disabled">Select A Color</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="tarea">Product Description</label>
                            <textarea class="form-control" id="tarea" name="product[productDesc]" rows="2"
                                required><?php echo $product->productDesc; ?></textarea>
                        </div>



                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="productThumb[]" class="custom-file-input" id="unlst" multiple
                                    required>
                                <label class="custom-file-label" for="unlst">Choose file</label>
                            </div>
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
                                            checked onclick="showquantitybox()">
                                        <label class="custom-control-label" for="customSwitchUlimited"> *Is
                                            Unlimited</label>

                                    </div>
                                </td>
                                <td class="w-25 unlimitedinput d-none">
                                    <div class="form-group ">
                                        <label for="productQuantity" class="  mr-3">Quantity</label>
                                        <input type="text" class="form-control" id="productQuantity"
                                            value="<?php echo $product->productUnlimited; ?>"
                                            name="product[productUnlimited]" placeholder="*Quantity" required>
                                    </div>
                                </td>
                            </tr>
                        </table>



                        <button type="submit" class="btn btn-primary float-right mt-3">Submit</button>
                    </div>
                </div>
            </div>

        </div>
    </form>

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

<!-- RuangAdmin Javascript -->
<script src="../vendor/js/ruang-admin.min.js"></script>
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

    //     // Bootstrap Date Picker
    //     $('#simple-date1 .input-group.date').datepicker({
    //         format: 'dd/mm/yyyy',
    //         todayBtn: 'linked',
    //         todayHighlight: true,
    //         autoclose: true,
    //     });

    //     $('#simple-date2 .input-group.date').datepicker({
    //         startView: 1,
    //         format: 'dd/mm/yyyy',
    //         autoclose: true,
    //         todayHighlight: true,
    //         todayBtn: 'linked',
    //     });

    //     $('#simple-date3 .input-group.date').datepicker({
    //         startView: 2,
    //         format: 'dd/mm/yyyy',
    //         autoclose: true,
    //         todayHighlight: true,
    //         todayBtn: 'linked',
    //     });

    //     $('#simple-date4 .input-daterange').datepicker({
    //         format: 'dd/mm/yyyy',
    //         autoclose: true,
    //         todayHighlight: true,
    //         todayBtn: 'linked',
    //     });

    //     // TouchSpin

    //     $('#touchSpin1').TouchSpin({
    //         min: 0,
    //         max: 100,
    //         boostat: 5,
    //         maxboostedstep: 10,
    //         initval: 0
    //     });

    //     $('#touchSpin2').TouchSpin({
    //         min: 0,
    //         max: 100,
    //         decimals: 2,
    //         step: 0.1,
    //         postfix: '%',
    //         initval: 0,
    //         boostat: 5,
    //         maxboostedstep: 10
    //     });

    //     $('#touchSpin3').TouchSpin({
    //         min: 0,
    //         max: 100,
    //         initval: 0,
    //         boostat: 5,
    //         maxboostedstep: 10,
    //         verticalbuttons: true,
    //     });

    //     $('#clockPicker1').clockpicker({
    //         donetext: 'Done'
    //     });

    //     $('#clockPicker2').clockpicker({
    //         autoclose: true
    //     });

    //     let input = $('#clockPicker3').clockpicker({
    //         autoclose: true,
    //         'default': 'now',
    //         placement: 'top',
    //         align: 'left',
    //     });

    //     $('#check-minutes').click(function(e) {  
    //         e.stopPropagation();
    //         input.clockpicker('show').clockpicker('toggleView', 'minutes');
    //     });

});
</script>