<?php
require_once('../../../private/initialize.php');
$page_title = "User Wishlist Page";
include(SHARED_PATH . '/staff_header.php');

echo display_session_message();
?>



<div class="w-50 m-auto" aria-labelledby="searchDropdown">
    <form class="navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-1 small" placeholder="Type Your Search?" aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
</div>


<!-- DataTable with Hover -->
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-betwee  n">
            <h6 class="m-0 font-weight-bold text-primary">All Users And Products in their cart </h6>
        </div>
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                <thead class="thead-light">
                    <tr>
                        <th>Identity</th>
                        <th>Product</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>

                    <tr>
                        <th>Identity</th>
                        <th>Product</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>

                </tfoot>
                <tbody>
                    <?php $cart = Cart::find_distinct_order();

                    foreach ($cart as $cart) {


                    ?>
                        <tr class="container">
                            <td class="font-weight-bold">
                                <?php
                                $user = User::find_by_username($cart->username);
                                echo ellipse_of(h($user->first_name . ' ' . h($user->last_name)), 40) . "<br>" .
                                    ellipse_of(h($user->username), 60) . "<br>" . ellipse_of(h($user->email), 30) . '<br>' .
                                    ellipse_of(h($user->phone), 60) . "<br>";

                                ?>
                            </td>
                            <td class="">
                                <?php

                                foreach (Cart::find_by_user_id($user->username) as $cart) {
                                    echo "<a href=''>Product:" . $cart->productId . "</a> <b>x" . $cart->quantity . "</b> (" . $cart->addedOn . ")" . "<br>";
                                }
                                ?>

                            </td>
                            <td class="">
                                <?php
                                if ($add = Address::find_last_address($cart->username)) {

                                    echo '<i class="fas fa-home text-success"></i><br>' . Rwanda::find_Rw($add->province, 'Rw_province')->Name . '<span class="text-primary font-weight-bold"> / </span>' .
                                        Rwanda::find_Rw($add->district, 'Rw_district')->Name . '<span class="text-primary font-weight-bold"> / </span>' .
                                        Rwanda::find_Rw($add->sector, 'Rw_sector')->Name;
                                    echo "<br>ST: " . $add->street;
                                    echo "<br>" . ellipse_of($add->description, 100);
                                }
                                ?>
                            </td>



                            <td class="users_action">
                                <a href="view-user-cart.php?user=<?php echo h($cart->username); ?>" class="m-1 btn btn-info btn-sm"><i class="fas fa-info-circle"></i></a>
                                <a href="edit_product.php?id=<?php echo h($user->id); ?>" class="m-1 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="block.php?id=<?php echo h($user->id); ?>" class="m-1 btn btn-secondary btn-sm"><i class="fas fa-ban"></i></a>
                                <a href="delete_user.php?id=<?php echo h($user->id); ?>" class="m-1 btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<?php
include(SHARED_PATH . '/staff_footer.php');
?>