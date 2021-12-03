<?php
require_once("../private/initialize.php");
require_once(PRIVATE_PATH . "/shared/public_header.php");
require_user_login();


if (is_post_request()) {
    $add = $_POST['address'];
    $add['username'] = $session_user->username;;
    $address = new Address($add);
    if ($address->save()) {
        $default = Address::set_primary_address($session_user->username, $address->id);
        $session_user->message("Your Address Was Added Successfully ");
        // redirect_to("register_address.php");
    };
}

echo display_user_session_message();

?>

<link href="staff/vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
<!-- Register Address -Page -->


<?php

$has_address = Address::find_address_by_username($_SESSION['username']);

if ($has_address) {
    $user = User::find_by_username($session_user->username);
?>

<div class="container mt-4">
    <div class="row justify-content-around">

        <?php
            $id = 0;
            foreach ($has_address as $add) {
                $bg = ($add->active == 1) ? 'success' : 'warning';
            ?>

        <div class="col-md-5 p-1 mb-4 rounded bg-<?php echo $bg; ?> ">
            <div class="card mb-4 h-100">
                <div style="position: absolute; top:10px;right:10px;">
                    <i class="fas fa-home fa-3x text-<?php echo $bg; ?>"></i>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12 mr-2">
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span><?php  ?></span>
                            </div>
                            <div class="text-secondary font-weight-bold  text-uppercase mb-1">
                                Shipping Address
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-dark">
                                <?php echo $user->first_name . ' ' . $user->last_name; ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-<?php echo $bg; ?> mr-2"><i class="fas fa-envelope-open"></i>
                                    Email:</span>
                                <span><?php echo $user->email; ?></span>
                            </div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-<?php echo $bg; ?> mr-2"><i class="fas fa-phone"></i>
                                    Phone:</span>
                                <span><?php echo $user->phone; ?></span>
                            </div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-<?php echo $bg; ?> mr-2"><i class="fas fa-map-marker-alt"></i>
                                    Address:</span>
                                <?php echo  Rwanda::find_Rw($add->province, 'Rw_province')->Name . '<span class="text-primary font-weight-bold"> / </span>' .
                                            Rwanda::find_Rw($add->district, 'Rw_district')->Name . '<span class="text-primary font-weight-bold"> / </span>' .
                                            Rwanda::find_Rw($add->sector, 'Rw_sector')->Name; ?>
                            </div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-<?php echo $bg; ?> mr-2"><i class="fa fa-road"></i> Street:
                                </span>
                                <?php echo $add->street; ?>
                            </div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-<?php echo $bg; ?> mr-2"><i class="fa fa-road"></i>Location:</span>
                                <?php echo ellipse_of($add->description, 30); ?>
                            </div>
                        </div>

                    </div>
                </div>
                <?php
                        if (!$add->active == 1) {
                            echo '<a href="#" class="btn btn-success btn-icon-split btn-sm" style="position:absolute; right:50px; bottom:0px">
                    <span class="icon text-white-50">
                           <i class="fas fa-flag"></i>
                    </span>
                   <span class="text">Set Default</span>
                 </a>';
                        }
                        ?>
                <button class="button text-white bg-danger rounded fas fa-trash" onclick="delete_address()"
                    style="position:absolute; right:0px; bottom:0px"></button>


            </div>
        </div>
        <?php    } ?>
    </div>

</div>




<div class="container">
    <div class="message-open u-s-m-b-24">
        Add Another Address?
        <strong>
            <a class="u-c-brand" data-toggle="collapse" href="#showlogin">Click Here To Add
            </a>
        </strong>
    </div>
    <div class="collapse u-s-m-b-24" id="showlogin">

        <section class="container">
            <div class="container">
                <div class="row mt-5 ">
                    <h2 class="col animate__animated animate__bounceInLeft">You are Almost There ! </h2><br>

                </div>
            </div>
            <section class="container mt-2">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                    <div class="row w-75 mx-auto  align-items-center">

                        <div class="col-10 col-md-6">
                            <div class="form-group animate__animated animate__bounceInLeft ">
                                <label for="selectProvince"><span class="astk">*</span> Please Select Your Province
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
                        <div class="col-10 col-md-6">
                            <div class="form-group animate__animated animate__bounceInRight ">
                                <label for="SelectDistrict"><span class="astk">*</span> Please Select Your District
                                </label><br>
                                <select class="select2-single-placeholder form-control" name="address[district]"
                                    id="SelectDistrict" required>
                                    <option value="">Select Your Province First</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-10 col-md-6">
                            <div class="form-group animate__animated animate__bounceInDown">
                                <label for="selectSector"><span class="astk">*</span> Please Select Your Sector
                                </label><br>
                                <select class="select2-single-placeholder form-control" name="address[sector]"
                                    id="selectSector">
                                    <option value="">Select Your District First</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-10 col-md-6">
                            <span class="astk">*</span>
                            <label for="streetN">Street</label>
                            <input type="text" class="form-control" value="" name="address[street]" id="streetN"
                                placeholder="*ex: KN 23 ST" required>
                        </div>
                        <div class="col-10 col-md-6">
                            <div class="form-group animate__animated animate__bounceInDown">
                                <label for="exampleFormControlTextarea1"> Descriptive Address(Or Road Nuber)</label><br>
                                <textarea class="form-control"
                                    placeholder="Ex:Near Nyarugenge Market, Near CST, Feel Free and be as descriptive as you can"
                                    id="exampleFormControlTextarea1" rows="2" name='address[description]'></textarea>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary mx-auto" value="Save Address">
                    </div>
                </form>
            </section>
        </section>


    </div>
</div>

<?php } else {
?>

<section class="container">
    <div class="container">
        <div class="row mt-5 ">
            <h2 class="col animate__animated animate__bounceInLeft">You are Almost There ! </h2><br>

        </div>
    </div>
    <section class="container mt-2">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

            <div class="row w-75 mx-auto  align-items-center">

                <div class="col-10 col-md-6">
                    <div class="form-group animate__animated animate__bounceInLeft ">
                        <label for="selectProvince"><span class="astk">*</span> Please Select Your Province </label><br>
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
                <div class="col-10 col-md-6">
                    <div class="form-group animate__animated animate__bounceInRight ">
                        <label for="SelectDistrict"><span class="astk">*</span> Please Select Your District </label><br>
                        <select class="select2-single-placeholder form-control" name="address[district]"
                            id="SelectDistrict" required>
                            <option value="">Select Your Province First</option>

                        </select>
                    </div>
                </div>
                <div class="col-10 col-md-6">
                    <div class="form-group animate__animated animate__bounceInDown">
                        <label for="selectSector"><span class="astk">*</span> Please Select Your Sector </label><br>
                        <select class="select2-single-placeholder form-control" name="address[sector]"
                            id="selectSector">
                            <option value="">Select Your District First</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-10 col-md-6">
                    <span class="astk">*</span>
                    <label for="streetN">Street</label>
                    <input type="text" class="form-control" value="" name="address[street]" id="streetN"
                        placeholder="*ex: KN 23 ST" required>
                </div>
                <div class="col-10 col-md-6">
                    <div class="form-group animate__animated animate__bounceInDown">
                        <label for="exampleFormControlTextarea1"> Descriptive Address(Or Road Nuber)</label><br>
                        <textarea class="form-control"
                            placeholder="Ex:Near Nyarugenge Market, Near CST, Feel Free and be as descriptive as you can"
                            id="exampleFormControlTextarea1" rows="2" name='address[description]'></textarea>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary mx-auto" value="Save Address">
            </div>
        </form>
    </section>
</section>


<?php } ?>












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
</script>