<?php
require_once('../../../private/initialize.php');

include(SHARED_PATH . '/staff_header.php');
$category = Category::find_all();
echo  "Status: " . $_SESSION['upload_status'] = false;
if (is_post_request()) {
    // Error While Doing the uploading things
    $errors = [];
    $args = $_POST['product'];
    $args["productCategory"] = $_POST['productCategory'];
    $category = Category::find_categories_by_ids($_POST['productCategory']);

    $args['productThumb'] = "default.png";
    //Check if really there was a file uploaded otherwise it will just get a random name and assign it to the user profile
    if ((has_presence($_FILES['productThumb']['name'][0]) && has_presence($_FILES['productThumb']['type'][0])) && $_FILES['productThumb']['error'][0] != 4 && ($_SESSION['upload_status'] == false)) {
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
        echo "----------Image Uploaded But -----------";
        //Images Are now Uploaded , no need to upload them again 
        $_SESSION['upload_status'] = true;

        echo "Upload Status:" .  $_SESSION['upload_status'];
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
            $$_SESSION['upload_status'] = false;
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


<!-- <div class="text-center">
    <img src="img/think.svg" style="max-height: 90px">
    <h4 class="pt-3">save your <b>imagination</b> here!</h4>
</div> -->


<section class="container">
    <div class="row">
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Basic</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Name</label>
                            <input type="text" class="form-control" value="<?php echo $product->productName; ?>"
                                name="product[productName]" placeholder="*Your Product Name (Min:12Chars)" required>
                        </div>


                        <div class="form-group">
                            <label for="sl2mul">Product Category</label>
                            <select class="select2-multiple form-control" name="productCategory[]" multiple="multiple"
                                id="sl2mul">
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

                        <div class="input-group mb-3">
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

                        <label>Product Unlimited</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                            <label class="custom-control-label" for="customSwitch1"> *Is Unlimited</label>
                        </div>



                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
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