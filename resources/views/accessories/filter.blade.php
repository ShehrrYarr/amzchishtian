@extends('user_navbar')
@section('content')

{{-- Store Modal --}}


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
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>


        <div class="content-body">

            <div class="ml-1">
                <form action="{{ route('filter.index') }}" method="GET" class="mb-3 d-flex align-items-center"
                    style="gap: 16px;">
                    <div>
                        <select id="groupSelect" name="group_id" class="form-control">
                            <option value="">All Groups</option>
                            @foreach($groups as $group)
                            <option value="{{ $group->id }}" {{ request('group_id')==$group->id ? 'selected' : '' }}>
                                {{ $group->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select id="companySelect" name="company_id" class="form-control">
                            <option value="">All Companies</option>
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ request('company_id')==$company->id ? 'selected' : ''
                                }}>
                                {{ $company->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('filter.index') }}" class="btn btn-secondary">Reset</a>
                </form>
            </div>

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
        
        $(document).ready(function () {
        $('#groupSelect').select2({
        placeholder: "Select a Group",
        allowClear: true,
        width: '100%'
        });
        });
        $(document).ready(function () {
        $('#companySelect').select2({
        placeholder: "Select a Company",
        allowClear: true,
        width: '100%'
        });
        });

       
</script>

@endsection