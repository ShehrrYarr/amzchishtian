@extends('user_navbar')
@section('content')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">

            <div class="content-header row">
            </div>

            {{-- Image Banner --}}
            <div class="mb-2">
                <img src="{{ asset('images/amz.png') }}" alt="AMZ Banner" class="img-fluid shadow rounded"
                    style="width: 100%; max-height: 250px; object-fit: cover;">
            </div>

            <!-- Grouped multiple cards for statistics starts here -->
            <div class="row grouped-multiple-statistics-card">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                    <div
                                        class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                        <span class="card-icon primary d-flex justify-content-center mr-3">
                                            <a href="/accessories"> <i
                                                    class="icon p-1 fa fa-mobile customize-icon font-large-5 p-1"></i></a>
                                        </span>
                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600">{{$totalAccessoryCount}}</h3>
                                            <p class="sub-heading">Available Accessories</p>
                                        </div>
                                        <!-- <span class="inc-dec-percentage">
                                                                        <small class="success"><i class="fa fa-long-arrow-up"></i> 5.2%</small>
                                                                    </span> -->
                                    </div>
                                </div>

                                <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                    <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                        <span class="card-icon success d-flex justify-content-center mr-3">
                                            <a href="/sales/all"> <i
                                                    class="icon p-1 fa fa-mobile customize-icon font-large-5 p-1"></i></a>
                                        </span>
                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600">{{$totalSoldAccessories}}</h3>
                                            <p class="sub-heading">Sold Accessories</p>
                                        </div>
                                        <!-- <span class="inc-dec-percentage">
                                                                        <small class="success"><i class="fa fa-long-arrow-up"></i> 10.0%</small>
                                                                    </span> -->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                    <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                        <span class="card-icon success d-flex justify-content-center mr-3">
                                            <a href="/sales/pending"> <i
                                                    class="icon p-1 fa fa-cart-plus customize-icon font-large-5 p-1"></i></a>
                                        </span>
                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600">{{$totalPendingSalesCount}}</h3>
                                            <p class="sub-heading">Pending Sales</p>
                                        </div>
                                        <!-- <span class="inc-dec-percentage">
                                                                        <small class="success"><i class="fa fa-long-arrow-up"></i> 10.0%</small>
                                                                    </span> -->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                    <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                        <span class="card-icon success d-flex justify-content-center mr-3">
                                            <a href="/sales/approved"> <i
                                                    class="icon p-1 fa fa-cart-plus customize-icon font-large-5 p-1"></i></a>
                                        </span>
                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600">{{$totalApprovedSalesCount}}</h3>
                                            <p class="sub-heading">Approved Sales</p>
                                        </div>
                                        <!-- <span class="inc-dec-percentage">
                                                                        <small class="success"><i class="fa fa-long-arrow-up"></i> 10.0%</small>
                                                                    </span> -->
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row grouped-multiple-statistics-card">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">



                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
            @if($lowStockAccessories->count())
            <div
                style="margin: 24px 0; padding: 20px; background: #fff7e6; border: 1px solid #ffd580; border-radius: 12px;">
                <h4 style="color: #b32d2e; margin-bottom: 12px;">
                    <i class="fas fa-exclamation-triangle"></i> Low Stock Reminder
                </h4>
                <table class="low-stock-table" style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th>Accessory Name</th>
                            <th>Minimum Qty</th>
                            <th>Current Stock</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lowStockAccessories as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['min_qty'] }}</td>
                            <td class="low-stock-count">{{ $item['stock'] }}</td>
                            <td class="low-stock-status">Restock Needed!</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div style="margin: 24px 0; padding: 15px; background: #eafdea; border-radius: 12px; color:#267a23;">
                All accessories are above their minimum quantity.
            </div> @endif

            @php
            $userId = auth()->id();
            @endphp
            @if (in_array($userId, [1, 2]))
            <div class="row grouped-multiple-statistics-card">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                    <div
                                        class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">

                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600">Rs. {{
                                                number_format($totalAccessoryAmount) }}
                                            </h3>
                                            <p class="sub-heading">Total Accessory Cost</p>
                                        </div>
                                        <!-- <span class="inc-dec-percentage">
                                                                                        <small class="success"><i class="fa fa-long-arrow-up"></i> 5.2%</small>
                                                                                    </span> -->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                    <div
                                        class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">

                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600">
                                                Rs.{{number_format($totalSoldAmount)}}</h3>
                                            <p class="sub-heading">Total Sold Accessory</p>
                                        </div>
                                        <!-- <span class="inc-dec-percentage">
                                                                                        <small class="danger"><i class="fa fa-long-arrow-down"></i> 2.0%</small>
                                                                                    </span> -->
                                    </div>
                                </div>

                                <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                    <div
                                        class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">

                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600">
                                                Rs.{{ number_format($totalReceivable) }}</h3>
                                            <p class="sub-heading">Total Receivable</p>
                                        </div>
                                        <!-- <span class="inc-dec-percentage">
                                                                                        <small class="success"><i class="fa fa-long-arrow-up"></i> 5.2%</small>
                                                                                    </span> -->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                    <div
                                        class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">

                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600">
                                                Rs.{{ number_format($totalPendingSales) }}</h3>
                                            <p class="sub-heading">Total Pending Sales</p>
                                        </div>
                                        <!-- <span class="inc-dec-percentage">
                                                                                        <small class="success"><i class="fa fa-long-arrow-up"></i> 5.2%</small>
                                                                                    </span> -->
                                    </div>
                                </div>
                               

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row grouped-multiple-statistics-card">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                
                                

                               
                               <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                    <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                
                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600">
                                                Rs.{{ number_format($totalApprovedSales) }}</h3>
                                            <p class="sub-heading">Total Approved Sales</p>
                                        </div>
                                        <!-- <span class="inc-dec-percentage">
                                                                                                                        <small class="success"><i class="fa fa-long-arrow-up"></i> 5.2%</small>
                                                                                                                    </span> -->
                                    </div>
                                </div>
                               

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .low-stock-table th,
                .low-stock-table td {
                    text-align: center;
                    padding: 12px 10px;
                }

                .low-stock-table th {
                    background: #ffe2a7;
                    color: #a34624;
                    font-weight: bold;
                    font-size: 1.07em;
                }

                .low-stock-table td {
                    background: #fff7e6;
                    color: #2d2d2d;
                    font-size: 1.05em;
                }

                .low-stock-status {
                    color: #c51111;
                    font-weight: bold;
                }

                .low-stock-count {
                    color: #b32d2e;
                    font-weight: 600;
                }
            </style>







            @endif





        </div>
    </div>
