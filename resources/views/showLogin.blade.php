@extends('user_navbar')

@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>

            <div class="content-body">
                {{-- Flash Messages --}}
                @if (session('success'))
                    <div class="alert alert-success" id="successMessage">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('danger'))
                    <div class="alert alert-danger" id="dangerMessage">
                        {{ session('danger') }}
                    </div>
                @endif

                {{-- Card --}}
                <div class="col-12 latest-update-tracking mt-1">
                    <div class="card">
                        <div class="card-header latest-update-heading d-flex justify-content-between">
                            <h4 class="latest-update-heading-title text-bold-500">Update Timings</h4>
                        </div>

                        <div class="card-body">
                            @php
                                $restriction = \App\Models\LoginRestriction::latest()->first();
                            @endphp

                            @if(in_array(auth()->id(), [1, 2]))
                                <form method="POST" action="{{ route('admin.updateLoginWindow') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="start_time">Start Time:</label>
                                        <input type="time" name="start_time" id="start_time" class="form-control"
                                            value="{{ old('start_time', $restriction->start_time ?? '09:00') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="end_time">End Time:</label>
                                        <input type="time" name="end_time" id="end_time" class="form-control"
                                            value="{{ old('end_time', $restriction->end_time ?? '17:00') }}" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Login Window</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Optional JS to auto-hide flash messages --}}
    <script>
        setTimeout(() => {
            document.getElementById('successMessage')?.remove();
            document.getElementById('dangerMessage')?.remove();
        }, 3000);
    </script>

@endsection