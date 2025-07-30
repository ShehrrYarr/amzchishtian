@extends('user_navbar')
@section('content')

<style>
    .report-container {
        width: 100%;
        max-width: none;
        margin: 30px auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 6px 30px #0002;
        padding: 32px;
    }

    @media (max-width: 700px) {
        .report-container {
            padding: 10px;
        }

        .responsive-table th,
        .responsive-table td {
            font-size: .97em;
        }
    }

    .filter-row {
        display: flex;
        gap: 18px;
        margin-bottom: 25px;
        align-items: flex-end;
        flex-wrap: wrap;
    }

    .filter-row label {
        font-weight: 600;
        color: #334;
    }

    .filter-row input[type=date] {
        padding: 7px 10px;
        border: 1px solid #aaa;
        border-radius: 8px;
        font-size: 1em;
    }

    .filter-row button {
        background: #0166f6;
        color: #fff;
        padding: 8px 22px;
        border: none;
        border-radius: 7px;
        font-size: 1em;
        font-weight: 600;
        transition: .18s;
    }

    .filter-row button:hover {
        background: #034fc7;
    }

    .summary-row {
        margin-bottom: 10px;
        font-size: 1.13em;
        font-weight: bold;
        color: #074b11;
        text-align: right;
    }

    .responsive-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
        background: #f9fafd;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px #0001;
    }

    .responsive-table th,
    .responsive-table td {
        padding: 10px 7px;
        text-align: center;
        border-bottom: 1px solid #eef2fa;
    }

    .responsive-table th {
        background: #f2f5ff;
        color: #1059b2;
    }

    .details-row {
        background: #f8fbff;
    }

    .sold-table {
        width: 90%;
        margin: 10px auto 10px auto;
        border-collapse: collapse;
    }

    .sold-table th,
    .sold-table td {
        border-bottom: 1px solid #eee;
        padding: 5px 7px;
        font-size: .98em;
    }

    .expand-btn {
        background: #ffb703;
        color: #1a1a1a;
        border: none;
        border-radius: 6px;
        padding: 5px 14px;
        font-size: 1em;
        font-weight: bold;
        cursor: pointer;
    }

    .expand-btn:hover {
        background: #ffa400;
    }

    @media (max-width: 700px) {
        .filter-row {
            flex-direction: column;
            gap: 8px;
        }

        .summary-row {
            text-align: left;
        }
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

           <div class="report-container">
                <h2 style="margin-bottom:22px;">Sales & Profit Report</h2>
                <div class="filter-row">
                    <div>
                        <label for="start_date">From:</label>
                        <input type="date" id="start_date">
                    </div>
                    <div>
                        <label for="end_date">To:</label>
                        <input type="date" id="end_date">
                    </div>
                    <button id="searchBtn">Search</button>
                </div>
                <div class="summary-row">
                    Profit: Rs. <span id="profitAmount">0.00</span>
                </div>
                <table class="responsive-table" id="salesTable">
                    <thead>
                        <tr>
                            <th>Sale ID</th>
                            <th>Date</th>
                            <th>Customer/Vendor</th>
                            <th>Total Amount</th>
                            <th>Show Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Filled by JS -->
                    </tbody>
                </table>
                <div id="noResults" style="display:none;text-align:center;color:#b32d2e;font-weight:500;">
                    No sales found for selected dates.
                </div>
            </div>


        </div>
    </div>
</div>

<script>
    function formatDate(dt) {
        let d = new Date(dt);
        return d.toLocaleDateString() + ' ' + d.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
    }
    
    document.getElementById('searchBtn').onclick = function() {
        let start = document.getElementById('start_date').value;
        let end = document.getElementById('end_date').value;
        if(!start || !end) {
            alert('Please select both dates!');
            return;
        }
        fetch(`/reports/sales?start=${start}&end=${end}`)
            .then(res => res.json())
            .then(data => {
                let tbody = document.querySelector('#salesTable tbody');
                tbody.innerHTML = '';
                document.getElementById('profitAmount').innerText = data.profit;
                if(data.sales.length === 0) {
                    document.getElementById('noResults').style.display = '';
                } else {
                    document.getElementById('noResults').style.display = 'none';
                }
                data.sales.forEach((sale, i) => {
                    let rowId = "saleDetails_" + i;
                    tbody.innerHTML += `
                        <tr>
                            <td>${sale.id}</td>
                            <td>${sale.sale_date_formatted}</td>
                            <td>${sale.customer_vendor}</td>
                            <td>${sale.total_amount}</td>
                            <td>
                                <button class="expand-btn" onclick="toggleDetails('${rowId}')">Show</button>
                            </td>
                        </tr>
                        <tr class="details-row" id="${rowId}" style="display:none;">
                            <td colspan="5">
                                <strong>Sold Items:</strong>
                                <table class="sold-table">
                                    <thead>
                                        <tr>
                                            <th>Accessory</th>
                                            <th>Barcode</th>
                                            <th>Qty</th>
                                            <th>Unit Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    ${sale.items.map(item =>
                                        `<tr>
                                            <td>${item.accessory}</td>
                                            <td>${item.barcode}</td>
                                            <td>${item.quantity}</td>
                                            <td>${item.price_per_unit}</td>
                                            <td>${item.subtotal}</td>
                                        </tr>`
                                    ).join('')}
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    `;
                });
            });
    }
    function toggleDetails(id) {
        let el = document.getElementById(id);
        if(el.style.display === 'none') el.style.display = '';
        else el.style.display = 'none';
    }
    </script>


@endsection