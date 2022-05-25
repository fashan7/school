<?php
session_start();
if (!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;
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
        <script src="/../public/ajax/parentReg.js"></script>
        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
        <link href="/../public/css/tableresponsive.css" rel="stylesheet"/>
        <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
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
                                    <h3 class="box-title">Parent Portal Registration</h3>
                                </div>
                                <form method="post" id="parentReg" role="form">
                                    <div class="box-body">                                        
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="Email Address">Email Address</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-envelope"></i>
                                                        </div>
                                                        <input type="text" class="form-control" id="parentemail" name="parentemail" placeholder="Email Address">
                                                    </div>
                                                    <span class="help-block" id="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="Username">Parent Username</label>                  
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-info"></i>
                                                        </div>
                                                        <input type="text" class="form-control" id="username" name="username" placeholder="Parent Username">
                                                    </div>
                                                    <span class="help-block" id="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="Password">Password</label>                  
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </div>
                                                        <input type="password" class="form-control" id="npassword" name="npassword" placeholder="New Password">
                                                    </div>
                                                    <span class="help-block" id="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="Password">Confirm Password</label>                  
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-check-square"></i>
                                                        </div>
                                                        <input type="password" class="form-control" id="conpassword" name="conpassword" placeholder="Confirm Password">
                                                    </div>
                                                    <span class="help-block" id="error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="Grade Number">Grade Number</label>
                                                    <select class="form-control select2" style="width: 100%;" name="gradenumberlist" id="gradenumberlist">
                                                        <option selected="selected" value=""> -- Grade Number -- </option>
                                                        <?php
                                                        $resultgr = $mat->SelectallGradeNumber();
                                                        foreach ($resultgr as $row) {
                                                            ?>
                                                            <option value="<?= $row['id'] ?>"><?= $row['gradenumber'] . " " . $row['gradesection'] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4" id="loadStudents">
                                                <input type="hidden" name="students" id="students">
                                            </div>   
                                            <div class="col-sm-2">
                                                <div style="padding-top: 25px;">
                                                    <button type="button" class="btn btn-primary" id="addStudent" name="addStudent">Add Children</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="Grade Number">Grade Number</label>
                                                    <input type="text" class="form-control grdcls" id="grade1" name="grade1" readonly>
                                                    <input type="hidden" class="form-control" id="gradeid1" name="gradeid1" readonly> 
                                                    <span class="help-block" id="error"></span>
                                                </div>
                                            </div>                                        
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="Child Name">Child Name</label>
                                                    <input type="text" class="form-control stdcls" id="student1" name="student1" readonly>
                                                    <input type="hidden" class="form-control" id="studentid1" name="studentid1" readonly>
                                                    <span class="help-block" id="error"></span>
                                                </div>
                                            </div>    
                                        </div>
                                        <div id="AddChildrens"></div>
                                        <div class="row">                                                                            
                                            <div class="col-sm-2"  id="hidebutton">                                                
                                                <button type="submit" class="btn btn-success" id="save" name="save">Save</button>   
                                                <input type="hidden" name="countStudents" id="countStudents" value="1">
                                            </div>   
                                        </div>                                        
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
            $(document).on('click', '#addStudent', function () {
                var grade = new Array();
                var gradeid = new Array();
                var student = new Array();
                var studentid = new Array();

                num_rows = parseInt(document.getElementById("countStudents").value);
                totalrows = num_rows + 1;

                for (i = 2; i <= totalrows; i++)
                {
                    grade[i] = document.getElementById("grade" + (i - 1)).value;
                    gradeid[i] = document.getElementById("gradeid" + (i - 1)).value;
                    student[i] = document.getElementById("student" + (i - 1)).value;
                    studentid[i] = document.getElementById("studentid" + (i - 1)).value;
                }

                document.getElementById("AddChildrens").innerHTML = "";
                var tech = '';

                for (i = 2; i <= totalrows; i++)
                {
                    if (i === totalrows)
                    {
                        tech += '<div class="row"><div class="col-lg-4"><div class="form-group"><label for="Grade Number">Grade Number</label><input type="text" class="form-control grdcls" id="grade' + i + '" name="grade' + i + '" value="' + grade[i] + '" readonly><input type="hidden" class="form-control" id="gradeid' + i + '" name="gradeid' + i + '" value="' + gradeid[i] + '" readonly><span class="help-block" id="error"></span></div></div>';

                        tech += '<div class="col-lg-4"><div class="form-group"><label for="Child Name">Child Name</label><input type="text" class="form-control stdcls" id="student' + i + '" name="student' + i + '" value="' + student[i] + '" readonly><input type="hidden" class="form-control" id="studentid' + i + '" name="studentid' + i + '" value="' + studentid[i] + '" readonly><span class="help-block" id="error"></span></div></div>';

                        tech += '<div class="form-group col-md-3 btn-group" style="padding-top: 25px;"><button type="button" class="btn btn-danger" id="deleteRenting' + i + '" ><i onclick="javascript:deleteRent(' + i + ')" class="fa fa-window-close"></i></button></div></div>';
                    }
                    else
                    {
                        tech += '<div class="row"><div class="col-lg-4"><div class="form-group"><label for="Grade Number">Grade Number</label><input type="text" class="form-control grdcls" id="grade' + i + '" name="grade' + i + '" value="' + grade[i] + '" readonly><input type="hidden" class="form-control" id="gradeid' + i + '" name="gradeid' + i + '" value="' + gradeid[i] + '" readonly><span class="help-block" id="error"></span></div></div>';

                        tech += '<div class="col-lg-4"><div class="form-group"><label for="Child Name">Child Name</label><input type="text" class="form-control stdcls" id="student' + i + '" name="student' + i + '" value="' + student[i] + '" readonly><input type="hidden" class="form-control" id="studentid' + i + '" name="studentid' + i + '" value="' + studentid[i] + '" readonly><span class="help-block" id="error"></span></div></div>';

                        tech += '<div class="form-group col-md-3 btn-group" style="padding-top: 25px;"><button type="button" class="btn btn-danger" id="deleteRenting' + i + '" ><i onclick="javascript:deleteRent(' + i + ')" class="fa fa-window-close"></i></button></div></div>';
                    }
                }

                tech += "";
                document.getElementById("AddChildrens").innerHTML = tech;
                document.getElementById("countStudents").value = totalrows;
            });
            function deleteRent(row)
            {
                var grade = new Array();
                var gradeid = new Array();
                var student = new Array();
                var studentid = new Array();

                num_rows = parseInt(document.getElementById("countStudents").value);
                int_num_rows = num_rows;
                row = parseInt(row);

                k = 2;
                m = k;

                for (; k <= int_num_rows; k++)
                {
                    if (k == row) {

                    }
                    else
                    {
                        grade[m] = document.getElementById("grade" + (m - 1)).value;
                        gradeid[m] = document.getElementById("gradeid" + (m - 1)).value;
                        student[m] = document.getElementById("student" + (m - 1)).value;
                        studentid[m] = document.getElementById("studentid" + (m - 1)).value;
                        m++;
                    }
                }
                document.getElementById("AddChildrens").innerHTML = "";
                tech = '';
                i = 2;
                j = i;

                for (; i <= int_num_rows; i++)
                {
                    if (i == row) {

                    }
                    else
                    {
                        tech += '<div class="row"><div class="col-lg-4"><div class="form-group"><label for="Grade Number">Grade Number</label><input type="text" class="form-control grdcls" id="grade' + j + '" name="grade' + j + '" value="' + grade[j] + '" readonly><input type="hidden" class="form-control" id="gradeid' + j + '" name="gradeid' + j + '" value="' + gradeid[j] + '" readonly><span class="help-block" id="error"></span></div></div>';

                        tech += '<div class="col-lg-4"><div class="form-group"><label for="Child Name">Child Name</label><input type="text" class="form-control stdcls" id="student' + j + '" name="student' + j + '" value="' + student[j] + '" readonly><input type="hidden" class="form-control" id="studentid' + j + '" name="studentid' + j + '" value="' + studentid[j] + '" readonly><span class="help-block" id="error"></span></div></div>';

                        tech += '<div class="form-group col-md-2 btn-group" style="padding-top: 25px;"><button type="button" class="btn btn-danger" id="deleteRenting' + j + '" onclick="javascript:deleteRent(' + j + ')"><i class="fa fa-window-close"></i></button></div></div>';
                        j++;
                    }
                }
                tech += "";
                document.getElementById("AddChildrens").innerHTML = tech;
                document.getElementById("countStudents").value = int_num_rows - 1;
            }


            $(document).on('change', '#gradenumberlist', function () {
                var gradenumberlist = $('#gradenumberlist').val();

                if (gradenumberlist != '')
                {
                    $('#grade1').val($('#gradenumberlist option:selected').text());
                    $('#gradeid1').val($('#gradenumberlist').val());
                    $.ajax({
                        url: "getStudentsDetSingle",
                        method: "POST",
                        data: {gradenumberlist: gradenumberlist},
                        success: function (jsonData)
                        {
                            $('#SearchStudent').val("");
                            $('#studentid').val("");
                            $('#loadStudents').html(jsonData);
                            document.getElementById("hiddenbtn").style.display = "none";
                        }
                    });
                }
                else
                {
                    $('#loadStudents').html("");
                    document.getElementById("hiddenbtn").style.display = "none";
                }
            });
            $(document).on('change', '#students', function () {
                $('#student1').val($('#students option:selected').text());
                $('#studentid1').val($('#students').val());
            });

        </script>
    </body>
</html>