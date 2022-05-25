<?php
if (!isset($_SESSION['loguserid']))
    return header("location: login");

$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new pageController;
$privilege = new privilegeController;
$mat = new materialController;

date_default_timezone_set('Asia/Colombo');
$date = date('Y-m-d');
$day = date('d');
$year = date('Y');
?>
<!-- Start Calender  -->
<link rel="shortcut icon" href="/../public/img/school.png">
<link rel="stylesheet" href="/../public/css/calender/fullcalendar.min.css">
<link rel="stylesheet" href="/../public/css/calender/fullcalendar.print.min.css" media='print'>
<script src="/../public/js/calender/fullcalendar.min.js"></script>
<script src="/../public/js/calender/moment.min.js"></script>
<link rel="stylesheet" href="/../public/css/bucket/clndr.css">
<link rel="stylesheet" href="/../public/css/bucket/clock/css/style.css">
<!-- End Calender -->
<link rel="stylesheet" href="/../public/css/bucket/style.css">
<script src="/../public/js/skycons.js"></script>
<script src="/../public/js/gauge.js"></script>
<!--Easy Pie Chart-->
<script src="/../public/js/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="/../public/js/jquery.sparkline.js"></script>

<script src="/../public/js/morris.js"></script>
<script src="/../public/js/raphael-min.js"></script>
<!--jQuery Flot Chart-->
<script src="/../public/js/flot-chart/jquery.flot.js"></script>
<script src="/../public/js/flot-chart/jquery.flot.pie.resize.js"></script>
<script src="/../public/ajax/dashboard.js"></script>
<script src="/../public/js/jquery.customSelect.min.js" ></script>
<script src="/../public/ajax/scripts.js"></script>
<style>
    .ScrollStyle{
        height: 290px;
        overflow: auto;
    }
    .ScrollStyle::-webkit-scrollbar {
        width: 10px;
    }

    .ScrollStyle::-webkit-scrollbar-thumb {
        background: #666;
        border-radius: 20px;
    }

    .ScrollStyle::-webkit-scrollbar-track {
        background: #ddd;
        border-radius: 20px;
    }
</style>
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:void(0)"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<?php
$rowStaff = $mat->CountStaff();
$rowStudent = $mat->CountStudent();
$upComing = $mat->UpcomingEvents();
$rowUsers = $mat->CountUsers();
?>
<input type="hidden" name="logusrnme" id="logusrnme" value="<?= $logusrnme ?>">
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $rowStaff ?></h3>
                    <p>No of Staff's</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $rowStudent ?></h3>
                    <p>No of Student's</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= $upComing ?></h3>
                    <p>UpComing Event's</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?= $rowUsers ?></h3>
                    <p>System User's</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <section class="panel">
                <div class="panel-body">
                    <div class="monthly-stats pink">
                        <div class="clearfix">
                            <h4 class="pull-left"><?= $year ?></h4>
                            <!-- Nav tabs -->
                            <div class="btn-group pull-right stat-tab">
                                <a href="#line-chart" class="btn stat-btn active" data-toggle="tab"><i class="ico-stats"></i></a>
                                <a href="#bar-chart" class="btn stat-btn" data-toggle="tab"><i class="ico-bars"></i></a>
                            </div>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="line-chart">
                                <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-min-spot-color="false" data-max-spot-color="false" data-line-color="#ffffff" data-spot-color="#ffffff" data-fill-color="" data-highlight-line-color="#ffffff" data-highlight-spot-color="#e1b8ff" data-spot-radius="3" <?= $mat->totalStudentFees(); ?>>
                                </div>
                            </div>
                            <div class="tab-pane" id="bar-chart">
                                <div class="sparkline" data-type="bar" data-resize="true" data-height="75" data-width="90%" data-bar-color="#d4a7f5" data-bar-width="10" <?= $mat->totalStudentFees(); ?>></div>
                            </div>
                        </div>
                    </div>
                    <div class="circle-sat">
                        <center>Student Fees Income</center>
                    </div>
                </div>                
            </section>
        </div>
        <div class="col-md-6">
            <section class="panel">
                <div class="panel-body">
                    <div class="monthly-stats" style="background-color: rgba(45,88,102,0.3)">
                        <div class="clearfix">
                            <h4 class="pull-left"><?= $year ?></h4>
                            <!-- Nav tabs -->
                            <div class="btn-group pull-right stat-tab">
                                <a href="#line-charts" class="btn stat-btn active" data-toggle="tab"><i class="ico-stats"></i></a>
                                <a href="#bar-charts" class="btn stat-btn" data-toggle="tab"><i class="ico-bars"></i></a>
                            </div>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="line-charts">
                                <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-min-spot-color="false" data-max-spot-color="false" data-line-color="#ffffff" data-spot-color="#ffffff" data-fill-color="" data-highlight-line-color="#ffffff" data-highlight-spot-color="#132120" data-spot-radius="3" <?= $mat->totalSalaryStaff(); ?>>
                                </div>
                            </div>
                            <div class="tab-pane" id="bar-charts">
                                <div class="sparkline" data-type="bar" data-resize="true" data-height="75" data-width="90%" data-bar-color="#132120" data-bar-width="10" <?= $mat->totalSalaryStaff(); ?>></div>
                            </div>
                        </div>
                    </div>
                    <div class="circle-sat">
                        <center>Staff Salary Expenses</center>
                    </div>
                </div>                
            </section>
        </div>
    </div>
    <div class="row">
        <section class="col-lg-6 connectedSortable">
            <div class="box">
                <div class="event-calendar clearfix">
                    <div class="col-lg-12 event-list-block" id="listevts">
                        <div class="cal-day">
                            <span>Today</span>
                            <?php
                            $arr = array('MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN');
                            $nameOfDay = date('D', strtotime($date));
                            echo $nameOfDay;
                            ?>
                        </div>
                        <ul class="event-list ScrollStyle"></ul>
                        <input type="text" class="form-control evnt-input" placeholder="NOTES">
                    </div>
                </div>
            </div>
        </section>
        <section class="col-lg-6 connectedSortable">
            <div class="box box-primary" id="calenderouter">
                <div class="box-body no-padding">
                    <!-- THE CALENDAR -->
                    <div id='calendar'></div>
                </div>
                <!-- /.box-body -->
            </div>
        </section>
    </div>
