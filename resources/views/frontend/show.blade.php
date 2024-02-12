@extends('layout.index')
@section('title', 'show')
@section('nav')
@section('header')

@section('content')
<div class="content">
    <div class="row d-flex justify-content-center align-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-uppercase">Employee NO : {{ $employee->id }} </h4>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="card-body p-5">
                            <form action="" method="POST" id="showEmployeeForm">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name : </label>
                                    <label for="name" class="form-label">{{ $employee->name }} </label>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Email : </label>
                                    <label for="name" class="form-label">{{ $employee->email }} </label>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Position : </label>
                                    <label for="name" class="form-label">{{ $employee->position }} </label>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Department : </label>
                                    <label for="name" class="form-label">{{ $employee->department }} </label>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Salary : </label>
                                    <label for="name" class="form-label">{{ $employee->salary }} </label>
                                </div>
                                <div class="mb-3 d-grid">
                                    <input type="submit" value="print" class="btn btn-dark rounded-1 text-capitalize"
                                        id="print_btn">
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
    //print
        document.getElementById('showEmployeeForm').addEventListener('submit', function (e) {
            e.preventDefault();
            hideElementsBeforePrint();
            window.print();
            showElementsAfterPrint();
        });

        //hide element by using id
        function hideElementsBeforePrint() {
            document.getElementById('print_btn').style.display = 'none';
            document.getElementById('logo').style.display = 'none';
            document.getElementById('nav').style.display = 'none';
        }

        function showElementsAfterPrint() {
            document.getElementById('print_btn').style.display = 'block';
            document.getElementById('logo').style.display = 'block';
            document.getElementById('nav').style.display = 'block';
        }
    </script>
@endsection