<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Receipt</title>
    <!-- Google Fonts: Poppins for English, Noto Nastaliq Urdu for Urdu -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Noto+Nastaliq+Urdu:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        @media print {
            @page {
                size: 80mm auto;
                margin: 0 !important;
                padding: 0 !important;
            }

            body,
            html {
                width: 80mm !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .receipt {
                width: 72mm !important;
                margin-left: 4mm !important;
                margin-right: 4mm !important;
                padding: 0 !important;
            }

            .no-print {
                display: none !important;
            }
        }

        body,
        html {
            width: 80mm;
            margin: 0 auto;
            padding: 0;
            background: #fff;
            font-family: 'Poppins', Arial, sans-serif;
        }

        .receipt {
            width: 70mm;
            margin: 0;
            font-family: 'Poppins', Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        /* Urdu font for policy section */
        .urdu {
            font-family: 'Noto Nastaliq Urdu', 'Noto Sans Arabic', serif;
            font-size: 13px;
            font-weight: bold;
            direction: rtl;
            text-align: right;
            letter-spacing: 0.2px;
            line-height: 1.65;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold !important;
        }

        .shop-logo {
            font-size: 20px;
            margin-bottom: 2px;
            letter-spacing: 1px;
        }

        .main-label {
            font-size: 14px;
        }

        .divider {
            border-top: 2px dashed #000;
            margin: 8px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            font-size: 13px;
            padding: 2px 0;
        }

        th {
            border-bottom: 1px solid #000;
        }

        td {
            color: #000;
        }

        .totals {
            font-size: 14px;
            font-weight: bold;
        }

        .total-label {
            text-align: left;
        }

        .total-value {
            text-align: right;
            width: 70px;
        }

        .policy {
            font-size: 10.5px;
            line-height: 1.5;
            margin-bottom: 6px;
            margin-top: 6px;
        }
    </style>
</head>

<body>
    <div class="receipt">
        <div class="center shop-logo bold">AMZ</div>
        <div class="center shop-logo bold">Shahzad Mobiles</div>
        <div class="center main-label">Hasilpur Branch</div>
        <div class="center" style="font-size:12px; margin-bottom: 2px;">
            <span class="bold">Ph: 0322-3190100, 0301-7662525</span>
        </div>
        <div class="divider"></div>
        <table>
            <tr>
                <td class="bold">Invoice#</td>
                <td>{{ $sale->id }}</td>
            </tr>
            <tr>
                <td class="bold">Date</td>
                <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d M Y, H:i') }}</td>
            </tr>
            <tr>
                <td class="bold">Sold By</td>
                <td>{{ $sale->user->name ?? '-' }}</td>
            </tr>
            @if($sale->vendor)
            <tr>
                <td class="bold">Vendor</td>
                <td>{{ $sale->vendor->name }}</td>
            </tr>
            <tr>
                <td class="bold">Mobile</td>
                <td>+{{ $sale->vendor->mobile_no ?? '-' }}</td>
            </tr>
            @elseif($sale->customer_name)
            <tr>
                <td class="bold">Customer</td>
                <td>{{ $sale->customer_name }}</td>
            </tr>
            <tr>
                <td class="bold">Mobile</td>
                <td>+{{ $sale->customer_mobile ?? '-' }}</td>
            </tr>
            @endif
        </table>
        <div class="divider"></div>
        <table>
            <thead>
                <tr>
                    <th style="text-align:left;">Item</th>
                    <th style="text-align:right;">Qty</th>
                    <th style="text-align:right;">Price</th>
                    <th style="text-align:right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->items as $item)
                <tr>
                    <td style="max-width:38mm;white-space:normal;word-break:break-word;" class="bold">{{
                        $item->batch->accessory->name ?? '-' }}</td>
                    <td style="text-align:right;" class="bold">{{ $item->quantity }}</td>
                    <td style="text-align:right;" class="bold">{{ number_format($item->price_per_unit,0) }}</td>
                    <td style="text-align:right;" class="bold">{{ number_format($item->subtotal,0) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="divider"></div>
        <table>
            <tr>
                <td class="totals total-label" colspan="3">TOTAL</td>
                <td class="totals total-value">Rs. {{ number_format($sale->total_amount) }}</td>
            </tr>
        </table>
        <div class="divider"></div>
        <div class="policy">
            <div class="bold center" style="font-size:11.5px; margin-bottom:2px;">Return & Exchange Policy:</div>
        </div>
        <div class="urdu">
            موبائل اسیسری موقع پہ چیک کریں •<br>
            وارنٹی والی چیز کی کمپنی ذمہ دار ہوگی •<br>
            استعمال شدہ اور کھلی ہوئی چیز کی واپسی نہیں ہوگی •<br>
        </div>
        <div class="divider"></div>
        <div class="center bold" style="font-size:13px;">
            <span style="font-size:10px;">Powered by AMZ Mobiles POS</span><br>
            Thank you for shopping!
        </div>
        <div class="no-print center" style="margin-top:10px;">
            <button onclick="window.print()" style="padding:5px 16px;font-size:13px;">Print</button>
        </div>
    </div>
</body>

</html>