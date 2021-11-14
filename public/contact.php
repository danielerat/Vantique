<?php
require_once("../private/initialize.php");

require_once(PRIVATE_PATH . "/shared/public_header.php");
?>
<!-- Contact-Page -->
<div class="page-contact u-s-p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="touch-wrapper">
                    <h1 class="contact-h1">Get In Touch With Us</h1>
                    <form id="#sendMessage" method="post">
                        <div class="group-inline u-s-m-b-30">
                            <div class="group-1 u-s-p-r-16">
                                <label for="contact-name">Your Names
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="contact-name" name="contact[names]" class="text-field"
                                    placeholder="Name" required>
                            </div>
                            <div class="group-2">
                                <label for="contact-email">Your Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="contact-email" name="contact[email]" class="text-field"
                                    placeholder="Email" required>
                            </div>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="contact-subject">Subject
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="contact-subject" name="contact[subject]" class="text-field"
                                placeholder="Subject" required>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="contact-message">Message:</label>
                            <textarea class="text-area" id="contact-message" name="contact[message]"
                                required></textarea>
                        </div>
                        <div class="">
                            <button type="submit" class="button button-outline-secondary"> Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="information-about-wrapper">
                    <h1 class="contact-h1">Information About Us</h1>
                    <p>
                        We were Born from nowhere and still we are not even real , so here we is what we are going to do
                        it , we are just going to paste some lorem ipsum text and boom , we gonna be good to go ,
                        happy to help you with the most whatever , whatever and whatever
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, tempora, voluptate.
                        Architecto aspernatur, culpa cupiditate deserunt dolore eos facere in, incidunt omnis quae quam
                        quos, similique sunt tempore vel vero.
                    </p>
                </div>
                <div class="contact-us-wrapper">
                    <h1 class="contact-h1">Contact Us</h1>
                    <div class="contact-material u-s-m-b-16">
                        <h6>Location</h6>
                        <span> KN 23 St, CST</span>
                        <span>KG 21 St, Kiyovu</span>
                    </div>
                    <div class="contact-material u-s-m-b-16">
                        <h6>Email</h6>
                        <span>support@vantique.com</span>
                    </div>
                    <div class="contact-material u-s-m-b-16">
                        <h6>Telephone</h6>
                        <span>+250783305114</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Contact-Page /- -->




<?php

require_once(PRIVATE_PATH . "/shared/public_footer.php");

if (is_post_request()) {


    $args = $_POST["contact"];
    $contact = new Contact($args);
    if ($contact->save()) {
        echo ' <script>
        swaltoast("success", "Thank you for reaching us , we will be back to you ASAP  :)");
        </script>';
    } else {
        echo '<script> swaltoast("error", "An Error occured , try again latter :(")</>';
    }
}


?>

<?php


?>