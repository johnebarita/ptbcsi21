<div class="modal fade" id="add_overtime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Request Overtime</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route_to('overtime.create')}}" method="post">
                   @csrf
                    <div class="form-group">
                        <label for="employee_id">Employee Name</label>
                        <select class="form-control" type="number" id="employee_id" name="employee_id">
                            @foreach ($employees as $employee)
                                <option value={{$employee->id}}>{{strtoupper($employee->lastname . ' ' . $employee->firstname . ' ' . $employee->middle)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="request_date">Date Requested</label>
                        <input type="date" id="request_date" class="form-control" name="request_date"
                               value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="overtime_in">Overtime In</label>
                        <input type="time" class="form-control" id="overtime_in" name="overtime_in" value="17:00" =""
                        required="">
                    </div>

                    <div class="form-group">
                        <label for="overtime_out">Overtime Out</label>
                        <input type="time" class="form-control" id="overtime_out" name="overtime_out" value="20:00" =""
                        required="">
                    </div>
                    <div class="form-group">
                        <label for="note">Reason</label>
                        <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                    </div>
                    <div class="modal-footer mt-5">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <input class="btn btn-primary" type="submit" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>