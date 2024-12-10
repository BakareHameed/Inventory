
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
        <title>Syscodes Network Services</title>
        <link rel="stylesheet" href="{{ asset('assets/css/maicons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/animate/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') }}">

        <script src="http://10.0.0.244:8081/js/app.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(function() {
                let commonId = ".datepicker";

                $( commonId ).datepicker({
                    dateFormat: 'yy-mm-dd',
                    minDate: 0,
                });
            });
        </script>
    </head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>
  @include('user.support.header')

 


<div >
<div class="row">
    </div>
      @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <strong>{{$message}}</strong>
      @endif
    </div>

    @include('user.support.customers.add-form')

</body>

<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script for Hidin/Unhiding Service Plan -->
    <script type="text/javascript">
        function planCheck(that) {
            if (that.value == "Shared") 
            {
            document.getElementById("Shared").style.display = "block";
            document.getElementById("Dedicated").style.display = "none";
            document.getElementById("bandwidth").style.display = "none";
            } 
            else if (that.value == "Dedicated")
            {
            document.getElementById("Dedicated").style.display = "block";
            document.getElementById("Shared").style.display = "none";
            }
            else 
            {
            document.getElementById("Shared").style.display = "none";
            document.getElementById("Dedicated").style.display = "none";
            document.getElementById("bandwidth").style.display = "none";
            }
        }
    </script>
<!-- End of Script for Hidin/Unhiding Service Plan -->

<script type="text/javascript">
    function DedicatedCheck(that) {
        if((that.value === "Fibre") || (that.value === "wireless"))
        {
            document.getElementById("bandwidth").style.display = "block";
        }
        else 
        {
            document.getElementById("bandwidth").style.display = "none";
        }
    }
</script>
