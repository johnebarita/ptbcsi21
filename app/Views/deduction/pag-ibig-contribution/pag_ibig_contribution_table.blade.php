@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pag-ibig Contribution Table </h1>
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
{{--                <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add_sss_lookup">--}}
{{--                    <span class="text">Add Pag-ibig Lookup</span>--}}
{{--                </a>--}}
                <table class="pag-ibig-contribution-table w-100 table-bordered">
                    <thead>
                    <tr>
                        <th rowspan="2">Year</th>
                        <th colspan="2">Compensation</th>
                        <th rowspan="2">Employeer Share (%)</th>
                        <th rowspan="2">Employee Share (%)</th>
                    </tr>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count = 1;?>
                    @foreach($pag_ibig_lookups as $key=>$lookup)
                        <tr>
{{--                            {{isset($pag_ibig_lookups[$key+1])?($pag_ibig_lookups[$key+1]->from == $lookup->from ? 'rowspan='.++$count:''):''}}--}}
                            <td >{{\Carbon\Carbon::parse($lookup->from)->format('Y')}}</td>
                            <td>{{number_format($lookup->lowest,2)}}</td>
                            <td>{{$lookup->highest==100000?'Over':number_format($lookup->highest,2)}}</td>
                            <td>{{$lookup->employer_share}}</td>
                            <td>{{$lookup->employee_share}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{--        @include('deduction.sss-contribution.partials.add_sss_lookup')--}}
        {{--        @include('deduction.sss-contribution.partials.edit_sss_lookup')--}}
        {{--        @include('deduction.sss-contribution.partials.delete_sss_lookup')--}}
    </div>
@endsection