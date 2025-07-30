@extends('user_navbar')
@section('content')

<style>
    .pos-container {
        width: 100%;
        max-width: none;
        margin: 30px auto;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 18px #0002;
        padding: 0;
        overflow: hidden;
    }

    @media (max-width: 900px) {
        .pos-main {
            flex-direction: column;
        }

        .pos-cart {
            min-width: 100%;
            border-left: none;
            border-top: 2px solid #eee;
        }
    }

    .pos-main {
        display: flex;
        gap: 0;
    }

    .pos-form,
    .pos-cart {
        padding: 32px 24px;
        min-width: 350px;
        flex: 1;
    }

    .pos-cart {
        border-left: 2px solid #eee;
        background: #f7f7fb;
    }

    .input-row {
        display: flex;
        gap: 12px;
        margin-bottom: 16px;
    }

    .input-row label {
        min-width: 100px;
        font-weight: bold;
    }

    .input-row input,
    .input-row select {
        flex: 1;
        border: 1px solid #ddd;
        border-radius: 7px;
        padding: 8px 10px;
    }

    .scan-section {
        margin-bottom: 24px;
    }

    .sale-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 12px;
    }

    .sale-table th,
    .sale-table td {
        padding: 7px 8px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }

    .sale-table th {
        background: #f2f2f7;
    }

    .cart-summary {
        font-size: 1.1em;
        margin: 20px 0 10px 0;
        text-align: right;
    }

    .pos-btn,
    .btn-scan {
        display: inline-block;
        background: #0066f7;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 9px 18px;
        margin: 3px 0;
        font-size: 1em;
        font-weight: 600;
        cursor: pointer;
        transition: .2s;
    }

    .btn-scan {
        background: #f78000;
        margin-left: 6px;
    }

    .pos-btn:hover,
    .btn-scan:hover {
        filter: brightness(.95);
    }

    .input-row {
        display: flex;
        gap: 12px;
        margin-bottom: 16px;
    }

    .input-row label {
        min-width: 150px;
        font-weight: bold;
        color: #333;
    }

    .input-row input {
        flex: 1;
        border: 1px solid #ddd;
        border-radius: 7px;
        padding: 8px 10px;
        font-size: 1em;
    }

    .input-row input:focus {
        border-color: #0066f7;
        /* Blue border on focus */
        outline: none;
    }

    .input-row input[type="number"] {
        -moz-appearance: textfield;
        /* Remove number input spin buttons */
        appearance: textfield;
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






            <div class="pos-container">
                <div style="padding:24px 32px 8px 32px; border-bottom:2px solid #f0f0f0;">
                    <h2 style="margin:0;font-weight:700;color:#111;">Point of Sale</h2>
                </div>
                <div class="pos-main">

                    <!-- Left: Sale & Scan Form -->
                    <div class="pos-form">

                        <form method="POST" action="{{ route('sales.store') }}">
                            @csrf
                            <div class="input-row">
                                <label for="vendor_id">Vendor (optional):</label>
                                <select name="vendor_id" id="vendor_id">
                                    <option value="">Walk-in Customer</option>
                                    @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-row">
                                <label for="customer_name">Customer Name:</label>
                                <input type="text" name="customer_name" id="customer_name"
                                    placeholder="Walk-in (leave blank if not)">
                            </div>
                            <div class="input-row" id="customer_mobile_row" style="display: none;">
                                <label for="customer_mobile">Customer Mobile:</label>
                                <input type="text" name="customer_mobile" id="customer_mobile"
                                    placeholder="Enter Mobile Number">
                            </div>
                        </form>

                        <div class="scan-section">
                            <label for="barcode_search" style="font-weight: bold;">Scan or Enter Barcode:</label>
                            <div style="display:flex; gap:8px; margin-top:4px;">
                                <input type="text" id="barcode_search" name="barcode_search"
                                    placeholder="Scan or type batch barcode" autocomplete="off" style="flex:1;">
                                <button type="button" class="btn-scan" onclick="scanBarcode()">Scan/Add</button>
                            </div>
                            <div style="margin-top:12px;">
                                <span style="color:#888;font-size:.97em;">or select manually:</span>
                            </div>
                            <div style="margin-top:6px;">
                                <select id="manual_batch_select"
                                    style="width:100%; padding:6px; border-radius:6px; border:1px solid #ddd;">
                                    <option value="">Select Accessory Batch</option>
                                    @foreach($batches as $batch)
                                    <option value="{{ $batch->barcode }}">
                                        {{ $batch->barcode }} - {{ $batch->accessory->name }} (Remaining: {{
                                        $batch->qty_remaining }})
                                    </option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn-scan" onclick="addSelectedBatch()">Add</button>
                            </div>
                        </div>
                        <script>
                            window.batchData = {};
                                                                            @foreach($batches as $batch)
                                                                                window.batchData["{{ $batch->barcode }}"] = {
                                                                                    id: {{ $batch->id }},
                                                                                    barcode: "{{ $batch->barcode }}",
                                                                                    accessory: "{{ addslashes($batch->accessory->name) }}",
                                                                                    qty_remaining: {{ $batch->qty_remaining }},
                                                                                    price: {{ $batch->selling_price }}
                                                                                };
                                                                            @endforeach                           
                        </script>

                    </div>

                    <!-- Right: Cart (Sale Items) -->
                    <div class="pos-cart">
                        <h3 style="margin-top:0;">Sale Cart</h3>
                        <table class="sale-table" id="sale-cart-table">
                            <thead>
                                <tr>
                                    <th>Barcode</th>
                                    <th>Accessory</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- JS will fill this out as items are added --}}
                            </tbody>
                        </table>
                        <div class="cart-summary" id="cart-summary">
                            Total: <span id="cart-total">0.00</span>
                        </div>
                        <div class="input-row">
                            <label for="cart_discount">Discount (Amount):</label>
                            <input type="number" id="cart_discount" min="0" step="0.01" placeholder="Enter Discount"
                                onchange="applyDiscount()">
                        </div>
                        <button class="pos-btn" id="checkout-btn" onclick="checkoutSale()">Checkout & Print
                            Invoice</button>
                        <br>
                        <div id="vendor-extra-fields" style="display:none; margin-top:20px;">
                            <div>
                                <label for="vendor_payment">Amount Vendor Will Pay (optional):</label>
                                <input type="number" min="0" name="pay_amount" id="pay_amount" class="form-control"
                                    placeholder="Enter amount">
                            </div>
                            <div style="margin-top:10px;">
                                <label for="vendor_balance">Vendor Balance:</label>
                                <input type="text" id="vendor_balance" class="form-control" readonly>
                            </div>
                        </div>
                    </div>



                </div>

            </div>


            <div class="pos-container">
                <div class="card ">
                    <div class="card-header latest-update-heading d-flex justify-content-between">
                        <h4 class="latest-update-heading-title text-bold-500">Daily Sales</h4>

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
                            <tbody>
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
                                        <a href="javascript:void(0)" class="sale-items-link"
                                            data-sale="{{ $sale->id }}">
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




        </div>
    </div>
