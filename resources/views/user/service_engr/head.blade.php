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
    {{-- for font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- for font-awesome --}}
    <script src="http://10.0.0.244:8081/js/app.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
    <!-- Script for Multi-level dropdown list  -->
      <script>
        $(document).ready(function(){
          $('.dropdown-submenu a.test').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
          });
        });
      </script>
  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   
      <style>
          .dropdown-submenu {
            position: relative;
            background-color:white;
            color:black;
            font-size:18.5px;
          }
          .dropdown-submenu .dropdown-menu {
            position:absolute; top:50px; right:50px;
            background-color: #f0e9e9;
            color:#f2f7c6;
            font-size:18.5px;
          }
          .dropdown-item:hover{
            color:black
          }
          .dropdown-submenu :hover{
            color:black;
          }
      </style>
        <!-- End of Styling for multi-level dropdown -->     
                <style>
        thead {color: green;}
        tbody {color: blue;}
        tfoot {color: red;}
        table, th, td {
          border: 1px solid black;
        }
      </style>
</head>