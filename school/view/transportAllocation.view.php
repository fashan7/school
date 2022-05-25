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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="/../public/js/bootstrap-datepicker/css/datepicker.css">
        <script type="text/javascript" src="/../public/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
        <script src="/../public/ajax/TransportAllocation.js"></script>
        <script src="/../public/ajax/TransportAllocationUpd.js"></script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini" id="bodytag" onload="startTime()">
        <div class="wrapper" >
            <?php
            $objpage->header();
            ?>
            <div class="content-wrapper" id="loadAllDetails">    
                <section class="content">
                    <div class="col-lg-12">        
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Transport Allocation</h3>
                            </div>
                            <div class="box-body">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#ta" data-toggle="tab">Transport Allocation</a></li>
                                        <li><a href="#man" data-toggle="tab">Manage</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="ta">
                                            <div class="post">
                                                <div class="user-block">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-lg-1"></div>
                                                            <div class="col-lg-10" id="updateDriver">
                                                                <form method="post" id="TrnasportALLReg" role="form">
                                                                    <div class="form-group">
                                                                        <label for="Route Code">Route Code</label>
                                                                        <select name="routecode" id="routecode" class="form-control select2" style="width: 100%;">
                                                                            <option value="">-- Select Route Code --</option>
                                                                            <?php
                                                                            $result = $mat->vehicleRoute();
                                                                            foreach ($result as $row) {
                                                                                ?>
                                                                                <option value="<?= $row['id'] ?>"><?= $row['r_code'] ?></option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <span class="help-block" id="error"></span>
                                                                    </div>
                                                                    <div class="form-group" id="getdestiny">
                                                                        <label for="Destination">Destination</label>
                                                                        <select name="destination" id="destination" class="form-control select2" style="width: 100%;">
                                                                            <option value="">-- Select Destination --</option>
                                                                        </select>
                                                                        <span class="help-block" id="error"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="UserType">UserType</label>
                                                                        <select name="usertype" id="usertype" class="form-control select2" style="width: 100%;">
                                                                            <option value="">-- Select Type --</option>
                                                                            <option value="student">Student</option>
                                                                            <option value="employee">Employee</option>
                                                                        </select>
                                                                        <span class="help-block" id="error"></span>
                                                                    </div>
                                                                    <div id="loadAutoCompleteTextBX"></div>
                                                                    <div class="form-group" id="StartLoadFreq">
                                                                        <label for="Start Frequency">Start Frequency</label>
                                                                        <select name="sFrequency" id="sFrequency" class="form-control select2" style="width: 100%;">
                                                                            <option value="">-- Select --</option>
                                                                        </select>
                                                                        <span class="help-block" id="error"></span>
                                                                    </div>
                                                                    <div class="form-group" id="EndLoadFreq">
                                                                        <label for="Endx`x` Frequency">End Frequency</label>
                                                                        <select name="eFrequency" id="eFrequency" class="form-control select2" style="width: 100%;">
                                                                            <option value="">-- Select --</option>
                                                                        </select>
                                                                        <span class="help-block" id="error"></span>
                                                                    </div>

                                                                    <div class="form-group" id="hidebutton">
                                                                        <button type="submit" class="btn btn-warning" id="save" name="save">Save</button>   
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="col-lg-1"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="box box-primary">
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered table-striped" id="loaddetails">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">#</th>
                                                                                        <th scope="col">Route Code</th>
                                                                                        <th scope="col">Destination</th>
                                                                                        <th scope="col">User Type</th>
                                                                                        <th scope="col">Name</th>
                                                                                        <th scope="col">Code</th>
                                                                                        <th scope="col">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="man">
                                            <div class="user-block">
                                                <div class="box box-solid">
                                                    <div class="box-body">
                                                        <form method="post" id="TrnasportALLUpd" role="form">
                                                            <div class="row col-lg-12">                                                
                                                                <div class="col-lg-4 form-group">
                                                                    <label for="UserType">UserType</label>
                                                                    <select name="usertypeman" id="usertypeman" class="form-control select2" style="width: 100%;">
                                                                        <option value="">-- Select Type --</option>
                                                                        <option value="student">Student</option>
                                                                        <option value="employee">Employee</option>
                                                                    </select>
                                                                    <span class="help-block" id="error"></span>                                                
                                                                </div>

                                                                <div id="loadallocatedUsers"></div>
                                                            </div>
                                                            <div class="row col-lg-12">
                                                                <div class="col-lg-4 form-group" id="getdestinyMan">
                                                                    <label for="Destination">Destination</label>
                                                                    <select name="destinationMan" id="destinationMan" class="form-control select2" style="width: 100%;">
                                                                        <option value="">-- Select Destination --</option>
                                                                    </select>
                                                                    <span class="help-block" id="error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row col-lg-12">
                                                                <center><b>Change To</b></center><br>
                                                            </div>
                                                            <div class="row col-lg-12">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="Route Code">Route Code</label>
                                                                        <select name="routecodeMan" id="routecodeMan" class="form-control select2" style="width: 100%;">
                                                                            <option value="">-- Select Route Code --</option>
                                                                            <?php
                                                                            $result = $mat->vehicleRoute();
                                                                            foreach ($result as $row) {
                                                                                ?>
                                                                                <option value="<?= $row['id'] ?>"><?= $row['r_code'] ?></option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <span class="help-block" id="error"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group" id="getdestinyMMan">
                                                                        <label for="Destination">Destination</label>
                                                                        <select name="destinationMMan" id="destinationMMan" class="form-control select2" style="width: 100%;">
                                                                            <option value="">-- Select Destination --</option>
                                                                        </select>
                                                                        <span class="help-block" id="error"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group" id="StartLoadFreqMan">
                                                                        <label for="Start Frequency">Start Frequency</label>
                                                                        <select name="sFrequencyMan" id="sFrequencyMan" class="form-control select2" style="width: 100%;">
                                                                            <option value="">-- Select --</option>
                                                                        </select>
                                                                        <span class="help-block" id="error"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group" id="EndLoadFreqMan">
                                                                        <label for="End Frequency">End Frequency</label>
                                                                        <select name="eFrequencyMan" id="eFrequencyMan" class="form-control select2" style="width: 100%;">
                                                                            <option value="">-- Select --</option>
                                                                        </select>
                                                                        <span class="help-block" id="error"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group" id="hidebuttons">
                                                                        <button type="submit" class="btn btn-warning" id="update" name="update">Update</button>   
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
        <style type="text/css">
            .ui-autocomplete.ui-menu
            {
                opacity: 0.7;
            }
            .ui-autocomplete
            {
                max-height: 100px;
                overflow-y: auto; /* prevent horizontal scrollbar */
                overflow-x: hidden; /* add padding to account for vertical scrollbar */
                padding-right: 20px;
            }
            * html .ui-autocomplete
            {
                height: 100px;
            }
            .ui-button
            {
                margin-left: -16px;
            }
            button.ui-button-icon-only
            {
                width: 1.2em;
            }
            .ui-button-icon-only .ui-button-text
            {
                padding: 0.35em;
            }
            .ui-autocomplete-input
            {
                margin: 0;padding: 0.48em 0 0.47em 0.45em;
            }
        </style>
        <script>
            $(document).ready(function () {
                $('#dob').datepicker({
                    format: 'yyyy-mm-dd'
                });
                $('.select2').select2();

                var dataTable = $('#loaddetails').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        url: "getAllTransportAllcation",
                        method: "POST"
                    },
                    "columnDefs": [
                        {
                            "targets": [0, 1, 2, 3, 4, 5, 6],
                            "orderable": false
                        },
                    ],
                });
            });
            $(document).on('change', '#usertype', function () {
                var usertype = $('#usertype').val();
                if (usertype != '')
                {
                    $.ajax({
                        url: "AutoCompleteUserTypeforVehicle",
                        method: "POST",
                        data: {usertype: usertype},
                        success: function (jsonData)
                        {
                            $('#loadAutoCompleteTextBX').html(jsonData);
                        }
                    });
                }
                else
                {
                    $('#loadAutoCompleteTextBX').html("");
                }
            });
            $(document).on('change', '#routecode', function () {
                var routecode = $('#routecode').val();
                $.ajax({
                    url: "GetDetination",
                    method: "POST",
                    data: {routecode: routecode},
                    success: function (jsonData)
                    {
                        $('#getdestiny').html("");
                        $('#getdestiny').html(jsonData);
                    }
                });
            });
            $(document).on('change', '#destination', function () {
                var destination = $('#destination').val();
                $.ajax({
                    url: "getStartFrequecncy",
                    method: "POST",
                    data: {destination: destination},
                    success: function (jsonData)
                    {
                        $('#StartLoadFreq').html("");
                        $('#StartLoadFreq').html(jsonData);
                    }
                });
            });
            $(document).on('change', '#destination', function () {
                var destination = $('#destination').val();
                $.ajax({
                    url: "getEndFrequecncy",
                    method: "POST",
                    data: {destination: destination},
                    success: function (jsonData)
                    {
                        $('#EndLoadFreq').html("");
                        $('#EndLoadFreq').html(jsonData);
                    }
                });
            });
            $(document).on('change', '#usertypeman', function () {
                var usertype = $('#usertypeman').val();
                if (usertype != '')
                {
                    $.ajax({
                        url: "AllocatedUsersforTransport",
                        method: "POST",
                        data: {usertype: usertype},
                        success: function (jsonData)
                        {
                            $('#loadallocatedUsers').html(jsonData);
                        }
                    });
                }
                else
                {
                    $('#loadallocatedUsers').html("");
                }
            });
            $(document).on('change', '#routecodeMan', function () {
                var routecode = $('#routecodeMan').val();
                $.ajax({
                    url: "GetDetinationMan",
                    method: "POST",
                    data: {routecode: routecode},
                    success: function (jsonData)
                    {
                        $('#getdestinyMMan').html("");
                        $('#getdestinyMMan').html(jsonData);
                    }
                });
            });
            $(document).on('change', '#destinationMMan', function () {
                var destination = $('#destinationMMan').val();
                $.ajax({
                    url: "getStartFrequecncyMan",
                    method: "POST",
                    data: {destination: destination},
                    success: function (jsonData)
                    {
                        $('#StartLoadFreqMan').html("");
                        $('#StartLoadFreqMan').html(jsonData);
                    }
                });
            });
            $(document).on('change', '#destinationMMan', function () {
                var destination = $('#destinationMMan').val();
                $.ajax({
                    url: "getEndFrequecncyMan",
                    method: "POST",
                    data: {destination: destination},
                    success: function (jsonData)
                    {
                        $('#EndLoadFreqMan').html("");
                        $('#EndLoadFreqMan').html(jsonData);
                    }
                });
            });
        </script>
    </body>
</html>