@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cash Advance</h1>
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
                <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add_cash_advance">
                    <span class="text">Add Cash Advance</span>
                </a>
                <div class="flex">
                    <div class="table-responsive" style="width: 65% !important;">
                        <input type="hidden" class="{{csrf_token()}}" value="{{csrf_hash()}}">
                        <table class="ca-table table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Bank Name</th>
                                <th>Amount</th>
                                <th>Repayment</th>
                                <th>Balance</th>
                                <th hidden>Purpose</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($cash_advances as $cash_advance)
                                <tr data-id="{{ $cash_advance->id }}"
                                    data-json='{{$cash_advance->cash_advance_details}}'>
                                    <td>{{ $cash_advance->request_date }}</td>
                                    <td>{{ strtoupper($cash_advance->employee->lastname . ' ' . $cash_advance->employee->firstname) }}</td>
                                    <td>{{ $cash_advance->employee->position->position }}</td>
                                    <td>{{ $cash_advance->employee->bank_name }}</td>
                                    <td>{{ $cash_advance->amount }}</td>
                                    <td>{{ $cash_advance->repayment }}</td>
                                    <td>{{ $cash_advance->balance }}</td>
                                    <td hidden>{{ $cash_advance->purpose }}</td>
                                    <td>
                                        <div class="flex">
                                            <a href="#" data-id="{{ $cash_advance->id }}"
                                               class="btn btn-success btn-circle btn-sm m-auto edit_cash_advance">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a href="#" data-id="{{ $cash_advance->id }}"
                                               class="btn btn-danger btn-circle btn-sm m-auto delete_cash_advance">
                                                <i class="fas fa-trash fa-sm"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card ml-3 w-40">
                        <div class="container">
                            <p class="text-center mt-2 " style="font-size: 17px">Cash Advance Details</p>
                            <hr class="ml-auto mr-auto p-0 w-100">
                            <div class="row ca_details">
                                <div class="col">
                                    <p class="m-0">Name: &nbsp<span id="ca_name"></span></p>
                                    <p class="m-0">Amount: &nbsp<span id="ca_amount"></span></p>
                                    <p class="m-0">Balance: &nbsp<span id="ca_balance"></span></p>
                                    <p class="m-0">Purpose: &nbsp<span id="ca_purpose"></span></p>
                                </div>
                                <div class="col">
                                    <p class="m-0">Date: &nbsp<span id="ca_request_date"></span></p>
                                    <p class="m-0">Repayment: &nbsp<span id="ca_repayment"></span></p>
                                    <p class="m-0">Paid?: &nbsp<span id="ca_paid"></span></p>
                                </div>
                            </div>
                            <div class="mt-1 mb-3">
                                <table class="ca-details-table w-100 table-bordered ">
                                    <thead>
                                    <tr>
                                        <th class="pl-2">Payroll Date Range</th>
                                        <th class="pl-2">Payroll #</th>
                                        <th class="pl-2">Amount Pay</th>
                                        <th class="pl-2">Balance</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center">No data available in table</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('cash-advance.partials.add_cash_advance')
        @include('cash-advance.partials.edit_cash_advance')
    </div>
@endsection