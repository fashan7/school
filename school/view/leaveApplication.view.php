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
$year = date('Y');
$month = date('m');
$effectiveDate = date('Y-m-d', strtotime("+1 day", strtotime($date)));
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
        <link rel="stylesheet" href="/../public/css/select2.min.css">
        <script src="/../public/js/select2.min.js"></script>
        <link rel="stylesheet" href="/../public/js/bootstrap-datepicker/css/datepicker.css">
        <script type="text/javascript" src="/../public/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="/../public/ajax/leaveApplication.js"></script>
        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
        <link href="/../public/css/tableresponsive.css" rel="stylesheet"/>
        <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    </head>
    <body class="hold-transition skin-blue sidebar-mini" id="bodytag" onload="startTime()">
        <div class="wrapper" >
            <?php
            $objpage->header();
            ?>
            <div class="content-wrapper" id="loadAllDetails">    
                <section class="content">
                    <div class="row">        
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Leave Application</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <form method="post" id="leaveAppReg" role="form">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="Department">Department</label>
                                                    <select name="department" id="department" class="form-control select2" style="width: 100%;">
                                                        <option value="">-- Select Department --</option>
                                                        <?php
                                                        $resultdep = $mat->SelectallDepartment();
                                                        foreach ($resultdep as $row) {
                                                            ?>
                                                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="help-block" id="error"></span>
                                                </div>
                                            </div>
                                            <div id="employee"></div> 
                                            <div class="col-lg-4">
                                                <div class="form-group" id="leavecategorydiv">
                                                    <label for="Leave Category Name">Leave Category</label>
                                                    <select name="leaveCategory" id="leaveCategory" class="form-control select2" style="width: 100%;">
                                                        <option value="">-- Please Select --</option>
                                                    </select>
                                                    <span class="help-block" id="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div id="loadDetailofLeaeves"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="From Date">From Date</label>
                                                    <input type="text" class="form-control pull-right" id="fromdate" name="fromdate" value="<?= $date ?>" readonly>
                                                    <span class="help-block" id="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="To Date">To Date</label>
                                                    <input type="text" class="form-control pull-right" id="todate" name="todate" value="<?= $effectiveDate ?>" readonly>
                                                    <span class="help-block" id="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="Reason">Reason</label>
                                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="reason" id="reason"></textarea>
                                                    <span class="help-block" id="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group" id="hidebutton">
                                                    <button type="submit" class="btn btn-warning" id="create" name="create">Create</button>   
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-lg-6">
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped" id="loadApplication">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Leave Type</th>
                                                            <th scope="col">Staff</th>
                                                            <th scope="col">From Date</th>
                                                            <th scope="col">To Date</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">View</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <div class="box-body">
                                    <div id="ApplicantDet"></div>
                                </div>
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
                $('.select2').select2();
                $('#fromdate').datepicker({
                    format: 'yyyy-mm-dd'
                });
                $('#todate').datepicker({
                    format: 'yyyy-mm-dd'
                });
                $('#todate').datepicker().on('changeDate', function (ev) {
                    var fromdate = $('#fromdate').val();
                    var todate = $('#todate').val();
                    if (todate < fromdate)
                    {
                        $.confirm({
                            icon: 'fa fa-bolt',
                            title: "Warning!",
                            content: "To Date must be greater than From Date",
                            type: 'orange',
                            typeAnimated: true
                        });
                    }
                });

                var dataTable = $('#loadApplication').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        url: "getAllleaveApplication",
                        method: "POST"
                    },
                    "columnDefs": [
                        {
                            "targets": [0, 1, 5],
                            "orderable": false
                        },
                    ],
                });
            });
            $(document).on('change', '#department', function () {
                var department = $('#department').val();
                $.ajax({
                    url: "getEmployee",
                    method: "POST",
                    data: {department: department},
                    success: function (jsonData)
                    {
                        $('#employee').html(jsonData);
                    }
                });
            });
            $(document).on('change', '#department', function () {
                var department = $('#department').val();
                $.ajax({
                    url: "getLeaveCategory",
                    method: "POST",
                    data: {department: department},
                    success: function (jsonData)
                    {
                        $('#leavecategorydiv').html(jsonData);
                    }
                });
            });
            $(document).on('change', '#leaveCategory', function () {
                var staffmem = $('#staffmem').val();
                var leaveCategory = $('#leaveCategory').val();
                var department = $('#department').val();
                if (leaveCategory != '')
                {
                    $.ajax({
                        url: "getLeavesSearchByLeaveCat",
                        method: "POST",
                        data: {leaveCategory: leaveCategory, staffmem: staffmem, department: department},
                        success: function (jsonData)
                        {
//                            alert(jsonData);
                            $('#loadDetailofLeaeves').html(jsonData);
                        }
                    });
                }
                else
                {
                    $('#loadDetailofLeaeves').html("");
                }
            });
            $(document).on('click', '.viewc', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: "getLeaveApplicantDet",
                    method: "POST",
                    data: {id: id},
                    success: function (jsonData)
                    {
                        $('#ApplicantDet').html(jsonData);
                    }
                });
            });
        </script>
    </body>
</html>