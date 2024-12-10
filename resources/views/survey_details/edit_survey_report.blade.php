
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="caW87pXPzkbECSwQ6QvjyarsID0Nzuf4R8kShzmI">

        <title>Syscodes ERP</title>
        <link rel="shortcut icon" type="image/x-icon" href="http://10.0.0.244:8081/images/favicon.ico">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="http://10.0.0.244:8081/css/app.css">

       
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
     <script src="http://10.0.0.244:8081/js/app.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
 window.onload = function() {
    document.getElementById('ifYes').style.display = 'none';
    document.getElementById('ifNo').style.display = 'none';
}
function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
        document.getElementById('ifNo').style.display = 'none';
   
    } 
    else if(document.getElementById('noCheck').checked) {
        document.getElementById('ifNo').style.display = 'block';
        document.getElementById('ifYes').style.display = 'none';
        ifyes.required=false;

   }
}

</script>




<script type="text/javascript">
            $(document).ready(function() {
                $('input[type="checkbox"]').click(function() {
                    var inputValue = $(this).attr("value");
                    $("." + inputValue).toggle();
                    // alert("Checkbox " + inputValue + " is selected");
                });
            });
        </script>


<style>
            [v-cloak] {display: none; }
        </style>

        <!-- Scripts -->
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
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
     
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $("#rm").remove(); 

            $(wrapper).append( '<tr id="rowMaterial'+x+'">' +
                        '<td><input id="divs" type="text" name="material[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/></td>' +
                        '<td><input id="divs" type="text" name="quantity[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/></td>' +
                        '<td><input id="divs" type="text" name="amount[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/></td>' +
                        '<td><input id="divs" type="text" name="remark[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/></td>' +
                        // '<td><i id="'+x+'" class="fas fa-times cursor-pointer removeMaterial"></i></td>' +
                    '</tr>'); //add input box
        
               $(wrapper).append('<div id="divs"><input type="button" name="mytext[]"/><a href="#" id="rm" class="remove_field">Remove</a></div>'); //add input box
                
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $("#divs").remove(); x--;
        $("#divs").remove(); x--;
        $("#divs").remove(); x--;
        $("#divs").remove(); x--;
        $("#divs").remove(); x--;
     

    })
});
</script>


</head>



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Survey Report
        </h2>
    </x-slot>
    <form class="main-form" action="{{url('edit_survey_report_form')}}" method="POST" >

    @csrf

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
     <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

     <center>
    
                                <input type="hidden" name="id" value="{{$data->id}}"> <br> </br>

                <span class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
    <input disabled type="text" name="name" value="{{$data->clients}}"> 
</span>

    <span class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
    <input disabled type="text" name="address" value="{{$data->address}}"> <br> </br>
</span>
                <div class="col-12 col-sm-6 py-2 wow " data-wow-delay="300ms" style="padding: 10px; color: black;">
                            <select name="engr_name" id="engr_name"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" required  >
                                    <option selected value="" >--select Assigned Engineer---</option>
                                @foreach($users as $user)
                                    <option value="{{$user->name}}" name="engr_name" id="engr_name" >{{$user->name}}</option>
                                @endforeach
                           </select>
                           </center>
             <div id="app">
  
                    <div class="py-12">
       
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 form-group">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                    
                <div class="pt-6 form-group">
                        <label class="inline-flex items-center pr-24">
                            <input
                            type="radio"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50"
                            onclick="javascript:yesnoCheck();" 
                            id="yesCheck"
                            name="feasibility[]"
                            value="Feasible"
                           
                            />
                            <span class="ml-2">It's feasible</span>
                        </label>

                        <label class="inline-flex items-center">
                            <input
                            type="radio"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50"
                            onclick="javascript:yesnoCheck();" 
                            id="noCheck"
                            name="feasibility[]"
                            value="Not feasible"

                          
                            />
                            <span class="ml-2">Not Feasible</span>
                        </label>
                    </div>

                
                    <div id="ifYes" style="display:none" class="form-group">
                        <div class="mt-8 mx-auto max-w-4xl">
                          

            <div class="form-group" >
                      
    <span class="text-gray-700 font-semibold">Geo Coordinates</span>
    <div class="grid grid-cols-2 gap-8">
        <input
        type="text" 
        name="latitude"
        value="{{ old('latitude', $data->latitude) }}" 
        placeholder="Latitude"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        />
        <input
        type="text"
        name="longitude"
        value="{{ old('longitude', $data->longitude) }}" 
        placeholder="Longitude"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        />
    </div>