</div>

<div id="loading-overlay" style="
    display:none; 
    position:fixed; 
    top:0; left:0; right:0; bottom:0; 
    z-index:99999;
    background:rgba(255,255,255,0.5); 
    backdrop-filter: blur(6px);
    justify-content:center; 
    align-items:center;
">
    <div style="background: #fff9; padding:28px 32px; border-radius:16px; box-shadow:0 4px 24px #0003;">
        <span style="font-size:1.4em; font-weight:600;">
            <i class="fa fa-spinner fa-spin"></i>
            Processing Sale, Please wait...
        </span>
    </div>
</div>


<script>
    // $(document).ready(function () {
    // $('#vendor_id').select2({
    // placeholder: "Select a vendor",
    // allowClear: true,
    // width: '100%'
    // });
    // });

    $(document).ready(function () {
    $('#manual_batch_select').select2({
    placeholder: "Select a Batch",
    allowClear: true,
    width: '100%'
    });
    });

    document.getElementById('barcode_search').addEventListener('keydown', function(e) {
if (e.key === 'Enter') {
e.preventDefault(); // Prevent form submission if inside a form
scanBarcode();
}
});


// document.getElementById('vendor_id').addEventListener('change', function() {
  
// const vendorId = this.value;
// const extraFields = document.getElementById('vendor-extra-fields');
// const balanceInput = document.getElementById('vendor_balance');

// if (vendorId) {
// // Show extra fields
// extraFields.style.display = '';
// balanceInput.value = 'Loading...';

