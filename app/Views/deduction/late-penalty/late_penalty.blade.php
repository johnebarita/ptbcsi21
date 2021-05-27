@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Late Penalty</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add_late_penalty">
                    <span class="text">Add Late Penalty</span>
                </a>
                <div class="table-responsive">
                    <table class="late-penalty-table table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>From (h:m)</th>
                            <th>To (h:m)</th>
                            <th>Equivalent (h:m)</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($late_penalties as $penalty)
                                <tr>
                                    <td>{{$penalty->from}}</td>
                                    <td>{{$penalty->to}}</td>
                                    <td>{{$penalty->equivalent}}</td>
                                    <td>
                                        <div class="flex">
                                            <a href="#" data-id="{{$penalty->id}}" title="Edit"
                                               class="btn btn-success btn-circle btn-sm m-auto edit_penalty">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a href="#" data-id="{{$penalty->id}}"
                                               class="btn btn-danger btn-circle btn-sm m-auto delete_penalty">
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
        @include('deduction.late-penalty.partials.add_late_penalty')
        @include('deduction.late-penalty.partials.edit_late_penalty')
        @include('deduction.late-penalty.partials.delete_late_penalty')
    </div>
@endsection