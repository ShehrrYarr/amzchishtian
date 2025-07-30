@extends('user_navbar')
@section('content')

    {{-- Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="storeMobile" action="{{ route('updatePassword') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-body">

                            <div class="mb-1">
                                <label for="name" class="form-label">Update Password</label>
                                <input type="text" class="form-control" name="update_password">
                            </div>
                              <div class="mb-1">
                                <label for="name" class="form-label">Delete Password</label>
                                <input type="text" class="form-control" name="delete_password">
                            </div>
                              <div class="mb-1">
                                <label for="name" class="form-label">Approve Password</label>
                                <input type="text" class="form-control" name="approve_password">
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

                <button type="button" class="btn btn-primary ml-1" data-toggle="modal" data-target="#exampleModal">
                    <i class="bi bi-plus"></i> Update Password
                </button>

                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 latest-update-tracking mt-1 ">
                    <div class="card ">
                        <div class="card-header latest-update-heading d-flex justify-content-between">
                            <h4 class="latest-update-heading-title text-bold-500">Update Password <h3><b>{{ $masterPassword->update_password }}</b></h3>  </h4>

                        </div>
                      
                    </div>
                </div>
                 <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 latest-update-tracking mt-1 ">
                    <div class="card ">
                        <div class="card-header latest-update-heading d-flex justify-content-between">
                            <h4 class="latest-update-heading-title text-bold-500">Delete Password <h3><b>{{ $masterPassword->delete_password }}</b></h3>  </h4>

                        </div>
                      
                    </div>
                </div>
                 <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12 latest-update-tracking mt-1 ">
                    <div class="card ">
                        <div class="card-header latest-update-heading d-flex justify-content-between">
                            <h4 class="latest-update-heading-title text-bold-500">Approve Password <h3><b>{{ $masterPassword->approve_password }}</b></h3>  </h4>

                        </div>
                      
                    </div>
                </div>


            </div>
        </div>
    </div>


   

@endsection