<div class="modal fade" id="add_late_penalty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Add Late Penalty</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route_to('late-penalty.create')}}" method="post" id="add_late_penalty">
                    @csrf
                    <div class="table-responsive">
                        <table class="late-penalty-table table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>From (h:m)</th>
                                <th>To (h:m)</th>
                                <th>Equivalent (h:m)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="flex">
                                        <input type="text" name="from_h" class="late-h w-50">
                                        <span class="pl-2 pr-2">:</span>
                                        <input type="text" name="from_m" class="late-h w-50">
                                    </div>
                                </td>
                                <td>
                                    <div class="flex">
                                        <input type="text" name="to_h" class="late-h w-50">
                                        <span class="pl-2 pr-2">:</span>
                                        <input type="text" name="to_m" class="late-h w-50">
                                    </div>
                                </td>
                                <td>
                                    <div class="flex">
                                        <input type="text" name="equivalent_h" class="late-h w-50">
                                        <span class="pl-2 pr-2">:</span>
                                        <input type="text" name="equivalent_m" class="late-h w-50">
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer mt-2">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <input class="btn btn-primary" type="submit" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
