<div class="modal fade" id="view_employee"  data-keyboard="false" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document" style="width:1250px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="view_employee_label">View Employee Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="font-weight-bold mb-2">BASIC INFORMATION</div>
                    <div class="form-row">
                        <div class="col-md-27 mb-2">
                            <label for="view_firstname">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="view_firstname" name="firstname" disabled>
                        </div>
                        <div class="col-md-27 mb-2">
                            <label for="view_middle">Middle Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="view_middle" name="middle" disabled>
                        </div>
                        <div class="col-md-27 mb-2">
                            <label for="view_lastname">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="view_lastname" name="lastname" disabled>
                        </div>
                        <div class="col-md-19 mb-2">
                            <label>Sex <span class="text-danger">*</span></label>
                            <div class="">
                                <div class="form-check-inline">
                                    <input class="form-check-input sex-radio" type="radio" name="sex"
                                           id="view_male" value="male" disabled>
                                    <label class="form-check-label" for="view_male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input sex-radio" type="radio" name="sex"
                                           id="view_female" value="female" disabled>
                                    <label class="form-check-label" for="view_female">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-2">
                            <label for="view_birth_date">Birth Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="view_birth_date" name="birth_date" disabled>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="view_marital_status_id">Marital Status <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" id="view_marital_status_id" name="marital_status_id" disabled>
                                @foreach ($marital_statuses as $marital_status)
                                    <option value="{{ $marital_status->id }}">{{ $marital_status->status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="view_address">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="view_address" name="address" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-2">
                            <label for="view_mobile_no">Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="view_mobile_no" name="mobile_no" disabled>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="view_tel_no">Telephone Number </label>
                            <input type="tel" class="form-control" id="view_tel_no" name="tel_no" disabled>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="view_email">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="view_email" name="email" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-2">
                            <label for="view_contact_person">Contact Person <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="view_contact_person" name="contact_person" disabled>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="view_contact_person_no">Contact Person / Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="view_contact_person_no" name="contact_person_no" disabled>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="view_date_hired">Date Hired <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="view_date_hired" name="date_hired" disabled>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="view_bank_name">Bank <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="view_bank_name" name="bank_name" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-20 mb-2">
                            <label for="view_tin_no">Tin No.</label>
                            <input type="number" class="form-control" id="view_tin_no" name="tin_no" disabled>
                        </div>
                        <div class="col-md-20 mb-2">
                            <label for="view_philhealth_no">Philhealth No.</label>
                            <input type="number" class="form-control" id="view_philhealth_no" name="philhealth_no" disabled>
                        </div>
                        <div class="col-md-20 mb-2">
                            <label for="view_sss_no">SSS No.</label>
                            <input type="number" class="form-control" id="view_sss_no" name="sss_no" disabled>
                        </div>
                        <div class="col-md-20 mb-2">
                            <label for="view_pagibig_no">Pag-ibig No.</label>
                            <input type="number" class="form-control" id="view_pagibig_no" name="pagibig_no" disabled>
                        </div>
                        <div class="col-md-20 mb-2">
                            <label for="view_is_active">Active</label>
                            <select type="text" class="form-control" id="view_is_active" name="is_active" disabled>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="font-weight-bold mb-2">POSITION</div>
                    <div class="form-row justify-content-between">
                        <div class="w-25">
                            <div class="mb-2">
                                <label for="view_position_id">Position <span class="text-danger">*</span></label>
                                <select type="text" class="form-control" id="view_position_id" name="position_id" disabled>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}"
                                                data-schedule="{{$position->schedule}}"
                                                data-salary="{{ $position->rate }}">{{ $position->position }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="view_monthly_pay">Monthly Salary <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="view_monthly_pay" name="monthly_pay" value="{{$positions[0]->rate}}" disabled>
                            </div>
                        </div>
                        <div class="w-32 mb-2">
                            <div class="mb-2">
                                <label for="view_schedule_id">Schedule <span class="text-danger">* </span>(Morning)</label>
                                <div class="flex ">
                                    <div class="pr-1 w-50">
                                        <input type="time" class="form-control" id="view_morning_in" name="morning_in" value="{{$positions[0]->schedule->morning_in}}" disabled>
                                    </div>
                                    <div class="pl-1 w-50">
                                        <input type="time" class="form-control" id="view_morning_out" name="morning_out" value="{{$positions[0]->schedule->morning_out}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="view_schedule_id">Schedule <span class="text-danger">* </span>(Afternoon)</label>
                                <div class="flex ">
                                    <div class="pr-1 w-50">
                                        <input type="time" class="form-control" id="view_afternoon_in" name="afternoon_in" value="{{$positions[0]->schedule->afternoon_in}}" disabled>
                                    </div>
                                    <div class="pl-1 w-50">
                                        <input type="time" class="form-control" id="view_afternoon_out" name="afternoon_out" value="{{$positions[0]->schedule->afternoon_out}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-25 mb-2">
                            <label for="view_monthly_pay">Working Days <span class="text-danger">* </span></label>
                            <div class=" ml-2 flex justify-content-between">
                                <div>
                                    @foreach(range(0,3) as $number)
                                        <?php $first = new \Carbon\Carbon('first Monday of January');?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input working_days" id="view_add_{{$number}}-day"  value="{{$number}}" name="working_days[]" disabled>
                                            <label class="form-check-label" for="view_{{$number}}-day">{{$first->addDays($number)->format('l')}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div>
                                    @foreach(range(4,6) as $number)
                                        <?php $first = new \Carbon\Carbon('first Monday of January');?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input working_days" id="view_add_{{$number}}-day"  value="{{$number}}" name="working_days[]" disabled>
                                            <label class="form-check-label" for="view_{{$number}}-day">{{$first->addDays($number)->format('l')}}</label>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <div class="col-md-14 mb-2">
                            <div class="mb-2">
                                <label for="view_is_fixed_salary">Fixed Salary <span class="text-danger">*</span></label>
                                <select type="text" class="form-control" id="view_is_fixed_salary" name="is_fixed_salary" disabled>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div>
                                <label for="view_can_ot">Can OT <span class="text-danger">*</span></label>
                                <select type="text" class="form-control" id="view_can_ot" name="can_ot" disabled>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="font-weight-bold mb-2">ALLOWANCE</div>
                    <div class="form-row">
                        <div class="col-md-3 mb-2">
                            <label for="view_transportation_allowance">Transportation</label>
                            <input type="number" class="form-control" id="view_transportation_allowance"
                                   name="transportation_allowance" disabled>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="view_internet_allowance">Internet</label>
                            <input type="number" class="form-control" id="view_internet_allowance" name="internet_allowance" disabled>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="view_meal_allowance">Meal</label>
                            <input type="number" class="form-control" id="view_meal_allowance" name="meal_allowance" disabled>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="view_phone_allowance">Phone</label>
                            <input type="number" class="form-control" id="view_phone_allowance" name="phone_allowance" disabled>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    </div>
            </div>
        </div>
    </div>
</div>