<div class="grid grid-cols-2 gap-8 mt-4">
    <input
        type="text"
        name="building_height"
        value="{{ old('building_height', $data->building_height) }}" 
        placeholder="Main Building Height"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    />
    <input
        type="text"
        name="distance_from_pop"
        value="{{ old('distance_from_pop', $data->distance_from_pop) }}" 
        placeholder="Distance from Pop"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    />
</div>


<div class="my-6">
    <table class="border-collapse border table-auto w-full get-company mt-4">
        <span class="text-gray-700 font-semibold">Materials Required</span>
        <thead>
            <tr>
                <th>Materials</th>
                <th>Qty</th>
                <th>Amount(₦)</th>
                <th>Store Remark</th>
                <th>
                    <i id="addNewMaterial" class="fas fa-plus cursor-pointer"></i>
                </th>
            </tr>
        </thead>

        <tbody id="material_body">
            <tr>
                <td>
                    <input
                        type="text"
                        name="material[]"
                
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    />
                </td>
                <td>
                    <input
                        type="text"
                        name="quantity[]"
                      
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    />
                </td>

                <td>
                    <input
                        type="text"
                        name="amount[]"
                     
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    />
                </td>

                <td>
                    <input
                        type="text"
                        name="remark[]"
                        
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    />
                </td>
                <td>
                    
                </td>
            </tr>
        </tbody>
    </table>

    <div class="input_fields_wrap">
    <button class="add_field_button" style="background-color:#8cd687" >Add More Materials</button>

</div>

</div>

<div class="grid grid-cols-2 gap-8 mt-4">
    <label class="block">
        <span class="text-gray-700">Closest Base Stations</span>
        <select
        name="base_stations[]"
   
        class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        multiple
        >
            <option value="">--- Select Base station ---</option>
            @foreach($pop_name as $pops)
                <option value="{{$pops->POP_name}}" name="pop" id="pop">{{$pops->POP_name}}</option>
            @endforeach
        </select>
    </label>


         </div>      

                <div>             
                        <label class="block">
            <span class="text-gray-700">Additional Info</span>
            <textarea
                name="additional_info"
                value="{{ old('additional_info', $data->additional_info) }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                rows="4"
            >{{ $defaultValue ?? '' }}</textarea>
        </label>
            </div>


                    </div>
                    </div>                    
                    </div>


                    
                      
                    <div id="ifNo" style="display:none" class="form-group">
                        <div class="mt-8 mx-auto max-w-4xl">


        <div class="form-group" >
                <!-- <div v-show="notFeasibleChecked"> -->
                     <div>             
                <label class="block">
    <span class="text-gray-700">Additional Info</span>
    <textarea
        name="reason"
        value="{{ old('reason', $data->reason) }}" 

        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        rows="4"
    >{{ $defaultValue ?? '' }}</textarea>
</label>
    </div>
    
                               
              </div>
               </div>
              </div>

    </main>
                <!-- </div> -->

</div>




<div class="py-12">
<div class="pt-8">
    <button class="py-2 px-8 rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none" type="submit"><span class="text-">Submit</span></button>
</div>

        </div>

        </form>

</x-app-layout>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

@push('scripts')
    <script>
        $(document).ready(function(){
            var j=1;
            $("#addNewMaterial").click(function(){
                j++;
                $("#material_body").append(
                    '<tr id="rowMaterial'+j+'">' +
                        '<td><input type="text" name="material[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/></td>' +
                        '<td><input type="text" name="quantity[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/></td>' +
                        '<td><i id="'+j+'" class="fas fa-times cursor-pointer removeMaterial"></i></td>' +
                    '</tr>'
                );
            });

            $(document).on('click', '.removeMaterial', function(){
                var button_coverage = $(this).attr("id");
                $('#rowMaterial'+button_coverage+'').remove();
            });
        });
    </script>


@endpush


