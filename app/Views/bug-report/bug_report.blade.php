@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bug Report</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add_bug_report">
                    <span class="text">Add Bug Report</span>
                </a>
                <div class="table-responsive">
                    <table class="position-table table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Bug / Step</th>
                            <th>Reference</th>
                            <th>Tester</th>
                            <th>Urgency</th>
                            <th>Date Reported</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bugs as $bug)
                            <tr >
                                <td>{{$bug->bug}}</td>
                                <td>
                                    @if($bug->reference!="")
                                        <a href="{{base_url()."/uploads/".$bug->reference}}" target="_blank">View
                                            Image</a>
                                    @endif
                                </td>
                                <td>{{$bug->tester}}</td>
                                <td>{{$bug->urgency}}</td>
                                <td>{{\Illuminate\Support\Carbon::parse($bug->date_reported)->format('Y-m-d')}}</td>
                                <td>{{$bug->remarks}}</td>
                                <td >
                                    <div class="flex">
                                        <a href="#" data-id="{{$bug->id}}" title="Edit"
                                           class="btn btn-primary btn-circle btn-sm m-auto edit_bug_report">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="#" data-id="{{$bug->id}}" title="Mark as Fixed"
                                           class="btn btn-success btn-circle btn-sm m-auto fixed_bug_report">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="#" data-id="{{$bug->id}}"
                                           class="btn btn-danger btn-circle btn-sm m-auto delete_bug_report">
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

        @include('bug-report.partials.add_bug_report')
        @include('bug-report.partials.edit_bug_report')
        @include('bug-report.partials.fixed_bug_report')
        @include('bug-report.partials.delete_bug_report')
    </div>
@endsection