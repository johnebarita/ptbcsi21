<div class="modal fade" id="edit_position" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Add Position</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route_to('position.update')}}" method="post" id="edit_position">
                   @csrf
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" class="form-control" id="id" name="id" value="" hidden>
                        <input type="text" class="form-control" id="position" name="position" required="">
                    </div>

                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="text" class="form-control" id="rate" name="rate" required="">
                    </div>

                    <div class="form-group">
                        <label for="schedule_id">Schedule</label>
                        <select class="form-control" type="number" id="schedule_id" name="schedule_id">
                            @foreach ($schedules as $schedule)
                                <option value={{$schedule->id}}>
                                    {{ \Carbon\Carbon::createFromFormat('G:i', $schedule->time_in)->format('h:i A').' - '.
                                    \Carbon\Carbon::createFromFormat('G:i', $schedule->time_out)->format('h:i A')}}
                                </option>
                            @endforeach
                        </select>
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