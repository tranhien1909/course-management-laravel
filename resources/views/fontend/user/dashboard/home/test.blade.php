<!-- Bootstrap v3.3.5 CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<!-- FullCalendar v2.2.0 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.0/fullcalendar.min.css" rel="stylesheet">

<style>
    #calendar {
        max-width: 1200px;
        margin: 0 auto;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>


<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>LỊCH HỌC </h5>
        </div>
        <div class="ibox-content">
            <div id="calendar"></div>
        </div>
    </div>

</div>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Moment.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- FullCalendar v2.2.0 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.0/fullcalendar.min.js"></script>
<!-- Bootstrap v3.3.5 JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Khởi tạo các biến ngày, tháng, năm
        var date = new Date();
        var d = date.getDate(); // Ngày hiện tại
        var m = date.getMonth(); // Tháng hiện tại (0-11)
        var y = date.getFullYear(); // Năm hiện tại

        // Khởi tạo FullCalendar
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultView: 'month', // View mặc định
            editable: true, // Cho phép chỉnh sửa sự kiện
            droppable: true, // Cho phép kéo thả sự kiện
            events: [{
                    title: 'All Day Event',
                    start: new Date(y, m, 1) // Sử dụng biến y đã khai báo
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d - 5),
                    end: new Date(y, m, d - 2)
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d - 3, 16, 0),
                    allDay: false
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d + 4, 16, 0),
                    allDay: false
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d + 1, 19, 0),
                    end: new Date(y, m, d + 1, 22, 30),
                    allDay: false
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/'
                }
            ],
            eventClick: function(event) {
                // Xử lý khi click vào sự kiện
                if (event.url) {
                    window.open(event.url);
                    return false;
                }
            },
            eventDrop: function(event, delta, revertFunc) {
                // Xử lý khi kéo thả sự kiện
                alert(event.title + " was dropped on " + event.start.format());
            },
            eventResize: function(event, delta, revertFunc) {
                // Xử lý khi thay đổi thời gian sự kiện
                alert(event.title + " end is now " + event.end.format());
            }
        });
    });
</script>
