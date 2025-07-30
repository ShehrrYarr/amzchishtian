<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $sale->id }}</title>
    <style>
        .invoice-box {
            max-width: 650px;
            margin: 40px auto;
            background: #fff;
            padding: 40px 38px;
            border-radius: 16px;
            box-shadow: 0 8px 38px #0001;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #252525;
            position: relative;
        }
    
        .invoice-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #f78000;
            padding-bottom: 12px;
            margin-bottom: 24px;
        }
    
        .shop-logo {
            font-size: 2.2em;
            font-weight: 900;
            letter-spacing: 2px;
            color: #f78000;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
    
        .invoice-title {
            text-align: right;
            color: #333;
        }
    
        .invoice-info {
            margin-bottom: 18px;
        }
    
        .invoice-info strong {
            color: #555;
        }
    
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }
    
        .invoice-table th {
            background: #f8f4ef;
            color: #f78000;
            font-weight: 700;
            padding: 10px 7px;
            border-bottom: 2px solid #eee;
        }
    
        .invoice-table td {
            padding: 9px 7px;
            border-bottom: 1px solid #f1e5da;
            font-size: 1.05em;
        }
    
        .invoice-summary {
            text-align: right;
            font-size: 1.13em;
            margin-top: 14px;
            color: #1c2138;
        }
    
        .print-btn {
            margin-top: 26px;
            padding: 13px 44px;
            background: #f78000;
            color: #fff;
            font-size: 1.1em;
            border: none;
            border-radius: 7px;
            font-weight: 700;
            letter-spacing: 1px;
            cursor: pointer;
            transition: .2s;
        }
    
        .print-btn:hover {
            background: #db6b00;
        }
    
        @media print {
            body * {
                visibility: hidden;
            }
    
            .invoice-box,
            .invoice-box * {
                visibility: visible;
            }
    
            .print-btn {
                display: none !important;
            }
    
            .invoice-box {
                box-shadow: none;
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="invoice-header">
            <div class="shop-logo">AMZ Traders</div>
            <div class="invoice-title">
                <div style="font-size:1.25em;font-weight:600;">INVOICE</div>
                <div style="font-size:.98em;color:#aaa;">#{{ $sale->id }}</div>
            </div>
        </div>
        <div class="invoice-info">
            <div><strong>Date:</strong> {{ \Carbon\Carbon::parse($sale->sale_date)->format('d M Y, H:i') }}</div>
            <div><strong>Sold By:</strong> {{ $sale->user->name ?? '-' }}</div>
            @if($sale->vendor)
            <div><strong>Vendor:</strong> {{ $sale->vendor->name }}</div>
            <div><strong>Mobile:</strong> {{ $sale->vendor->mobile_no ?? '-' }}</div>
            @elseif($sale->customer_name)
            <div><strong>Customer:</strong> {{ $sale->customer_name }}</div>
            <div><strong>Mobile:</strong> {{ $sale->customer_mobile ?? '-' }}</div>
            @else
            <div><strong>Customer:</strong> Walk-in</div>
            <div><strong>Mobile:</strong>+{{ $sale->customer_mobile ?? '-' }}</div>
            @endif
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Accessory</th>
                    <th>Barcode</th>
                    <th style="text-align:right;">Qty</th>
                    <th style="text-align:right;">Unit Price</th>
                    <th style="text-align:right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($sale->items) && count($sale->items))
                @foreach($sale->items as $item)
                <tr>
                    <td>{{ $item->batch->accessory->name ?? '-' }}</td>
                    <td>{{ $item->batch->barcode }}</td>
                    <td style="text-align:right;">{{ $item->quantity }}</td>
                    <td style="text-align:right;">{{ number_format($item->price_per_unit,2) }}</td>
                    <td style="text-align:right;">{{ number_format($item->subtotal,2) }}</td>
                </tr>
                @endforeach
                @elseif(isset($items) && count($items))
                @foreach($items as $item)
                <tr>
                    <td>{{ $item['accessory'] }}</td>
                    <td>{{ $item['barcode'] }}</td>
                    <td style="text-align:right;">{{ $item['qty'] }}</td>
                    <td style="text-align:right;">{{ number_format($item['price'],2) }}</td>
                    <td style="text-align:right;">{{ number_format($item['qty'] * $item['price'],2) }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" style="text-align:center;">No items</td>
                </tr>
                @endif
            </tbody>
        </table>
        <div class="invoice-summary">
            <strong>Total: Rs. {{ number_format($sale->total_amount,2) }}</strong>
        </div>
        <div class="footer">
            Thank you for shopping with <strong>AMZ Traders</strong>!
        </div>
    </div>
</body>

</html>