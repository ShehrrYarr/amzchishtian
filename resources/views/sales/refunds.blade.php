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
                        <h4 class="latest-update-heading-title text-bold-500">Refund Sales</h4>

                    </div>
                    <div class="table-responsive">
                        <table id="loginTable" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                   <th>Return #</th>
                                    <th>Date</th>
                                    <th>Sale #</th>
                                    <th>Returned By</th>
                                    <th>Items Returned</th>
                                    <th>Total Refund</th>
                                </tr>
                            </thead>
                         <tbody>
                                @forelse($refunds as $refund)
                                <tr>
                                    <td>{{ $refund->id }}</td>
                                    <td>{{ $refund->created_at->format('d M Y, H:i') }}</td>
                                    <td>{{ $refund->sale_id }}</td>
                                    <td>{{ $refund->user->name ?? '-' }}</td>
                                    <td>
                                        <ul class="mb-0">
                                            @foreach($refund->items as $item)
                                            <li>
                                                {{ $item->saleItem->batch->accessory->name ?? '-' }}
                                                x{{ $item->quantity }}
                                                (Refunded: Rs. {{ number_format($item->quantity * $item->price_per_unit, 2) }})
                                            </li>             @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <strong>Rs. {{ number_format($refund->items->sum(function($item) {
                                            return $item->quantity * $item->price_per_unit;
                                            }), 2) }}</strong>                       </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No refunds recorded.</td>
                                </tr>
                                @endforelse            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


@endsection