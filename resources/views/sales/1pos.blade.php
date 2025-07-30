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
                            <label for="cart_discount">Discount (% or Amount):</label>
                            <input type="number" id="cart_discount" min="0" step="0.01" placeholder="Enter Discount" onchange="applyDiscount()">
                        </div>
                        <button class="pos-btn" onclick="checkoutSale()">Checkout & Print Invoice</button>
                    </div>
                </div>
            </div>







        </div>
    </div>
</div>


<script>
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


function renderCart() {
let tbody = document.querySelector('#sale-cart-table tbody');
tbody.innerHTML = "";
let total = 0;
cart.forEach((item, i) => {
total += item.subtotal;
tbody.innerHTML += `<tr>
    <td>${item.barcode}</td>
    <td>${item.accessory}</td>
    <td><input type="number" value="${item.qty}" min="1" style="width:50px;"
            onchange="updateQuantity(${i}, this.value)"></td>
    <td><input type="number" value="${item.price}" min="0" step="0.01" style="width:70px;"
            onchange="updatePrice(${i}, this.value)"></td>
    <td>${item.subtotal.toFixed(2)}</td>
    <td><button type="button" onclick="removeCartItem(${i})"
            style="background:#f33;color:#fff;padding:4px 10px;border:none;border-radius:3px;">Remove</button></td>
</tr>`;
});
document.getElementById('cart-total').textContent = total.toFixed(2);
}

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
        
        // Gather customer/vendor info
        let vendor_id = document.getElementById('vendor_id').value;
        let customer_name = document.getElementById('customer_name').value;
        let customer_mobile = document.getElementById('customer_mobile') ? document.getElementById('customer_mobile').value : '';
        
        // Build payload
        let payload = {
        vendor_id: vendor_id,
        customer_name: customer_name,
        customer_mobile: customer_mobile,
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