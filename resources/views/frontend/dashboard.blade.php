@extends('layout.index')
@section('title', 'dashboard')
@section('nav')
@section('header')
@section('content')


<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-uppercase">Employees</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>
                                    Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Position
                                </th>
                                <th>
                                    Department
                                </th>
                                <th>
                                    Salary
                                </th>
                            </thead>
                            @foreach($employees as $employee)
                            <tbody>
                                <tr>
                                    <td>
                                    {{ $employee->name }}
                                    </td>
                                    <td>
                                    {{ $employee->email }}
                                    </td>
                                    <td>
                                    {{ $employee->position }}
                                    </td>
                                    <td>
                                    {{ $employee->department }}
                                    </td>
                                    <td>
                                    {{ $employee->salary }}
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <div class="row d-flex justify-content-center align-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-uppercase">total employees and users</h4>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="card-body p-5">
                        <div style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap;">
                            <div style="flex: 1; margin: 10px; padding: 20px; border: 1px solid #ccc; border-radius: 9px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); ">
                                <h5 class="text-center">Total Users: {{ $totalUsers }}</h5>
                            </div>
                            <div style="flex: 1; margin: 10px; padding: 20px; border: 1px solid #ccc; border-radius: 9px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <h5 class="text-center">Total Employees: {{ $totalEmployees }}</h5>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
 @endsection


@section('script')
@endsection