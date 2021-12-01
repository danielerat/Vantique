<?php

include("../initialize.php");
if (is_post_request()) {

    $id = (int) $_POST['id'];
    $value = (int) $_POST['value'];
    $new = (int) ++$value;
    $order = new userOrder;
    $order->updateOrderStatus($id, $new);
}