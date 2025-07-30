@extends('user_navbar')
@section('content')

<!-- Modal for Sale Items and Return Form -->
<div class="modal fade"  id="saleItemsModal" tabindex="-1" aria-labelledby="saleItemsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="" id="return-items-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="saleItemsModalLabel">Sale Items</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="saleItemsModalBody">
                    <!-- Sale items and return fields will be loaded here -->
                    <div class="text-center"><i class="fa fa-spinner fa-spin"></i> Loading...</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit Return</button>
                   <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                        <i class="feather icon-x"></i> Close
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>  

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            @if (session('success'))
            <div class="alert alert-success" id="successMessage">
                {{ session('success') }}
            </div>
            @endif

            @if (session('danger'))
            <div class="alert alert-danger" id="dangerMessage" style="color: red;">
                {{ session('danger') }}
            </div>
            @endif

            <div class="row mb-2">
                <div class="col-md-3">
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary" id="filterBtn" type="button">Filter</button>
                    <button class="btn btn-secondary" id="resetBtn" type="button">Reset</button>
                </div>
            </div>



            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 latest-update-tracking mt-1 ">
                <div class="card ">
                    <div class="card-header latest-update-heading d-flex justify-content-between">
                        <h4 class="latest-update-heading-title text-bold-500">All Sales</h4>

                    </div>
                    <div class="table-responsive">
                        <table id="loginTable" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                   <th>Sale #</th>
                                    <th>Date</th>
                                    <th>Customer/Vendor</th>
                                    <th>Total</th>
                                    <th>Items</th> 
                                        <th>Status</th>
                                </tr>
                            </thead>
                           <tbody id="sales-table-body">
                            @include('sales.partials.table', ['sales' => $sales])
                                {{-- @foreach($sales as $sale)
                                <tr>
                                    <td>{{ $sale->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d M Y, H:i') }}</td>
                                    <td>
                                        @if($sale->vendor)
                                        Vendor: {{ $sale->vendor->name }}
                                        @elseif($sale->customer_name)
                                        Customer: {{ $sale->customer_name }}
                                        @else
                                        Walk-in
                                        @endif
                                    </td>
                                    <td><strong>Rs. {{ number_format($sale->total_amount,2) }}</strong></td>
                                    <td>
                                        <a href="javascript:void(0)" class="sale-items-link" data-sale="{{ $sale->id }}">
                                            @foreach($sale->items as $item)
                                            <li>
                                                {{ $item->batch->accessory->name ?? '-' }} x{{ $item->quantity }}
                                                ({{ number_format($item->price_per_unit,2) }} each)
                                            </li>
                                            @endforeach
                                        </a>
                                    </td>
                                    <td>
                                        @if($sale->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                        @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach       --}}
                                      </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
    $('#filterBtn').on('click', function() {
    var start = $('#start_date').val();
    var end = $('#end_date').val();
    
    $.ajax({
    url: '{{ route("sales.all") }}',
    type: 'GET',
    data: {start_date: start, end_date: end},
    success: function(data) {
    // Extract only the table body from the response
    var html = $('<div>').html(data);
        var newTbody = html.find('#sales-table-body').html();
        $('#sales-table-body').html(newTbody ? newTbody : data); // fallback
        }
        });
        });
    
        $('#resetBtn').on('click', function() {
        $('#start_date').val('');
        $('#end_date').val('');
    
        $.ajax({
        url: '{{ route("sales.all") }}',
        type: 'GET',
        success: function(data) {
        var html = $('<div>').html(data);
            var newTbody = html.find('#sales-table-body').html();
            $('#sales-table-body').html(newTbody ? newTbody : data);
            }
            });
            });
            });
    // document.addEventListener('DOMContentLoaded', function() {
    //     // When the "View Items" link is clicked
    //     document.querySelectorAll('.sale-items-link').forEach(function(link) {
    //         link.addEventListener('click', function() {
    //             let saleId = this.getAttribute('data-sale');
    //             // Show modal and loading state
    //             let modal = new bootstrap.Modal(document.getElementById('saleItemsModal'));
    //             document.getElementById('saleItemsModalBody').innerHTML = '<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Loading...</div>';
    //             modal.show();
    
    //             // Fetch sale items via AJAX
    //             fetch('/sales/' + saleId + '/items')
    //                 .then(res => res.json())
    //                 .then(data => {
    //                     if (data.success) {
    //                         // Build HTML for sale items and input fields for returns
    //                         let html = '<table  class="table"><thead><tr><th>Item</th><th>Qty Sold</th><th>Return Qty</th></tr></thead><tbody>';
    //                         data.items.forEach(function(item) {
    //                             html += `<tr>
    //                                 <td>${item.accessory}</td>
    //                                 <td>${item.quantity}</td>
    //                                 <td>
    //                                     <input type="number" min="0" max="${item.quantity}" class="form-control return-qty" name="return_qty[${item.id}]" value="0">
    //                                 </td>
    //                             </tr>`;
    //                         });
    //                         html += '</tbody></table>';
    //                         html += `<input type="hidden" name="sale_id" value="${saleId}">`;
    //                         document.getElementById('saleItemsModalBody').innerHTML = html;
    //                     } else {
    //                         document.getElementById('saleItemsModalBody').innerHTML = '<div class="text-danger">Could not load items.</div>';
    //                     }
    //                 });
    //         });
    //     });
    
    //     // Handle return form submit (will be implemented in next step)
    //     document.getElementById('return-items-form').addEventListener('submit', function(e) {
    //         e.preventDefault();
    //         // We'll fill this part in the next step
    //     });
    // });

    document.addEventListener('DOMContentLoaded', function() {
    // Open modal and load sale items
    document.querySelectorAll('.sale-items-link').forEach(function(link) {
        link.addEventListener('click', function() {
            let saleId = this.getAttribute('data-sale');
            // Set form action dynamically
            document.getElementById('return-items-form').action = '/sales/' + saleId + '/return';

            // Show modal and loading state
            let modal = new bootstrap.Modal(document.getElementById('saleItemsModal'));
            document.getElementById('saleItemsModalBody').innerHTML = '<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Loading...</div>';
            modal.show();

            // Fetch sale items via AJAX
            fetch('/sales/' + saleId + '/items')
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        let html = '<table class="table"><thead><tr><th>Item</th><th>Qty Sold</th><th>Return Qty</th></tr></thead><tbody>';
                        data.items.forEach(function(item) {
                            html += `<tr>
                                <td>${item.accessory}</td>
                                <td>${item.quantity}</td>
                                <td>
                                    <input type="number" min="0" max="${item.quantity}" class="form-control return-qty" name="return_qty[${item.id}]" value="0">
                                </td>
                            </tr>`;
                        });
                        html += '</tbody></table>';
                        html += `<input type="hidden" name="sale_id" value="${saleId}">`;
                        document.getElementById('saleItemsModalBody').innerHTML = html;
                    } else {
                        document.getElementById('saleItemsModalBody').innerHTML = '<div class="text-danger">Could not load items.</div>';
                    }
                });
        });
    });

    // Handle return form submit (AJAX)
    document.getElementById('return-items-form').addEventListener('submit', function(e) {
        e.preventDefault();
        let form = e.target;
        let actionUrl = form.action;

        // Prepare FormData (so it works with @csrf and arrays)
        let formData = new FormData(form);

        // Optionally, disable button to prevent double-submits
        let submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerText = "Processing...";

        fetch(actionUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            submitBtn.disabled = false;
            submitBtn.innerText = "Submit Return";
            if (data.success) {
                // Optionally show a toast/alert
                alert("Return processed successfully!");
                // Close modal
                let modalEl = document.getElementById('saleItemsModal');
                let modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();
                // Optionally reload sales list
                location.reload();
            } else {
                alert(data.message || "Could not process return.");
            }
        })
        .catch(err => {
            submitBtn.disabled = false;
            submitBtn.innerText = "Submit Return";
            alert("Server error. Try again.");
        });
    });
});

    </script>


@endsection