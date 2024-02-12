@extends('layout.app')
@section('title', 'Reset password')

@section('content')

<div class="container-fluid">
    <div class="row d-flex justify-content-center align-content-center min-vh-100">
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="fw-4 text-secondary text-center text-uppercase">
                        Reset Password
                        <hr>
                    </h2>
                    <div class="card-body p-5">
                        <form action="{{ route('auth.reset') }}" method="POST" id="reset_form">
                            @csrf
                           <input type="hidden" name="email" value="{{ $email }}">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="mb-3">
                                <input type="email" name="email" id="email" class="form-control rounded-1" placeholder="Email" value="{{ $email }}" disabled>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="npassword" id="npassword" class="form-control rounded-1" placeholder="New Password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="cnpassword" id="cnpassword" class="form-control rounded-1" placeholder="Confirm New Password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 d-grid">
                                <button type="submit" class="btn btn-dark rounded-1 text-capitalize" id="reset_btn">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function () {
        $("#reset_form").submit(function (e) {
            e.preventDefault();
            $("#reset_btn").html("Please wait..."); 

            $.ajax({
                url: '{{ route('auth.reset') }}',
                method: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status === 200) {
                        // Success: Show success popup
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: res.messages,
                        });
                    } else {
                        // Error: Show error popup
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: res.messages,
                        });
                    }
                    $('#reset_btn').html('Reset Password'); 
                },
                error: function (err) {
                    // AJAX request failed: Show error popup
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while processing the request.',
                    });
                    $('#reset_btn').html('Reset Password'); 
                }
            });
        });
    });
</script>

@endsection
