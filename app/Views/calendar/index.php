<div class="container-fluid ">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Calendar</h1>
    </div>
    <?php use Carbon\Carbon;

    if (session()->has('success')) { ?>
        <div class="alert alert-success alert-dismissible fade show " role="alert">
            <?= session('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <div class="card shadow mb-4  flex">
        <div class="card-body flex">
            <div class="todo-sidebar">
                <div class="p-2 bg-primary text-white"><span><i class="fa fa-tasks mr-2"></i></span>TODO</div>
                <a href="#" class="btn btn-primary m-2 mt-3" data-toggle="modal" data-target="#add_event">
                    <span class="text">Add Todo</span>
                </a>
                <div class="flex-sm-grow-1 ml-2 mr-2 mt-3">
                    <form action="<?= route_to('calendar.index') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group flex ml-auto">
                            <label for="half" class="mt-auto pr-2">Filter: </label>
                            <select class="form-control mr-2 w-50" name="month" id="month">
                                <?php foreach (range(1, 12) as $number) { ?>
                                    <option value='<?= $number ?>' <?= ($month == $number ? 'selected' : ''); ?>><?= Carbon::createFromFormat('m', $number)->format('F') ?></option>
                                <?php } ?>
                            </select>
                            <select class="form-control  mr-2 w-25" name="year" id="year">
                                <?php foreach (range(date('Y'),2019,-1) as $y){?>
                                    <option <?= ($year == $y ? "selected" : '') ?>><?=$y?></option>
                                <?php }?>
                            </select>
                            <input type="submit" class="btn btn-primary" value="GO"/>
                        </div>
                    </form>
                </div>
                <div class="overflow-auto h-50 m-2">
                    <?php foreach ($events as $event) { ?>
                        <p class="p-2 bg-primary text-white rounded "><?= $event->title ?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="calendar" id='calendar'></div>
        </div>
    </div>

    <?= $this->include('calendar\partials\add_event') ?>
    <?= $this->include('calendar\partials\edit_event') ?>
    <?= $this->include('calendar\partials\move_event') ?>
</div>
