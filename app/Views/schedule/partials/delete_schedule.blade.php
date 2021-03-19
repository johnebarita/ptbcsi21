<div class="modal fade" id="delete_schedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Schedule</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure you want to delete this schedule?</div>
            <div class="modal-footer">
                <form action="{{route_to('schedule.delete')}}" method="post" id="add_schedule">
                    {!! csrf_field() !!}
                    <input type="text" name="id" id="id" value=""hidden>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input class="btn btn-danger"  type="submit" value="Delete"/>
                </form>
            </div>
        </div>
    </div>
</div>