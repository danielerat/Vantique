<?php
require_once('../../../private/initialize.php');

include(SHARED_PATH . '/staff_header.php');

echo display_session_message();
?>


<div class="w-50 m-auto" aria-labelledby="searchDropdown">
    <form class="navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-1 small" placeholder="Type Your Search?"
                aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
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
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">All Products </h6>
        </div>
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                <thead class="thead-light">
                    <tr>
                        <th>Names</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Account</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>

                    <tr>
                        <th>Names</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Account</th>
                        <th>Action</th>
                    </tr>

                </tfoot>
                <tbody>
                    <?php $admins = Admin::find_all();
                    foreach ($admins as $admin) {
                    ?>
                    <tr class="container ">
                        <td class="font-weight-bold">
                            <?php echo ellipse_of(h($admin->first_name . ' ' . h($admin->last_name)), 40); ?></td>
                        <td class=""><?php echo ellipse_of(h($admin->username), 60); ?>
                        <td class=""><?php echo ellipse_of(h($admin->email), 60); ?>
                        </td>

                        <td class=" justify-content-center">
                            <?php echo has_account_type((int) $admin->account_type); ?>

                        </td>


                        <td class="">
                            <a href="view.php?id=<?php echo h($admin->id); ?>" class="btn btn-info btn-sm"><i
                                    class="fas fa-info-circle"></i></a>
                            <a href="edit_product.php?id=<?php echo h($admin->id); ?>" class="btn btn-warning btn-sm"><i
                                    class="fas fa-edit"></i></a>
                            <a href="delete_admin.php?id=<?php echo h($admin->id); ?>" class="btn btn-danger btn-sm"><i
                                    class="fas fa-trash"></i></a>

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