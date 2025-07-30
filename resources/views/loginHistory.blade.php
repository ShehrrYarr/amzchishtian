@extends('user_navbar')
@section('content')


<style>
    .card {
        border-radius: 12px;

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



            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 latest-update-tracking mt-1 ">
                <div class="card ">
                    <div class="card-header latest-update-heading d-flex justify-content-between">
                        <h4 class="latest-update-heading-title text-bold-500">Login Histories</h4>

                    </div>
                    <div class="table-responsive">
                        <table id="loginTable" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Created At</th>

                                    <th>Status</th>

                                    <th>Name</th>
                                    <th>Device</th>
                                    <th>Browser</th>
                                    <th>Platform</th>
                                    {{-- <th>User Agent</th> --}}
                                    <th>ip</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($LoginHistories as $key)
                                <tr>
                                    <td>{{ $key->created_at }}</td>
                                    <td>{{ $key->status }}</td>
                                    <td>{{ $key->name }}</td>
                                    <td>{{ $key->device }}</td>
                                    <td>{{ $key->browser }}</td>
                                    <td>{{ $key->platform }}</td>
                                    {{-- <td>{{ $key->user_agent }}</td> --}}
                                    <td>{{ $key->ip }}</td>

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
    $('#loginTable').DataTable({
    order: [
    [0, 'desc']
    ]
    });
    });
</script>

@endsection