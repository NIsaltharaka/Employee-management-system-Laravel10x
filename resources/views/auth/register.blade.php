@extends('layout.app')
@section('title', 'Register')

@section('content')

<div class="container-fluid">
    <div class="row d-flex justify-content-center align-content-center min-vh-100">
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="fw-4 text-secondry text-center text-uppercase">
                        register
                        <hr>
                    </h2>
                    <div class="card-body p-5">
                        <form action="{{ route('auth.register') }}" method="POST" id="register_form">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="name" id="name" class="form-control rounded-1"
                                    placeholder="Full name">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" id="email" class="form-control rounded-1"
                                    placeholder="Email">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" id="password" class="form-control rounded-1"
                                    placeholder="Password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="cpassword" id="cpassword" class="form-control rounded-1"
                                    placeholder="Confirm password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 d-grid">
                                <input type="submit" value="register" class="btn btn-dark rounded-1 text-capitalize"
                                    id="register_btn">
                            </div>
                            <div class="text-center text-secondary mb-3">
                                <div>Already have an account? <a href="/" class="text-decoration-none">Login here</a>
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
    $(function () {
        $("#register_form").submit(function (e) {
            e.preventDefault();
            $("#register_btn").val("please wait..");

            $.ajax({
                url: '{{ route('auth.register') }}',
                method: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status === '200') {
                        // Registration successful, show a success popup
                        showSuccessPopup(res.messages);
                        window.location.href = '/';
                    } else if (res.status === '400') {
                        // Validation failed, show an error popup
                        showErrorPopup(res.messages);
                    }
                }
            });
        });

        function showSuccessPopup(messages) {
            // Display a success message in a popup
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: messages,
            });
        }

        function showErrorPopup(messages) {
            // Display the error message in a popup
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: messages,
            });
        }
    });
</script>
@endsection