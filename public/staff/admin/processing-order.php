<?php
require_once('../../../private/initialize.php');
$page_title = "Orders Being Processed";
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





<!-- Invoice Example -->
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-sm-12 mb-4">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Orders</h6>

                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Method</th>

                                <th>Payment</th>
                                <th>Made On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $order = UserOrder::find_order_by_status(2);

                            foreach ($order as $o) {

                            ?>



                            <tr class="t-<?php echo $o->id; ?>">
                                <td><a href="#"><?php echo $o->orderId; ?></a></td>
                                <td><?php echo $o->username; ?></td>
                                <td><?php echo $o->deliverySpeed($o->deliveryMethod); ?></td>
                                <td><?php echo "<span class='btn btn-warning p-0 px-2'>Cash</span>" ?></td>
                                <td class="text-truncate"><?php echo $o->addedOn; ?></td>
                                <td>
                                    <?php echo $o->getOrderStatus($o->status); ?>
                                </td>
                                <td class=" text-truncate">
                                    <a href="#" class="m-1 btn btn-success btn-sm confirmOrderToNext"
                                        data-id="<?php echo $o->id ?>" data-val="<?php echo $o->status ?>"><i
                                            class="fas fa-check"></i></a>
                                    <a href="invoice.php?id=<?php echo $o->orderId; ?>"
                                        class="m-1 btn btn-info btn-sm"><i class="fas fa-info-circle"></i></a>
                                    <a href="#" class="m-1 btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
<!-- Invoice Example end ------------------------------ -->




<?php
include(SHARED_PATH . '/staff_footer.php');
?>