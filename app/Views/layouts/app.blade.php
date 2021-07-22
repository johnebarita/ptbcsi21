<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PTBCSI</title>

    <!-- Custom fonts for this template-->
    <link href="/assets/css/fontawesome/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/css/app.css" rel="stylesheet">
    <link href="/assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/fullcalendar/core.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/fullcalendar/daygrid.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/fullcalendar/timegrid.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/jquery-stickytable.css">
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
@include('includes.sidebar')
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
        @include('includes.topbar')
        <!-- End of Topbar -->
            <div class="container-fluid">
                @if(session()->has('status'))
                    <div class="alert alert-{{session('status')['key']}} alert-dismissible fade show " role="alert">
                        {!! session('status')['message']!!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>


            @yield('content')

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; PTBCSI 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= route_to('logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/jquery-3.5.1.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/assets/js/jquery.easing.js"></script>

<!-- Custom scripts for all pages-->
<script src="/assets/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/dataTables.bootstrap4.min.js"></script>

<!--<script src="/assets/js/fullcalendar/dayGrid.js"></script>-->
<!--<script src="/assets/js/fullcalendar/fullCalendar2.js"></script>-->
<script type="text/javascript" src="/assets/js/fullcalendar/core.min.js"></script>
<script type="text/javascript" src="/assets/js/fullcalendar/interaction.min.js"></script>
<script type="text/javascript" src="/assets/js/fullcalendar/daygrid.min.js"></script>
<script type="text/javascript" src="/assets/js/fullcalendar/timegrid.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery-stickytable.min.js"></script>


<!-- Page level custom scripts -->
{{--<script src="/assets/js/chart.js/chart-bar-demo.js"></script>--}}
{{--<script src="/assets/js/chart.js/chart-pie-demo.js"></script>--}}

<!--<script type="text/javascript" src="/assets/js/app.js">-->
</body>

</html>
<script type="text/javascript">
    (function ($) {
        "use strict"; // Start of use strict

        //
        // if (typeof(Storage) !== "undefined") {
        //     if(localStorage.getItem('sidebarToggled')==null){
        //         console.log('null');
        //         localStorage.setItem("sibarToggled", "show");
        //     }else if(localStorage.getItem('sidebarToggled')=="hide"){
        //         console.log('hide');
        //         $('.sidebar .collapse').collapse('hide');
        //     }
        // }
        var state = true;
        if (typeof (Storage) !== "undefined") {
            if (!localStorage.state) {
                localStorage.state = true;
            }
            state = localStorage.state;

        }

        if (state == 'true') {
            $("body").remove("sidebar-toggled");
            $(".sidebar").remove("toggled");
        } else {
            $("body").toggleClass("sidebar-toggled");
            $(".sidebar").toggleClass("toggled");
        }

        // Toggle the side navigation
        $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
            $("body").toggleClass("sidebar-toggled");
            $(".sidebar").toggleClass("toggled");
            if ($(".sidebar").hasClass("toggled")) {
                $('.sidebar .collapse').collapse('hide');
                localStorage.state = false;
            } else {
                localStorage.state = true;
            }
        });

        // Close any open menu accordions when window is resized below 768px
        $(window).resize(function () {
            if ($(window).width() < 768) {
                $('.sidebar .collapse').collapse('hide');
            }

            // Toggle the side navigation when window is resized below 480px
            if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
                $("body").addClass("sidebar-toggled");
                $(".sidebar").addClass("toggled");
                $('.sidebar .collapse').collapse('hide');
            }
        });

        // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
        $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
            if ($(window).width() > 768) {
                var e0 = e.originalEvent,
                    delta = e0.wheelDelta || -e0.detail;
                this.scrollTop += (delta < 0 ? 1 : -1) * 30;
                e.preventDefault();
            }
        });

        // Scroll to top button appear
        $(document).on('scroll', function () {
            var scrollDistance = $(this).scrollTop();
            if (scrollDistance > 100) {
                $('.scroll-to-top').fadeIn();

            } else {
                $('.scroll-to-top').fadeOut();
            }
        });

        // Smooth scrolling using jQuery easing
        $(document).on('click', 'a.scroll-to-top', function (e) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: ($($anchor.attr('href')).offset().top)
            }, 1000, 'easeInOutExpo');
            e.preventDefault();
        });

        $(document).ready(function () {
            $('#dataTable').DataTable();
            startTime();
        });

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid'],
                timeZone: 'UTC',
                allDayDefault: true,
                header: {
                    right: 'prev,next today',
                    center: 'title',
                    left: ''
                },
                customButtons: {
                    prev: {
                        text: 'Prev',
                        click: function () {
                            calendar.prev();
                            var date = calendar.getDate().toLocaleString().split(',')[0].split('/');
                            $.ajax({
                                url: "calendar/getEventsPerMonth/" + date[0] + "/" + date[2],
                                method: 'post',
                                success: function (response) {
                                    calendar.removeAllEvents();
                                    var events = JSON.parse(response);
                                    events.map(function (value) {
                                        calendar.addEvent(value);
                                    });
                                },
                            });
                            console.log(calendar.getEvents());

                        }
                    },
                    next: {
                        text: 'Next',
                        click: function () {
                            calendar.next();
                            var date = calendar.getDate().toLocaleString().split(',')[0].split('/');
                            $.ajax({
                                url: "calendar/getEventsPerMonth/" + date[0] + "/" + date[2],
                                method: 'post',
                                success: function (response) {
                                    calendar.removeAllEvents();
                                    var events = JSON.parse(response);
                                    events.map(function (value) {
                                        calendar.addEvent(value);
                                    });
                                },
                            });
                        }
                    },
                    today: {
                        text: 'Today',
                        click: function () {
                            calendar.today();
                            var date = calendar.getDate().toLocaleString().split(',')[0].split('/');
                            $.ajax({
                                url: "calendar/getEventsPerMonth/" + date[0] + "/" + date[2],
                                method: 'post',
                                success: function (response) {
                                    calendar.removeAllEvents();
                                    var events = JSON.parse(response);
                                    events.map(function (value) {
                                        calendar.addEvent(value);
                                    });
                                },
                            });

                        }
                    }
                },
                editable: true,
                selectable: true,
                eventLimit: true, // when too many events in a day, show the popover
                {{--events: [--}}
                        {{--    <?php--}}
                        {{--    if (isset($events)) {--}}
                        {{--        foreach ($events as $event) {--}}
                        {{--            echo $event . ',';--}}
                        {{--        }--}}
                        {{--    }--}}
                        {{--    ?>],--}}
                dateClick: function (info) {
                    console.log(calendar.getDate().toLocaleString());
                    $('#add_event').modal('show');
                    $('#add_event #start').val(info.dateStr);
                    $('#add_event #end').val(info.dateStr);
                },
                select: function (info) {
                    $('#add_event').modal('show');
                    $('#add_event #start').val(info.startStr);
                    $('#add_event #end').val(info.endStr);
                },
                eventDrop: function (info) {
                    var start = info.event.start.toISOString().substring(0, 10);
                    if (info.event.end !== null) {
                        var end = info.event.end.toISOString().substring(0, 10)
                    } else {
                        var end = info.event.start.toISOString().substring(0, 10)
                    }

                    $.ajax({
                        url: "<?=route_to('calendar.update')?>",
                        method: 'post',
                        data: {
                            drag: true,
                            id: info.event.id,
                            title: info.event.title,
                            start: start,
                            end: end,
                            note: info.event.extendedProps.note,
                            ["<?=csrf_token();?>"]: "<?=csrf_hash();?>"
                        },
                        dataType: 'json',
                        success: function (response) {
                            //TODO add flash message
                        }
                    });

                },
                eventClick: function (info) {
                    console.log(info.event);
                    $('#edit_event').modal('show');
                    $('#edit_event #edit_id').val(info.event.id);
                    $.ajax({
                        url: "calendar/get/" + info.event.id,
                        success: function (result) {
                            var event = JSON.parse(result);
                            $('#edit_event #edit_id').val(event.id);
                            $('#edit_event #edit_title').val(event.title);
                            $('#edit_event #edit_start').val(event.start.substring(0, 10));
                            $('#edit_event #edit_end').val(event.end.substring(0, 10));
                            $('#edit_event #edit_note').val(event.note);
                        }
                    });
                }
            });
            <?php if(isset($active) && $active == "calendar"){?>
            calendar.render();
            var date = calendar.getDate().toLocaleString().split(',')[0].split('/');
            $.ajax({
                url: "calendar/getEventsPerMonth/" + date[0] + "/" + date[2],
                method: 'post',
                success: function (response) {
                    calendar.removeAllEvents();
                    var events = JSON.parse(response);
                    events.map(function (value) {
                        calendar.addEvent(value);
                    });
                },
            });
            <?php }?>
        });

        $('.fc-button-prev span').on('click', function () {
            console.log('test');
        });

        $('.fc-button-next span').on('click', function () {
            console.log('test');
        });

        $('.event_sidebar').on('click', function () {
            $('#edit_event').modal('show');
            var id = $(this).data('id');
            $.ajax({
                url: "calendar/get/" + id, success: function (result) {
                    var event = JSON.parse(result);
                    $('#edit_event #edit_id').val(event.id);
                    $('#edit_event #edit_title').val(event.title);
                    $('#edit_event #edit_start').val(event.start.substring(0, 10));
                    $('#edit_event #edit_end').val(event.end.substring(0, 10));
                    $('#edit_event #edit_note').val(event.note);
                }
            });
        });

        $('.edit_schedule').on('click', function () {
            $('#edit_schedule').modal('show');
            var id = $(this).data('id');
            var tr = $(this).closest('tr');
            var data = tr.children("td").map(function () {
                return $(this).text();
            }).get();
            var working_days = $(this).data('days');

            $('#edit_schedule #edit_id').val(id);
            $('#edit_schedule #edit_morning_in').val(convertTo24Hour(data[0]));
            $('#edit_schedule #edit_morning_out').val(convertTo24Hour(data[1]));
            $('#edit_schedule #edit_afternoon_in').val(convertTo24Hour(data[2]));
            $('#edit_schedule #edit_afternoon_out').val(convertTo24Hour(data[3]));
            $('#edit_schedule .working_days').each(function (index) {
                if (working_days.includes(index)) {
                    $(this).prop("checked", true);
                }
            });

        });

        $('.delete_schedule').on('click', function () {
            $('#delete_schedule').modal('show');
            $('#delete_schedule #delete_id').val($(this).data('id'));
        });

        $('.edit_position').on('click', function () {
            $('#edit_position').modal('show');
            var id = $(this).data('id');
            var tr = $(this).closest('tr');
            var data = tr.children("td").map(function () {
                return $(this).text();
            }).get();
            var schedule = $(tr.children("td")[2]).data('id');

            $('#edit_position #id').val(id);
            $('#edit_position #position').val(data[0]);
            $('#edit_position #rate').val(data[1]);
            $('#edit_position #schedule_id').val(schedule)

        });

        $('.delete_position').on('click', function () {
            $('#delete_position').modal('show');
            var id = $(this).data('id');
            $('#delete_position #id').val(id);
        });

        $('.accept_overtime').on('click', function () {
            $('#accept_overtime').modal('show');
            var id = $(this).data('id');
            $('#accept_overtime #id').val(id);
        });

        $('.reject_overtime').on('click', function () {
            $('#reject_overtime').modal('show');
            var id = $(this).data('id');
            $('#reject_overtime #id').val(id);
        });

        $('.accept_leave').on('click', function () {
            $('#accept_leave').modal('show');
            var id = $(this).data('id');
            $('#accept_leave #id').val(id);
        });

        $('.reject_leave').on('click', function () {
            $('#reject_leave').modal('show');
            var id = $(this).data('id');
            $('#reject_leave #id').val(id);
        });

        $('#position_id').on('click', function () {
            $('#monthly_pay').val($(this).find(':selected').data('salary'));
            var schedule = $(this).find(':selected').data('schedule');
            $('#add_employee #morning_in').val(schedule['morning_in']);
            $('#add_employee #morning_out').val(schedule['morning_out']);
            $('#add_employee #afternoon_in').val(schedule['afternoon_in']);
            $('#add_employee #afternoon_out').val(schedule['afternoon_out']);
            $('#add_employee .working_days').each(function (index) {
                if (schedule['working_days'].includes(index)) {
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            });
        });


        function convertTo24Hour(time) {
            var hours = parseInt(time.substr(0, 2));
            if (time.indexOf('AM') != -1 && hours == 12) {
                time = time.replace('12', '00');
            }
            if (time.indexOf('PM') != -1 && hours < 12) {
                time = time.replace(hours, (hours + 12));
                time = (time[0] == "0" ? time.substr(1) : time);
            }
            return time.replace(/( AM| PM)/, '');
        }

        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            var ampm = h >= 12 ? 'PM' : 'AM';
            m = checkTime(m);
            s = checkTime(s);
            $("#time_display").text(
                (h % 12 == 0 ? 12 : h % 12) + ":" + m + ":" + s + " " + ampm);
            var t = setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }
            // add zero in front of numbers < 10
            return i;
        }

        window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 2000);

        function setInputFilter(textbox, inputFilter) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "contextmenu", "drop"].forEach(function (event) {
                for (var i = 0; i < textbox.length; i++) {
                    textbox[i].addEventListener(event, function () {

                        if (inputFilter(this.value.trim())) {
                            this.oldValue = this.value;
                            this.oldSelectionStart = this.selectionStart;
                            this.oldSelectionEnd = this.selectionEnd;
                        } else if (this.hasOwnProperty("oldValue")) {
                            this.value = this.oldValue;
                            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                        } else {
                            this.value = "";
                        }
                        this.value = this.value.trim();
                        if (this.value != '') {
                            this.value = parseInt(this.value);
                        }

                    });
                }
            });
        }

        setInputFilter(document.getElementsByClassName("time_h_input"), function (value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 12);
        });

        setInputFilter(document.getElementsByClassName("time_m_input"), function (value) {

            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 59);
        });

        setInputFilter(document.getElementsByClassName("ca-num-input"), function (value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) >= 1);
        });

        setInputFilter(document.getElementsByClassName("late-h"), function (value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 12);
        });

        setInputFilter(document.getElementsByClassName("late-m"), function (value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 59);
        });

        $('.time_h_input').on('blur', function () {
            var h = $(this);
            var m = $(this).next();

            h.val(h.val().padStart(2, 0));

            if (h.val() != "" && m.val() == "") {
                m.val("00");
            }
            if ((h.val() == "" || h.val() == "00") && (m.val() == "" || m.val() == "00")) {
                m.val('');
                h.val('');
            }
            updateDtrTime(h);
        });

        $('.time_m_input').on('blur', function () {
            var m = $(this);
            var h = $(this).prev();

            m.val(m.val().padStart(2, 0));

            if (m.val() != "" && h.val() == "") {
                h.val("00");
            }

            if ((h.val() != "" || h.val() != "00") && m.val() == '') {
                m.val("00");
            }


            if ((h.val() == "" || h.val() == "00") && (m.val() == "" || m.val() == "00")) {
                m.val('');
                h.val('');
            }
            updateDtrTime(h);
        });

        function updateDtrTime(input) {

            var tr = $(input).closest('tr');
            var inputs = $(tr).find("input");
            var data = inputs.map(function () {
                return $(this).val();
            });
            var m_time = getTimeDiff(data[0], data[1], data[2], data[3]);
            var a_time = getTimeDiff(data[5], data[6], data[7], data[8]);
            var o_time = getTimeDiff(data[10], data[11], data[12], data[13]);
            var pre_time = (Math.round((m_time + a_time) * 100) / 100);
            var late_time = pre_time - 8;
            var ot_time = o_time;
            if (late_time < 0) {
                late_time = Math.abs(late_time);
            } else {
                ot_time += late_time;
                pre_time = 8;
                late_time = 0;
            }

            $(tr).find('.m_time').text(m_time == 0 ? '' : m_time.toFixed(2));
            $(tr).find('.m_time_i').val(m_time == 0 ? '' : m_time.toFixed(2));
            $(tr).find('.a_time').text(a_time == 0 ? '' : a_time.toFixed(2));
            $(tr).find('.a_time_i').val(a_time == 0 ? '' : a_time.toFixed(2));
            $(tr).find('.o_time').text(o_time == 0 ? '' : o_time.toFixed(2));
            $(tr).find('.o_time_i').val(o_time == 0 ? '' : o_time.toFixed(2));
            $(tr).find('.pre_time').text(pre_time != 0 ? pre_time.toFixed(2) : '');
            $(tr).find('.pre_time_i').val(pre_time != 0 ? pre_time.toFixed(2) : '');
            $(tr).find('.ot_time').text(ot_time != 0 ? ot_time.toFixed(2) : '');
            $(tr).find('.ot_time_i').val(ot_time != 0 ? ot_time.toFixed(2) : '');
            $(tr).find('.late_time').text(late_time != 0 ? late_time.toFixed(2) : '');
            $(tr).find('.late_time_i').val(late_time != 0 ? late_time.toFixed(2) : '');

            if (pre_time < 8) {
                $(tr).find('.pre_time_i').closest('td').addClass('dtr-flag');
                $(tr).find('.ot_time').closest('td').addClass('dtr-flag');
                $(tr).find('.late_time').closest('td').addClass('dtr-flag');
            } else {
                $(tr).find('.pre_time_i').closest('td').removeClass('dtr-flag');
                $(tr).find('.ot_time').closest('td').removeClass('dtr-flag');
                $(tr).find('.late_time').closest('td').removeClass('dtr-flag');
            }


            var total_pre = 0;
            var pre_data = $('.pre_time').map(function () {
                return $(this).text();
            });

            pre_data.each(function (index, item) {
                if (item.trim() != '') {
                    total_pre += parseFloat(item);
                }
            });

            var total_ot = 0;
            var ot_data = $('.o_time').map(function () {
                return $(this).text();
            });
            ot_data.each(function (index, item) {
                if (item.trim() != '') {
                    total_ot += parseFloat(item);
                }
            });

            var total_late = 0;
            var late_data = $('.late_time').map(function () {
                return $(this).text();
            });
            late_data.each(function (index, item) {
                if (item.trim() != '') {
                    total_late += parseFloat(item);
                }
            });

            $('#total_pre').text(total_pre.toFixed(2));
            $('#total_ot').text(total_ot.toFixed(2));
            $('#total_late').text(total_late.toFixed(2));
        }

        function getTimeDiff(in_h, in_m, out_h, out_m) {

            if (in_h == '' || in_m == '' || out_h == '' || out_m == '') {
                return 0;
            }
            var time_in = new Date();
            time_in.setHours(in_h);
            time_in.setMinutes(in_m);

            var time_out = new Date();
            time_out.setHours(out_h);
            time_out.setMinutes(out_m);


            var mins = (time_in.getTime() - time_out.getTime()) / 1000;
            var diff = (mins / 60) / 60;

            return Math.abs(Math.round(diff * 100) / 100);
        }

        $('#payroll-table').stickyTable({
            copyTableClass: true,
            overflowy: true
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $('.edit_cash_advance').on('click', function () {
            $('#edit_cash_advance').modal('show');
            var id = $(this).data('id');
            var tr = $(this).closest('tr');
            var data = tr.children("td").map(function () {
                return $(this).text();
            }).get();

            $('#edit_cash_advance #edit_cash_advance_id').val(id);
            $('#edit_cash_advance #edit_employee_name').val(data[1]);
            $('#edit_cash_advance #edit_request_date').val(data[0]);
            $('#edit_cash_advance #edit_amount').val(data[4]);
            $('#edit_cash_advance #edit_repayment').val(data[5]);
            $('#edit_cash_advance #edit_purpose').val(data[8]);
        });

        $('.delete_cash_advance').on('click', function () {
            alert('delete    ');
        });

        $('.ca-table tr').each(function () {
            $(this).on('click', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: "cash-advance-detail/get/" + id, success: function (result) {
                        var ca = JSON.parse(result);

                        $('#ca_name').text(ca.employee.lastname.toUpperCase() + " " + ca.employee.firstname.toUpperCase());
                        $('#ca_amount').text(ca.amount);
                        $('#ca_balance').text(ca.balance);
                        $('#ca_purpose').text(ca.purpose);
                        $('#ca_request_date').text(ca.request_date);
                        $('#ca_repayment').text(ca.repayment);
                        $('#ca_paid').text((ca.balance == 0 ? 'Yes' : 'No'));
                        var total_paid = ca.amount - ca.balance;
                        if (ca.cash_advance_details.length >= 1) {
                            console.log(ca.cash_advance_details);
                            $('.ca-details-table tbody tr').remove();
                            var body = $('.ca-details-table tbody');
                            var bal_amount = ca.amount;
                            for (var i = 0; i < ca.cash_advance_details.length; i++) {
                                var tr = document.createElement('tr');
                                var range = document.createElement('td');
                                var payrolll_no = document.createElement('td');
                                var amount = document.createElement('td');
                                var bal = document.createElement('td');
                                range.innerHTML = ca.cash_advance_details[i].payroll_range;
                                payrolll_no.innerHTML = ca.cash_advance_details[i].payroll_id;
                                amount.innerHTML = ca.cash_advance_details[i].amount_paid;
                                bal_amount -= ca.cash_advance_details[i].amount_paid;
                                bal.innerHTML = bal_amount;
                                tr.append(range);
                                tr.append(payrolll_no);
                                tr.append(amount);
                                tr.append(bal);
                                body.append(tr);
                            }
                            var tra = document.createElement('tr');
                            var tp = document.createElement('td');
                            var tpa = document.createElement('td');
                            var td = document.createElement('td');
                            $(tp).attr('colspan', 2);
                            $(tp).addClass('text-right');
                            tp.innerHTML = "Total Paid :";
                            tpa.innerHTML = total_paid;
                            tra.append(tp);
                            tra.append(tpa);
                            tra.append(td);
                            body.append(tra);
                        }
                    }
                });

            });
        });

        $('.edit_payroll').on('click', function () {
            $('#edit_payroll').modal('show');
            var id = $(this).data('id');
            $.ajax({
                url: "payroll/get/" + id, success: function (result) {
                    var payroll = JSON.parse(result);
                    //Employee Basic Information
                    $('#edit_payroll #id').val(payroll.id);
                    $('#edit_payroll #name').text(payroll.employee.lastname + " " + payroll.employee.firstname);
                    $('#edit_payroll #email').text(payroll.employee.email);
                    $('#edit_payroll #position').text(payroll.employee.position.position);
                    $('#edit_payroll #tel_no').text(payroll.employee.tel_no);
                    $('#edit_payroll #mobile').text(payroll.employee.mobile_no);
                    $('#edit_payroll #bank').text(payroll.employee.bank);
                    $('#edit_payroll #tin_no').text(payroll.employee.tin_no);
                    $('#edit_payroll #sss_no').text(payroll.employee.sss_no);
                    $('#edit_payroll #philhealth_no').text(payroll.employee.philhealth_no);
                    $('#edit_payroll #pagibig_no').text(payroll.employee.pagibig_no);
                    //Employee Time Record
                    $('#edit_payroll #dtr_time').val(payroll.dtr_time);
                    $('#edit_payroll #late').val(payroll.late);
                    $('#edit_payroll #absent').val(payroll.absent);
                    $('#edit_payroll #total_ot').val(payroll.total_ot);
                    $('#edit_payroll #with_tax').val(payroll.with_tax);
                    $('#edit_payroll #phi').val(payroll.phi);
                    $('#edit_payroll #sss').val(payroll.sss);
                    $('#edit_payroll #hdmf').val(payroll.hdmf);
                    // if (payroll.cash_advance == 0) {
                    //     $('#edit_payroll #cash_advance').prop('disabled',true);
                    // }
                    $('#edit_payroll #cash_advance').val(payroll.cash_advance);
                    $('#edit_payroll #sss_loan').val(payroll.sss_loan);
                    $('#edit_payroll #other_deduction').val(payroll.other_deduction);
                    $('#edit_payroll #hdmf_loan').val(payroll.hdmf_loan);
                    // Employee Deduction
                    $('#edit_payroll #basic_salary').val(payroll.basic_salary);
                    $('#edit_payroll #normal_ot_pay').val(payroll.normal_ot_pay);
                    $('#edit_payroll #rd_sunday_ot_pay').val(payroll.rd_sunday_ot_pay);
                    $('#edit_payroll #rd_special_ot_pay').val(payroll.rd_special_ot_pay);
                    $('#edit_payroll #rd_regular_ot_pay').val(payroll.rd_regular_ot_pay);
                    $('#edit_payroll #rd_double_ot_pay').val(payroll.rd_double_ot_pay);
                    $('#edit_payroll #rd_sunday_pay').val(payroll.rd_sunday_pay);
                    $('#edit_payroll #rd_special_pay').val(payroll.rd_special_pay);
                    $('#edit_payroll #rd_regular_pay').val(payroll.rd_regular_pay);
                    $('#edit_payroll #rd_double_pay').val(payroll.rd_double_pay);
                    $('#edit_payroll #nd_regular_ot_pay').val(payroll.nd_regular_ot_pay);
                    $('#edit_payroll #nd_special_ot_pay').val(payroll.nd_special_ot_pay);
                    $('#edit_payroll #nd_double_ot_pay').val(payroll.nd_double_ot_pay);
                    $('#edit_payroll #nd_regular_pay').val(payroll.nd_regular_pay);
                    $('#edit_payroll #nd_special_pay').val(payroll.nd_special_pay);
                    $('#edit_payroll #nd_double_pay').val(payroll.nd_double_pay);
                    $('#edit_payroll #allowance').val(payroll.allowance);
                    $('#edit_payroll #other_income').val(payroll.other_income);
                    console.log(payroll);
                }
            });
        });

        $('.payroll-row').on('click', function () {
            $('.payroll-selected').each(function () {
                $(this).removeClass("payroll-selected");
            });
            var index = $(this).data('id');

            var payroll_table = $('.payroll-table tbody').children()[index];
            $(payroll_table).addClass('payroll-selected');

            var sticky_col = $('.sticky-col tbody').children()[index];
            $(sticky_col).addClass('payroll-selected');

            var sticky_intersect = $('.sticky-intersect tbody').children()[index];
            $(sticky_intersect).addClass('payroll-selected');

        });

        $('.payroll_notes').on('click', function () {
            $('#payroll_notes ').modal('show');
        });

        $('.payslip').on('click', function () {
            $('#payslip').modal('show');
            var id = $(this).data('id');
            $.ajax({
                url: "payroll/get/" + id, success: function (result) {
                    var payroll = JSON.parse(result);

                    // $('#payslip #payslip_title').text(payroll.employee.firstname + " " + payroll.employee.lastname+" Payslip For "+
                    //     date_from.toLocaleString('default', { month: 'long' }) + " "+ date_from.getFullYear() + " "+date_from.getDate()+" - "+date_to.getDate());

                    $('#payslip #id').val(payroll.id);
                    $('#payslip #name').text(payroll.employee.firstname + " " + payroll.employee.lastname);
                    $('#payslip #position').text(payroll.employee.position.position);
                    $('#payslip #monthly_pay').text(payroll.employee.monthly_pay);
                    $('#payslip #sss_no').text(payroll.employee.sss_no);
                    var date_from = new Date(payroll.from);
                    var date_to = new Date(payroll.to);
                    $('#payslip #payroll_period').text(date_from.toLocaleString('default', {month: 'long'}) + " " +
                        date_from.getFullYear() + " " + date_from.getDate() + " - " + date_to.getDate());
                    $('#payslip #bank_name').text(payroll.employee.bank_name);
                    $('#payslip #tin_no').text(payroll.employee.tin_no);
                    $('#payslip #philhealth_no').text(payroll.employee.philhealth_no);
                    $('#payslip #pagibig_no').text(payroll.employee.pagibig_no);
                    $('#payslip #basic_salary').text(payroll.basic_salary);
                    $('#payslip #allowance').text(payroll.allowance);
                    $('#payslip #total_ot_pay').text(payroll.total_ot_pay);
                    $('#payslip #total_holiday_pay').text(payroll.total_holiday_pay);
                    $('#payslip #thirteenth_month_pay').text(payroll.thirteenth_month_pay);
                    $('#payslip #other_income').text(payroll.other_income);
                    $('#payslip #gross_pay').text(payroll.gross_pay);
                    $('#payslip #late').text(payroll.late + ' (mins)');
                    $('#payslip #absent').text(payroll.absent + ' day(s)');
                    $('#payslip #sss').text(payroll.sss);
                    $('#payslip #hdmf').text(payroll.hdmf);
                    $('#payslip #phi').text(payroll.phi);
                    $('#payslip #with_tax').text(payroll.with_tax);
                    $('#payslip #cash_advance').text(payroll.cash_advance);
                    $('#payslip #total_deduction').text(payroll.total_deduction);
                    $('#payslip #net_pay').text((payroll.net_pay).toFixed(2));
                    $('#payslip #payslip_title').text(payroll.employee.firstname + " " + payroll.employee.lastname + " Payslip For " +
                        date_from.toLocaleString('default', {month: 'long'}) + " " + date_from.getFullYear() + " " + date_from.getDate() + " - " + date_to.getDate());

                }
            });

        });

        $('.view_employee').on('click', function () {
            $('#view_employee').modal('show');
            var id = $(this).data('id');
            $.ajax({
                url: "employee/get/" + id, success: function (result) {
                    var employee = JSON.parse(result);

                    $('#view_employee #view_firstname').val(employee.firstname);
                    $('#view_employee #view_middle').val(employee.middle);
                    $('#view_employee #view_lastname').val(employee.lastname);
                    $('#view_employee .sex-radio').each(function () {
                        if ($(this).val() == employee.gender) {
                            $(this).prop('checked', true);
                        } else {
                            $(this).prop('disabled', true);
                        }
                    });
                    $('#view_employee #view_birth_date').val(employee.birth_date);
                    $('#view_employee #view_marital_status_id').val(employee.marital_status_id);
                    $('#view_employee #view_address').val(employee.address);
                    $('#view_employee #view_mobile_no').val(employee.mobile_no);
                    $('#view_employee #view_tel_no').val(employee.tel_no);
                    $('#view_employee #view_email').val(employee.email);
                    $('#view_employee #view_contact_person').val(employee.contact_person);
                    $('#view_employee #view_contact_person_no').val(employee.contact_person_no);
                    $('#view_employee #view_date_hired').val(employee.date_hired);
                    $('#view_employee #view_bank_name').val(employee.bank_name);
                    $('#view_employee #view_tin_no').val(employee.tin_no);
                    $('#view_employee #view_philhealth_no').val(employee.philhealth_no);
                    $('#view_employee #view_sss_no').val(employee.sss_no);
                    $('#view_employee #view_pagibig_no').val(employee.pagibig_no);
                    $('#view_employee #view_is_active').val(employee.is_active);
                    $('#view_employee #view_position_id').val(employee.position_id);
                    $('#view_employee #view_monthly_pay').val(employee.monthly_pay);
                    if (employee.schedule == null) {
                        $('#view_employee #view_morning_in').val(employee.position.schedule.morning_in);
                        $('#view_employee #view_morning_out').val(employee.position.schedule.morning_out);
                        $('#view_employee #view_afternoon_in').val(employee.position.schedule.afternoon_in);
                        $('#view_employee #view_afternoon_out').val(employee.position.schedule.afternoon_out);
                        $('#view_employee .working_days').each(function (index) {
                            if (employee.position.schedule.working_days.includes(index)) {
                                $(this).prop("checked", true);
                            }
                        });
                    } else {
                        $('#view_employee #view_morning_in').val(employee.schedule.morning_in);
                        $('#view_employee #view_morning_out').val(employee.schedule.morning_out);
                        $('#view_employee #view_afternoon_in').val(employee.schedule.afternoon_in);
                        $('#view_employee #view_afternoon_out').val(employee.schedule.afternoon_out);
                        $('#view_employee .working_days').each(function (index) {
                            if (employee.schedule.working_days.includes(index)) {
                                $(this).prop("checked", true);
                            }
                        });
                    }
                    $('#view_employee #view_is_fixed_salary').val(employee.is_fixed_salary);
                    $('#view_employee #view_can_ot').val(employee.can_ot);
                    $('#view_employee #view_transportation_allowance').val(employee.transportation_allowance);
                    $('#view_employee #view_internet_allowance').val(employee.internet_allowance);
                    $('#view_employee #view_meal_allowance').val(employee.meal_allowance);
                    $('#view_employee #view_phone_allowance').val(employee.phone_allowance);
                }
            });
        });

        $('.edit_employee').on('click', function () {
            $('#edit_employee').modal('show');
            var id = $(this).data('id');
            $.ajax({
                url: "employee/get/" + id, success: function (result) {
                    var employee = JSON.parse(result);
                    $('#edit_id').val(employee.id);
                    $('#edit_employee #edit_firstname').val(employee.firstname);
                    $('#edit_employee #edit_middle').val(employee.middle);
                    $('#edit_employee #edit_lastname').val(employee.lastname);
                    $('#edit_employee .sex-radio').each(function () {
                        if ($(this).val() == employee.gender) {
                            $(this).prop('checked', true);
                        }
                    });
                    $('#edit_employee #edit_birth_date').val(employee.birth_date);
                    $('#edit_employee #edit_marital_status_id').val(employee.marital_status_id);
                    $('#edit_employee #edit_address').val(employee.address);
                    $('#edit_employee #edit_mobile_no').val(employee.mobile_no);
                    $('#edit_employee #edit_tel_no').val(employee.tel_no);
                    $('#edit_employee #edit_email').val(employee.email);
                    $('#edit_employee #edit_contact_person').val(employee.contact_person);
                    $('#edit_employee #edit_contact_person_no').val(employee.contact_person_no);
                    $('#edit_employee #edit_date_hired').val(employee.date_hired);
                    $('#edit_employee #edit_bank_name').val(employee.bank_name);
                    $('#edit_employee #edit_tin_no').val(employee.tin_no);
                    $('#edit_employee #edit_philhealth_no').val(employee.philhealth_no);
                    $('#edit_employee #edit_sss_no').val(employee.sss_no);
                    $('#edit_employee #edit_pagibig_no').val(employee.pagibig_no);
                    $('#edit_employee #edit_is_active').val(employee.is_active);
                    $('#edit_employee #edit_position_id').val(employee.position_id);
                    $('#edit_employee #edit_monthly_pay').val(employee.monthly_pay);
                    if (employee.schedule == null) {
                        $('#edit_employee #edit_morning_in').val(employee.position.schedule.morning_in);
                        $('#edit_employee #edit_morning_out').val(employee.position.schedule.morning_out);
                        $('#edit_employee #edit_afternoon_in').val(employee.position.schedule.afternoon_in);
                        $('#edit_employee #edit_afternoon_out').val(employee.position.schedule.afternoon_out);
                        $('#edit_employee .working_days').each(function (index) {
                            if (employee.position.schedule.working_days.includes(index)) {
                                $(this).prop("checked", true);
                            }
                        });
                    } else {
                        $('#edit_employee #edit_morning_in').val(employee.schedule.morning_in);
                        $('#edit_employee #edit_morning_out').val(employee.schedule.morning_out);
                        $('#edit_employee #edit_afternoon_in').val(employee.schedule.afternoon_in);
                        $('#edit_employee #edit_afternoon_out').val(employee.schedule.afternoon_out);
                        $('#edit_employee .working_days').each(function (index) {
                            if (employee.schedule.working_days.includes(index)) {
                                $(this).prop("checked", true);
                            }
                        });
                    }
                    $('#edit_employee #edit_is_fixed_salary').val(employee.is_fixed_salary);
                    $('#edit_employee #edit_can_ot').val(employee.can_ot);
                    $('#edit_employee #edit_transportation_allowance').val(employee.transportation_allowance);
                    $('#edit_employee #edit_internet_allowance').val(employee.internet_allowance);
                    $('#edit_employee #edit_meal_allowance').val(employee.meal_allowance);
                    $('#edit_employee #edit_phone_allowance').val(employee.phone_allowance);
                }
            });
        });

        $('.delete_employee').on('click', function () {
            $('#delete_employee').modal('show');
            var id = $(this).data('id');
            $('#delete_employee #delete_id').val(id);
        });

        $('.restore_employee').on('click', function () {
            $('#restore_employee').modal('show');
            var id = $(this).data('id');
            $('#restore_employee #restore_id').val(id);
        });
        $('.ss_input').on('blur', function () {
            $('#edit_sss_lookup #edit_ss_total').val((parseFloat($('#edit_sss_lookup #edit_ss_er').val()) + parseFloat($('#edit_sss_lookup #edit_ss_ee').val())).toFixed(2));
            $('#edit_sss_lookup #add_ss_total').val((parseFloat($('#edit_sss_lookup #add_ss_er').val()) + parseFloat($('#edit_sss_lookup #add_ss_ee').val())).toFixed(2));
        });

        $('.tc_input').on('blur', function () {
            $('#edit_sss_lookup #edit_tc_total').val((parseFloat($('#edit_sss_lookup #edit_tc_er').val()) + parseFloat($('#edit_sss_lookup #edit_tc_ee').val())).toFixed(2));
            $('#edit_sss_lookup #add_tc_total').val((parseFloat($('#edit_sss_lookup #add_tc_er').val()) + parseFloat($('#edit_sss_lookup #add_tc_ee').val())).toFixed(2));
        });

        $('.edit_sss_lookup').on('click', function () {
            $('#edit_sss_lookup').modal('show');
            var id = $(this).data('id');
            var tr = $(this).closest('tr');
            var data = tr.children("td").map(function () {
                return $(this).text();
            }).get();

            $('#edit_sss_lookup #edit_sss_lookup_id').val(id);
            $('#edit_sss_lookup #edit_from').val(data[0].replace(',', ''));
            $('#edit_sss_lookup #edit_to').val(data[1].replace(',', ''));
            $('#edit_sss_lookup #edit_salary_credit').val(data[2].replace(',', ''));
            $('#edit_sss_lookup #edit_ss_er').val(data[3].replace(',', ''));
            $('#edit_sss_lookup #edit_ss_ee').val(data[4].replace(',', ''));
            $('#edit_sss_lookup #edit_ss_total').val(data[5].replace(',', ''));
            $('#edit_sss_lookup #edit_ec_er').val(data[6].replace(',', ''));
            $('#edit_sss_lookup #edit_tc_er').val(data[7].replace(',', ''));
            $('#edit_sss_lookup #edit_tc_ee').val(data[8].replace(',', ''));
            $('#edit_sss_lookup #edit_tc_total').val(data[9].replace(',', ''));
        });

        $("#edit_sss_lookup").on("keypress", function (event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
            }
        });

        $('.delete_sss_lookup').on('click', function () {
            $('#delete_sss_lookup').modal('show');
            $('#delete_sss_lookup #delete_id').val($(this).data('id'));
        });

        $('.edit_penalty').on('click', function () {
            $('#edit_late_penalty').modal('show');
            var id = $(this).data('id');
            var tr = $(this).closest('tr');
            var data = tr.children("td").map(function () {
                return $(this).text();
            }).get();
            $('#edit_late_penalty #edit_id').val(id);
            $('#edit_late_penalty #edit_from_h').val(data[0].split(':')[0]);
            $('#edit_late_penalty #edit_from_m').val(data[0].split(':')[1]);
            $('#edit_late_penalty #edit_to_h').val(data[1].split(':')[0]);
            $('#edit_late_penalty #edit_to_m').val(data[1].split(':')[1]);
            $('#edit_late_penalty #edit_equivalent_h').val(data[2].split(':')[0]);
            $('#edit_late_penalty #edit_equivalent_m').val(data[2].split(':')[1]);
        });

        $('.delete_penalty').on('click', function () {
            $('#delete_late_penalty').modal('show');
            $('#delete_late_penalty #delete_id').val($(this).data('id'));
        });

        //TODO Bug Report

        $('.edit_bug_report').on('click', function () {
            $('#edit_bug_report').modal('show');
            var id = $(this).data('id');
            var tr = $(this).closest('tr');
            var data = tr.children("td").map(function () {
                return $(this).text();
            }).get();
            $('#edit_bug_report #edit_id').val(id);
            $('#edit_bug_report #edit_bug').val(data[0]);
            $('#edit_bug_report #edit_tester').val(data[2]);
            $('#edit_bug_report #edit_urgency').val(data[3]);
            $('#edit_bug_report #edit_date_reported').val(data[4]);
            $('#edit_bug_report #edit_status').val(data[5]);
            console.log(data);
        });

        $('.fixed_bug_report').on('click', function () {
            $('#fixed_bug_report').modal('show');
            var id = $(this).data('id');
            $('#fixed_bug_report #fixed_id').val(id);
        });

        $('.delete_bug_report').on('click', function () {
            $('#delete_bug_report').modal('show');
            var id = $(this).data('id');
            $('#delete_bug_report #delete_id').val(id);
        });
    })(jQuery);
</script>
`