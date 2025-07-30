@extends('user_navbar')
@section('content')
    

    <style>
        .gradient-button3 {
            background: linear-gradient(to right, #74a8e0, #1779e2);
            border-color: #007bff;
            color: white;
        }
    </style>


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

                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 latest-update-tracking mt-1">
                    <div class="card">
                        <div class="card-header latest-update-heading d-flex justify-content-between">
                            <h4 class="latest-update-heading-title text-bold-500">Mobiles Sent to  <b>{{$vendor->name}}</b></h4>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration" id="mobileTable">
                                <thead>
                                    <tr>
                                        {{-- <th>ID</th> --}}
                                        <th>Added at</th>
                                        <th>Mobile Name</th>
                                        <th>Company</th>
                                        <th>Group</th>
                                        <th>Vendor</th>
                                        <th>IMEI#</th>
                                        <th>SIM Lock</th>
                                        <th>Color</th>
                                        <th>Storage</th>
                                        <th>Battery Health</th>
                                        <th>Cost Price</th>
                                        <th>Selling Price</th>
                                        <th>Mobile History</th>
                                        <th>Availability</th>
                                         <!-- #region -->
                                    </tr>
                                </thead>
                                <tbody>
    @foreach ($transactions as $key)
        <tr>
            <td>{{ \Carbon\Carbon::parse($key->transaction_date ?? $key->created_at)->format('Y-m-d / h:i') }}</td>

            <td>{{ $key->mobile->mobile_name ?? 'N/A' }}</td>
            <td>{{ $key->mobile->company->name ?? 'N/A' }}</td>
            <td>{{ $key->mobile->group->name ?? 'N/A' }}</td>

            <td>{{ optional($key->vendor)->name ?? 'N/A' }}</td>

            <td>{{ $key->mobile->imei_number ?? 'N/A' }}</td>
            <td>{{ $key->mobile->sim_lock ?? 'N/A' }}</td>
            <td>{{ $key->mobile->color ?? 'N/A' }}</td>
            <td>{{ $key->mobile->storage ?? 'N/A' }}</td>
            <td>{{ $key->mobile->battery_health ?? 'N/A' }}</td>

            <td>{{ $key->cost_price ?? 'N/A' }}</td>
            <td>{{ $key->selling_price ?? 'N/A' }}</td>

            <td>
                <a href="{{ route('showHistory', $key->mobile_id) }}" class="btn btn-sm btn-warning">
                    <i class="fa fa-eye"></i>
                </a>
            </td>

            <td>
                <span class="badge badge-success">
                    {{ $key->mobile->availability ?? 'Sold' }}
                </span>
            </td>
        </tr>
    @endforeach
</tbody>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 latest-update-tracking mt-1">
                    <div class="card">
                        <div class="card-header latest-update-heading d-flex justify-content-between">
                            <h4 class="latest-update-heading-title text-bold-500">Download The Inventory</h4>
                            <a style="font-size: 25px" href="" data-toggle="modal" data-target="#exampleModal5"><i
                                    style="color:red;" class="fa fa-download"></i></a>
                        </div>
                    </div>

                </div>

                

            </div>
        </div>
    </div>
    
@endsection