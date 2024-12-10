<form class="form-group" action="{{ route('weekly.expenses.summary') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="summary" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="summaryLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="summaryLabel"><span style="color:blue;align:right">
                    <strong >Expense Summary<strong>
                        
                    </span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><div><strong>X</strong></div></button>
            </div>
            <div class="modal-body">
                <div class="row mt-5 ">
                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Amount Expended for the week</strong></label>
                        <input type="text" name="amount_expended" id="amount_expended"  value="₦ {{ number_format($sum)  }}"  class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                         data-type="currency">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Amount Recieved for the week: </strong></label>
                        <input type="text" name="amount_recieved" id="amount_recieved" onkeyup="calculateExpense()" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        pattern="^\₦ \d{1,3}(,\d{3})*(\.\d+)?₦ "  data-type="currency" placeholder="Amount expended?">
                    </div>

                    <div class="form-group name2 col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Surplus: </strong></label>
                        <input type="text" name="surplus" id="surplus"  onkeyup="calculateExpense()"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        pattern="^\₦ \d{1,3}(,\d{3})*(\.\d+)?₦ "  data-type="currency" placeholder="Any surplus?">
                    </div>

                    <div class="form-group name2  col-md-6">
                        <label for="exampleInputEmail1## Heading ##" class="formText" style="font-size:20px"><strong>Balance: </strong></label>
                        <input   type="text" readonly  id="balance" style="background-color:white;color:blue;" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        pattern="^\₦ \d{1,3}(,\d{3})*(\.\d+)?₦ "  data-type="currency">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="background-color:grey;" data-bs-dismiss="modal">Close</button>
                <button type="button" id="submitExpenseSummarry" class="btn btn-primary" style="background-color:purple;">Submit</button>
            </div>
            </div>
        </div>
    </div>
</form>