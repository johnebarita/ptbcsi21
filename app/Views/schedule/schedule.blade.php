@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Schedule</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add_schedule">
                    <span class="text">Add Schedule</span>
                </a>
                <div class="table-responsive">
                    <table class="schedule-table table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Morning In</th>
                            <th>Morning Out</th>
                            <th>Afternoon In</th>
                            <th>Afternoon Out</th>
                            <th>Working Days</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($schedules as $schedule)
                            <tr>
                                <td>{{ $time = \Carbon\Carbon::createFromFormat('G:i', $schedule->morning_in)->format('h:i A')}}</td>
                                <td>{{ $time = \Carbon\Carbon::createFromFormat('G:i', $schedule->morning_out)->format('h:i A')}}</td>
                                <td>{{ $time = \Carbon\Carbon::createFromFormat('G:i', $schedule->afternoon_in)->format('h:i A')}}</td>
                                <td>{{ $time = \Carbon\Carbon::createFromFormat('G:i', $schedule->afternoon_out)->format('h:i A')}}</td>
                                <td>
                                    @foreach(explode(',',$schedule->working_days) as $key=>$day)
                                        <?php $first = new \Carbon\Carbon('first Monday of January');?>
                                        {{$first->addDays($day)->format('D')}}
                                        @if($key<count(explode(',',$schedule->working_days))-1)
                                            {{',  '}}
                                        @endif
                                    @endforeach
                                </td>
                                {{--                                <td data-working-days="{{(implode(",", json_decode($schedule->working_days)))}}">{{ucwords(implode(", ", json_decode($schedule->working_days)))}}</td>--}}
                                <td>
                                    <div class="flex">
                                        <a href="#" data-id="{{$schedule->id}}" data-days="{{$schedule->working_days}}" title="Edit"
                                           class="btn btn-success btn-circle btn-sm m-auto edit_schedule">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="#" data-id="{{$schedule->id}}"
                                           class="btn btn-danger btn-circle btn-sm m-auto delete_schedule">
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
        @include('schedule.partials.add_schedule')
        @include('schedule.partials.edit_schedule')
        @include('schedule.partials.delete_schedule')
    </div>
@endsection