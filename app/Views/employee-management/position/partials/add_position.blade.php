<div class="modal fade" id="add_position" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form action="{{route_to('position.create')}}" method="post" id="add_position">
                    @csrf
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" class="form-control" id="position" name="position" required="">
                    </div>

                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="number" class="form-control" id="rate" name="rate" required="">
                    </div>
                    <div class="flex w-100">
                        <div class="form-group w-50 mr-2">
                            <label for="morning_in">Morning In</label>
                            <input type="time" class="form-control" id="add_morning_in" name="morning_in" value="08:00"
                                   required>
                        </div>

                        <div class="form-group w-50 ml-2">
                            <label for="morning_out">Morning Out</label>
                            <input type="time" class="form-control" id="add_morning_out" name="morning_out" value="12:00"
                                   required>
                        </div>
                    </div>

                    <div class="flex w-100">
                        <div class="form-group w-50 mr-2">
                            <label for="afternoon_in">Afternoon In</label>
                            <input type="time" class="form-control" id="add_afternoon_in" name="afternoon_in" value="13:00"
                                   required>
                        </div>

                        <div class="form-group w-50 ml-2">
                            <label for="afternoon_out">Afternoon Out</label>
                            <input type="time" class="form-control" id="add_afternoon_out" name="afternoon_out" value="17:00"
                                   required>
                        </div>
                    </div>

                    <div>
                        <label for="afternoon_out">Working Days</label>
                        <div class="ml-2">
                            @foreach(range(0,6) as $number)
                                <?php $first = new \Carbon\Carbon('first Monday of January');?>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="add_{{$number}}-day" {{$number<6?'checked':''}} value="{{$number}}" name="working_days[]">
                                    <label class="form-check-label" for="{{$number}}-day">{{$first->addDays($number)->format('l')}}</label>
                                </div>
                            @endforeach
                        </div>
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