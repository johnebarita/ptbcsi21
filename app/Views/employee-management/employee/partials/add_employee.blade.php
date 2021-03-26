<div class="modal fade  " id="add_employee" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document" style="width:1250px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Add Employee</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route_to('employee.create') }}" method="post">
                    @csrf
                    <div class="font-weight-bold mb-3">BASIC INFORMATION</div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="firstname">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="firstname" name="firstname">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="middle">Middle Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="middle" name="middle">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="lastname">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="lastname" name="lastname">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-13 mb-3">
                            <label>Sex <span class="text-danger">*</span></label>
                            <div class="">
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender"
                                           id="male" value="male">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender"
                                           id="female" value="female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="birth_date">Birth Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="marital_status_id">Marital Status <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" id="marital_status_id" name="marital_status_id">
                                @foreach ($marital_statuses as $marital_status)
                                    <option value="{{ $marital_status->id }}>">{{ $marital_status->status }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address">
                            <div class="valid-feedback">
                                Looks good
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="mobile_no">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="tel_no">Telephone Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tel_no" name="tel_no">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email">
                            <div class="valid-feedback">
                                Looks good
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="contact_person">Contact Person</label>
                            <input type="text" class="form-control" id="contact_person" name="contact_person">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="contact_person_no">Contact Person / Mobile Number <span
                                        class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="contact_person_no" name="contact_person_no">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="date_hired">Date Hired <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date_hired" name="date_hired">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="bank_name">Bank <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="tin_no">Tin No.</label>
                            <input type="text" class="form-control" id="tin_no" name="tin_no">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="philhealth_no">Philhealth No.</label>
                            <input type="text" class="form-control" id="philhealth_no" name="philhealth_no">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="sss_no">SSS No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="sss_no" name="sss_no">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="pagibig_no">Pag-ibig No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="pagibig_no" name="pagibig_no">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="is_active">Active <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" id="is_active" name="is_active">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                    <div class="font-weight-bold mb-3">MONTHLY SALARY AND DEDUCTION</div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="position_id">Position <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" id="position_id" name="position_id">
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"
                                            data-salary="{{ $position->rate }}">{{ $position->position }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="monthly_pay">Monthly Salary <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="monthly_pay" name="monthly_pay">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="is_fixed_salary">Fixed Salary <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" id="is_fixed_salary" name="is_fixed_salary">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                    <div class="font-weight-bold mb-3">ALLOWANCE</div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="transportation_allowance">Transportation <span
                                        class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="transportation_allowance"
                                   name="transportation_allowance">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="internet_allowance">Internet <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="internet_allowance" name="internet_allowance">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="meal_allowance">Meal <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="meal_allowance" name="meal_allowance">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="phone_allowance">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone_allowance" name="phone_allowance">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>