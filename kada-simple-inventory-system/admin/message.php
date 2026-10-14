<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="../assets/js/toastr.min.js"></script>
<?php
    if(isset($_SESSION['status_message'])){
?>
    <script>
         toastr.options = {
            "closeButton": true,
            "debug": true,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr['<?= $_SESSION['status_code']?>']('<?= $_SESSION['status_message']?>');
    </script>
<?php 
    unset($_SESSION['status_message']);
        }
?>