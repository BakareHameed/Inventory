
<!DOCTYPE html>
<html lang="en">
  @include('user.field_engineer.head')
<body>
  <!-- Back to top button -->
  <div class="back-to-top"></div>
  @include('user.field_engineer.header')

<div class="row">
    @include('user.field_engineer.ticket_form')
    @include('user.field_engineer.scripts')

  <script type="text/javascript">
    function yesnoCheck(that) {
      if (that.value == "Yes") {
  
          document.getElementById("ifYes").style.display = "block";
          document.getElementById("MTC_sales_Yes").style.display = "block";
          document.getElementById("Service").style.display = "block";
      } else {
          document.getElementById("ifYes").style.display = "none";
          document.getElementById("MTC_sales_Yes").style.display = "none";
          document.getElementById("Service").style.display = "none";
      }
    }
  </script>

  <script type="text/javascript">
    function QuoteCheck(that) {
      if (that.value == "Yes") {
  
          document.getElementById("ifQuoteYes").style.display = "block";
          document.getElementById("MTCYes").style.display = "block";
      } else {
          document.getElementById("ifQuoteYes").style.display = "none";
          document.getElementById("MTCYes").style.display = "none";
      }
    }
  </script>

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
</body>

</html>

