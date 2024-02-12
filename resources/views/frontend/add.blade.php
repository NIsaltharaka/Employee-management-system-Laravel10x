@extends('layout.index')
@section('title', 'Add')
@section('nav')
@section('header')
@section('content')

<div class="content">
    <div class="row d-flex justify-content-center align-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-uppercase"> Add Employee</h4>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <div class="card-body p-5">
                        <form action="{{ route('frontend.add') }}" method="POST" id="addEmployeeForm">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="name" id="name" class="form-control rounded-1"
                                    placeholder="name">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" id="email" class="form-control rounded-1"
                                    placeholder="Email">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="position" id="position" class="form-control rounded-1"
                                    placeholder="position">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="department" id="department" class="form-control rounded-1"
                                    placeholder="department">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="salary" id="salary" class="form-control rounded-1"
                                    placeholder="salary">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 d-grid">
                                <input type="submit" value="add employee" class="btn btn-dark rounded-1 text-capitalize"
                                    id="add_btn">
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
        $("#addEmployeeForm").submit(function (e) {
            e.preventDefault();
            $("#add_btn").val("please wait..");

            $.ajax({
                url: '{{ route('frontend.add') }}',
                method: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status === '200') {
                        // add successful, show a success popup
                        showSuccessPopup(res.messages);
                        $("#add_btn").val("add employee");
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