<form class="form-group" action="{{route('expense.update',$expense->expense_id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="EditExpense{{$expense->expense_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditExpense{{$expense->expense_id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EditExpense{{$expense->expense_id}}Label"><span style="color:blue;align:right">
                    <strong >Update Expense 
                    <span style="color: rgb(190, 107, 59)">
                        [
                            @if($expense->category == "client-maintenance" || $expense->category == "client-Maintenance")
                                {{$expense->client_name}}
                            @elseif($expense->category == "survey")
                                {{$expense->survey_clients}}
                            @elseif($expense->category == "POP-maintenance")
                                {{$expense->pop}}
                            @elseif($expense->category == "POP-survey")
                                {{$expense->survey_pop}}
                            @else
                                {{$expense->clients}}
                            @endif
                            -ID( {{$expense->category_id}})
                        ]
                    </span>
                    <strong>
                        
                    </span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
            </div>
            <div class="modal-body">
                <div class="row mt-5 ">
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Expense-ID: </strong></label>
                        <input type="text" disabled value="{{ $expense->expense_id }}" placeholder="Enter the POP name"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Type: </strong></label>
                        <input type="text" disabled value="{{  $expense->category }}" placeholder="Enter the POP name"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Amount: </strong></label>
                        <input type="text" name="amount" id="currency-field" 
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        pattern="^\₦ \d{1,3}(,\d{3})*(\.\d+)?₦ "  data-type="currency" placeholder="Enter amount...">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>short Description: </strong></label>
                        <input type="text" name="description" placeholder="Write brief(< 70 characters) description on expense purpose not"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                   
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="background-color:grey;" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" style="background-color:purple;">Submit</button>
            </div>
            </div>
        </div>
    </div>
</form>