</section>
<style>

    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }
</style>
<script>
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            navLinks: true,
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'eventRegisteronDashboard',
                        type: 'POST',
                        data: {title: title, start: start, end: end},
                        success: function () {
                            $('#calendar').fullCalendar('refetchEvents');
                        }
                    });
                }
            },
            editable: true,
                    eventLimit: true,
            events: 'eventLoad',
            eventResize: function (event)
            {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url: 'eventUpdateonDashboard',
                    type: 'POST',
                    data: {title: title, start: start, end: end, id: id},
                    success: function () {
                        $('#calendar').fullCalendar('refetchEvents');
                    }
                });
            },
            eventDrop: function (event)
            {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url: 'eventUpdateonDashboard',
                    type: 'POST',
                    data: {title: title, start: start, end: end, id: id},
                    success: function () {
                        $('#calendar').fullCalendar('refetchEvents');
                    }
                });
            },
            eventClick: function (event)
            {
                $.confirm({
                    title: 'Confirm!',
                    content: 'Are You Sure to Delete the Event',
                    buttons: {
                        confirm: function () {
                            var id = event.id;
                            $.ajax({
                                url: 'eventDeleteonDashboard',
                                type: 'POST',
                                data: {id: id},
                                success: function ()
                                {
                                    $('#calendar').fullCalendar('refetchEvents');
                                }
                            });
                        },
                        cancel: function () {
                        }
                    }
                });
            }

        });

    });
</script>
<script>
    $(document).ready(function () {
        function GetNotesindetails()
        {
            var logusrnme = $('#logusrnme').val();
            $.ajax({
                url: "loadNotes",
                type: 'POST',
                data: {logusrnme: logusrnme},
                success: function (jsonData)
                {
                    $(".event-list").empty();
                    $(".event-list").append(jsonData);
                }
            });
        }
        $('.evnt-input').keypress(function (e) {
            var p = e.which;
            var inText = $('.evnt-input').val();
            var logusrnme = $('#logusrnme').val();
            if (p == 13) {
                if (inText == "")
                {
                    $.confirm({
                        icon: 'fa fa-exclamation-triangle',
                        title: "Cannot Leave Empty!",
                        content: "Fill Up the Note",
                        type: 'orange',
                        typeAnimated: true,
                    });
                } else {
                    $.ajax({
                        url: "registerNotes",
                        method: "POST",
                        data: {logusrnme: logusrnme, value: inText},
                        success: function (jsonData) {
                            GetNotesindetails();
                        }
                    });
                }
                $(this).val('');
                $('.event-list').scrollTo('100%', '100%', {
                    easing: 'swing'
                });
                return false;
                e.epreventDefault();
                e.stopPropagation();
            }
        });
        $(document).on('click', '.event-close', function () {
            var id = this.id;
            $.ajax({
                url: "deleteNotes",
                method: "POST",
                data: {id: id},
                success: function () {
                    GetNotesindetails();
                }
            });
            return false;
        });
        GetNotesindetails();
    });
</script>   
<style>
    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }

</style>