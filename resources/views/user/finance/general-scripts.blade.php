

<script src="{{ asset('../assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('../assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('../assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('../assets/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('../assets/js/theme.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- Beginning  of required script for Modal -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<!-- Beginning of required script for Modal -->

{{-- Begin show/Hide form for Activation --}}
  <script type="text/javascript">
    function planCheck(that) {
      if (that.value == "Shared") {
           document.getElementById("Shared").style.display = "block";
           document.getElementById("Dedicated").style.display = "none";
      } 
      else if (that.value == "Dedicated") {
           document.getElementById("Dedicated").style.display = "block";
           document.getElementById("Shared").style.display = "none";
      }
      else {
            document.getElementById("Shared").style.display = "none";
                document.getElementById("Dedicated").style.display = "none";
          }
    }
  </script>
          
  <script type="text/javascript">
    function QuoteCheck(that) {
      if (that.value == "Yes") {
          document.getElementById("ifQuoteYes").style.display = "block";
      } else {
          document.getElementById("ifQuoteYes").style.display = "none";
          document.getElementById("Shared").style.display = "none";
          document.getElementById("Dedicated").style.display = "none";
      }
    }
  </script>
{{-- End show/Hide form for Activation --}}
