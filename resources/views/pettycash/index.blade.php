@extends('user_navbar')
@section('content')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="container mt-4" style="max-width: 720px;">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h3 class="mb-3" style="font-weight: 600;">Add Petty Cash</h3>
                        <form action="{{ route('pettycash.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Amount</label>
                                    <input type="number" name="amount" class="form-control" step="0.01" min="0.01"
                                        required placeholder="Enter amount">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label class="form-label">Type</label>
                                    <select name="type" class="form-control" required>
                                        <option value="in">Cash In</option>
                                        <option value="out">Cash Out</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Description</label>
                                    <input type="text" name="description" class="form-control"
                                        placeholder="Short description">
                                </div>
                            </div>
                            <div class="mt-3 text-end">
                                <button type="submit" class="btn btn-primary px-4">Add Entry</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mb-2 px-2">
                <span class="fw-bold" style="font-size: 1rem;">Total In:</span> Rs. <b>{{ number_format($totalIn,2)
                    }}</b>
                &nbsp;
                <span class="fw-bold" style="font-size: 1rem;">Total Out:</span> Rs. <b>{{ number_format($totalOut,2)
                    }}</b>
                &nbsp;
                <span class="fw-bold" style="font-size: 1rem;">Balance:</span> Rs. <b>{{ number_format($balance,2)
                    }}</b>
            </div>

            <hr>


            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 latest-update-tracking mt-1 ">
                <div class="card ">
                    <div class="card-header latest-update-heading d-flex justify-content-between">
                        <h4 class="latest-update-heading-title text-bold-500">Petty Cash</h4>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Added By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pettyCashes as $entry)
                                <tr>
                                    <td>{{ $entry->date }}</td>
                                    <td>{{ $entry->type == 'in' ? 'Cash In' : 'Cash Out' }}</td>
                                    <td>Rs. {{ number_format($entry->amount,2) }}</td>
                                    <td>{{ $entry->description }}</td>
                                    <td>{{ $entry->user->name ?? '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No entries yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection