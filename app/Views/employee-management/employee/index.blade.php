@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Employee</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add_employee">
                    <span class="text">Add Employee</span>
                </a>
                <div class="table-responsive">
                    <table class="employee-table table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Position</th>
                            <th>Schedule</th>
                            <th>Member Since</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($employees as $employee)
                        <tr>
                            <td>{{strtoupper($employee->lastname . ' ' . $employee->firstname . ' ' . $employee->middle)}}</td>
                            <td>{{$employee->position->position}}</td>
                            <td>
                                {{\Carbon\Carbon::createFromFormat('G:i', $employee->position->schedule->time_in)->format('h:i A') . ' - ' .
                                \Carbon\Carbon::createFromFormat('G:i', $employee->position->schedule->time_out)->format('h:i A')}}
                            </td>
                            <td>{{$employee->date_hired}}</td>
                            <td>
                                <div class="flex">
                                    <a href="#" class="btn btn-primary btn-circle btn-sm m-auto">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-success btn-circle btn-sm m-auto">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-circle btn-sm m-auto">
                                        <i class="fas fa-trash fa-sm"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('employee-management.employee.partials.add_employee')
    </div>
@endsection