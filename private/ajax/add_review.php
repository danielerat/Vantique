<?php

include("../initialize.php");
if (is_post_request()) {

    $review = new ProductReview($_POST["Review"]);
    if ($review->save()) {
        echo true;
    } else {
        echo false;
    }
}