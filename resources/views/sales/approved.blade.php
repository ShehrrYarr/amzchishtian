@extends('user_navbar')
@section('content')

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



            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 latest-update-tracking mt-1 ">
                <div class="card ">
                    <div class="card-header latest-update-heading d-flex justify-content-between">
                        <h4 class="latest-update-heading-title text-bold-500">Approved Sales</h4>

                    </div>

                    <div class="ml-1">
                        <form method="GET" action="{{ route('sales.approved') }}"
                            class="mb-3 d-flex align-items-center">
                            <input type="date" class="form-control mr-2" name="start_date"
                                value="{{ request('start_date') }}" style="max-width: 180px;">
                            <span class="mx-1">to</span>
                            <input type="date" class="form-control mr-2" name="end_date"
                                value="{{ request('end_date') }}" style="max-width: 180px;">
                            <button type="submit" class="btn btn-primary mx-1">Filter</button>
                            <a href="{{ route('sales.approved') }}" class="btn btn-secondary mx-1">Reset</a>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table id="loginTable" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Sale #</th>
                                    <th>Date</th>
                                    <th>Customer/Vendor</th>
                                    <th>Mobile</th>
                                    <th>Total</th>
                                    <th>Items</th>
                                    <th>Added By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sales as $sale)
                                <tr>
                                    <td>{{ $sale->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d M Y, H:i') }}</td>
                                    <td>
                                        @if($sale->vendor)
                                        <strong>Vendor:</strong> {{ $sale->vendor->name }}
                                        @elseif($sale->customer_name)
                                        <strong>Customer:</strong> {{ $sale->customer_name }}
                                        @else
                                        Walk-in
                                        @endif
                                    </td>
                                    <td>
                                        @if($sale->vendor)
                                        {{ $sale->vendor->mobile_no }}
                                        @else
                                        {{ $sale->customer_mobile }}
                                        @endif
                                    </td>
                                    <td><strong>Rs. {{ number_format($sale->total_amount,2) }}</strong></td>
                                    <td>
                                        <ul style="margin:0; padding-left: 1rem;">
                                            @foreach($sale->items as $item)
                                            <li>
                                                {{ $item->batch->accessory->name ?? '-' }} x{{ $item->quantity }}
                                                ({{ number_format($item->price_per_unit,2) }} each)
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $sale->user->name ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">Approved</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('sales.approve', $sale->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                Approve
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">No Approved sales found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


@endsection