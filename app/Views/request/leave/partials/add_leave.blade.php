<div class="modal fade" id="add_leave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Request Leave</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route_to('leave.create')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="employee_id">Employee Name</label>
                        <select class="form-control" id="employee_id" name="employee_id" required>
                            @foreach ($employees as $employee)
                                <option value={{$employee->id}}>{{strtoupper($employee->lastname.' '.$employee->firstname.' '.$employee->middle)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="request_start">Date From</label>
                        <input type="date" id="request_start" class="form-control" name="request_start"
                               value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="request_end">Date From</label>
                        <input type="date" id="request_end" class="form-control" name="request_end"
                               value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="leave_type_id">Type of Leave</label>
                        <select class="form-control" id="leave_type_id" name="leave_type_id" required>
                            @foreach ($leave_types as $leave_type)
                                <option value={{$leave_type->id}}> {{$leave_type->name}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Note</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer mt-5">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>