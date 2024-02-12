@extends('layout.index')
@section('title', 'table')
@section('nav')
@section('header')
@section('content')


<div class="content">
    <div class="row d-flex justify-content-center align-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-uppercase"> Employee Table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary ">
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
                                <th class="text-center">
                                    Action
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
                                    <td class="text-center">
                                        <a href="{{ route('edit', ['id' => $employee->id]) }}"
                                            class="btn btn-secondary btn-sm rounded-1">
                                            <i class="fas fa-edit"></i> 
                                        </a>
                                        <a href="{{ route('employee.destroy', ['id' => $employee->id]) }}"
                                            class="btn btn-danger btn-sm rounded-1">
                                            <i class="fas fa-trash-alt"></i> 
                                        </a>
                                        <a href="{{ route('showemployee', ['id' => $employee->id]) }}"
                                            class="btn btn-info btn-sm rounded-1">
                                            <i class="fas fa-eye"></i> 
                                        </a>
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
</div>

@endsection

@section('script')
@endsection