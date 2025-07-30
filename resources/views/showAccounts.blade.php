@extends('user_navbar')
@section('content')

{{-- Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter Credit Amount</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="storeMobile" action="{{ route('creditAmount') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-body">

                        <div class="mb-1">
                            <label for="amount" class="form-label">Credit Amount</label>
                            <input type="number" class="form-control" name="amount" required>
                            <input type="number" value="{{ $vendor->id }}" class="form-control" name="vendor_id"
                                required hidden>

                        </div>
                        <div class="mb-1">
                            <label for="name" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description">
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
{{-- End Modal --}}


{{-- Edit Modal --}}

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter Debit Amount</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="editmobile" action="{{ route('debitAmount') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">

                        <div class="mb-1">
                            <label for="number" class="form-label">Amount</label>
                            <input class="form-control" name="vendor_id" value="{{ $vendor->id }}" hidden>
                            <input type="number" class="form-control" name="amount" required>
                        </div>
                        <div class="mb-1">
                            <label for="name" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description">
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

{{-- Delete Account --}}
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Vendor?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="deleteMobile" action="{{ route('destroyAccount') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">

                        <div class="mb-1">
                            <label for="name" class="form-label">Are you sure you want to delete this Entry?</label>
                            <input class="form-control" hidden name="id" id="did" value="Update">
                            {{-- <input type="text" class="form-control" id="dname" name="name" readonly required> --}}
                        </div>
                        <div class="mb-1">
                            <label for="name" class="form-label">Enter Password to Delete This Entry</label>
                            <input type="password" class="form-control" name="password">
                        </div>

                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                            <i class="feather icon-x"></i> No
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-square-o"></i> Yes
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- End Delete Account --}}



<style>
    .card {
        border-radius: 12px;
    }

    .gradient-button {
        background: linear-gradient(to right, #74a8e0, #1779e2);
        border-color: #007bff;
        color: white;
    }

    .gradient-button1 {
        background: linear-gradient(to right, rgb(224, 199, 116), rgb(226, 168, 23));
        border-color: rgb(255, 162, 0);
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

            <button type="button" class="btn ml-1 gradient-button" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-arrow-circle-down" style="font-size: 20px;"></i>
            </button>
            <button type="button" class="btn ml-1 gradient-button1" data-toggle="modal" data-target="#exampleModal1">
                <i class="fa fa-arrow-circle-up" style="font-size: 20px;"></i>
            </button>



            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 latest-update-tracking mt-1 ">
                <div class="card ">
                    <div class="card-header latest-update-heading d-flex justify-content-between">
                        <h4 class="latest-update-heading-title text-bold-500">Account Details of <b>
                                {{ $vendor->name }}</b></h4>

                    </div>
                    <div class="table-responsive">
                        <table id="accountsTable" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Created By</th>
                                    <th>Description</th>
                                    <th>Debit (DB)</th>
                                    <th>Credit (CR)</th>
                                    <th>Balance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $row)
                                <tr>
                                    <td>{{ $row->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ $row->creator->name ?? 'N/A' }}</td>
                                    <td>{{ $row->description }}</td>
                                    <td class="text-danger">{{ $row->Debit ? number_format($row->Debit) : '-' }}</td>
                                    <td>{{ $row->Credit ? number_format($row->Credit) : '-' }}</td>
                                    <td class="balance-cell" data-credit="{{ $row->Credit ?? 0 }}"
                                        data-debit="{{ $row->Debit ?? 0 }}"></td>
                                    <td>
                                        <a href="#" onclick="remove({{ $row->id }})" data-toggle="modal"
                                            data-target="#exampleModal2">
                                            <i style="color:red" class="feather icon-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                @php
                                $totalDebit = $accounts->sum('Debit');
                                $totalCredit = $accounts->sum('Credit');
                                @endphp
                                <tr>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                    <th>{{ number_format($totalDebit) }}</th>
                                    <th>{{ number_format($totalCredit) }}</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<script>
    //Start dataTable

        // $(document).ready(function () {
        //     $('#accountsTable').DataTable({
        //         order: [
        //             [0, 'desc']
        //         ]
        //     });
        // });
        //End dataTable

        $(document).ready(function () {
        var table = $('#accountsTable').DataTable({
        order: [
        [0, 'asc']
        ]
        });
        
        function recalcBalance() {
        let runningBalance = 0;
        // Loop through the rows in the **current displayed order**
        table.rows({order:'applied', search:'applied'}).every(function(rowIdx, tableLoop, rowLoop){
        let node = this.node();
        let $cell = $(node).find('.balance-cell');
        let credit = parseFloat($cell.data('credit')) || 0;
        let debit = parseFloat($cell.data('debit')) || 0;
        runningBalance += (credit - debit);
        // Format as integer with commas, you can adjust as needed
        $cell.text(runningBalance.toLocaleString());
        // Optional: style for positive/negative
        $cell.removeClass('text-danger text-primary');
        if (runningBalance < 0) $cell.addClass('text-danger'); else if (runningBalance> 0) $cell.addClass('text-primary');
            });
            }
        
            // Calculate on page load and on every redraw
            table.on('draw', function(){
            recalcBalance();
            });
        
            // Initial call
            recalcBalance();
            });

        function remove(value) {
        console.log(value);
        var id = value;
        $.ajax({
        type: "GET",
        url: '/getaccount/' + id,
        success: function (data) {
        $("#deleteMobile").trigger("reset");
        
        $('#did').val(data.result.id);
        // $('#dname').val(data.result.name);
        
        },
        error: function (error) {
        console.log('Error:', error);
        }
        });
        }
</script>


@endsection