<div class="modal fade" id="fixed_bug_report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mark Bug as Fixed</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure you want to mark this bug as fixed?</div>
            <div class="px-3 mb-2">
                <form action="{{ route_to('bug-report.fixed') }}"  method="post" id="accept_leave">
                    @csrf
                    <input type="text" name="id" id="fixed_id" value="" hidden>

                    <div class="form-group">
                        <label for="fixed_note">Remarks</label>
                        <textarea class="form-control" id="fixed_note" name="note" rows="3"></textarea>
                    </div>
                    <div class="flex justify-content-end ">
                        <button class="btn btn-secondary mr-2" type="button" data-dismiss="modal">Cancel</button>
                        <input class="btn btn-primary" type="submit" value="Accept"/>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>