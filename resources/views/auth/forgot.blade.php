@extends('layout.app')
@section('title', 'Forgot password')

@section('content')

<div class="container-fluid">
    <div class="row d-flex justify-content-center align-content-center min-vh-100">
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header">
                <h2 class="fw-4 text-secondry text-center text-uppercase">
                        forgot password
                        <hr>
                    </h2>
                    <div class="card-body p-5">
                        <form action="{{ route('auth.forgot') }}" method="post" id="forgot_form">
                            @csrf
                            <div class="mb-3 text-secondary">
                                Enter your email address, and we will send you a link to reset the password.
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" id="email"
                                    class="form-control rounded-1" placeholder="Email">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 d-grid">
                                <input type="submit" value="Reset Password" class="btn btn-dark rounded-1 text-capitalize"
                                    id="forgot_btn">
                            </div>
                            <div class="text-center text-secondary mb-3">
                                <div>Back to <a href="/" class="text-decoration-none">Login page</a>
                                </div>
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
    $(function(){
        $('#forgot_form').submit(function(e){
            e.preventDefault();
            $('#forgot_btn').val('Please wait..');
            $.ajax({
                url: '{{ route('auth.forgot') }}',
                method: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(res){
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
                    $('#forgot_btn').val('Reset Password'); 
                },
                error: function(err) {
                    // AJAX request failed: Show error popup
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while processing the request.',
                    });
                    $('#forgot_btn').val('Reset Password'); 
                }
            });
        });
    });
</script>
@endsection
