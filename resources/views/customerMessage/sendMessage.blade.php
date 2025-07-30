@extends('user_navbar')
@section('content')


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

            <style>
                .blur-bg {
                    filter: blur(5px);
                    pointer-events: none;
                    user-select: none;
                }
            
                .modal-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100vw;
                    height: 100vh;
                    background: rgba(0, 0, 0, 0.4);
                    z-index: 1000;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
            
                .progress-modal {
                    background: #fff;
                    padding: 38px 40px;
                    border-radius: 16px;
                    box-shadow: 0 8px 38px #0002;
                    text-align: center;
                    min-width: 320px;
                    font-size: 1.35em;
                    font-weight: 600;
                    color: #079f2d;
                }
            
                .spinner-border {
                    width: 2rem;
                    height: 2rem;
                    margin-bottom: 14px;
                }
            </style>   
            
          

            <div class="container py-5"  style="max-width: 540px;">
                <div class="card shadow-lg rounded-4 border-0">
                    <div class="card-body p-4">
                        <div class="mb-4 text-center">
                            <i class="fa fa-whatsapp" style="font-size:2.7rem; color: #25D366;"></i>
                            <h3 class="mb-2 mt-2 fw-bold" style="letter-spacing: 1px;">Send WhatsApp Message to All
                                Customers</h3>
                            <div class="text-muted" style="font-size:.98em;">Broadcast your update or promo to every
                                customer in
                                your database!</div>
                        </div>

                        @if(session('success'))
                        <div class="alert alert-success text-center mb-3 rounded-pill px-4 py-2">
                            {{ session('success') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('send.message.submit') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="message" class="form-label fw-semibold">Message</label>
                                <textarea name="message" id="message" rows="5" class="form-control rounded-3"
                                    placeholder="Type your WhatsApp message here..." required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label fw-semibold">Attach File (PDF, JPG, PNG,
                                    optional)</label>
                                <input type="file" class="form-control rounded-3" name="file" id="file"
                                    accept=".pdf, .jpg, .jpeg, .png">
                            </div>
                            <button id="sendButton" onclick="checkoutSale()" class="btn btn-success btn-lg w-100 rounded-pill fw-bold"
                                style="letter-spacing:1px;">
                                <i class="fab fa-whatsapp me-1"></i> Send to All Customers
                            </button>
                        </form>
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
                        Sending Messages , Please wait & DoNot close the tab
                    </span>
                </div>
            </div>        




        </div>
    </div>
</div>

<script>
    function checkoutSale() {
document.getElementById('loading-overlay').style.display = 'flex';
        const btn = document.getElementById('sendButton');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';
        btn.form.submit();
    }
 
    </script>  


@endsection