// fetch(`/api/vendor-balance/${vendorId}`)
// .then(res => res.json())
// .then(data => {
// balanceInput.value = data.balance;
// })
// .catch(() => {
// balanceInput.value = 'Error loading balance';
// });
// } else {
// // Hide fields and clear
// extraFields.style.display = 'none';
// balanceInput.value = '';
// }
// });

$(document).ready(function () {
$('#vendor_id').select2({
placeholder: "Select a vendor",
allowClear: true,
width: '100%'
});

// Attach change event using jQuery
$('#vendor_id').on('change', function () {
const vendorId = $(this).val();
const extraFields = document.getElementById('vendor-extra-fields');
const balanceInput = document.getElementById('vendor_balance');

if (vendorId) {
extraFields.style.display = '';
balanceInput.value = 'Loading...';

fetch(`/api/vendor-balance/${vendorId}`)
.then(res => res.json())
.then(data => {
balanceInput.value = data.balance;
})
.catch(() => {
balanceInput.value = 'Error loading balance';
});
} else {
extraFields.style.display = 'none';
balanceInput.value = '';
}
});
});

document.getElementById('customer_mobile').addEventListener('input', function(e) {
// Only allow numbers
this.value = this.value.replace(/\D/g, '');

// Force start with 923 (replace if not)
if (!this.value.startsWith('923')) {
this.value = '923' + this.value.replace(/^923*/, '');
}
// Limit to 12 chars
if (this.value.length > 12) {
this.value = this.value.slice(0, 12);
}
});
    // --- JS Placeholders (to be replaced with your AJAX logic) ---
    
   
    let cart = [];
    function scanBarcode() {
        let code = document.getElementById('barcode_search').value.trim();
        if (!code) return alert('Enter or scan a barcode!');
        
        // Use the batchData loaded from Blade
        let batch = window.batchData[code];
        if (!batch) return alert('Barcode not found in available batches!');
        
        let qty = prompt('Quantity to add from batch ' + code + ' (Max: ' + batch.qty_remaining + '):', 1);
        if (!qty || isNaN(qty) || qty <= 0 || qty> batch.qty_remaining) return alert('Invalid quantity!');
        
            cart.push({
            barcode: batch.barcode,
            accessory: batch.accessory,
            qty: Number(qty),
            price: batch.price,
            subtotal: batch.price * qty
            });
            renderCart();
            document.getElementById('barcode_search').value = ''; // Clear after adding
    }
  function addSelectedBatch() {
    let select = document.getElementById('manual_batch_select');
    let code = select.value;
    if (!code) return alert('Select a batch to add!');

    // Use real batch data
    let batch = window.batchData[code];
    if (!batch) return alert('Batch not found!');

    let qty = prompt('Quantity to add from batch ' + code + ' (Max: ' + batch.qty_remaining + '):', 1);
    if (!qty || isNaN(qty) || qty <= 0 || qty > batch.qty_remaining) return alert('Invalid quantity!');
    
    cart.push({
        barcode: batch.barcode,
        accessory: batch.accessory,
        qty: Number(qty),
        price: batch.price,
        subtotal: batch.price * qty
    });
    renderCart();
}

function applyDiscount() {
// Get the discount value entered by the user (in percentage or flat amount)
let discountValue = parseFloat(document.getElementById('cart_discount').value);

if (isNaN(discountValue) || discountValue < 0) return; // If no valid discount, do nothing // Calculate the total amount of the items in the cart
     let totalAmount=cart.reduce((total, item)=> total + item.subtotal, 0);

    // Apply the discount proportionally across all items
    cart.forEach(item => {
    // Calculate the proportional discount for each item
    let proportionalDiscount = (item.subtotal / totalAmount) * discountValue;

    // Update the price for the item after discount
    item.price -= proportionalDiscount / item.qty; // Adjusting price per unit
    item.subtotal = item.price * item.qty; // Recalculate subtotal after price change
    });

    // Update the display of the cart
    renderCart();
    }

    function renderCart() {
    let tbody = document.querySelector('#sale-cart-table tbody');
    tbody.innerHTML = "";
    let total = 0;

    cart.forEach((item, i) => {
        total += item.subtotal;
        tbody.innerHTML += `<tr>
            <td>${item.barcode}</td>
            <td>${item.accessory}</td>
            <td><input type="number" value="${item.qty}" min="1" style="width:50px;" onchange="updateQuantity(${i}, this.value)"></td>
            <td><input type="number" value="${item.price.toFixed(2)}" min="0" step="0.01" style="width:70px;" onchange="updatePrice(${i}, this.value)"></td>
            <td>${item.subtotal.toFixed(2)}</td>
            <td><button type="button" onclick="removeCartItem(${i})" style="background:#f33;color:#fff;padding:4px 10px;border:none;border-radius:3px;">Remove</button></td>
        </tr>`;
    });
    document.getElementById('cart-total').textContent = total.toFixed(2);
}


