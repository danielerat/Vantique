<?php
require_once('../../../private/initialize.php');

include(SHARED_PATH . '/staff_header.php');
$file = ["o copy 12.png"];


function delete_product_images($files)
{
    $errors = [];
    foreach ($files as $file) {
        if (file_exists(PRIVATE_PATH . "/uploads/" . $file)) {
            if (file_exists(PRIVATE_PATH . "/uploads/thumb/" . $file)) {
                if (unlink(PRIVATE_PATH . "/uploads/" . $file) && unlink(PRIVATE_PATH . "/uploads/thumb/" . $file)) {
                } else {
                    $errors[] = "Permission Denied on File " . $file;
                }
            }
        } else {
            $errors[] = "File " . $file . ' Was Not Deleted!';
        }
    }
    if (empty($errors)) {
        return true;
    }
    return $errors;
}


print_r(delete_product_images($file));

?>





<?php
include(SHARED_PATH . '/staff_footer.php');
?>