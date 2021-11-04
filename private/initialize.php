<?php
ob_start(); // turn on output buffering

// Assign file paths to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("STAFF_PATH", PROJECT_PATH . '/public/staff');
define("SHARED_PATH", PRIVATE_PATH . '/shared');
define("UPLOAD_PRODUCT_PATH", PRIVATE_PATH . '/uploads');
define("S_PRIVATE",  '/vantique/vantique/private/');
define("S_PUBLIC",  '/vantique/vantique/public/');

// Assign the root URL to a PHP constant
// * Do not need to include the domain
// * Use same document root as webserver
// * Can set a hardcoded value:
// define("WWW_ROOT", '/~kevinskoglund/chain_gang/public');
// define("WWW_ROOT", '');
// * Can dynamically find everything in URL up to "/public"
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", "/vantique/vantique/private/");

require_once('functions.php');
require_once('db_credentials.php');
require_once('db_functions.php');
require_once('validation_functions.php');
require_once('status_error_functions.php');

// Load class definitions manually
// -> Individually
require_once('classes/databaseobject.class.php');
require_once('classes/product.class.php');
require_once('classes/category.class.php');
require_once('classes/productCategory.class.php');
require_once('classes/subcategory.class.php');
require_once('classes/productSubCategory.class.php');
require_once('classes/subsubcategory.class.php');
require_once('classes/productSubSubCategory.class.php');
require_once('classes/color.class.php');
require_once('classes/productColor.class.php');
require_once('classes/productimage.class.php');
require_once('classes/productStock.class.php');
require_once('classes/admin.class.php');
require_once('classes/cart.class.php');
require_once('classes/cartTemp.class.php');
require_once('classes/user.class.php');
require_once('classes/session.class.php');
require_once('classes/sessionUser.class.php');
require_once('classes/rwanda.class.php');
require_once('classes/address.class.php');
/*
require_once('classes/bicycle.class.php');
require_once('classes/admin.class.php');
require_once('classes/session.class.php');
require_once('classes/pagination.class.php');*/

// -> All classes in directory
// foreach (glob(PRIVATE_PATH . "/classes/*.class.php") as $file) {
//     require_once($file);
// }




$db = db_connect();
DatabaseObject::set_database($db);

$cart = new CartTemp;

$session_user = new SessionUser;
$session_admin = new Session;