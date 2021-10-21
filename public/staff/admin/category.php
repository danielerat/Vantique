<?php
require_once('../../../private/initialize.php');

include(SHARED_PATH . '/staff_header.php');


$category_count = Category::count_all();

if (is_post_request()) {
    // Error While Doing the uploading things
    $errors = [];
    $args = $_POST['category'];
    $args['categoryName'] = strtolower($args['categoryName']);
    $category = new Category($args);
    $result = $category->save();
    if ($result === true) {
        $session->message("Category " . $category->id . " Successfully Added !");
        header("Location: category.php");
    } else {
        //Not Inserted 
        echo display_errors($category->errors);
    }
}
$category = Category::find_all();

?>


<!-- <div class="text-center">
    <img src="img/think.svg" style="max-height: 90px">
    <h4 class="pt-3">save your <b>imagination</b> here!</h4>
</div> -->

<section>
    <div class="container">

        <div class="row m-2 justify-content-center">

            <div>
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Number Of category
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $category_count . " Categories" ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Category Number End-------------->

            <div class="mx-3" onclick="showCategoryForm()">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Add A New Category
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Add Category
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-plus-circle fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <form method="post" id="addCategoryForm" class="d-none" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                <div class="form-group">
                    <label for="exampleInputPassword1">Category Name</label>
                    <input type="text" class="form-control" value="" name="category[categoryName]"
                        placeholder="*Category Name" required>
                    <button type="submit" class="btn  btn-primary">Add</button>
                </div>

            </form>
        </div>

    </div>
    <div class="row justify-content-center">

        <div class="col-10">
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
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Added On</th>
                                    <th>Products</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Added On</th>
                                    <th>Products</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($category as $cat) { ?>
                                <tr>
                                    <td class=""><?php echo $cat->id; ?></td>
                                    <td class="w-25 font-weight-bold"><?php echo strtoupper($cat->categoryName); ?></td>
                                    <td class="w-25"><?php echo $cat->addedOn; ?></td>
                                    <td class="w-25 font-weight-bold align-middle">
                                        <?php echo ProductCategory::count_product_by_cat($cat->id) . " Products"; ?>
                                    </td>

                                    <td class="w-50">
                                        <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit fw"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash fw"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function showCategoryForm() {
    var form = document.querySelector('#addCategoryForm');
    form.classList.add('d-inline-block')
}
</script>




<?php
include(SHARED_PATH . '/staff_footer.php');
?>