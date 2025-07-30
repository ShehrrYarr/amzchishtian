@foreach($sales as $sale)
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
            <ul style="list-style:none; margin:0; padding:0;">
                @foreach($sale->items as $item)
                <li>
                    {{ $item->batch->accessory->name ?? '-' }} x{{ $item->quantity }}
                    ({{ number_format($item->price_per_unit,2) }} each)
                </li>
                @endforeach
            </ul>
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
@endforeach