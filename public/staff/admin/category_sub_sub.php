<?php
require_once('../../../private/initialize.php');
$id = $_GET['id'] ?? Null;
$parent = SubCategory::find_by_id($id);
if (empty($parent)) {
    header("Location: 404.php");
}

$page_title = "Sub - Sub - Category: " . $parent->name;

include(SHARED_PATH . '/staff_header.php');


$category_count = SubSubCategory::count_by_parent($parent->id);

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
$category = SubSubCategory::find_by_parent($id);

echo display_session_message();
?>


<!-- <div class="text-center">
    <img src="img/think.svg" style="max-height: 90px">
    <h4 class="pt-3">save your <b>imagination</b> here!</h4>
</div> -->

<section>
    <div class="container">

        <div class="row m-2 justify-content-center">
            <div class="col-12 col-sm-6 col-md-5 col-lg-4 mb-2">
                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Number Of category
                                    </div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
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
            </div>
            <div class="col-12 col-sm-6 col-md-5 col-lg-4 mb-2">

                <div class="mx-3 cursor-pointer " onclick="showCategoryForm()">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Add A New Category
                                    </div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
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
                <form method="post" id="addCategoryForm" class="d-none bg-light mt-4"
                    action="<?php echo $_SERVER["PHP_SELF"] ?>" autocomplete="off">
                    <a href="#" class="btn btn-danger btn-sm close-form-btn" onclick="showCategoryForm()">
                        <i class="fas fa-times"></i>
                    </a>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Category Name</label>
                        <input type="text" class="form-control" value="" name="category[categoryName]"
                            placeholder="*Category Name (min: 2char)" required>
                        <button type="submit" class="btn float-right mt-2 btn-primary">Add</button>
                    </div>

                </form>
            </div>
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
                    <div class="table-responsive p-1">
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
                                    <td class="w-25 font-weight-bold"><?php echo strtoupper($cat->name); ?></td>

                                    <td class="w-25"><?php echo $cat->addedOn; ?></td>
                                    <td class="w-25 font-weight-bold align-middle">
                                        <?php echo ProductSubCategory::count_product_by_cat($cat->id) . " Products"; ?>
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
    form.classList.toggle('d-block');
}
</script>




<?php
include(SHARED_PATH . '/staff_footer.php');
?>