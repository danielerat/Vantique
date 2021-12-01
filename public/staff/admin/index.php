<?php
require_once('../../../private/initialize.php');

$page_title = "Admin Dashboared";

include(SHARED_PATH . '/staff_header.php');

// echo "<pre>";
// print_r($session);
// echo "</pre>";
echo display_session_message();
?>



<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Monthly)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">frw 193,000</div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                                0.00%</span>
                            <span>Since last month</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo (UserOrder::find_number_of_sales([1, 3, 2, 4])->status); ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <span class="text-success mr-2"><i class="fas fa-money-bill"></i>
                            </span>
                            <span>All Sales Made</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Number Of users</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">8</div>
                        <div class="mt-2 mb-0 text-muted text-xs">

                            <span class="text-primary mr-2"><i class="fas fa-flag"></i></span>
                            <span>All Current Users</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo (UserOrder::find_number_of_sales([1])->status); ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">

                            <span class="text-danger mr-2"><i class="fas fa-flag"></i></span>
                            <span>All pending Requests</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Card Design End ------------------------------------------------>




    <!-- Pending Shipping Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Shipping
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo (UserOrder::find_number_of_sales([3])->status); ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <span class="text-success mr-2"><i class="fas fa-flag"></i>
                            </span>
                            <span>All Orders Being Shipped</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shipping-fast fa-2x "></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Card Shipping End ------------------------------------------------>



    <!-- Pending Shipping Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Delivered
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo (UserOrder::find_number_of_sales([4])->status); ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <span class="text-success mr-2"><i class="fas fa-flag"></i>
                            </span>
                            <span>All Successfull Orders</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Card Shipping End ------------------------------------------------>




    <!-- Invoice Example 
    <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Invoice</h6>
                <a class="m-0 float-right btn btn-danger btn-sm" href="#">View More <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Item</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="#">RA0449</a></td>
                            <td>Udin Wayang</td>
                            <td>Nasi Padang</td>
                            <td><span class="badge badge-success">Delivered</span></td>
                            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA5324</a></td>
                            <td>Jaenab Bajigur</td>
                            <td>Gundam 90' Edition</td>
                            <td><span class="badge badge-warning">Shipping</span></td>
                            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA8568</a></td>
                            <td>Rivat Mahesa</td>
                            <td>Oblong T-Shirt</td>
                            <td><span class="badge badge-danger">Pending</span></td>
                            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA1453</a></td>
                            <td>Indri Junanda</td>
                            <td>Hat Rounded</td>
                            <td><span class="badge badge-info">Processing</span></td>
                            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA1998</a></td>
                            <td>Udin Cilok</td>
                            <td>Baby Powder</td>
                            <td><span class="badge badge-success">Delivered</span></td>
                            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
     Invoice Example end ------------------------------ -->
    <!-- Message From Customer-->

    <!-- Invoice Message Example -->

</div>
<!--Row-->
<div class="col-xl-4 col-lg-5 ">
    <div class="card">
        <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-light">Message From Customer</h6>
        </div>
        <div>

            <div class="customer-message align-items-center">
                <a class="font-weight-bold" href="#">
                    <div class="text-truncate message-title">Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit
                    </div>
                    <div class="small text-gray-500 message-time font-weight-bold">Jajang Cincau
                        · 25m</div>
                </a>
            </div>
            <div class="customer-message align-items-center">
                <a class="font-weight-bold" href="#">
                    <div class="text-truncate message-title">At vero eos et accusamus et iusto
                        odio dignissimos
                        ducimus qui blanditiis
                    </div>
                    <div class="small text-gray-500 message-time font-weight-bold">Udin Wayang ·
                        54m</div>
                </a>
            </div>
            <div class="card-footer text-center">
                <a class="m-0 small text-primary card-link" href="#">View More <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </div>
</div>






<?php

include(SHARED_PATH . '/staff_footer.php');
?>

<!-- Code To generate The Cart -->
<!-- <script src="../vendor/chart.js/Chart.min.js"></script>
<script src="../js/demo/chart-area-demo.js"></script> -->