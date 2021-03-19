<div class="modal fade" id="add_cash_advance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Request Leave</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route_to('cash-advance.create')}}" method="post">
                    {!! csrf_field()  !!}
                    <div class="form-group">
                        <label for="employee_id">Employee Name</label>
                        <select class="form-control" id="employee_id" name="employee_id" required>
                            @foreach ($employees as $employee)
                                <option value={{$employee->id}}>{{strtoupper($employee->lastname.' '.$employee->firstname.' '.$employee->middle)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="request_date">Date Requested</label>
                        <input type="date" id="request_date" class="form-control" name="request_date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Requested Amount</label>
                        <input type="text" id="amount" class="form-control ca-num-input" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="repayment">Repayment Amount Every Payroll</label>
                        <input type="text" id="repayment" class="form-control ca-num-input" name="repayment" required>
                    </div>
                    <div class="form-group">
                        <label for="purpose">Purpose</label>
                        <textarea class="form-control" id="purpose" name="purpose" rows="3" required></textarea>
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