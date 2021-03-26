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
                <form method="post" action="{{route_to("schedule.update")}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" id="id" name="id" hidden value="">
                        <label for="time_in">Time In</label>
                        <input type="time" class="form-control" id="time_in" name="time_in" value="08:00" ="" required="
                        ">
                    </div>

                    <div class="form-group">
                        <label for="time_out">Time Out</label>
                        <input type="time" class="form-control" id="time_out" name="time_out" value="17:00" ="" required
                        ="">
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