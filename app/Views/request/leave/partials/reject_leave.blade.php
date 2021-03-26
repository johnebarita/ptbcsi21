<div class="modal fade" id="reject_leave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reject Leave Request</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure you want to reject this leave request?</div>
            <div class="modal-footer">
                <form action="{{route_to('leave.update') }}" method="post" id="reject_leave">
                 @csrf
                    <input type="text" name="id" id="id" value="" hidden>
                    <input type="text" name="status" id="status" value="rejected" hidden>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input class="btn btn-danger" type="submit" value="Reject"/>
                </form>
            </div>
        </div>
    </div>
</div>