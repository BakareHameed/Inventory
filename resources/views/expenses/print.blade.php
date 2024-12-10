<!DOCTYPE html>
<html lang="en">

<head>
    <title>OPERATIONS WEEKLY EXPENSES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/fonts/font-awesome/css/font-awesome.min.css') }}">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/css/style.css') }}">
</head>
@include('sweetalert::alert')
 
    <div class="invoice-16 invoice-content">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="invoice-inner-9" id="invoice_wrapper">
                        <div class="invoice-top">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="logo">
                                        <img src="{{ asset('assets/img/Syscodes.png') }}" style="width:40%; height:40%" height="20%" alt="App Logo">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="invoice">
                                        <h4 style="color: black">Operations Weekly Expenses<span></span></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-info">
                            <div class="row">
                                <div class="col-sm-6 mb-1">
                                    <div class="invoice-number">
                                        <h4 class="inv-title-1">Date Raised:</h4>
                                        <p class="invo-addr-1">
                                            {{Carbon\Carbon::parse($today)->format('D, M j, Y. g:i A')}}
                                        </p>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6 mb-1">
                                    <div class="invoice-number">
                                        <h4 class="inv-title-1">Total Count:</h4>
                                        <p class="invo-addr-1">
                                            {{ $count}}
                                        </p>
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                        <div class="invoice-info">
                            <div class="row">
                                <div class="col-sm-6 ">
                                    <h4 class="inv-title-1">Expenses Made (Total = {{ $count}})</h4>
                                </div>
                                {{-- <div class="col-sm-6 text-end mb-2">
                                    <h4 class="inv-title-1">{{ $item->standard }}</h4>
                                </div> --}}
                            </div>
                        </div>

                        <div style="padding-left:3%"  class="flex  items-center justify-around w-screen bg-gray-900 py-0 mb-5 " >
                            <div class="flex mt-0">
                                <div class="overflow-x-auto sm:mx-6 lg:mx-8 ">
                                    <div class="py-0 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                        <table id="expensesTable" class="shadow overflow-hidden sm:rounded-lg  text-sm text-gray-400 ml-4">
                                            <thead class="bg-gray-800 text-xs uppercase font-medium">
                                                <tr style="background-color:black;" >
                                                    <th style="padding:5px; font-size: 14px; color: white ;">S/N</th>
                                                    {{-- <th style="padding:5px; font-size: 14px; color: white ;">ID</th> --}}
                                                    {{-- <th style="padding:5px; font-size: 14px; color: white ;">T-ID</th> --}}
                                                    <th style="padding:5px; font-size: 14px; color: white ;">Type</th>
                                                    <th style="padding:5px; font-size: 14px; color: white ;">Client</th>
                                                    <th style="padding:5px; font-size: 14px; color: white ;">Description</th>
                                                    <th style="padding:5px; font-size: 14px; color: white ;">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-gray-800 text-xs  font-medium ml-2">
                                                @foreach($expenses as $expense)
                                                    <tr style="background-color: white;padding:0px">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td style="padding: 10px; color: black;display: none">{{$expense->id}}</td>
                                                        {{-- <td style="padding: 10px; font-size: 17px; color: black;">{{$expense->category_id}}</td> --}}
                                                        <td style="padding: 10px; font-size: 14px; color: black;">{{$expense->category}}</td>
                                                        @if($expense->category == "client-maintenance")
                                                            <td style="padding: 10px; font-size: 14px; color: black;">{{$expense->client_name}}</td>
                                                        @elseif($expense->category == "survey")
                                                            <td style="padding: 10px; font-size: 14px; color: black;">{{$expense->survey_clients}}</td>
                                                        @elseif($expense->category == "POP-maintenance")
                                                            <td style="padding: 10px; font-size: 14px; color: black;">{{$expense->pop}}</td>
                                                        @elseif($expense->category == "POP-survey")
                                                            <td style="padding: 10px; font-size: 14px; color: black;">{{$expense->survey_pop}}</td>
                                                        @else
                                                            <td style="padding: 10px; font-size: 14px; color: black;">{{$expense->clients}}</td>
                                                        @endif
                                                        <td style="padding: 10px; font-size: 14px; color: black;">{{$expense->description}}</td>
                                                        <td style="padding: 10px; font-size: 14px; color: black;">₦ {{ number_format($expense->amount) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                     
                                        </table>
                                        <tfoot>
                                            <div  style="padding: 10px; font-size: 17px; color: black;">
                                                <th  class="text-right">
                                                    <strong>Sum Total = </strong>
                                                    <span class="text-right">
                                                        <strong>₦ {{ number_format($sum) }}</strong>
                                                    </span>
                                                </th>
                                                {{-- <td class="text-right" id="totalcost">
                                                    
                                                </td> --}}
                                            </div>
                                        </tfoot>
                                    </div>
                                </div>
                            </div>
                            <!-- Component End  -->
                        </div>

                        <div class="invoice-info">
                            <h4 class="inv-title-1">Printed By:</h4>
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <h5 class="inv-title-1 pt-1 pb-1">{{ Auth::user()->name }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="invoice-btn-section clearfix d-print-none">
                        {{-- <span>
                            <a style="padding: 10px;margin-bottom:5px" class="btn btn-outline-info" href="#" data-bs-toggle="modal" data-bs-target="#Create">Add New</a>
                        </span> --}}
                         <a href="#" data-bs-toggle="modal" data-bs-target="#summary" class="btn btn-lg btn-download">
                            <i class="fa fa-download"></i> Expense Summary
                        </a>
                         {{-- <a href="javascript:window.print()" class="btn btn-lg btn-print">
                            <i class="fa fa-print"></i> Print Form
                        </a>
                        --}}
                        {{-- <a id="invoice_download_btn" class="btn btn-lg btn-download">
                            <i class="fa fa-download"></i> Download Invoice
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

        @include('expenses.summary')

    <!-- Beginning  of required script for print and download -->
        <script src="{{ asset('assets/invoice/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/invoice/js/jspdf.min.js') }}"></script>
        <script src="{{ asset('assets/invoice/js/html2canvas.js') }}"></script>
        <script src="{{ asset('assets/invoice/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/weekly-expense.js') }}"></script>
    <!-- Beginning  of required script for print and download -->

    <!-- Beginning  of required script for Modal -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Beginning of required script for Modal -->

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
    {{-- End of Numeric  --}}

    <script type="text/javascript">
        function calculateExpense(){
        // get html input values
          var amount_expended =  document.getElementById("amount_expended").value;
          var amount_recieved = document.getElementById("amount_recieved").value;
          var surplus = document.getElementById("surplus").value;
          total = document.getElementById("balance");
        //   convert currency to number
          a = Number(amount_expended.replace(/[^0-9.-]+/g,""));
          b = Number(amount_recieved.replace(/[^0-9.-]+/g,""));
          c = Number(surplus.replace(/[^0-9.-]+/g,""));
          if (isNaN(c)) c = 0;
          var bal=Number(b+c-a);

          total.value = "₦ " + bal;

        //   console.log(a);
          console.log(b);
        //   console.log(c);
        //   console.log(bal);

        // window.location.reload();
        }
    </script>

    {{-- Script for adding Multiple Payment Begins --}}
<script>
    $(function(e)
      {
          $('#submitExpenseSummarry').click(function(e){
            e.preventDefault();
            // Get the table element
            var amount_expended = document.getElementById('amount_expended').value;
            var amount_recieved = document.getElementById('amount_recieved').value;
            var surplus = document.getElementById('surplus').value;
            var balance = document.getElementById('balance').value;
            //   convert currency to number
                a = Number(amount_expended.replace(/[^0-9.-]+/g,""));
                b = Number(amount_recieved.replace(/[^0-9.-]+/g,""));
                c = Number(surplus.replace(/[^0-9.-]+/g,""));
                d = Number(balance.replace(/[^0-9.-]+/g,""));

            var table = document.getElementById('expensesTable');
            // Initialize an empty array to store ages
            var category_ids = [];
            // Iterate over each row in the table (excluding the header row)
            for (var i = 1; i < table.rows.length; i++) {
                // Get the age from the second column of each row
                var category_id =table.rows[i].cells[1].innerHTML;
                // Store the age in the array
                category_ids.push(category_id);
            }

            // Display the array in the console
                console.log(a);
      
            $.ajax({
            url: "{{ route('weekly.expenses.summary')}}",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: 'application/json',
            data: JSON.stringify({ 
                category_ids: category_ids,
                amount_expended: a,
                surplus: c,
                amount_recieved: b,
                balance: d,
                
             }),
             success: function(response) {
                if (response.success) {
                    // Display success message using Real Rashid Sweet Alert
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your form was submitted successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                } else {
                    // Handle other cases, if needed
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to submit expenses summarry');

            }
           

        });
         //reload the current page
        //  window.location.reload();
                    // Close modal
            $('#summary').modal('hide');

            // Remove backdrop
            $('.modal-backdrop').remove();

            window.print();

          //reload the current page
        //  window.location.reload();
          });
    });
</script>
{{-- Script for adding Multiple Payment Ends --}}
</body>

</html>