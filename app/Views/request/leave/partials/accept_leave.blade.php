<div class="modal fade" id="accept_leave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Accept Leave Request</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure you want to accept this leave request?</div>
            <div class="modal-footer">
                <form action="{{ route_to('leave.update') }}" method="post" id="accept_leave">
                    @csrf
                    <input type="text" name="id" id="id" value="" hidden>
                    <input type="text" name="status" id="status" value="accepted" hidden>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input class="btn btn-primary" type="submit" value="Accept"/>
                </form>
            </div>
        </div>
    </div>
</div>