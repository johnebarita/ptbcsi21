<div class="modal fade" id="edit_schedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Edit Schedule</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route_to("schedule.update")}}" id="edit_schedule">
                    @csrf
                    <div class="form-group">
                        <input type="text" id="edit_id" name="id" hidden value="">
                        <label for="morning_in">Morning In</label>
                        <input type="time" class="form-control" id="edit_morning_in" name="morning_in" value="08:00" required>
                    </div>

                    <div class="form-group">
                        <label for="morning_out">Morning Out</label>
                        <input type="time" class="form-control" id="edit_morning_out" name="morning_out" value="12:00" required>
                    </div>
                    <div class="form-group">
                        <label for="afternoon_in">Afternoon In</label>
                        <input type="time" class="form-control" id="edit_afternoon_in" name="afternoon_in" value="13:00" required>
                    </div>

                    <div class="form-group">
                        <label for="afternoon_out">Afternoon Out</label>
                        <input type="time" class="form-control" id="edit_afternoon_out" name="afternoon_out" value="17:00" required>
                    </div>

                    <div>
                        <label for="afternoon_out">Working Days</label>
                        <div class="ml-2">

                            @foreach(range(0,6) as $number)
                                <?php $first = new \Carbon\Carbon('first Monday of January');?>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input edit_working_days" id="edit_{{$number}}-day" value="{{$number}}" name="working_days[]">
                                    <label class="form-check-label" for="{{$number}}-day">{{$first->addDays($number)->format('l')}}</label>
                                </div>
                            @endforeach
                        </div>

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