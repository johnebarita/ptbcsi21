<?php use Carbon\Carbon;?>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Overtime</h1>
        </div>
        @if(session()->has('status'))
            <div class="alert alert-{{session('status')['key']}} alert-dismissible fade show " role="alert">
                {{ session('status')['message']}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add_overtime">
                    <span class="text">Add Overtime</span>
                </a>
                <div class="table-responsive">
                    <table class="overtime-table table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee Name</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($overtimes as $overtime)
                            <tr>
                                <td>{{ Carbon::createFromFormat('Y-m-d H:i:s', $overtime->created_at)->format('Y-m-d')}}</td>
                                <td>{{strtoupper($overtime->employee->lastname . ' ' . $overtime->employee->firstname . ' ' . $overtime->employee->middle)}}</td>
                                <td>{{ Carbon::createFromFormat('G:i', $overtime->overtime_in)->format('h:i A')}}</td>
                                <td>{{ Carbon::createFromFormat('G:i', $overtime->overtime_out)->format('h:i A')}}</td>
                                <td>{{ $overtime->note}}</td>
                                <td>{{ ucfirst($overtime->status)}}</td>
                                <td>
                                    <div class="flex">
                                        <a href="#" data-id="{{$overtime->id}}"
                                           class="btn btn-success btn-circle btn-sm m-auto accept_overtime">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="#" data-id="{{$overtime->id}}"
                                           class="btn btn-danger btn-circle btn-sm m-auto reject_overtime">
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
        @include('request.overtime.partials.add_overtime')
        @include('request.overtime.partials.accept_overtime')
        @include('request.overtime.partials.reject_overtime')
    </div>
@endsection