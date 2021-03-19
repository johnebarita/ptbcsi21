(function ($) {
    "use strict"; // Start of use strict

    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            $('.sidebar .collapse').collapse('hide');
        }
        ;
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function () {
        if ($(window).width() < 768) {
            $('.sidebar .collapse').collapse('hide');
        }
        ;

        // Toggle the side navigation when window is resized below 480px
        if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
            $("body").addClass("sidebar-toggled");
            $(".sidebar").addClass("toggled");
            $('.sidebar .collapse').collapse('hide');
        }
        ;
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
    });

    $('#time_display').on('load',function () {
        alert('test');
    });

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid'],
            timeZone: 'UTC',
            header: {
                right: 'prev,next today',
                center: 'title',
                left:''
            },
            editable: true,
            selectable: true,
            eventLimit: true, // when too many events in a day, show the popover
            // events: 'https://fullcalendar.io/demo-events.json?overload-day',
            events:[],
            dateClick: function (info) {
                alert('clicked ' + info.dateStr);
            },
            // select: function(info) {
            //     alert('selected ' + info.startStr + ' to ' + info.endStr);
            // }
        });

        calendar.render();
    });

    $('.edit_schedule').on('click', function () {
        $('#edit_schedule').modal('show');
        var id = $(this).data('id');
        var tr = $(this).closest('tr');
        var data = tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#edit_schedule #id').val(id);
        $('#edit_schedule #time_in').val(convertTo24Hour(data[0]));
        $('#edit_schedule #time_out').val(convertTo24Hour(data[1]));
    });

    $('.delete_schedule').on('click', function () {
        $('#delete_schedule').modal('show');
        var id = $(this).data('id');
        $('#delete_schedule #id').val(id);
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
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('txt').innerHTML =
            h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
    }

    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }

})(jQuery); // End of use strict
