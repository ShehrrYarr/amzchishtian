@extends('user_navbar')
@section('content')

{{-- Store Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Batch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="storeMobile" action="{{ route('batches.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-body">

                        <div class="mb-1">
                            <label for="accessory_id" class="form-label">Accessory</label>
                            <select class="form-control" name="accessory_id" id="accessorySelect1" required>
                                <option value="">Select Accessory</option>
                                @foreach ($accessories as $accessory)
                                <option value="{{ $accessory->id }}">{{ $accessory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-1">
                            <label for="vendor_id" class="form-label">Vendor</label>
                            <select class="form-control" name="vendor_id" id="vendorSelect1" required>
                                <option value="">Select Vendor</option>
                                @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }} ({{ $vendor->mobile_no }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-1">
                            <label for="purchase_date" class="form-label">Purchase Date</label>
                            <input type="date" class="form-control" name="purchase_date" required>
                        </div>

                        <div class="mb-1">
                            <label for="pay_amount" class="form-label">Description (Optional)</label>
                            <input type="text" class="form-control" name="description" placeholder="Enter Description">
                        </div>

                        <div class="mb-1">
                            <label for="qty_purchased" class="form-label">Quantity Purchased</label>
                            <input type="number" class="form-control" id="qty_purchased" name="qty_purchased" min="1"
                                required>
                        </div>

                        <div class="mb-1">
                            <label for="purchase_price" class="form-label">Purchase Price (per unit)</label>
                            <input type="number" class="form-control" id="purchase_price" name="purchase_price"
                                step="0.01" min="0" required>
                        </div>
                        <div class="mb-1">
                            <label for="selling_price" class="form-label">Selling Price (per unit)</label>
                            <input type="number" class="form-control" name="selling_price" step="0.01" min="0" required>
                        </div>
                        <div class="mb-1">
                            <label for="pay_amount" class="form-label">Pay amount</label>
                            <input type="number" id="pay_amount" class="form-control" name="pay_amount">
                        </div>



                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                            <i class="feather icon-x"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary" id="storeButton">
                            <i class="fa fa-check-square-o"></i> Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- End Store Modal --}}

{{-- Edit Modal --}}

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Accessory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="editAccessory" action="{{ route('accessories.update') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-body">

                        <div class="mb-1">
                            <label for="mobile_name" class="form-label">Accessory Name</label>
                            <input class="form-control" type="hidden" name="id" id="id" value="Update">
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>



                        <div class="mb-1">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" id="description">
                        </div>
                        <div class="mb-1">
                            <label for="password" class="form-label">Edit Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                            <i class="feather icon-x"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-square-o"></i> Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- End Edit Modal --}}

{{-- Barcode Modal --}}
<div id="barcode-modal" class="barcode-modal print-area"
    style="display:none; position:fixed; top:20%; left:50%; transform:translate(-50%, 0); background:#fff; padding:30px; border-radius:8px; box-shadow:0 2px 8px #0003; z-index:9999; min-width:300px;">
    <div id="barcode-modal-content"></div>
    <button class="btn btn-primary btn-sm" onclick="printBarcodeModal()">
        <i class="fa fa-print"></i> Print
    </button>
    <button class="btn btn-secondary btn-sm" onclick="hideBarcodeModal()">
        <i class="fa fa-times"></i> Close
    </button>
</div>



{{-- End Barcode Modal --}}
{{-- @foreach($batches as $batch)
<div id="barcode-modal-{{ $batch->id }}" class="barcode-modal"
    style="display:none; position:fixed; top:20%; left:50%; transform:translate(-50%, 0); background:#fff; padding:30px; border-radius:8px; box-shadow:0 2px 8px #0003; z-index:9999;">
    <h4>Batch Barcode ({{ $batch->barcode }})</h4>
    <div>{!! DNS1D::getBarcodeHTML($batch->barcode, 'C128') !!}</div>
    <button onclick="printBarcode('{{ $batch->id }}')">Print</button>
    <button onclick="hideBarcodeModal('{{ $batch->id }}')">Close</button>
</div>
@endforeach --}}


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
            <div class="ml-1">
                <form method="GET" action="{{ route('batches.index') }}" class="mb-3 d-flex align-items-center">
                    <input type="date" class="form-control mr-2" name="start_date" value="{{ request('start_date') }}"
                        style="max-width: 180px;">
                    <span class="mx-1">to</span>
                    <input type="date" class="form-control mr-2" name="end_date" value="{{ request('end_date') }}"
                        style="max-width: 180px;">
                    <button type="submit" class="btn btn-primary mx-1">Filter</button>
                    <a href="{{ route('batches.index') }}" class="btn btn-secondary mx-1">Reset</a>
                </form>
            </div>
            <div class="ml-1">
                <h2>Total Purchase Amount: {{$totalPurchasePrice}}</h2>
            </div>

            <button type="button" class="btn btn-primary ml-1" data-toggle="modal" data-target="#exampleModal">
                <i class="bi bi-plus"></i> Add Batch
            </button>

            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 latest-update-tracking mt-1 ">
                <div class="card ">
                    <div class="card-header latest-update-heading d-flex justify-content-between">
                        <h4 class="latest-update-heading-title text-bold-500">Accessories</h4>

                    </div>
                    <div class="table-responsive">
                        <table id="accessoryTable" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Created By</th>

                                    <th>Accessory</th>
                                    <th>Vendor</th>
                                    <th>Qty Purchased</th>
                                    <th>Qty Remaining</th>
                                    <th>Purchase Price</th>
                                    <th>Selling Price</th>
                                    <th>Description</th>
                                    <th>Purchase Date</th>
                                    <th>Barcode</th>
                                    <th>Print Barcode</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($batches as $batch)
                                <tr>
                                    <td>{{ $batch->created_at }}</td>
                                    <td>{{ $batch->user->name }}</td>
                                    <td>{{ $batch->accessory->name ?? '-' }}</td>
                                    <td>{{ $batch->vendor->name ?? '-' }}</td>
                                    <td>{{ $batch->qty_purchased }}</td>
                                    <td>{{ $batch->qty_remaining }}</td>
                                    <td>{{ $batch->purchase_price }}</td>
                                    <td>{{ $batch->selling_price }}</td>
                                    <td>{{ $batch->description }}</td>
                                    <td>{{ $batch->purchase_date }}</td>
                                    <td>{{ $batch->barcode }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm"
                                            onclick="showBarcodeAjax({{ $batch->id }})">
                                            <i class="fa fa-barcode"></i> View Barcode
                                        </button>
                                    </td>
                                    <td><a href="" onclick="edit({{ $batch->id }})" data-toggle="modal"
                                            data-target="#exampleModal1">
                                            <i class="feather icon-edit"></i></a>
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



<script>
    const qtyInput = document.getElementById('qty_purchased');
    const priceInput = document.getElementById('purchase_price');
    const payAmountInput = document.getElementById('pay_amount');
    
    function calculatePayAmount() {
    // Get the current values
    const qty = parseFloat(qtyInput.value) || 0;
    const price = parseFloat(priceInput.value) || 0;
    // Calculate
    const total = qty * price;
    // Write result to Pay Amount field (2 decimal places)
    payAmountInput.value = total ? total.toFixed(2) : '';
    }
    
    // Attach event listeners
    qtyInput.addEventListener('input', calculatePayAmount);
    priceInput.addEventListener('input', calculatePayAmount); 


    
    $(document).ready(function () {
        $('#accessoryTable').DataTable({
        order: [
        [0, 'desc']
        ]
        });
        });

        $(document).ready(function () {
        $('#vendorSelect1').select2({
        placeholder: "Select a vendor",
        allowClear: true,
        width: '100%' 
        });
        });


        $(document).ready(function () {
        $('#accessorySelect1').select2({
        placeholder: "Select a Accessory",
        allowClear: true,
        width: '100%' 
        });
        });

     function showBarcodeAjax(batchId) {
        fetch('/batches/' + batchId + '/barcode')
        .then(response => response.json())
        .then(data => {
        if (data.success) {
        document.getElementById('barcode-modal-content').innerHTML = `
        <h4>Batch Barcode (${data.batch.barcode})</h4>
        <svg id="barcode-svg"></svg>
        <p><strong>Accessory:</strong> ${data.batch.accessory}</p>
        <p><strong>Vendor:</strong> ${data.batch.vendor}</p>
        <p><strong>Qty Purchased:</strong> ${data.batch.qty_purchased}</p>
        <p><strong>Qty Remaining:</strong> ${data.batch.qty_remaining}</p>
        <p><strong>Purchase Price:</strong> ${data.batch.purchase_price}</p>
        <p><strong>Selling Price:</strong> ${data.batch.selling_price}</p>
        <p><strong>Purchase Date:</strong> ${data.batch.purchase_date}</p>
        `;
        document.getElementById('barcode-modal').style.display = 'block';
        
        // THIS IS THE KEY LINE:
        JsBarcode("#barcode-svg", data.batch.barcode, {
        format: "CODE128",
        lineColor: "#000",
        width: 2,
        height: 40,
        displayValue: false
        });
        } else {
        alert('Could not fetch barcode info!');
        }
        });
        }
        
        
        // function printBarcodeModal() {
        // var printContents = document.getElementById('barcode-modal-content').innerHTML;
        // var originalContents = document.body.innerHTML;
        // document.body.innerHTML = printContents;
        // window.print();
        // document.body.innerHTML = originalContents;
        // hideBarcodeModal();
        // }

        function hideBarcodeModal() {
        document.getElementById('barcode-modal').style.display = 'none';
        }

    //    function printBarcodeModal() {
    //     // 1. Get batch number and how many to print
    //     // You may want to grab batch number from your modal content or store it somewhere
    //     let batchNumber = document.querySelector('#barcode-modal-content h4').textContent.match(/\((\d+)\)/);
    //     batchNumber = batchNumber ? batchNumber[1] : '';
        
    //     // 2. Open new window for printing
    //     let win = window.open('', '', 'width=900,height=700');
        
    //     // 3. Write the HTML, including the JsBarcode library (escaped closing tag)
    //     win.document.write(`
    //     <!DOCTYPE html>
    //     <html>
        
    //     <head>
    //         <title>Print Barcodes</title>
    //         <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js">
    //             <\/script>
    //       <style>
    //         body { background: #fff; }
    //         .barcode-grid {
    //             display: grid;
    //             grid-template-columns: repeat(5, 1fr);
    //             gap: 34px 10px;
    //             margin-top: 40px;
    //             margin-left: 20px;
    //             margin-right: 20px;
    //         }
    //         .barcode-box {
    //             text-align: center;
    //             margin-bottom: 10px;
    //         }
    //         .barcode-box svg {
    //             width: 140px !important;
    //             height: 40px !important;
    //             display: block;
    //             margin: 0 auto;
    //         }
    //         .barcode-label {
    //             font-size: 1.3em;
    //             font-weight: 600;
    //             letter-spacing: 2px;
    //             margin-top: 3px;
    //         }
    //       </style>
    //     </head>
    //     <body>
    //       <div class="barcode-grid">
    //         ${Array.from({ length: 1 }).map((_, i) =>
    //           `<div class="barcode-box">
    //             <svg id="barcode_${i}"></svg>
    //             <div class="barcode-label">${batchNumber}</div>
    //           </div>`
    //         ).join('')}
    //       </div>
    //       <script>
    //         window.onload = function() {
    //           for(let i=0; i<1; i++) {
    //             JsBarcode("#barcode_" + i, "${batchNumber}", {
    //               format: "CODE128",
    //               width: 2,
    //               height: 40,
    //               displayValue: false
    //             });
    //           }
    //           window.print();
    //         }
    //       <\/script>
    //     </body>
    //     </html>
    //         `);
    //         win.document.close();
    //     }

    // function printBarcodeModal(labelCount = 1) {
    // // 1. Get batch number
    // let match = document
    // .querySelector('#barcode-modal-content h4')
    // .textContent.match(/\((\d+)\)/);
    // const batchNumber = match ? match[1] : '';
    
    // // 2. Open print window
    // const win = window.open('', '', 'width=900,height=700');
    
    // // 3. Write HTML + CSS (slightly smaller barcode + text)
    // win.document.write(`
    // <!DOCTYPE html>
    // <html>
    
    // <head>
    //     <meta name="viewport" content="width=50mm, height=25mm, initial-scale=1.0">
    //     <title>Print Barcodes</title>
    //     <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js">
    //         <\/script>
    //   <style>
    //     @page { size: 50mm 25mm; margin: 0; }
    //     html, body { width: 50mm; height: 25mm; margin: 0; padding: 0; }
    //     .barcode-box {
    //       width: 50mm;
    //       height: 25mm;
    //       page-break-after: always;
    //       display: flex;
    //       flex-direction: column;
    //       align-items: center;
    //       justify-content: center;
    //     }
    //     .barcode-box svg {
    //       /* ~120px ≈ 15mm at 203dpi (slightly smaller) */
    //       width: 120px !important;
    //       height: 45px !important;
    //       display: block;
    //     }
    //     .barcode-label {
    //       font-size: 4.5mm;  /* a touch smaller than before */
    //       font-weight: 600;
    //       margin-top: 1mm;
    //     }
    //   </style>
    // </head>
    // <body>
    //   ${Array.from({ length: labelCount }).map((_, i) => `
    //     <div class="barcode-box">
    //       <svg id="barcode_${i}"></svg>
    //       <div class="barcode-label">${batchNumber}</div>
    //     </div>
    //   `).join('')}
    //   <script>
    //     window.onload = function() {
    //       for (let i = 0; i < ${labelCount}; i++) {
    //         JsBarcode("#barcode_" + i, "${batchNumber}", {
    //           format: "CODE128",
    //           width: 2,    // slightly narrower bars (~0.31mm)
    //           height: 40,    // slightly shorter bars
    //           displayValue: false
    //         });
    //       }
    //       setTimeout(() => window.print(), 300);
    //     };
    //   <\/script>
    // </body>
    // </html>`);
    //   win.document.close();
    // }
    function printBarcodeModal(labelCount = 1) {
    // 1. Get batch number
    let match = document
    .querySelector('#barcode-modal-content h4')
    .textContent.match(/\((\d+)\)/);
    const batchNumber = match ? match[1] : '';
    
    // 2. Get selling price from the modal
    // This assumes you always render selling price in a <p><strong>Selling Price:</strong> ...</p>
    let sellingPriceText = '';
    let sellingPriceElem = Array.from(document.querySelectorAll('#barcode-modal-content p'))
    .find(el => el.textContent.includes('Selling Price:'));
    if (sellingPriceElem) {
    // Extract just the numeric value
    sellingPriceText = sellingPriceElem.textContent.replace('Selling Price:', '').trim();
    }
    
    // 3. Open print window
    const win = window.open('', '', 'width=900,height=700');
    
    // 4. Write HTML + CSS (add price below batch number)
    win.document.write(`
    <!DOCTYPE html>
    <html>
    
    <head>
        <meta name="viewport" content="width=50mm, height=25mm, initial-scale=1.0">
        <title>Print Barcodes</title>
        <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js">
            <\/script>
          <style>
            @page { size: 50mm 25mm; margin: 0; }
            html, body { width: 50mm; height: 25mm; margin: 0; padding: 0; }
            .barcode-box {
              width: 50mm;
              height: 25mm;
              page-break-after: always;
              display: flex;
              flex-direction: column;
              align-items: center;
              justify-content: center;
            }
            .barcode-box svg {
              width: 120px !important;
              height: 45px !important;
              display: block;
            }
            .barcode-label {
              font-size: 4.5mm;
              font-weight: 600;
              margin-top: 1mm;
            }
            .barcode-price {
              font-size: 4mm;
              font-weight: bold;
              color: #111;
              margin-top: 1mm;
            }
          </style>
        </head>
        <body>
          ${Array.from({ length: labelCount }).map((_, i) => `
            <div class="barcode-box">
              <svg id="barcode_${i}"></svg>
              <div class="barcode-label">${batchNumber}</div>
              <div class="barcode-price">${sellingPriceText ? 'Rs. ' + sellingPriceText : ''}</div>
            </div>
          `).join('')}
          <script>
            window.onload = function() {
              for (let i = 0; i < ${labelCount}; i++) {
                JsBarcode("#barcode_" + i, "${batchNumber}", {
                  format: "CODE128",
                  width: 2,
                  height: 40,
                  displayValue: false
                });
              }
              setTimeout(() => window.print(), 300);
            };
          <\/script>
        </body>
        </html>`);
        win.document.close();
    }
// function edit(value) {
//         console.log(value);
//         var id = value;
//         $.ajax({
//         type: "GET",
//         url: '/accessoryedit/' + id,
//         success: function (data) {
//         $("#editAccessory").trigger("reset");
        
//         $('#id').val(data.result.id);
//         $('#name').val(data.result.name);
//         $('#company_id').val(data.result.company_id);
//         $('#group_id').val(data.result.group_id);
//         $('#description').val(data.result.description);
        
        
        
//         },
//         error: function (error) {
//         console.log('Error:', error);
//         }
//         });
//         }
       
</script>

@endsection