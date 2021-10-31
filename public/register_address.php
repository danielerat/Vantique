<?php
require_once("../private/initialize.php");
require_once(PRIVATE_PATH . "/shared/public_header.php");

?>

<link href="staff/vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
<!-- Wishlist-Page -->
<section class="container mt-5">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

        <div class="row w-75 mx-auto  align-items-center">


            <div class="col-8 col-md-6">
                <div class="form-group">
                    <label for="selectProvince"><span class="astk">*</span> Please Select Your Province </label><br>
                    <select class="select2-single-placeholder form-control" name="state" id="selectProvince" required>
                        <option value="">Select</option>
                        <?php $province = Rwanda::find_province();
                        foreach ($province as $p) {
                            echo "<option value='" . $p->id . "'>" . $p->Name . "</option>";
                        }
                        ?>

                    </select>
                </div>
            </div>
            <div class="col-8 col-md-6">
                <div class="form-group">
                    <label for="SelectDistrict"><span class="astk">*</span> Please Select Your District </label><br>
                    <select class="select2-single-placeholder form-control" name="state" id="SelectDistrict" required>
                        <option value="">Select Your Province First</option>

                    </select>
                </div>
            </div>
            <div class="col-8 col-md-6">
                <div class="form-group">
                    <label for="selectSector"><span class="astk">*</span> Please Select Your Sector </label><br>
                    <select class="select2-single-placeholder form-control" name="state" id="selectSector">
                        <option value="">Select Your District First</option>
                    </select>
                </div>
            </div>
            <div class="col-8 col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1"> Descriptive Address(Or Road Nuber)</label><br>
                    <textarea class="form-control" placeholder="Ex:Near CST or KN 23 St, Feel Free"
                        id="exampleFormControlTextarea1" rows="2"></textarea>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Save Address">
        </div>
    </form>

</section>
<!-- Wishlist-Page /- -->
<?php
require_once(PRIVATE_PATH . "/shared/public_footer.php");
?>

<script src="staff/vendor/select2/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2-single').select2();
    // Select2 Single  with Placeholder
    $('.select2-single-placeholder').select2({

        allowClear: true
    });

});
</script>