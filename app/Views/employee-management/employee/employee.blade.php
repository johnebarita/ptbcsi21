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
                                    {{\Carbon\Carbon::createFromFormat('G:i', $employee->position->schedule->morning_in)->format('h:i A').' - '.
                                      \Carbon\Carbon::createFromFormat('G:i', $employee->position->schedule->afternoon_out)->format('h:i A').''}}
                                    (<span>
                                        @foreach(explode(',',$employee->position->schedule->working_days) as $key=>$day)
                                            <?php $first = new \Carbon\Carbon('first Monday of January');?>
                                            {{$first->addDays($day)->format('D')}}
                                            @if($key<count(explode(',',$employee->position->schedule->working_days))-1)
                                                {{',  '}}
                                            @endif
                                        @endforeach
                                    </span>)
                                </td>
                                {{--                                <td>{{$employee->date_hired}}</td>--}}
                                <td>{{\Carbon\Carbon::now()->format('Y-m-d')}}</td>
                                <td>
                                    <div class="flex">
                                        <a href="#" class="btn btn-primary btn-circle btn-sm m-auto view_employee"
                                           data-id="{{$employee->id}}">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="#" class="btn btn-success btn-circle btn-sm m-auto edit_employee"
                                           data-id="{{$employee->id}}">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        @if($employee->trashed())
                                            <a href="#" class="btn btn-warning btn-circle btn-sm m-auto restore_employee"
                                               data-id="{{$employee->id}}">
                                                <i class="fas fa-trash-restore"></i>
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-danger btn-circle btn-sm m-auto delete_employee"
                                               data-id="{{$employee->id}}">
                                                <i class="fas fa-trash fa-sm"></i>
                                            </a>
                                        @endif
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
        @include('employee-management.employee.partials.view_employee')
        @include('employee-management.employee.partials.edit_employee')
        @include('employee-management.employee.partials.delete_employee')
        @include('employee-management.employee.partials.restore_employee')
    </div>
@endsection