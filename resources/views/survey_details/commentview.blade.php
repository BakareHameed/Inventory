<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

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

    <base href="/public">


    <style type="text/css">
      
      label
      {

          display: inline-block;

          width: 200px;
      }

    </style>
    
    @include('admin.css')

    @include('admin.script')


  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      
      
      @include('survey_details.sidebar')

      <!-- partial -->
    
      @include('survey_details.navbar')
 






 	<div class="container" align="text-center" style="padding-top: 100px;">


      @if($message = Session::get('success'))


    <div class="alert alert-success">

      <button type="button" class="close" data-dismiss="alert">
        x
      </button>

    <strong>{{$message}}</strong>

  </div>

  @endif

 		<form action="{{url('comment',$data->id)}}" method="post"> 


      {{  csrf_field () }}
 

 			<div style="padding: 15px;">

 				<label></label>
 				<input type="text" style="color:black" name="greeting" value='Dear {{$marketer}},' class="form-control"  required="">
 			</div>

 			<div style="padding: 15px;">

 				<label>Body</label>
 				<input type="text" style="color:black; background-color:#f2d3ef" name="body" class="form-control"   required="">
 			</div>

 		
    
<!--                 
      <div style="padding: 15px; ">  
      <label class="form-control"   style="color:white" >Marketer's Email</label>     
             <select name="marketer_email" id="marketer_email">
                <option>--send to---</option>
                @foreach($users as $user)
                <option value="{{$user->email}}">{{$user->email }}</option>
                @endforeach
                </select>
                 
     </div> -->


        <div style="padding: 15px;">

        <label>End Part</label>
        <input type="text" class="form-control"   style="color:black" value="Regards. "name="endpart"  required="">
      </div>




      <div style="padding: 15px;">

        
        <input type="submit" class="btn btn-success">
      </div>



 				</select> 

 		</form>
 		


 	</div>

       
    <!-- container-scroller -->
    <!-- plugins:js -->

     
 
    <!-- End custom js for this page -->
  </body>
</html>