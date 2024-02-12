@extends('layout.index')
@section('title', 'edit')

@section('content')
<div class="content">
    <div class="row d-flex justify-content-center align-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-uppercase">Edit Employee</h4>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <div class="card-body p-5">
                        <form action="{{ route('updateEmployee', $employee->id) }}" method="POST" id="editEmployeeForm">
                        @csrf    
                        @method('PUT')
                            <div class="mb-3">
                                <input type="text" name="name" id="name" class="form-control rounded-1"
                                    value="{{ $employee->name }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" id="email" class="form-control rounded-1"
                                value="{{ $employee->email }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="position" id="position" class="form-control rounded-1"
                                value="{{ $employee->position }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="department" id="department" class="form-control rounded-1"
                                value="{{ $employee->department }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="salary" id="salary" class="form-control rounded-1"
                                value="{{ $employee->salary }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 d-grid">
                                <input type="submit" value="update employee" class="btn btn-dark rounded-1 text-capitalize"
                                    id="update_btn">
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
    $("#editEmployeeForm").submit(function (e) {
        e.preventDefault();
        $("#update_btn").val("please wait..");

        $.ajax({
            url: '{{ route('updateEmployee', $employee->id) }}',
            method: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (res) {
                if (res.status === '200') {
                    // update successful, show a success popup
                    showSuccessPopup(res.messages);
                    $("#update_btn").val("update employee");
                } else if (res.status === '404') {
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