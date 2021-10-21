<?php
require_once('../../../private/initialize.php');

include(SHARED_PATH . '/staff_header.php');

?>


<!-- <div class="text-center">
    <img src="img/think.svg" style="max-height: 90px">
    <h4 class="pt-3">save your <b>imagination</b> here!</h4>
</div> -->


<!-- DataTable with Hover -->
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">DataTables with Hover</h6>
        </div>
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Preview</th>
                        <th>By</th>
                        <th>On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Preview</th>
                        <th>By</th>
                        <th>On</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>2011/04/25</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></a>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>

                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>




<?php
include(SHARED_PATH . '/staff_footer.php');
?>