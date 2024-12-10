<!DOCTYPE html>
<html lang="en">
  @include('user.finance.head')
  <body>
    <!-- Back to top button -->
    <div class="back-to-top"></div>
    @include('user.finance.header')
    
  @if($message = Session::get('success'))


<div class="alert alert-success">

<button type="button" class="close" data-dismiss="alert">
  x
</button>

<strong>{{$message}}</strong>

</div>

@endif

  <div class="page-section" style="background-color:#e2e3d5; font-size:20px">
    <div class="container" >
  <div style="text-align:center; " class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
  <h1 class="text-center wow fadeInUp">Enter Amount Paid</h1>
</div>

<form class="main-form" action="{{url('amount_paid',$data->id)}}" method="POST" >
    @csrf
    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
    <input disabled type="text" class="form-control" name="name" value="{{$data->clients}}"> <br> </br>
          </div>
  
    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <input type="number" name="amount_paid" id="amount_paid" class="form-control" placeholder="Total amount paid..." required>
          </div>

    <div style="padding: 15px;">
    <button type="submit" style="font-size:15px; background-color:#64d921;"  class="btn btn-primary btn-lg">Submit Amount</button>
   
</div>
</form>

        </div>
        </div>

        </body>