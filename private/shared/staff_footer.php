</div>
</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>copyright &copy;
                <script>
                document.write(new Date().getFullYear());
                </script> - developed by
                <b><a href="vantique" target="_blank">Vantique</a></b>
            </span>
        </div>
    </div>
</footer>
<!-- Footer -->
</div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../vendor/js/ruang-admin.min.js"></script>
<!-- Sweet Alert 2 -->
<script type="text/javascript" src="../vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

<script>
function swaltoast(type, message) {
    let Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    Toast.fire({
        icon: type,
        title: message
    })
}



$('.confirmOrderToNext').click(function() {
    var id = $(this).data('id');
    var val = $(this).data('val');
    // getting the new value of the current cart so that we can increment it

    $.ajax({
        url: '../../../private/ajax/update_order.php',
        type: 'post',
        data: {
            id: id,
            value: val
        },
        success: function(response) {


            if (response == true) {
                document.querySelector(".t-" + id).classList.add("d-none");
                swaltoast("success", "Confirmation Successfully Added");

            } else {
                swaltoast("error", "Error Confirming the product");

            }
            //     swaltoast("success", "Item Added To Your Cart List");
            //     var currentCount = parseInt($('.cartItemCounterUpdate').text());
            //     var newCount = parseInt(currentCount + 1);
            //     $('.cartItemCounterUpdate').html(newCount);
            // } else if (response === 'Auth') {
            //     swaltoast("info", "Please Login First ");
            // } else if (response === 'Exist') {
            //     swaltoast("info", "Item is Alread In Your Cart List :)");
            // } else {
            //     swaltoast("error", "Error Adding Your Product, try again later ");
            // }
        }
    });
});
</script>
</body>

</html>