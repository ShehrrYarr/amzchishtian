@extends('user_navbar')
@section('content')

{{-- Store Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Accessory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="storeMobile" action="{{ route('accessories.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-body">

                        <div class="mb-1">
                            <label for="mobile_name" class="form-label">Accessory Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-1">
                            <label for="company_id" class="form-label">Company</label>
                            <select class="form-control" name="company_id" required>
                                <option value="">Select Company</option>
                                @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="group_id" class="form-label">Group</label>
                            <select class="form-control" name="group_id" required>
                                <option value="">Select Group</option>
                                @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-1">
                            <label for="pay_amount" class="form-label">Description (Optional)</label>
                            <input type="text" class="form-control" name="description" placeholder="Enter Description">
                        </div>
                        <div class="mb-1">
                            <label for="min_qty" class="form-label">Minimum Quantity</label>
                            <input type="integer" class="form-control" name="min_qty"
                                placeholder="Enter Minumum Quantity" required>
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
                            <label for="company_id" class="form-label">Company</label>
                            <select class="form-control" id="company_id" name="company_id" required>
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-1">
                            <label for="group_id" class="form-label">Group</label>
                            <select class="form-control" id="group_id" name="group_id" required>
                                @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
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

            <button type="button" class="btn btn-primary ml-1" data-toggle="modal" data-target="#exampleModal">
                <i class="bi bi-plus"></i> Add Accessory
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

                                    <th>Name</th>
                                    <th>Group</th>
                                    <th>Company</th>
                                    <th>Remaining Qty</th>
                                    <th>Minimum Quantity</th>
                                    <th>Description</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accessories as $accessory)
                                <tr>
                                    <td>{{ $accessory->created_at }}</td>
                                    <td>{{ $accessory->user->name }}</td>
                                    <td>{{ $accessory->name }}</td>
                                    <td>{{ $accessory->group->name ?? '-' }}</td>
                                    <td>{{ $accessory->company->name ?? '-' }}</td>
                                    <td><strong>{{ $accessory->total_remaining }}</strong></td>
                                    <td>{{ $accessory->min_qty }}</td>
                                    <td>{{ $accessory->description }}</td>
                                    <td>
                                        <a href="" onclick="edit({{ $accessory->id }})" data-toggle="modal"
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
    $(document).ready(function () {
        $('#accessoryTable').DataTable({
        order: [
        [0, 'desc']
        ]
        });
        });

function edit(value) {
        console.log(value);
        var id = value;
        $.ajax({
        type: "GET",
        url: '/accessoryedit/' + id,
        success: function (data) {
        $("#editAccessory").trigger("reset");
        
        $('#id').val(data.result.id);
        $('#name').val(data.result.name);
        $('#company_id').val(data.result.company_id);
        $('#group_id').val(data.result.group_id);
        $('#description').val(data.result.description);
        
        
        
        },
        error: function (error) {
        console.log('Error:', error);
        }
        });
        }
       
</script>

@endsection