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
            <div class="card-body mt-3">
                <div>
                    <div class="flex">
                        <div class="flex-sm-grow-1">
                            <form action="{{route_to('dtr.index')}}" id="filter" method="post">
                                @csrf
                                <div class="form-group flex ml-auto">
                                    <label for="half" class="m-auto pr-2">Filter: </label>
                                    <select class="form-control  mr-2 select-small" name="half" id="half">
                                        <option {{($half == "A" ? "selected" : '') }}>A</option>
                                        <option {{($half == "B" ? "selected" : '') }}>B</option>
                                    </select>
                                    <select class="form-control mr-2 w-50" name="month" id="month">
                                        @foreach (range(1, 12) as $number)
                                            <option value='{{ $number }}' {{ ($month == $number ? 'selected' : '') }} {{$number>\Carbon\Carbon::now()->format('m')?'disabled':''}}>{{ \Carbon\Carbon::create()->day(1)->month($number)->format('F')}}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-control  mr-2 w-25" name="year" id="year">
                                        @foreach (range(date('Y'),2019,-1) as $y)
                                            <option {{($year == $y ? "selected" : '') }}>{{$y}}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-control mr-2 " type="text" id="selected_employee"
                                            name="selected_employee">
                                        @foreach ($employees as $employee)
                                            <option value={{$employee->id}} {{($selected_employee == $employee->id ? 'selected' : '')}}>{{strtoupper($employee->lastname . ' ' . $employee->firstname . ' ' . $employee->middle)}}</option>
                                        @endforeach
                                    </select>
                                    <input type="submit" form="filter" class="btn btn-primary" value="GO"/>
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
                        <form action="{{route_to('dtr.update')}}" method="post" id="edit_dtr">
                            @csrf
                            <input hidden type="text" name="half" value="{{$half}}">
                            <input hidden type="text" name="month" value="{{$month}}">
                            <input hidden type="text" name="year" value="{{$year}}">
                            <input hidden type="text" name="selected_employee" value="{{$selected_employee}}">
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
                                $leave = Leave::where('employee_id', $selected_employee)->whereRaw('? between request_start and request_end', [$date])->where('status', 'accepted')->first();
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
                                    @elseif (!$time_sheet && $D != "Sun" && $now > $date && $selected_employee != 0)
                                        <td colspan="9" class="text-center justify-content-center absent">ABSENT</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @else
                                        <td data-time="{{$time_sheet->morning_in??"null"}}">
                                            <div class="flex-center">
                                                <input type="text" class="time_h_input" {{$date>$now?'disabled':''}}
                                                {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}}
                                                value="{{ (isset($time_sheet->morning_in) ? substr(Carbon::createFromFormat('G:i',$time_sheet->morning_in)->format('h:i'), 0, 2) : '')}}">:
                                                <input type="text" class="time_m_input" {{$date>$now?'disabled':''}}
                                                {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}}
                                                value="{{ (isset($time_sheet->morning_in) ? substr(Carbon::createFromFormat('G:i',$time_sheet->morning_in)->format('h:i'), 3) : '')}}">
                                            </div>
                                        </td>
                                        <td data-time="{{$time_sheet->morning_out??"null"}}">
                                            <div class="flex-center">
                                                <input type="text" class="time_h_input" {{$date>$now?'disabled':''}}
                                                {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}}
                                                value="{{ (isset($time_sheet->morning_out) ? substr(Carbon::createFromFormat('G:i', $time_sheet->morning_out)->format('h:i'), 0, 2) : '')}}">:
                                                <input type="text" class="time_m_input" {{$date>$now?'disabled':''}}
                                                {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}}
                                                value="{{ (isset($time_sheet->morning_out) ? substr(Carbon::createFromFormat('G:i', $time_sheet->morning_out)->format('h:i'), 3) : '')}}">
                                            </div>
                                        </td>
                                        <td>
                                            <span class="m_time">{{ (isset($time_sheet) ? ($time_sheet->morning_time) : '')}}</span>
                                            <input type="text" hidden
                                                   value="{{ (isset($time_sheet) ? ($time_sheet->morning_time) : '')}}"
                                                   {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}}  class="m_time_i">
                                        </td>
                                        <td data-time ="{{$time_sheet->afternoon_in??"null"}}">
                                            <div class="flex-center">
                                                <input type="text" class="time_h_input" {{$date>$now?'disabled':''}}
                                                {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}}
                                                value="{{ (isset($time_sheet->afternoon_in) ? substr(Carbon::createFromFormat('G:i', $time_sheet->afternoon_in)->format('h:i'), 0, 2) : '')}}">:
                                                <input type="text" class="time_m_input" {{$date>$now?'disabled':''}}
                                                {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}}
                                                value="{{ (isset($time_sheet->afternoon_in) ? substr(Carbon::createFromFormat('G:i', $time_sheet->afternoon_in)->format('h:i'), 3) : '')}}">
                                            </div>
                                        </td>
                                        <td data-time="{{$time_sheet->afternoon_out??"null"}}">
                                            <div class="flex-center">
                                                <input type="text" class="time_h_input" {{$date>$now?'disabled':''}}
                                                {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}}
                                                value="{{ (isset($time_sheet->afternoon_out) ? substr(Carbon::createFromFormat('G:i', $time_sheet->afternoon_out)->format('h:i'), 0, 2) : '')}}">:
                                                <input type="text" class="time_m_input" {{$date>$now?'disabled':''}}
                                                {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}}
                                                value="{{ (isset($time_sheet->afternoon_out) ? substr(Carbon::createFromFormat('G:i', $time_sheet->afternoon_out)->format('h:i'), 3) : '')}}">
                                            </div>
                                        </td>
                                        <td>
                                            <span class="a_time">{{ (isset($time_sheet) ? ($time_sheet->afternoon_time) : '')}}</span>
                                            <input type="text" hidden
                                                   value="{{ (isset($time_sheet) ? ($time_sheet->afternoon_time) : '')}}"
                                                   class="a_time_i" {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}} >
                                        </td>
                                        <td data-time="{{$time_sheet->overtime_in??"null"}}">
                                            <div class="flex-center">
                                                <input type="text" class="time_h_input" {{$date>$now?'disabled':''}}
                                                {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}}
                                                value="{{ (isset($time_sheet->overtime_in) ? substr(Carbon::createFromFormat('G:i', $time_sheet->overtime_in)->format('h:i'),0, 2) : '')}}">
                                                <input type="text" class="time_m_input" {{$date>$now?'disabled':''}}
                                                {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}}
                                                value="{{ (isset($time_sheet->overtime_in) ? substr(Carbon::createFromFormat('G:i', $time_sheet->overtime_in)->format('h:i'), 3) : '')}}">
                                            </div>
                                        </td>
                                        <td data-time="{{$time_sheet->overtime_out??"null"}}">
                                            <div class="flex-center">
                                                <input type="text" class="time_h_input" {{$date>$now?'disabled':''}}
                                                {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}}
                                                value="{{ (isset($time_sheet->overtime_out) ? substr(Carbon::createFromFormat('G:i', $time_sheet->overtime_out)->format('h:i'),0, 2) : '')}}">
                                                <input type="text" class="time_m_input" {{$date>$now?'disabled':''}}
                                                {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}}
                                                value="{{ (isset($time_sheet->overtime_out) ? substr(Carbon::createFromFormat('G:i', $time_sheet->overtime_out)->format('h:i'), 3) : '')}}">
                                            </div>
                                        </td>
                                        <td>
                                            <span class="o_time">{{ (isset($time_sheet) ? ($time_sheet->overtime_time) : '')}}</span>
                                            <input type="text" hidden
                                                   value="{{ (isset($time_sheet) ? ($time_sheet->overtime_time) : '')}}"
                                                   class="o_time_i" {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}} >
                                        </td>
                                        <td class="{{ (isset($time_sheet) ? ($time_sheet->pre <8 ? 'dtr-flag':''): '')}}">
                                            <span class="pre_time">  {{ (isset($time_sheet) ? ($time_sheet->pre) : '')}}</span>
                                            <input type="text" hidden
                                                   value="{{ (isset($time_sheet) ? ($time_sheet->pre) : '')}}"
                                                   class="pre_time_i" {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}} >
                                        </td>
                                        <td class="{{ (isset($time_sheet) ? ($time_sheet->pre <8 ? 'dtr-flag':''): '')}}">
                                            <span class="ot_time"> {{ (isset($time_sheet) ? ($time_sheet->ot) : '')}}</span>
                                            <input type="text" hidden
                                                   value="{{ (isset($time_sheet) ? ($time_sheet->ot) : '')}}"
                                                   class="ot_time_i" {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}} >
                                        </td>
                                        <td class="{{ (isset($time_sheet) ? ($time_sheet->pre <8 ? 'dtr-flag':''): '')}}">
                                            <span class="late_time"> {{ (isset($time_sheet) ? ($time_sheet->late) : '')}}</span>
                                            <input type="text" hidden
                                                   value="{{ (isset($time_sheet) ? ($time_sheet->late) : '')}}"
                                                   class="late_time_i" {{$date<=$now ? 'name=timesheet['.($time_sheet!=null? $time_sheet->id : $date).'][]':''}} >
                                        </td>
                                        <?php
                                        $pre += (isset($time_sheet) ? ((float)$time_sheet->pre) : 0);
                                        $ot += (isset($time_sheet) ? ((float)$time_sheet->ot) : 0);
                                        $late += (isset($time_sheet) ? ((float)$time_sheet->late) : 0);
                                        ?>
                                    @endif
                                </tr>
                            @endforeach
                        </form>
                        <tr>
                            <td colspan="11" class="text-right">Total Time:</td>
                            <td id="total_pre">{{$pre }}</td>
                            <td id="total_ot">{{$ot }}</td>
                            <td id="total_late">{{$late }}</td>
                        </tr>
                    </table>
                    <div class="mt-2 flex justify-content-end">
                        <input class="btn btn-primary" form="edit_dtr" type="submit" value="Save Changes"/>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection