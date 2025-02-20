    <!-- JAVASCRIPT -->
    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>
    <script src="../assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI"></script>

    <script src="../assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- Required datatable js -->
    <script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="../assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="../assets/libs/jszip/jszip.min.js"></script>
    <script src="../assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="../assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="../assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="../assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <!-- Responsive examples -->
    <script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <!-- Datatable init js -->
    <script src="../assets/js/pages/datatables.init.js"></script>

    <?php

    if (isset($aditionals_js)) {
        echo $aditionals_js;
    }


    ?>

    <script>
        document.querySelectorAll('.telefono').forEach(input => {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, ''); // Elimina cualquier carácter que no sea número

                if (value.length > 3) {
                    value = value.slice(0, 3) + '-' + value.slice(3);
                }
                if (value.length > 8) {
                    value = value.slice(0, 8) + '-' + value.slice(8);
                }

                e.target.value = value.slice(0, 12); // Limita el input al formato 000-0000-000
            });
        });
    </script>

    <!-- App js -->
    <script src="../assets/js/app.js"></script>
    <script src="../assets/js/ajax.js"></script>