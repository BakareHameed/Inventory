<!DOCTYPE html>
<html lang="en">

<head>
    <title>JOB ORDER FORM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/fonts/font-awesome/css/font-awesome.min.css') }}">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/css/style.css') }}">
</head>
 
<body>
    <div class="invoice-16 invoice-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
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
                                        <h3 style="color: black">Job Order Form <span></span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-info">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <div class="invoice-number">
                                        <h4 class="inv-title-1">Date Raised:</h4>
                                        <p class="invo-addr-1">
                                            {{Carbon\Carbon::parse($dateRaised)->format('D, M j, Y. g:i A')}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6 mb-1">
                                    <h4 class="inv-title-1">Client's Details:</h4>
                                </div>
                                <div class="col-sm-6 text-end mb-10">
                                    <h4 class="inv-title-1">Survey ID:{{ $ID}}</h4>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="border-collapse text-left border table-auto w-full get-company" >
                                    <table class="default-table invoice-table" style="border: block 2px black">
                                        <thead>
                                        </thead>
                                        @foreach ($joborder as $item)
                                        <tbody style="padding: 0%">
                                            <tr>
                                                <td style="padding: 1%"><strong>Company</strong></td>
                                                <td style="padding: 1%">{{ $item->clients }}({{ $item->service_type }})</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 1%" ><strong>Address</strong></td>
                                                <td  style="padding: 1%">{{ $item->address }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 1%"><strong>Contact Person</strong></td>
                                                <td  style="padding: 1%">{{ $item->contact_person_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 1%"><strong>Account Manager</strong></td>
                                                <td  style="padding: 1%">{{ $item->acct_manager }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 1%"><strong>Site Engineer</strong></td>
                                                <td  style="padding: 1%">{{ $item->site_engr }}(<strong>{{$item->bank }},{{ $item->acct_no}}</strong>)</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 1%"><strong>Distance</strong></td>
                                                <td  style="padding: 1%">{{ $item->distance_from_pop }} ({{$item->base_stations}})</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 1%"><strong>Building/Height</strong></td>
                                                <td  style="padding: 1%">{{ $item->BType }}/{{ $item->building_height }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 1%"><strong>Building Floor</strong></td>
                                                <td  style="padding: 1%">{{ $item->BFloor }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 1%"><strong>Installation Point</strong></td>
                                                <td  style="padding: 1%">{{ $item->suitable_loc }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 1%"><strong>Duration</strong></td>
                                                <td style="padding: 1%">{{ $item->duration }} day(s)</td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="invoice-info">
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <h4 class="inv-title-1">Tools/Materials Needed:</h4>
                                </div>
                                <div class="col-sm-6 text-end mb-2">
                                    <h4 class="inv-title-1">{{ $item->standard }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="order-summary row col-12 col-xl-12 mt-0">
                            <div class="table-outer column" style="overflow:hidden; width:12%;float:left;" class="column">
                                @foreach ($joborder as $item)
                                    <table class="default-table invoice-table">
                                        <thead>
                                            <tr>
                                                <th style="padding: 1.5%" >S/N</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach(explode(',', $item->items) as $items) 
                                                <tr>
                                                    <td style="color:blue;padding: 1%">{{ $loop->iteration }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>
                            <div class="table-outer column"  style="overflow:hidden; width:45%;float:left;margin-left:-4%" class="column">
                                @foreach ($joborder as $item)
                                    <table class="default-table invoice-table">
                                        <thead>
                                            <tr>
                                                <th style="padding: 1.5%">Materials Needed</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach(explode(',', $item->items) as $items) 
                                                <tr>
                                                    <td style="color:black;padding: 1%">{{ $items }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>

                            <div class="table-outer column"  style="overflow:hidden; width:16%;float:left;margin-left:-4%" class="column">
                                @foreach ($joborder as $item)
                                    <table class="default-table invoice-table">
                                        <thead>
                                            <tr>
                                                <th style="padding: 1.5%">Quantity</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach(explode(',', $item->qty) as $qty) 
                                                <tr>
                                                    <td style="color:black;padding: 1%">{{ $qty }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>

                            <div class="table-outer column"  style="overflow:hidden; width:17%;float:left;margin-left:-4%" class="column">
                                @foreach ($joborder as $item)
                                    <table class="default-table invoice-table">
                                        <thead>
                                            <tr>
                                                <th style="padding: 1.5%">Amount</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach(explode(',', $item->cost) as $cost) 
                                                <tr>
                                                    <td style="color:black;padding: 1%">₦ {{ $cost }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>

                            <div class="table-outer column"  style="overflow:hidden; width:25%;float:left;margin-left:-4%" class="column">
                                @foreach ($joborder as $item)
                                    <table class="default-table invoice-table">
                                        <thead>
                                            <tr>
                                                <th style="padding: 1.5%">Store Remark</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach(explode(',', $item->store_remark) as $store_remark) 
                                                <tr>
                                                    <td style="color:black;padding: 1%"> {{ $store_remark }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>

                            <table class="default-table invoice-table" style="margin-left:2%">
                                <thead>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th  class="text-center"><strong>Total</strong></th>
                                        <td class="text-center" id="totalcost"><strong>₦ {{ number_format($sum) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="invoice-info">
                            <h4 class="inv-title-1">General Remark:</h4>
                            @foreach ($joborder as $jo)
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <h5 class="inv-title-1 pt-1 pb-1">{{$jo->reviewed_by}}</h5>
                                    <hr width="50%" style="float: left;border:none;border-top: 2px dotted black;"><br><br>
                                    <h6 class="inv-title-1" >Service Operations</h6>
                                </div>
                                <div class="col-sm-6 text-end mb-2">
                                    <h5 class="inv-title-1 pt-1 pb-1">
                                            {{$jo->raised_by}}
                                    </h5>
                                    <hr width="50%" style="float: right;border:none;border-top: 2px dotted black;"><br><br>
                                    <h6 class="inv-title-1">Service Delivery Engineer</h6>
                                </div>
                                <div class="col-sm-6 mb-2 pt-1">
                                    <h5 class="inv-title-1 pt-1 pb-1">{{$jo->first_reviewer}}</h5>
                                    <hr width="50%" style="float: left;border:none;border-top: 2px dotted black;"><br><br>
                                    <h6 class="inv-title-1" >Service Delivery</h6>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="invoice-btn-section clearfix d-print-none">
                        <a href="javascript:window.print()" class="btn btn-lg btn-print">
                            <i class="fa fa-print"></i> Print Form
                        </a>
                        {{-- <a id="invoice_download_btn" class="btn btn-lg btn-download">
                            <i class="fa fa-download"></i> Download Invoice
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/invoice/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/invoice/js/jspdf.min.js') }}"></script>
    <script src="{{ asset('assets/invoice/js/html2canvas.js') }}"></script>
    <script src="{{ asset('assets/invoice/js/app.js') }}"></script>
</body>

</html>