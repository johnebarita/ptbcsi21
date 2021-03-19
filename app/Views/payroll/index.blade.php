@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Payroll</h1>
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
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div>
                    <div class="flex select-md">
                        <div class="flex-sm-grow-1 ">
                            <form action="{{ route_to('payroll.index') }}" method="post">
                                {!! csrf_field() !!}
                                <div class="form-group flex ml-auto">
                                    <label for="half" class="m-auto pr-2">Filter: </label>
                                    <select class="form-control  mr-2 select-small" name="half" id="half">
                                        <option {{ ($half == "A" ? "selected" : '') }}>A</option>
                                        <option {{ ($half == "B" ? "selected" : '') }}>B</option>
                                    </select>
                                    <select class="form-control mr-2 w-50" name="month" id="month">
                                        @foreach (range(1, 12) as $number)
                                            <option value='{{ $number }}' {{ ($month == $number ? 'selected' : '') }} {{$number>\Carbon\Carbon::now()->format('m')?'disabled':''}}>{{ \Carbon\Carbon::createFromFormat('m', $number)->format('F') }}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-control  mr-2 w-25" name="year" id="year">
                                        @foreach (range(date('Y'), 2019, -1) as $y)
                                            <option {{ ($year == $y ? "selected" : '') }}>{{$y}}</option>
                                        @endforeach
                                    </select>
                                    <input type="submit" class="btn btn-primary" value="GO"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div>
                    <div style="height:60vh;width:100%;" class="payroll-table-container">
                        <table id="payroll-table"
                               class=" text-center table payroll-table table-bordered table-condensed ">
                            <thead>
                            <tr>
                                <th rowspan="2">No.</th>
                                <th>Employee</th>
                                <th>Daily</th>
                                <th>Monthly</th>
                                <th>DTR</th>
                                <th># Day(s)</th>
                                <th rowspan="2">Late(min)</th>
                                <th>Basic</th>
                                <th rowspan="2">Allowance</th>
                                <th colspan="2">Normal Day OT</th>
                                <th colspan="8">Rest Day And Sunday Holiday Overtime</th>
                                <th colspan="4">Rest Day and Sunday Holiday</th>
                                <th colspan="6">Holiday Overtime</th>
                                <th colspan="3">Holiday Rate</th>
                                <th>Total hrs</th>
                                <th>Other</th>
                                <th rowspan="2">Gross Pay</th>
                                <th>With</th>
                                <th rowspan="2">Phi</th>
                                <th rowspan="2">SSS</th>
                                <th rowspan="2">HDMF</th>
                                <th>Cash</th>
                                <th>SSS</th>
                                <th>PAG-IBIG</th>
                                <th>Other</th>
                                <th>Total</th>
                                <th rowspan="2">Net Pay</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <th>Rate</th>
                                <th>Rate</th>
                                <th>Time</th>
                                <th>Absent</th>
                                <th>Salary</th>
                                <th># of hrs</th>
                                <th>OT</th>
                                <th># of hrs</th>
                                <th>Sunday OT</th>
                                <th># of hrs</th>
                                <th>Regular OT</th>
                                <th># of hrs</th>
                                <th>Special OT</th>
                                <th># of hrs</th>
                                <th>Double OT</th>
                                <th>Sunday</th>
                                <th>Regular</th>
                                <th>Special</th>
                                <th>Double</th>
                                <th># of hrs</th>
                                <th>Regular OT</th>
                                <th># of hrs</th>
                                <th>Special OT</th>
                                <th># of hrs</th>
                                <th>Double OT</th>
                                <th>Regular</th>
                                <th>Special</th>
                                <th>Double</th>
                                <th>OT</th>
                                <th>Income</th>
                                <th>Tax</th>
                                <th>Advance</th>
                                <th>Loan</th>
                                <th>Loan</th>
                                <th>Deduction</th>
                                <th>Deduction</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 1;
                            $phi = 0;
                            $sss = 0;
                            $hdmf = 0;
                            $total_deductions = 0;
                            $total_pay = 0;
                            ?>
                            @foreach ($positions as $position)
                                <tr class="text-left">
                                    <th colspan="46"
                                        class="bg-position">
                                        <i class="fas fa-users fa-sm"></i>
                                        {{ ucfirst($position->position) }}</th>
                                </tr>
                                @foreach ($position->employees as $employee)
                                    <?php
                                    $payroll = $employee->payrolls->first();
                                    $can_ot = "strikethrough";

                                    ?>
                                    <tr class="{{ ($employee->is_fixed_salary == 1 ? 'fixed-salary' : '') }}">
                                        <th>{{ $count++}}</th>
                                        <th>{{ strtoupper($employee->lastname . ' ' . $employee->firstname)}}
                                            <span class="font-italic font-weight-lighter">{{ ($employee->is_fixed_salary == 1 ? '(Fixed-salary)' : '') }}</span>
                                        </th>
                                        <td>{{ number_format($employee->basic_pay,2)}}</td>
                                        <td>{{ number_format($employee->monthly_pay,2)}}</td>
                                        <td>{{ ($payroll->dtr_time != 0 ? $payroll->dtr_time : '')}}</td>
                                        <td>{{ ($payroll->absent != 0 ? $payroll->absent : '')}}</td>
                                        <td>{{ ($payroll->late != 0 ? $payroll->late : '')}}</td>
                                        <td>{{ ($payroll->basic_salary != 0 ? number_format($payroll->basic_salary,2) : '')}}</td>
                                        <td>{{ ($payroll->allowance != 0 ? number_format($payroll->allowance,2) : '')}}</td>

                                        <td class="{{ $can_ot }}">{{ ($payroll->normal_ot != 0 ? $payroll->normal_ot : '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->normal_ot_pay != 0 ? number_format($payroll->normal_ot_pay,2) : '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->rd_sunday_ot != 0 ? $payroll->rd_sunday_ot : '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->rd_sunday_pay != 0 ? number_format($payroll->rd_sunday_pay ,2): '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->rd_regular_ot != 0 ? $payroll->rd_regular_ot : '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->rd_regular_pay != 0 ? number_format($payroll->rd_regular_pay ,2): '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->rd_special_ot != 0 ? $payroll->rd_special_ot : '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->rd_special_pay != 0 ? number_format($payroll->rd_special_pay ,2): '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->rd_double_ot != 0 ? $payroll->rd_double_ot : '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->rd_double_pay != 0 ? number_format($payroll->rd_double_pay ,2): '')}}</td>
                                        <td>{{ ($payroll->rd_sunday_pay != 0 ? number_format($payroll->rd_sunday_pay,2) : '')}}</td>
                                        <td>{{ ($payroll->rd_regular_pay != 0 ? number_format($payroll->rd_regular_pay,2) : '')}}</td>
                                        <td>{{ ($payroll->rd_special_pay != 0 ? number_format($payroll->rd_special_pay,2) : '')}}</td>
                                        <td>{{ ($payroll->rd_double_pay != 0 ? number_format($payroll->rd_double_pay,2) : '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->nd_regular_ot != 0 ? $payroll->nd_regular_ot : '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->nd_regular_pay != 0 ? number_format($payroll->nd_regular_pay,2) : '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->nd_special_ot != 0 ? $payroll->nd_special_ot : '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->nd_special_pay != 0 ? number_format($payroll->nd_special_pay,2) : '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->nd_double_ot != 0 ? $payroll->nd_double_ot : '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->nd_double_pay != 0 ? number_format($payroll->nd_double_pay,2) : '')}}</td>
                                        <td>{{ ($payroll->nd_regular_pay != 0 ? number_format($payroll->nd_regular_pay,2) : '')}}</td>
                                        <td>{{ ($payroll->nd_special_pay != 0 ? number_format($payroll->nd_special_pay,2) : '')}}</td>
                                        <td>{{ ($payroll->nd_double_pay != 0 ? number_format($payroll->nd_double_pay,2) : '')}}</td>
                                        <td class="{{ $can_ot }}">{{ ($payroll->total_ot != 0 ? $payroll->total_ot : '')}}</td>

                                        <td>{{ ($payroll->other_income != 0 ? $payroll->other_income : '')}}</td>
                                        <td>{{ ($payroll->gross_pay != 0 ? number_format($payroll->gross_pay,2) : '')}}</td>
                                        <td>{{ ($payroll->with_tax != 0 ? $payroll->with_tax : '')}}</td>
                                        <td>{{ ($payroll->phi != 0 ? $payroll->phi : '')}}</td>
                                        <td>{{ ($payroll->sss != 0 ? $payroll->sss : '')}}</td>
                                        <td>{{ ($payroll->hdmf != 0 ? $payroll->hdmf : '')}}</td>
                                        <td>{{ ($payroll->cash_advance != 0 ? $payroll->cash_advance : '')}}</td>
                                        <td>{{ ($payroll->sss_loan != 0 ? $payroll->sss_loan : '')}}</td>
                                        <td>{{ ($payroll->hdmf_loan != 0 ? $payroll->hdmf_loan : '')}}</td>
                                        <td>{{ ($payroll->other_deduction != 0 ? $payroll->other_deduction : '')}}</td>
                                        <td>{{ ($payroll->total_deduction != 0 ? $payroll->total_deduction : '')}}</td>
                                        <td>{{ ($payroll->net_pay != 0 ? number_format($payroll->net_pay,2) : '')}}</td>
                                        <td>
                                            <div class="flex ml-2 mr-2">
                                                <a href="#" data-id="{{$payroll->id}}"
                                                   class="btn btn-primary btn-circle btn-sm btn-xs edit_payroll">
                                                    <i class="fas fa-pen fa-xs"></i>
                                                </a>
                                                <a href="#" data-id="" class="btn btn-primary btn-circle btn-sm btn-xs">
                                                    <i class="fas fa-sticky-note fa-xs"></i>
                                                </a>
                                                <a href="#" data-id="" class="btn btn-primary btn-circle btn-sm btn-xs">
                                                    <i class="fas fa-file-invoice fa-xs"></i>
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                    <?php
                                    $phi += $payroll->phi;
                                    $sss += $payroll->sss;
                                    $hdmf += $payroll->hdmf;
                                    $total_deductions += $payroll->total_deduction;
                                    $total_pay += $payroll->net_pay;
                                    ?>
                                @endforeach
                            @endforeach
                            <tr>
                                <th colspan="2"></th>
                                <td colspan="34" class="text-right">TOTAL :</td>
                                <td>{{ $phi }}</td>
                                <td>{{ $sss }}</td>
                                <td>{{ $hdmf }}</td>
                                <td></td>
                                <td></td>
                                <td style="background-color: white !important;"></td>
                                <td></td>
                                <td>{{ $total_deductions }}</td>
                                <td style="background-color: white !important;">{{ $total_pay }}</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('payroll.partials.edit_payroll')
    </div>
@endsection