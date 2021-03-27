<?php
use App\Models\Eloquent\Leave;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
?>

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">DTR</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div>
                    <div class="flex">
                        <div class="flex-sm-grow-1">
                            <form action="{{route_to('dtr.index')}}" method="post">
                                @csrf
                                <div class="form-group flex ml-auto">
                                    <label for="half" class="m-auto pr-2">Filter: </label>
                                    <select class="form-control  mr-2 select-small" name="half" id="half">
                                        <option {{($half == "A" ? "selected" : '') }}>A</option>
                                        <option {{($half == "B" ? "selected" : '') }}>B</option>
                                    </select>
                                    <select class="form-control mr-2 w-50" name="month" id="month">
                                        @foreach (range(1, 12) as $number)
                                            <option value='{{$number}}' {{($month == $number ? 'selected' : '')}}>{{ \Carbon\Carbon::createFromFormat('m', $number)->format('F') }}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-control  mr-2 w-25" name="year" id="year">
                                        @foreach (range(date('Y'),2019,-1) as $y)
                                            <option {{($year == $y ? "selected" : '') }}>{{$y}}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-control mr-2 " type="text" id="employee_id" name="employee_id">
                                        @foreach ($employees as $employee)
                                            <option value={{$employee->id}} {{($employee_id == $employee->id ? 'selected' : '')}}>{{strtoupper($employee->lastname . ' ' . $employee->firstname . ' ' . $employee->middle)}}</option>
                                        @endforeach
                                    </select>
                                    <input type="submit" class="btn btn-primary" value="GO"/>
                                </div>
                            </form>
                        </div>
                        <div class="flex-sm-grow-1">
                            <div class="flex">
                                <div class="form-group flex ml-auto">
                                    <label class="mr-5">
                              <span>
                                  <i class=" text-primary far fa-clock"></i>
                                  Time:
                                  <text id="time_display"></text>
                              </span>
                                    </label>
                                    <label class="">
                              <span>
                                  <i class="text-primary far fa-calendar-alt"></i>
                                  Date: {{Carbon::now("GMT+8")->format("l  F d, Y")}}
                              </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="form-group flex ml-auto mb-0">
                            <label class="pl-3 ">Leave:<span class="text-primary">____</span></label>
                            <label class="pl-3 ">Absent:<span class="text-primary">____</span></label>
                            <label class="pl-3 ">Over Time:<span class="text-primary">____</span></label>
                            <label class="pl-3 ">Under Time:<span
                                        class="text-primary">____</span></label>
                            <label class="pl-3 ">Late:<span class="text-primary">____</span></label>
                        </div>
                    </div>
                </div>
                <div>
                    <table class="dtr-table text-center w-100">
                        <tr>
                            <th colspan="2" class="half-month">Half Month</th>
                            <th colspan="2" class="w-20">Morning</th>
                            <th></th>
                            <th colspan="2" class="  w-20">Afternoon</th>
                            <th></th>
                            <th colspan="2" class="  w-20">Overtime</th>
                            <th></th>
                            <th colspan="3" class="  total-time">Total Time</th>
                        </tr>
                        <tr class="text-center">
                            <th colspan="2">Days</th>
                            <th class="half-month">In</th>
                            <th class="half-month">Out</th>
                            <th>Time</th>
                            <th class="half-month">In</th>
                            <th class="half-month">Out</th>
                            <th>Time</th>
                            <th class="half-month">In</th>
                            <th class="half-month">Out</th>
                            <th>Time</th>
                            <th>Pre</th>
                            <th>Ot</th>
                            <th>Late</th>
                        </tr>

                        <?php
                        $now = Carbon::now()->format('Y-m-d');
                        $pre = 0;
                        $ot = 0;
                        $late = 0;
                        $periods = CarbonPeriod::create($year . '-' . $month . '-' . $start, $year . '-' . $month . '-' . $end);
                        ?>
                        @foreach ($periods as $period)
                            <?php
                            $d = $period->format('d');
                            $date = $period->format('Y-m-d');
                            $D = $period->format('D');
                            $leave = Leave::where('employee_id', $employee_id)->whereRaw('? between request_start and request_end', [$date])->where('status', 'accepted')->first();
                            $time_sheet = (count($time_sheets) ? $time_sheets->where('date', '=', Carbon::parse($date))->first() : null);

                            $holiday = (count($holidays) ? $holidays->where('start', $date)->first() : null);
                            ?>
                            <tr class="{{ (($holiday) ? 'holiday' : ($D == "Sun" ? 'sunday' : ''))}}" {{($holiday) ? 'data-toggle="tooltip" data-placement="top" title="' . $holiday->name . '"' : ''}}>
                                <td class="">{{ $d }}</td>
                                <td class="">{{ $D }}</td>
                                @if ($leave)
                                    <td colspan="9" class="text-center justify-content-center leave">ON LEAVE</td>
                                    <td>8.00</td>
                                    <td></td>
                                    <td></td>
                                    <?php  $pre += (isset($time_sheet) ? ((float)$time_sheet->pre) : 0);?>
                                @elseif (!$time_sheet && $D != "Sun" && $now > $date && $employee_id != 0)
                                    <td colspan="9" class="text-center justify-content-center absent">ABSENT</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                @else
                                    <td>
                                        <div class="flex-center">
                                            <input type="text" class="time_input"
                                                   value="{{ (isset($time_sheet) ? substr($time_sheet->morning_in, 0, 2) : '')}}">:
                                            <input type="text" class="time_m_input"
                                                   value="{{ (isset($time_sheet) ? substr($time_sheet->morning_in, 3) : '')}}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-center">
                                            <input type="text" class="time_h_input"
                                                   value="{{ (isset($time_sheet) ? substr($time_sheet->morning_out, 0, 2) : '')}}">:
                                            <input type="text" class="time_m_input"
                                                   value="{{ (isset($time_sheet) ? substr($time_sheet->morning_out, 3) : '')}}">
                                        </div>
                                    </td>
                                    <td>{{ (isset($time_sheet) ? ($time_sheet->morning_time) : '')}}</td>
                                    <td>
                                        <div class="flex-center">
                                            <input type="text" class="time_h_input"
                                                   value="{{ (isset($time_sheet) ? substr($time_sheet->afternoon_in, 0, 2) : '')}}">:
                                            <input type="text" class="time_m_input"
                                                   value="{{ (isset($time_sheet) ? substr($time_sheet->afternoon_in, 3) : '')}}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-center">
                                            <input type="text" class="time_h_input"
                                                   value="{{ (isset($time_sheet) ? substr($time_sheet->afternoon_out, 0, 2) : '')}}">:
                                            <input type="text" class="time_m_input"
                                                   value="{{ (isset($time_sheet) ? substr($time_sheet->afternoon_out, 3) : '')}}">
                                        </div>
                                    </td>
                                    <td>{{ (isset($time_sheet) ? ($time_sheet->afternoon_time) : '')}}</td>
                                    <td>
                                        <div class="flex-center">
                                            <input type="text" class="time_h_input"
                                                   value="{{ (isset($time_sheet) ? substr($time_sheet->overtime_in, 0, 2) : '')}}">:
                                            <input type="text" class="time_m_input"
                                                   value="{{ (isset($time_sheet) ? substr($time_sheet->overtime_in, 3) : '')}}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex-center">
                                            <input type="text" class="time_h_input"
                                                   value="{{ (isset($time_sheet) ? substr($time_sheet->overtime_out, 0, 2) : '')}}">:
                                            <input type="text" class="time_m_input"
                                                   value="{{ (isset($time_sheet) ? substr($time_sheet->overtime_out, 3) : '')}}">
                                        </div>
                                    </td>
                                    <td>{{ (isset($time_sheet) ? ($time_sheet->overtime_time) : '')}}</td>
                                    <td>{{ (isset($time_sheet) ? ($time_sheet->pre) : '')}}</td>
                                    <td>{{ (isset($time_sheet) ? ($time_sheet->ot) : '')}}</td>
                                    <td>{{ (isset($time_sheet) ? ($time_sheet->late) : '')}}</td>
                                    <?php
                                    $pre += (isset($time_sheet) ? ((float)$time_sheet->pre) : 0);
                                    $ot += (isset($time_sheet) ? ((float)$time_sheet->ot) : 0);
                                    $late += (isset($time_sheet) ? ((float)$time_sheet->late) : 0);
                                    ?>
                                @endif
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="11" class="text-right">Total Time:</td>
                            <td>{{$pre }}</td>
                            <td>{{$ot }}</td>
                            <td>{{$late }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection