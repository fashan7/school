<?php
session_start();
if (!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;
date_default_timezone_set('Asia/Colombo');
$date = date('Y-m-d');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>School</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="/../public/css/bootstrap.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/brands.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/solid.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/fontawesome.js"></script>
        <link rel="shortcut icon" href="/../public/img/school.png">
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="/../public/ajax/logout.js"></script>
        <script src="/../public/js/jquery.min.js"></script>
        <link rel="stylesheet" href="/../public/css/jquery-confirm.min.css">
        <script src="/../public/js/jquery-confirm.min.js"></script>
        <link rel="stylesheet" href="/../public/css/admin.css">
        <link rel="stylesheet" href="/../public/css/flipclock.css">
        <link rel="stylesheet" href="/../public/css/_all-skins.min.css">
        <link rel="stylesheet" href="/../public/css/pace/themes/silver/pace-theme-minimal.css">
        <link rel="stylesheet" href="/../public/css/alertify.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <script src="/../public/ajax/header.js"></script>
        <script src="/../public/js/alertify.min.js"></script>
        <script src="/../public/js/jquery-ui.min.js"></script>
        <script data-pace-options='{ "ajax": false }' src="/../public/js/pace.js"></script>    
        <script src="/../public/js/jquery.validate.min.js"></script>
        <script src="/../public/js/bootstrap.min.js"></script>
        <script src="/../public/js/admin.min.js"></script>
        <script src="/../public/js/flipclock.min.js"></script>
        <script src="/../public/ajax/bookExams.js"></script>
        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
        <link href="/../public/css/tableresponsive.css" rel="stylesheet"/>
        <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="/../public/css/bootstrap-clockpicker.min.css">
        <script src="/../public/js/clock/bootstrap-clockpicker.min.js"></script>
        <link rel="stylesheet" href="/../public/js/bootstrap-datepicker/css/datepicker.css">
        <script type="text/javascript" src="/../public/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini" id="bodytag">
        <div class="wrapper" >
            <?php
            $objpage->header();
            ?>
            <div class="content-wrapper" id="loadAllDetails">    
                <section class="content">
                    <div class="row">        
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Book Exam</h3>
                                </div>
                                <form method="post" id="ExambookReg" role="form">
                                    <div class="box-body">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="Student Name">Student Name</label>
                                                <input type="text" class="form-control" id="SearchStudent" name="SearchStudent" placeholder="Search From Student Name" autocomplete="off">
                                                <input type="hidden" name="studentid" id="studentid">
                                                <span class="help-block" id="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="Paper">Paper</label>
                                                <select name="paperno" id="paperno" class="form-control select2">
                                                    <option selected="selected" value=""> -- Paper No -- </option>
                                                    <?php
                                                    $resultgr = $mat->getallPapers();
                                                    foreach ($resultgr as $row) {
                                                        ?>
                                                        <option value="<?= $row['id'] ?>"><?= $row['exampaper_no'] . " - " . $row['subject'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="getsecond" id="getsecond">
                                                <span class="help-block" id="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="Date">Date</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" value="<?= $date ?>" readonly>
                                                </div>
                                                <span class="help-block" id="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="Exam Start Time">Exam Start Time</label>
                                                <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                                                    <input type="text" class="form-control" id="time1" name="time1" type="text" placeholder="Start Time" autocomplete="off">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                    </span>
                                                </div>
                                                <span class="help-block" id="error"></span>
                                            </div>                                                            
                                        </div>
                                    </div>
                                    <div class="box-footer" id="hidebutton">
                                        <button type="submit" class="btn btn-warning" id="save" name="save">Save</button>   
                                    </div>
                                </form>
                            </div>
                        </div>            
                    </div>                    
                </section>
            </div>
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                </div>
                <strong>Copyright &copy; 2019 <a href="https://www.linkedin.com/in/mohammed-fashan-a59092187/" target="_blank">Fashan</a>.</strong> All rights
                reserved.
            </footer>
            <div class="control-sidebar-bg"></div>
        </div>
        <script>
            $(document).ready(function () {
                $('#datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                });
            });
            $(document).on('keyup', '#SearchStudent', function () {
                $('#gradenumberlist').val("");
                $('#students').val("");
                $('#SearchStudent').autocomplete({
                    autoFocus: true,
                    source: "autoCompleteStudent",
                    minLength: 2,
                    select: function (event, ui)
                    {
                        $('#studentid').val(ui.item.studentid);
                    }
                });
            });
            $('#paperno').change(function () {
                if ($('#paperno').val() !== "") {
                    var paper = $('#paperno').val();
                    $.ajax({
                        url: "getSecondforExam",
                        data: {paper: paper},
                        method: "POST",
                        success: function (jsonData)
                        {
                            $('#getsecond').val(jsonData);
                        }
                    });
                }
                else {
                    $('#getsecond').val("");
                }
            });
        </script>
        <script type="text/javascript">
            $('.clockpicker').clockpicker()
                    .find('input').change(function () {
                console.log(this.value);
            });
            var input = $('#single-input').clockpicker({
                placement: 'bottom',
                align: 'left',
                autoclose: true,
                'default': 'now'
            });

            $('.clockpicker-with-callbacks').clockpicker({
                donetext: 'Done',
                init: function () {
                    console.log("colorpicker initiated");
                },
                beforeShow: function () {
                    console.log("before show");
                },
                afterShow: function () {
                    console.log("after show");
                },
                beforeHide: function () {
                    console.log("before hide");
                },
                afterHide: function () {
                    console.log("after hide");
                },
                beforeHourSelect: function () {
                    console.log("before hour selected");
                },
                afterHourSelect: function () {
                    console.log("after hour selected");
                },
                beforeDone: function () {
                    console.log("before done");
                },
                afterDone: function () {
                    console.log("after done");
                }
            })
                    .find('input').change(function () {
                console.log(this.value);
            });

            // Manually toggle to the minutes view
            $('#check-minutes').click(function (e) {
                // Have to stop propagation here
                e.stopPropagation();
                input.clockpicker('show')
                        .clockpicker('toggleView', 'minutes');
            });
            if (/mobile/i.test(navigator.userAgent)) {
                $('input').prop('readOnly', true);
            }
        </script>
    </body>
</html>