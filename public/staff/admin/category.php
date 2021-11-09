<?php
require_once('../../../private/initialize.php');

$page_title = "Main Categories";

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
                                    <th>Sub Category</th>
                                    <th>Added On</th>
                                    <th>Products</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Sub Category</th>
                                    <th>Added On</th>
                                    <th>Products</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($category as $cat) { ?>
                                <tr>
                                    <td class=""><?php echo $cat->id; ?></td>
                                    <td class="w-25 font-weight-bold"><a
                                            href="category_sub.php?id=<?php echo $cat->id; ?>"><?php echo strtoupper($cat->categoryName); ?></a>
                                    </td>
                                    <td class="w-25">
                                        <?php echo SubCategory::count_by_parent($cat->id) . " Sub Categories"; ?>
                                    </td>
                                    <td class="w-25"><?php echo $cat->addedOn; ?></td>
                                    <td class="w-25 font-weight-bold align-middle">
                                        <?php echo ProductCategory::count_product_by_cat($cat->id) . " Products"; ?>
                                    </td>

                                    <td class="">
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