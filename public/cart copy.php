<?php
require_once("../private/initialize.php");

require_once(PRIVATE_PATH . "/shared/public_header.php");

?>

<script>
function delete_cart_item(id) {
    function wait(ms) {
        var start = new Date().getTime();
        var end = start;
        while (end < start + ms) {
            end = new Date().getTime();
        }
    }

    Swal.fire({
        text: "Do you Really Want to remove it from your card ?",
        icon: 'warning',
        timer: 10000,
        toast: true,
        timerProgressBar: true,
        position: 'top-end',
        showCancelButton: true,
        confirmButtonColor: 'var(--success)',
        cancelButtonColor: 'var(--danger)',
        confirmButtonText: 'Yes !'
    }).then((result) => {
        if (result.isConfirmed) {

            let action = "../private/ajax/delete_cart_product.php";
            var parent = document.querySelector(".singleItemRow_" + id);
            // console.log("Parent is: " + parent)
            var xhr = new XMLHttpRequest();
            xhr.open('POST', action, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let result = xhr.responseText;
                    console.log('Result: ' + result);
                    let json = JSON.parse(result);
                    if (json.hasOwnProperty('errors') && json.errors.length > 0) {
                        Swal.fire(
                            'Eroor!',
                            'Please Try Again Later.',
                            'error'
                        )
                    } else {
                        parent.classList.add("animate__zoomOutLeft");


                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            toast: true,
                            title: 'Record Deleted Successfully',
                            showConfirmButton: false,
                            timer: 1000
                        }).then((result) => {
                            wait(500);

                            parent.classList.add("d-none");

                        })



                    }
                }
            };
            xhr.send("productId=" + id);
        }
    })
}
</script>

<?php
require_once(PRIVATE_PATH . "/shared/public_footer.php");

?>