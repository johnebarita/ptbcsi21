<div class="modal fade" id="edit_event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Edit Event</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route_to('calendar.update')}}" method="post">
                    @csrf
                    <input type="text" id="edit_id" name="id" hidden>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="edit_title" class="form-control" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="start">Start</label>
                        <input type="date" id="edit_start" class="form-control" name="start" value="2020-10-15" required>
                    </div>

                    <div class="form-group">
                        <label for="end">End</label>
                        <input type="date" id="edit_end" class="form-control" name="end" value="2020-10-15" required>
                    </div>
                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea class="form-control" id="edit_note" name="note" rows="3" required minlength="3"></textarea>
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