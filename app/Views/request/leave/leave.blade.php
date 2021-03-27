<?php
use Carbon\Carbon;
?>
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Leave</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add_leave">
                    <span class="text">Add Leave</span>
                </a>
                <div class="table-responsive">
                    <table class=" leave-table table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Date Requested</th>
                            <th>Date From</th>
                            <th>Date To</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($leaves as $leave)
                        <tr>
                            <td>{{strtoupper($leave->employee->lastname . ' ' . $leave->employee->firstname . ' ' . $leave->employee->middle)}}</td>
                            <td>{{Carbon::createFromFormat('Y-m-d H:i:s', $leave->created_at)->format('Y-m-d')}}</td>
                            <td>{{Carbon::createFromFormat('Y-m-d H:i:s', $leave->created_at)->format('Y-m-d')}}</td>
                            <td>{{Carbon::createFromFormat('Y-m-d H:i:s', $leave->created_at)->format('Y-m-d')}}</td>
                            <td>{{$leave->leave_type->name}}</td>
                            <td>{{ucfirst($leave->status)}}</td>
                            <td>
                                <div class="flex">
                                    <a href="#" data-id="{{$leave->id}}"
                                       class="btn btn-success btn-circle btn-sm m-auto accept_leave">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="#" data-id="{{$leave->id}}"
                                       class="btn btn-danger btn-circle btn-sm m-auto reject_leave">
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
       @include('request.leave.partials.add_leave')
       @include('request.leave.partials.accept_leave')
       @include('request.leave.partials.reject_leave')
    </div>
@endsection