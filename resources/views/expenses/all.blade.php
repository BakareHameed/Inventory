<!DOCTYPE html>
<html lang="en">
    @include('user.service_engr.head')
     <!-- Css for autonumbering the dynamically added row in modal -->
     <style>
        #tb2 {
            counter-reset: rowNumber-1;
        }
        #tb2 tr {
            counter-increment: rowNumber;
        }

        #tb2 tr td:first-child::before {
            content: counter(rowNumber);
        }
    </style>
    <!-- End of auto numbering css -->
    <body>
        <!-- Back to top button -->
        <div class="back-to-top"></div>
        @include('user.service_engr.header')

        <div align="center" style="padding:0px">
            <div class="col-md-3 py-3 wow fadeInUp text-center" >
                <h1 class="text-center" style="text-align:center;font-size:2rem">
                  All Weekly Expenses
                </h1>
            </div>
        </div>

        <div align="center"  >
            @if(Session::has('message'))
                <div class="alert alert-success" role="alert"><strong>Success:</strong>{{Session::get('message')}}</div>
            @endif
        </div>

        <div class="container pb-0" style="margin-left:5vw">
            <div class="row">
                <div class="col-md-2 mb-1">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-left">
                                <div class="">
                                    <div class="text-lg text-center font-weight-bold text-info text-uppercase mb-1"> Total</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$count}} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-1">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-left">
                                <div class="">
                                    <div class="text-lg text-center font-weight-bold text-info text-uppercase mb-1"> Page Count</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$PageCount}} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div  class="flex  items-center justify-center w-screen bg-gray-900 py-0 mb-5" >
                <div class="flex mt-0">
                    <div class="overflow-x-auto sm:mx-6 lg:mx-8">
                        <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="">
                                <table  class="shadow overflow-hidden sm:rounded-lg  text-sm text-gray-400">
                                    <div align="right">    
                                        <span>
                                            <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-info" href="#" data-bs-toggle="modal" data-bs-target="#Create">Add New</a>
                                        </span>
                                        <span>
                                            <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-danger" href="{{route('all.POP.tickets')}}" >POP Tickets</a>
                                        </span>
                                        <span>
                                            <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-primary" href="{{ route('POP.surveys.all')}}" >Surveys</a>
                                        </span>
                                        <span>
                                            <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-warning" href="{{ route('all.weekly.expenses.print')}}" >Print</a>
                                        </span>
                                    </div>
                                    <thead class="bg-gray-800 text-xs uppercase font-medium">
                                        <tr style="background-color:black;" >
                                            <th style="padding:10px; font-size: 20px; color: white ;">S/N</th>
                                            {{-- <th style="padding:10px; font-size: 20px; color: white ;">ID</th> --}}
                                            {{-- <th style="padding:10px; font-size: 20px; color: white ;">T-ID</th> --}}
                                            <th style="padding:10px; font-size: 20px; color: white ;">Type</th>
                                            <th style="padding:10px; font-size: 20px; color: white ;">Client</th>
                                            <th style="padding:10px; font-size: 20px; color: white ;">Description</th>
                                            <th style="padding:10px; font-size: 20px; color: white ;">Status</th>
                                            <th style="padding:10px; font-size: 20px; color: white ;">Amount</th>
                                            <th style="padding:10px; font-size: 20px; color: white ;">Recorded By</th>
                                            <th style="padding:10px; font-size: 20px; color: white ;">Edit</th>
                                            <th style="padding:10px; font-size: 20px; color: white ;">Delete</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $i = ($expenses->currentPage() - 1) * $expenses->perPage();
                                    @endphp
                                    <tbody class="bg-gray-800 text-xs  font-medium">
                                        @foreach($expenses as $expense)
                                            <tr style="background-color: white;padding:0px">
                                                <td>{{++$i}}</td>
                                                {{-- <td style="padding: 10px; color: black;">{{$expense->id}}</td> --}}
                                                {{-- <td style="padding: 10px; font-size: 17px; color: black;">{{$expense->category_id}}</td> --}}
                                                <td style="padding: 10px; font-size: 17px; color: black;">{{$expense->category}}</td>
                                                @if($expense->category == "client-maintenance" || $expense->category == "client-Maintenance")
                                                    <td style="padding: 10px; font-size: 17px; color: black;">{{$expense->client_name}}</td>
                                                @elseif($expense->category == "survey")
                                                    <td style="padding: 10px; font-size: 17px; color: black;">{{$expense->survey_clients}}</td>
                                                @elseif($expense->category == "POP-maintenance")
                                                    <td style="padding: 10px; font-size: 17px; color: black;">{{$expense->pop}}</td>
                                                @elseif($expense->category == "POP-survey")
                                                    <td style="padding: 10px; font-size: 17px; color: black;">{{$expense->survey_pop}}</td>
                                                @else
                                                    <td style="padding: 10px; font-size: 17px; color: black;">{{$expense->clients}}</td>
                                                @endif
                                                <td style="padding: 10px; font-size: 17px; color: black;">{{$expense->description}}</td>
                                                <td style="padding: 10px; font-size: 17px; color: black;">{{$expense->status}}</td>
                                                <td style="padding: 10px; font-size: 17px; color: black;">₦ {{ number_format($expense->amount) }}</td>
                                                <td style="padding: 10px; font-size: 17px; color: black;">{{$expense->recorded_by}}</td>
                                                <td> 
                                                    <span>
                                                        <a style="padding: 10px; font-size: 17px;" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#EditExpense{{$expense->expense_id}}">Edit</a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <form method="POST" enctype="multipart/form-data" action="{{ route('delete.weekly.expenses',$expense->expense_id) }}">
                                                        @csrf
                                                        <input name="_method"  type="hidden" value="DELETE">
                                                        <a style="padding:10px; color: black;" class="btn btn-xs btn-danger btn-flat show_confirm">
                                                            Delete
                                                        </a>
                                                    </form> 
                                                </td> 
                                                 
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="pt-2 pb-5">
                            {{ $expenses->links('user.customPagination') }}
                        </div>
                    </div>
                </div>
                <!-- Component End  -->
            </div>
            @foreach($expenses as $expense)
                @include('expenses.edit')
            @endforeach
    </body>
    <!-- Beginning  of required script for Modal -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Beginning of required script for Modal -->

    <!-- Script for laravel sweet alert when deleting record -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
        <script type="text/javascript">
            $('.show_confirm').click(function(event) {
                var form =  $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                    title: `Are you sure you want to delete this handover record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                    form.submit();
                    }
                });
            });
        
        </script>
    <!-- Script for laravel sweet alert when deleting record -->

    {{-- Beginning of Numeric  --}}
    <script>
           // Jquery Dependency
        $("input[data-type='currency']").on({
            keyup: function() {
            formatCurrency($(this));
            },
            blur: function() { 
            formatCurrency($(this), "blur");
            }
        });

        function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }

        function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.
        
        // get input value
        var input_val = input.val();
        
        // don't validate empty input
        if (input_val === "") { return; }
        
        // original length
        var original_len = input_val.length;

        // initial caret position 
        var caret_pos = input.prop("selectionStart");
            
        // check for decimal
        if (input_val.indexOf(".") >= 0) {

            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);
            
            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
            right_side += "00";
            }
            
            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by .
            input_val = "₦  " + left_side + "." + right_side;

        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = "₦  " + input_val;
            
            // final formatting
            if (blur === "blur") {
            input_val += ".00";
            }
        }
        
        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
        }
    </script>
    


</html>


