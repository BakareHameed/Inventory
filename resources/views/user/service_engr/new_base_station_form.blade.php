<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>Syscodes Network Services</title>

  <link rel="stylesheet" href="../assets/css/maicons.css">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../assets/css/theme.css">

     <script src="http://10.0.0.244:8081/js/app.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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

       
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script>
    $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".cluster_field_wrap"); //Fields wrapper
    var add_button      = $(".add_cluster_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
     
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $("#rem").remove(); 

            $(wrapper).append( '<tr id="rowMaterial'+x+'">' +
                        '<td><input id="divs" type="text" name="Base_Cluster_IP[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/></td>' +

                    '</tr>'); //add input box
        
               $(wrapper).append('<div id="divs"><input type="button" name="mycluster[]"/><a href="#" id="rm" class="remove_cluster_field">Remove field</a></div>'); //add input box
                
        }
    });

    $(wrapper).on("click",".remove_cluster_field", function(e){ //user click on remove text
        e.preventDefault(); $("#divs").remove(); x--;
        $("#divs").remove(); x--;
    
     

    })
});
</script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script>
    $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
     
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $("#rm").remove(); 

            $(wrapper).append( '<tr id="rowMaterial'+x+'">' +
                        '<td><input id="divs" type="text" name="Trunk_IP[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/></td>' +

                    '</tr>'); //add input box
        
               $(wrapper).append('<div id="divs"><input type="button" name="mytext[]"/><a href="#" id="rm" class="remove_field">Remove</a></div>'); //add input box
                
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $("#divs").remove(); x--;
        $("#divs").remove(); x--;
    
     

    })
});
</script>



</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> +00 123 4455 6666</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> syscodescomms.com</a>
            </div>
          </div>
          <div class="col-sm-4 text-right text-sm">
            <div class="social-mini-button">
              <a href="#"><span class="mai-logo-facebook-f"></span></a>
              <a href="#"><span class="mai-logo-twitter"></span></a>
              <a href="#"><span class="mai-logo-dribbble"></span></a>
              <a href="#"><span class="mai-logo-instagram"></span></a>
            </div>
          </div>
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{url('/')}}"><span class="text-primary">Syscodes</span>-Network Services</a>

        <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
            </div>
            <input type="text" class="form-control" placeholder="Enter keyword.." aria-label="Username" aria-describedby="icon-addon1">
          </div>
        </form>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{url('/')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="doctors.html">Engineers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="blog.html">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>

             
              <x-app-layout>
              </x-app-layout>
          
          </ul>


        </div> <!-- .navbar-collapse -->
      </div>
    </nav>
  </header>

  
  <div align="Center" style="padding:0px">
    <div class="col-lg-6 py-3 wow fadeInUp text-center" >
        <h1 class="text-center" style="text-align:center">Create New Base Station</h1>
    </div>
</div>


      <div align="Center" style="padding-left:30px;padding-bottom:30px">



<form class="main-form" action="{{url('base_station_creation')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mt-5 ">
          
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
          <input  type="text" name="POP_name"  class="form-control" placeholder="POP Name" required>
           </div>

           <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
           <input type="text" name="site_id"  class="form-control" placeholder="Site ID" required> 
           </div>

           

          <!-- <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="text" name="Trunk_IP" class="form-control" placeholder="Trunk IP" required>
          </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
           <input type="text" name="Base_Cluster_IP" class="form-control" placeholder="Base/Cluster IP" required> 
           </div> -->

          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
            <input type="text" name="POP_router" class="form-control" placeholder="POP router" >
          </div>
       

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="text" name="POP_switch" class="form-control" placeholder="POP switch" required>
          </div>

          <!-- <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
            <input type="text" name="service_description" class="form-control" placeholder="Service Description">
          </div> -->
       

          <div class="col-12 py-2 wow fadeInRight" data-wow-delay="300ms">
          <input type="text" name="Third_Party_Vendor" class="form-control" placeholder="Third Party Vendor">
         
         </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="text" name="Longitude" class="form-control" placeholder="Longitude"> 
          </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
          <input type="text" name="Latitude" class="form-control" placeholder="Latitude">
          </div>
         
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
          <input type="text" name="Inverter_Power" class="form-control" placeholder="Inverter Power" required>
          </div>
      
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
         <input type="text" name="Infrastructure_Type" class="form-control" placeholder="Infrastructure Type" required>
         </div>
         
         
         <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
         <input type="date" name="Activated_Date" class="form-control" placeholder="Activated Date" required>
        
        </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
         <input type="text" name="Tower_Pole_Length" class="form-control" placeholder="Tower Pole Length" required>
         </div>


         <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
    <table  class="border-collapse border table-auto w-full get-company mt-4">
       
        <thead>
            <tr>
                <th>Trunk IP</th>
               
            </tr>
        </thead>

        <tbody id="material_body">
            <tr>
                <td>
                    <input
                        type="text"
                        name="Trunk_IP[]"
                
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    />
                </td>
               
            </tr>
        </tbody>
    </table>

    <div class="input_fields_wrap" data-wow-delay="300ms">
    <button class="add_field_button" style="background-color:#8cd687" >Add Trunk IP</button>

</div>

</div>

<div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
    <table class="border-collapse border table-auto w-full get-company mt-4">
       
        <thead>
            <tr>
                <th>Base/Cluster IP</th>
               
            </tr>
        </thead>

        <tbody id="material_body">
            <tr>
                <td>
                    <input
                        type="text"
                        name="Base_Cluster_IP[]"
                
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    />
                </td>
               
            </tr>
        </tbody>
    </table>

    <div class="cluster_field_wrap" data-wow-delay="300ms">
    <button class="add_cluster_button" style="background-color:#8cd687" >Add Base/Cluster IP</button>

</div>

</div>
    <button type="submit" class="btn btn-primary btn-sm" style="background-color:#8cd687">Submit</button>

    </div>
</div>
</div>
</form>
</body>