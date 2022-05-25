<?php
if (!isset($_SESSION['logusersid']))
    return header("location: login");
//if(!isset($_COOKIE['usrname']))
//    return header("location: login");

$loguserid = $_SESSION['logusersid'];
$logusrnme = $_SESSION['usrname'];
$mat = new materialController;
?>
<!DOCTYPE html>
<html lang="en" id="loadhtml">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="../public/media/fashan/logo.png" />
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Exam Engine</title>
        <link href="/../public/js/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                padding-top: 54px;
            }
            @media (min-width: 992px) {
                body {
                    padding-top: 56px;
                }
            }
        </style>
    </head>
    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="javascript:void(0)">Exam Engine</a>    
                <ul style="padding-top: 10px;">
                    <li style="color:white; list-style-type: none"><a class="navbar-brand" href="logoutAction">Logout</a></li>
                    
                </ul>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h4 class="mt-5">Student Code Or Name</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" id="SearchStudent" name="SearchStudent" placeholder="Search From Student Name" autocomplete="off">
                        <input type="hidden" name="studentid" id="studentid">
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <h4 class="mt-5">&nbsp;</h4>
                        <button class="btn btn-primary pull-right" id="loaddetails" style="background-color: #1fb5ad;">Load Student Details</button>
                    </div>
                </div>
                <div class="col-lg-4"></div>
                <div id="detailsStudents"></div>
            </div>
        </div>
        <script src="/../public/js/vendor/jquery/jquery.min.js"></script>
        <script src="/../public/js/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <style type="text/css">
            .ui-autocomplete.ui-menu
            {
                opacity: 2;
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
            $(document).on('keyup', '#SearchStudent', function () {
                if ($('#SearchStudent').val() !== "") {
                    $('#SearchStudent').autocomplete({
                        autoFocus: true,
                        source: "autoCompleteStudent",
                        minLength: 2,
                        select: function (event, ui)
                        {
                            $('#studentid').val(ui.item.studentid);
                        }
                    });
                } else {
                    $('#detailsStudents').html("");
                }                
            });
            $(document).on('click', '#loaddetails', function () {
                var SearchStudent = $('#SearchStudent').val();
                var studentid = $('#studentid').val();
                if (SearchStudent !== '' && studentid !== '')
                {
                    $.ajax({
                        url: "StudentDetails",
                        method: "POST",
                        data: {studentid: studentid},
                        success: function (jsonData)
                        {
                            $('#detailsStudents').html(jsonData);
                        }
                    });
                }
                else
                {
                    $('#detailsStudents').html("");
                }
            });
        </script>
    </body>
</html>
