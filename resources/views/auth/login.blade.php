@extends('layout.app')
@section('title', 'Login')


@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-lg-4 text-center">
            <h1 class="fw-bold text-secondary text-uppercase">Welcome to Employee Management System</h1>
        </div> 
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="fw-4 text-secondry text-center text-uppercase">
                        login
                        <hr>
                    </h2>
                    <div class="card-body p-5">
                        <form action="{{ route('auth.login') }}" method="post" id="login_form">
                            @csrf
                            <div class="mb-3">
                                <input type="email" name="email" id="email" class="form-control rounded-1" placeholder="email">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" id="password" class="form-control rounded-1" placeholder="password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <a href="/forgot" class="text-decoration-none text-capitalize">forgot password?</a>
                            </div>
                            <div class="mb-3 d-grid">
                                <input type="submit" value="login" class="btn btn-dark rounded-1 text-capitalize" id="login_btn">
                            </div>
                            <div class="text-center text-secondary mb-3">
                                <div>Don't have an account? <a href="/register" class="text-decoration-none">Register here</a></div>
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
        $("#login_form").submit(function(e){
            e.preventDefault();
            $('#login_btn').val('please wait...');

            $.ajax({
                url: '{{ route('auth.login') }}',
                method: 'post',
                data: $(this).serialize(),
                dataType: 'json', 
                success: function(res){
                    if (res.status === 200) {
                        // show Login successful
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: res.messages,
                        }).then(function() {
                            // redirect to another page or perform additional actions here
                            window.location.href = 'dashboard';
                        });
                    } else {
                        // show Login failed
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: res.messages,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred during login.',
                    });
                }
            });
        });
    });
</script>

@endsection