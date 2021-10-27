<?php
require_once('../../private/initialize.php');

// Log out the admin
$session_admin->logout();

redirect_to('index.php');