// function renderCart() {
// let tbody = document.querySelector('#sale-cart-table tbody');
// tbody.innerHTML = "";
// let total = 0;
// cart.forEach((item, i) => {
// total += item.subtotal;
// tbody.innerHTML += `<tr>
//     <td>${item.barcode}</td>
//     <td>${item.accessory}</td>
//     <td><input type="number" value="${item.qty}" min="1" style="width:50px;"
//             onchange="updateQuantity(${i}, this.value)"></td>
//     <td><input type="number" value="${item.price}" min="0" step="0.01" style="width:70px;"
//             onchange="updatePrice(${i}, this.value)"></td>
//     <td>${item.subtotal.toFixed(2)}</td>
//     <td><button type="button" onclick="removeCartItem(${i})"
//             style="background:#f33;color:#fff;padding:4px 10px;border:none;border-radius:3px;">Remove</button></td>
// </tr>`;
// });
// document.getElementById('cart-total').textContent = total.toFixed(2);
// }

function updateQuantity(i, newQty) {
    if (isNaN(newQty) || newQty <= 0) return; // Prevent invalid input
    cart[i].qty = Number(newQty);
    cart[i].subtotal = cart[i].qty * cart[i].price;
    renderCart();
}

function updatePrice(i, newPrice) {
    if (isNaN(newPrice) || newPrice <= 0) return; // Prevent invalid input
    cart[i].price = Number(newPrice);
    cart[i].subtotal = cart[i].qty * cart[i].price;
    renderCart();
}
    function removeCartItem(i) {
        cart.splice(i, 1);
        renderCart();
    }


    function checkoutSale() {

      if (!cart.length) return alert("Cart is empty!");
        document.getElementById('loading-overlay').style.display = 'flex';
          const btn = document.getElementById('checkout-btn');
           btn.disabled = true;
            btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';
        
        // Gather customer/vendor info
        let vendor_id = document.getElementById('vendor_id').value;
        let customer_name = document.getElementById('customer_name').value;
        let customer_mobile = document.getElementById('customer_mobile') ? document.getElementById('customer_mobile').value : '';
        let pay_amount = document.getElementById('pay_amount') ? document.getElementById('pay_amount').value : "";
        
        // Build payload
        let payload = {
        vendor_id: vendor_id,
        customer_name: customer_name,
        customer_mobile: customer_mobile,
        pay_amount: pay_amount,
        items: cart
        };

   
        
       fetch('/pos/checkout', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify(payload)
})
.then(async res => {
    let contentType = res.headers.get("content-type");
    if (contentType && contentType.includes("application/json")) {
        return res.json();
    } else {
        let text = await res.text();
        throw new Error("Server did not return JSON. Response was: " + text.substring(0, 400));
    }
})
.then(data => {
    if (data.success) {
        // Open invoice in a new tab
        window.open('/pos/invoice/' + data.invoice_number, '_blank');
        // Reload current page after short delay (so user sees invoice opens)
        setTimeout(function() {
            window.location.reload();
        }, 700); // 700ms is enough, you can adjust
    } else {
        console.error(data);
        alert("Error: " + (data.message || 'Sale failed.'));
    }
})
.catch(error => {
    console.error(error);
    alert("Unexpected error: " + error.message);
});
    }
    // --- END JS Placeholders ---

    // Show/Hide customer mobile field if 'Walk-in Customer' is selected
    document.getElementById('vendor_id').addEventListener('change', function() {
    const mobileRow = document.getElementById('customer_mobile_row');
    if (!this.value) {
    // Walk-in Customer (vendor_id is blank)
    mobileRow.style.display = '';
    } else {
    mobileRow.style.display = 'none';
    document.getElementById('customer_mobile').value = '';
    }
    });
    
    // On page load, trigger the change in case the default is Walk-in
    document.getElementById('vendor_id').dispatchEvent(new Event('change'));
</script>




@endsection