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
$day = date('d');
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
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/brands.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/solid.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/fontawesome.js"></script>
        <script src="/../public/ajax/header.js"></script>
        <script src="/../public/js/alertify.min.js"></script>
        <script src="/../public/js/jquery-ui.min.js"></script>
        <script data-pace-options='{ "ajax": false }' src="/../public/js/pace.js"></script>    
        <script src="/../public/js/jquery.validate.min.js"></script>
        <script src="/../public/js/bootstrap.min.js"></script>
        <script src="/../public/js/admin.min.js"></script>  
        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
        <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/../public/css/select2.min.css">
        <script src="/../public/js/select2.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
        <link rel="stylesheet" href="/../public/js/bootstrap-datepicker/css/datepicker.css">
        <script type="text/javascript" src="/../public/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="/../public/ajax/issuebooks.js"></script>
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
                                    <h3 class="box-title">Books Issue Related</h3>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#issuebks" data-toggle="tab">Issue Books</a></li>
                                                <li><a href="#issueList" data-toggle="tab">Issued List</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="issuebks">
                                                    <div class="post">
                                                        <form method="post" id="IssuebooksReg" role="form">
                                                            <div class="user-block">
                                                                <div class="row">                                                    
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="searchby" name="searchby" placeholder="Search By Book No/ ISBN No/ Book Title/ Author" autocomplete="off">
                                                                            <div id="Searchlist"></div>
                                                                            <span class="help-block" id="error"></span>
                                                                            <input type="hidden" name="childTbID" id="childTbID">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <div class="form-group">
                                                                            <button type="button" class="btn btn-primary" id="search" name="search">Search</button>   
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4"></div>                                                    
                                                                </div>
                                                                <div id="loadSingleBookDetails"></div>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label for="UserType">UserType</label>
                                                                            <select name="usertype" id="usertype" class="form-control select2" style="width: 100%;">
                                                                                <option value="">-- Select Type --</option>
                                                                                <option value="student">Student</option>
                                                                                <option value="employee">Employee</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div id="loadAutoCompleteTextBX"></div>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label for="Book Issue Date">Book Issue Date</label>
                                                                            <div class="input-group date">
                                                                                <div class="input-group-addon">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <input type="text" class="form-control pull-right" id="bookissuedate" name="bookissuedate" value="<?= $date ?>" readonly>
                                                                            </div>
                                                                            <span class="help-block" id="error"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label for="Due Date">Due Date</label>
                                                                            <div class="input-group date">
                                                                                <div class="input-group-addon">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <input type="text" class="form-control pull-right" id="duedate" name="duedate" value="<?= $date ?>" readonly>
                                                                            </div>
                                                                            <span class="help-block" id="error"></span>
                                                                        </div>
                                                                    </div>                                                    
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-2">
                                                                        <div class="form-group">
                                                                            <div class="box-footer" id="hidebutton">
                                                                                <button type="submit" class="btn btn-warning" id="save1" name="save1">Issue Book</button>   
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="issueList">
                                                    <div class="user-block">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-striped" id="loadissuedDetails" width="100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">#</th>
                                                                                <th scope="col">User Type</th>
                                                                                <th scope="col">User</th>
                                                                                <th scope="col">Book No</th>
                                                                                <th scope="col">ISBN No</th>
                                                                                <th scope="col">Title</th>
                                                                                <th scope="col">Book Issue Date</th>
                                                                                <th scope="col">Book Due Date</th>
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
                $('.select2').select2();
                $('#bookissuedate').datepicker({
                    format: 'yyyy-mm-dd'
                });
                $('#duedate').datepicker({
                    format: 'yyyy-mm-dd'
                });
                var dataTable = $('#loadissuedDetails').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        url: "getAllissuedBooksDetails",
                        method: "POST"
                    },
                    "columnDefs": [
                        {
                            "targets": [0, 2, 3, 4, 5],
                            "orderable": false
                        },
                    ],
                });
            });

            $(document).on('keyup', '#searchby', function () {
                if ($('#searchby').val() !== "") {
                    $('#searchby').autocomplete({
                        source: "autoCompleteBook",
                        minLength: 2,
                        select: function (event, ui)
                        {
                            $('#childTbID').val(ui.item.parentID);
                        }
                    });
                }else {
                    $('#loadSingleBookDetails').html("");
                }
            });
            $(document).on('click', '#search', function () {
                var searchby = $('#searchby').val();
                var childTbID = $('#childTbID').val();

                if (searchby != '' && childTbID != '')
                {
                    $.ajax({
                        url: "ShowUpDetails",
                        method: "POST",
                        data: {id: childTbID},
                        success: function (jsonData)
                        {
                            $('#loadSingleBookDetails').html(jsonData);
                        }
                    });
                }
                else
                {
                    $('#loadSingleBookDetails').html("");
                }
            });
            $(document).on('change', '#usertype', function () {
                var usertype = $('#usertype').val();
                if (usertype != '')
                {
                    $.ajax({
                        url: "AutoCompleteUserType",
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
        </script>
    </body>
</html>