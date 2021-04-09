<div class="modal fade" id="add_employee" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
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
                    <div class="font-weight-bold mb-2">BASIC INFORMATION</div>
                    <div class="form-row">
                        <div class="col-md-27 mb-2">
                            <label for="firstname">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>
                        <div class="col-md-27 mb-2">
                            <label for="middle">Middle Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="middle" name="middle">
                        </div>
                        <div class="col-md-27 mb-2">
                            <label for="lastname">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                        <div class="col-md-19 mb-2">
                            <label>Sex <span class="text-danger">*</span></label>
                            <div class="">
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="sex"
                                           id="male" value="male" required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sex"
                                           id="female" value="female" required>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-2">
                            <label for="birth_date">Birth Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="marital_status_id">Marital Status <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" id="marital_status_id" name="marital_status_id">
                                @foreach ($marital_statuses as $marital_status)
                                    <option value="{{ $marital_status->id }}">{{ $marital_status->status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="address">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-2">
                            <label for="mobile_no">Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="tel_no">Telephone Number </label>
                            <input type="tel" class="form-control" id="tel_no" name="tel_no">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="email">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-2">
                            <label for="contact_person">Contact Person <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="contact_person" name="contact_person" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="contact_person_no">Contact Person / Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="contact_person_no" name="contact_person_no" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="date_hired">Date Hired <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date_hired" name="date_hired" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="bank_name">Bank <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-20 mb-2">
                            <label for="tin_no">Tin No.</label>
                            <input type="number" class="form-control" id="tin_no" name="tin_no">
                        </div>
                        <div class="col-md-20 mb-2">
                            <label for="philhealth_no">Philhealth No.</label>
                            <input type="number" class="form-control" id="philhealth_no" name="philhealth_no">
                        </div>
                        <div class="col-md-20 mb-2">
                            <label for="sss_no">SSS No.</label>
                            <input type="number" class="form-control" id="sss_no" name="sss_no">
                        </div>
                        <div class="col-md-20 mb-2">
                            <label for="pagibig_no">Pag-ibig No.</label>
                            <input type="number" class="form-control" id="pagibig_no" name="pagibig_no">
                        </div>
                        <div class="col-md-20 mb-2">
                            <label for="is_active">Active</label>
                            <select type="text" class="form-control" id="is_active" name="is_active">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="font-weight-bold mb-2">POSITION</div>
                    <div class="form-row justify-content-between">
                        <div class="w-25">
                            <div class="mb-2">
                                <label for="position_id">Position <span class="text-danger">*</span></label>
                                <select type="text" class="form-control" id="position_id" name="position_id">
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}"
                                                data-schedule="{{$position->schedule}}"
                                                data-salary="{{ $position->rate }}">{{ $position->position }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="monthly_pay">Monthly Salary <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="monthly_pay" name="monthly_pay" value="{{$positions[0]->rate}}">
                            </div>
                        </div>
                        <div class="w-32 mb-2">
                            <div class="mb-2">
                                <label for="schedule_id">Schedule <span class="text-danger">* </span>(Morning)</label>
                                <div class="flex ">
                                    <div class="pr-1 w-50">
                                        <input type="time" class="form-control" id="morning_in" name="morning_in" value="{{$positions[0]->schedule->morning_in}}">
                                    </div>
                                    <div class="pl-1 w-50">
                                        <input type="time" class="form-control" id="morning_out" name="morning_out" value="{{$positions[0]->schedule->morning_out}}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="schedule_id">Schedule <span class="text-danger">* </span>(Afternoon)</label>
                                <div class="flex ">
                                    <div class="pr-1 w-50">
                                        <input type="time" class="form-control" id="afternoon_in" name="afternoon_in" value="{{$positions[0]->schedule->afternoon_in}}">
                                    </div>
                                    <div class="pl-1 w-50">
                                        <input type="time" class="form-control" id="afternoon_out" name="afternoon_out" value="{{$positions[0]->schedule->afternoon_out}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-25 mb-2">
                            <label for="monthly_pay">Working Days <span class="text-danger">* </span></label>
                            <div class=" ml-2 flex justify-content-between">
                                <div>
                                    @foreach(range(0,3) as $number)
                                        <?php $first = new \Carbon\Carbon('first Monday of January');?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input working_days" id="add_{{$number}}-day" {{str_contains ( $positions[0]->schedule->working_days , $number )?'checked':''}} value="{{$number}}" name="working_days[]">
                                            <label class="form-check-label" for="{{$number}}-day">{{$first->addDays($number)->format('l')}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div>
                                    @foreach(range(4,6) as $number)
                                        <?php $first = new \Carbon\Carbon('first Monday of January');?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input working_days" id="add_{{$number}}-day" {{str_contains ( $positions[0]->schedule->working_days , $number )?'checked':''}} value="{{$number}}" name="working_days[]">
                                            <label class="form-check-label" for="{{$number}}-day">{{$first->addDays($number)->format('l')}}</label>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <div class="col-md-14 mb-2">
                            <div class="mb-2">
                                <label for="is_fixed_salary">Fixed Salary <span class="text-danger">*</span></label>
                                <select type="text" class="form-control" id="is_fixed_salary" name="is_fixed_salary">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div>
                                <label for="can_ot">Can OT <span class="text-danger">*</span></label>
                                <select type="text" class="form-control" id="can_ot" name="can_ot">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="font-weight-bold mb-2">ALLOWANCE</div>
                    <div class="form-row">
                        <div class="col-md-3 mb-2">
                            <label for="transportation_allowance">Transportation</label>
                            <input type="number" class="form-control" id="transportation_allowance"
                                   name="transportation_allowance">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="internet_allowance">Internet</label>
                            <input type="number" class="form-control" id="internet_allowance" name="internet_allowance">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="meal_allowance">Meal</label>
                            <input type="number" class="form-control" id="meal_allowance" name="meal_allowance">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="phone_allowance">Phone</label>
                            <input type="number" class="form-control" id="phone_allowance" name="phone_allowance">
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