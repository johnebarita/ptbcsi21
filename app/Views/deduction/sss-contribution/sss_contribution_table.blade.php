@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">SSS Contribution Table </h1>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show " role="alert">
                {{ session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-body">
                <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add_sss_lookup">
                    <span class="text">Add SSS Lookup</span>
                </a>
                <table class="sss-contribution-table w-100 table-bordered">
                    <thead>
                    <tr>
                        <th rowspan="2" colspan="2" >Compensation</th>
                        <th rowspan="2">Salary</th>
                        <th colspan="7">Employer - Employee</th>
                    </tr>
                    <tr>
                        <th colspan="3">Social Security</th>
                        <th>EC</th>
                        <th colspan="3">Total Contribution</th>
                    </tr>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Credit</th>
                        <th>ER</th>
                        <th>EE</th>
                        <th>Total</th>
                        <th>ER</th>
                        <th>ER</th>
                        <th>EE</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sss_lookup as $sss)
                        <tr>
                            <td>{{number_format($sss->from,2)}}</td>
                            <td>{{$sss->to==100000?'Over':number_format($sss->to,2)}}</td>
                            <td>{{number_format($sss->salary_credit,2)}}</td>
                            <td>{{number_format($sss->ss_er,2)}}</td>
                            <td>{{number_format($sss->ss_ee,2)}}</td>
                            <td>{{number_format($sss->ss_total,2)}}</td>
                            <td>{{number_format($sss->ec_er,2)}}</td>
                            <td>{{number_format($sss->tc_er,2)}}</td>
                            <td>{{number_format($sss->tc_ee,2)}}</td>
                            <td>{{number_format($sss->tc_total,2)}}</td>
{{--                            <td>--}}
{{--                                <div class="flex">--}}
{{--                                    <a href="#" data-id="{{$sss->id}}"  title="Edit"--}}
{{--                                       class="btn btn-success btn-circle btn-sm m-auto edit_sss_lookup btn-xs">--}}
{{--                                        <i class="fas fa-pen fa-xs"></i>--}}
{{--                                    </a>--}}
{{--                                    <a href="#" data-id="{{$sss->id}}"--}}
{{--                                       class="btn btn-danger btn-circle btn-sm m-auto delete_sss_lookup btn-xs">--}}
{{--                                        <i class="fas fa-trash fa-xs"></i>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('deduction.sss-contribution.partials.add_sss_lookup')
        @include('deduction.sss-contribution.partials.edit_sss_lookup')
        @include('deduction.sss-contribution.partials.delete_sss_lookup')
    </div>
@endsection