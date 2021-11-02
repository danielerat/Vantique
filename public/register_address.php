<?php
require_once("../private/initialize.php");
require_once(PRIVATE_PATH . "/shared/public_header.php");
require_user_login();


if (is_post_request()) {
    $add = $_POST['address'];
    $add['username'] = $session_user->username;;
    $address = new Address($add);
    if ($address->save()) {
        $session_user->message("Your Address Was Added Successfully ");
        redirect_to("register_address.php");
    };
}


?>

<link href="staff/vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
<!-- Register Address -Page -->


<?php

$has_address = Address::find_address_by_username($_SESSION['username']);

if ($has_address) {
?>

<div class="container">

    <table class="table align-items-center mx-auto table-flush table-hover w-50" id="dataTableHover">
        <thead class="thead-light">
            <tr>

                <th>id</th>
                <th>Province</th>
                <th>District</th>
                <th>Sector</th>
                <th>Description</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
                $id = 0;
                foreach ($has_address as $add) {
                    $id++;
                ?>
            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo Rwanda::find_Rw($add->province, 'Rw_province')->Name; ?></td>
                <td><?php echo Rwanda::find_Rw($add->district, 'Rw_district')->Name; ?></td>
                <td><?php echo Rwanda::find_Rw($add->sector, 'Rw_sector')->Name; ?></td>
                <td><?php echo $add->description; ?></td>
                <td>
                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <?php    } ?>

        </tbody>
    </table>
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
                    <h2 class="col animate__animated animate__bounceInLeft">Add Another Address! </h2><br>

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
                            <div class="form-group animate__animated animate__bounceInRight animate__delay-1s">
                                <label for="SelectDistrict"><span class="astk">*</span> Please Select Your District
                                </label><br>
                                <select class="select2-single-placeholder form-control" name="address[district]"
                                    id="SelectDistrict" required>
                                    <option value="">Select Your Province First</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-10 col-md-6">
                            <div class="form-group animate__animated animate__bounceInDown animate__delay-1s">
                                <label for="selectSector"><span class="astk">*</span> Please Select Your Sector
                                </label><br>
                                <select class="select2-single-placeholder form-control" name="address[sector]"
                                    id="selectSector">
                                    <option value="">Select Your District First</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-10 col-md-6">
                            <div class="form-group animate__animated animate__bounceInDown">
                                <label for="exampleFormControlTextarea1"> Descriptive Address(Or Road Nuber)</label><br>
                                <textarea class="form-control" placeholder="Ex:Near CST or KN 23 St, Feel Free"
                                    id="exampleFormControlTextarea1" rows="2" name='address[description]'></textarea>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Save Address">
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
                    <div class="form-group animate__animated animate__bounceInRight animate__delay-1s">
                        <label for="SelectDistrict"><span class="astk">*</span> Please Select Your District </label><br>
                        <select class="select2-single-placeholder form-control" name="address[district]"
                            id="SelectDistrict" required>
                            <option value="">Select Your Province First</option>

                        </select>
                    </div>
                </div>
                <div class="col-10 col-md-6">
                    <div class="form-group animate__animated animate__bounceInDown animate__delay-1s">
                        <label for="selectSector"><span class="astk">*</span> Please Select Your Sector </label><br>
                        <select class="select2-single-placeholder form-control" name="address[sector]"
                            id="selectSector">
                            <option value="">Select Your District First</option>
                        </select>
                    </div>
                </div>
                <div class="col-10 col-md-6">
                    <div class="form-group animate__animated animate__bounceInDown">
                        <label for="exampleFormControlTextarea1"> Descriptive Address(Or Road Nuber)</label><br>
                        <textarea class="form-control" placeholder="Ex:Near CST or KN 23 St, Feel Free"
                            id="exampleFormControlTextarea1" rows="2" name='address[description]'></textarea>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Save Address">
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