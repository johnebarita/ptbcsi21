<div class="modal fade" id="edit_cash_advance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Edit Cash Advance</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route_to('cash-advance.update') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="employee_name">Employee Name</label>
                        <input type="text" hidden id="cash_advance_id" class="form-control" name="cash_advance_id"/>
                        <input type="text" id="employee_name" class="form-control" disabled/>
                    </div>
                    <div class="form-group">
                        <label for="edit_request_date">Date Requested</label>
                        <input type="date" id="edit_request_date" class="form-control" name="request_date"
                               value="{{\Carbon\Carbon::now()->format('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_amount">Requested Amount</label>
                        <input type="text" id="edit_amount" class="form-control ca-num-input" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_repayment">Repayment Amount Every Payroll</label>
                        <input type="text" id="edit_repayment" class="form-control ca-num-input" name="repayment" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_purpose">Purpose</label>
                        <textarea class="form-control" id="edit_purpose" name="purpose" rows="3" required></textarea>
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