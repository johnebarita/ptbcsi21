@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Attendance </h1>
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
                <div class="flex">
                    <form action="{{ route_to('attendance.index') }}" method="post">
                        @csrf
                        <div class="flex">
                            <div class="flex p-2">
                                <label for="filter" class="m-auto p-2">Filter: </label>
                                <select class="form-control" name="" id="filter" onchange="filterChanged()">
                                    <option value="monthly">Monthly</option>
                                    <option value="quarterly">Quarterly</option>
                                    <option value="yearly">Yearly</option>
                                </select>
                            </div>
                            <div class="mr-3 ml-3 border-left">&nbsp</div>
                            <div class="flex">
                                <div class="p-2" id="monthly">
                                    <select class="form-control" name="" id="filter">
                                        @foreach (range(1, 12) as $number)
                                            <option value='{{ $number }}'  {{$number>\Carbon\Carbon::now()->format('m')?'disabled':''}}>{{ Carbon\Carbon::create()->day(1)->month($number)->format('F')}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="p-2" style="display: none" id="quarterly">
                                    <select class="form-control" name="" id="filter">
                                        <option value="">1st Quarter</option>
                                        <option value="">2nd Quarter</option>
                                        <option value="">3rd Quarter</option>
                                        <option value="">4th Quarter</option>
                                    </select>
                                </div>
                                <div class="p-2" id="yearly">
                                    <select class="form-control " name="year" id="year">
                                        @foreach (range(date('Y'), 2019, -1) as $y)
                                            <option >{{$y}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                    </form>

                </div>
                <script type="text/javascript">
                    function filterChanged() {
                        var selected = document.getElementById("filter").value;
                        document.getElementById('monthly').style.display = "none";
                        document.getElementById('quarterly').style.display = "none";

                        document.getElementById(selected).style.display = "block";
                    }
                </script>
            </div>
        </div>
    </div>
@endsection