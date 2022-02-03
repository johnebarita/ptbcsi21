<div class="modal fade" id="reject_overtime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{session()->userData['role']=='Employee'?'Delete':'Reject'}} Overtime</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure you want to {{session()->userData['role']=='Employee'?'delete':'reject'}} this overtime?</div>
            <div class="modal-footer">
                <form action="{{route_to('overtime.update')}}" method="post" id="reject_overtime">
                  @csrf
                    <input type="text" name="id" id="reject_id" value="" hidden/>
                    <input type="text" name="status" id="reject_status" value="rejected" hidden/>
                    <input type="text" name="action" id="reject_action" value="{{session()->userData['role']=='Employee'?'delete':'reject'}}" hidden/>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input class="btn btn-danger" type="submit" value="{{session()->userData['role']=='Employee'?'Delete':'Reject'}}"/>
                </form>
            </div>
        </div>
    </div>
</div>