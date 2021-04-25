<div class="modal fade" id="restore_employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Restore Employee</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure you want to restore this employee?</div>
            <div class="modal-footer">
                <form action="{{route_to('employee.restore')}}" method="post" id="restore_employee">
                    @csrf
                    <input type="text" name="id" id="restore_id" value=""hidden>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input class="btn btn-primary"  type="submit" value="Restore"/>
                </form>
            </div>
        </div>
    </div>
</div>