</div>
</div>

<script>


</script>


{{-- <script>
    document.getElementById('downPayment').addEventListener('input', updateRemaining);
    document.getElementById('totalAmount').addEventListener('input', updateRemaining);
    
    function updateRemaining() {
        let total = parseFloat(document.getElementById('totalAmount').value) || 0;
        let down = parseFloat(document.getElementById('downPayment').value) || 0;
        let remaining = total - down;
        document.getElementById('remainingAmount').value = remaining >= 0 ? remaining.toFixed(2) : 0;
    }
    
    document.getElementById('generateInstallments').addEventListener('click', function() {
        let container = document.getElementById('installmentsContainer');
        container.innerHTML = '';
    
        let num = parseInt(document.getElementById('numInstallments').value);
        let percentage = parseFloat(document.getElementById('percentage').value) || 0;
        let remaining = parseFloat(document.getElementById('remainingAmount').value) || 0;
    
        if(isNaN(num) || num < 1 || remaining <= 0) {
            container.innerHTML = `<div class="alert alert-warning">Please enter all values correctly to generate installments.</div>`;
            return;
        }
    
        let rows = '';
        for (let i = 0; i < num; i++) {
            rows += `
            <div class="row installment-row mb-3" data-index="${i}">
                <div class="col-md-3">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control" name="installment_date_${i}" />
                </div>
                <div class="col-md-3">
                    <label class="form-label">Installment Amount</label>
                    <input type="number" class="form-control installment-amount" name="installment_amount_${i}" readonly />
                </div>
                <div class="col-md-3">
                    <label class="form-label">Pay Amount</label>
                    <input type="number" class="form-control pay-amount" name="pay_amount_${i}" min="0" />
                </div>
                <div class="col-md-3">
                    <label class="form-label">Remaining After Payment</label>
                    <input type="number" class="form-control remaining-after" name="remaining_after_${i}" readonly />
                </div>
            </div>
            `;
        }
        container.innerHTML = rows;
    
        recalculateInstallments();
        document.querySelectorAll('.pay-amount').forEach(input => {
            input.addEventListener('input', recalculateInstallments);
        });
    });
    
    function recalculateInstallments() {
        let num = parseInt(document.getElementById('numInstallments').value) || 0;
        let percentage = parseFloat(document.getElementById('percentage').value) || 0;
        let initialRemaining = parseFloat(document.getElementById('remainingAmount').value) || 0;
    
        let currentRemaining = initialRemaining;
        for (let i = 0; i < num; i++) {
            let interest = currentRemaining * (percentage / 100);
            let installmentAmount = currentRemaining + interest;
    
            let instAmountInput = document.querySelector(`[name="installment_amount_${i}"]`);
            if (instAmountInput) instAmountInput.value = installmentAmount.toFixed(2);
    
            let payInput = document.querySelector(`[name="pay_amount_${i}"]`);
            let pay = parseFloat(payInput && payInput.value) || 0;
    
            let remainingInput = document.querySelector(`[name="remaining_after_${i}"]`);
            let newRemaining = installmentAmount - pay;
            newRemaining = newRemaining < 0 ? 0 : newRemaining;
            if (remainingInput) remainingInput.value = newRemaining.toFixed(2);
    
            currentRemaining = newRemaining;
        }
    }
</script> --}}



@endsection