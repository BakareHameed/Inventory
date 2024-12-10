<script src="../assets/js/jquery-3.5.1.min.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
        <script src="../assets/vendor/wow/wow.min.js"></script>
        <script src="../assets/js/theme.js"></script>

        <script>
            function Checkroad() {
                let select = document.getElementById('service_type[]');
                let road = document.getElementById('dedicated');
                if((select.value === "fibre") || (select.value === "wireless"))
                    road.style.display='block';
                else  
                    road.style.display='none';
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>