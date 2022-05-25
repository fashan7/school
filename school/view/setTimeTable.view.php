<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;

$rowmaxreciptId = $mat->getMaxTimetable();
if($rowmaxreciptId == '0')
{
    $reciptId = '0001';
}
else
{
    $incrementorder = $rowmaxreciptId + 1;
    $reciptId = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
}
date_default_timezone_set('Asia/Colombo');
$year = date('Y');
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
  <script src="/../public/ajax/HostelFeeCollection.js"></script>
  <link rel="stylesheet" href="/../public/css/select2.min.css">
  <link rel="stylesheet" href="/../public/css/bootstrap-clockpicker.min.css">
  <script src="/../public/js/clock/bootstrap-clockpicker.min.js"></script>
  <script src="/../public/js/select2.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/../public/js/bootstrap-datepicker/css/datepicker.css">
  <script type="text/javascript" src="/../public/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini" id="bodytag">
<div class="wrapper" >
<?php 
$objpage->header();
?>
<div class="content-wrapper" id="loadAllDetails">    
<form method="post" id="HostelFeesPayment" role="form">
<section class="content">
    <div class="row">        
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Select Grade And Name The TimeTable</h3>
                </div>                
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-3 form-group">
                                <label for="Grade Number">Term</label>
                                <select class="form-control select2" style="width: 100%;" name="term" id="term">
                                    <option selected="selected" value=""> -- Select Term -- </option>
                                    <option value="1">1st Term</option>
                                    <option value="2">2nd Term</option>
                                    <option value="3">3rd Term</option>
                                </select>
                            </div>                            
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="Grade Number">Grade Number</label>
                                    <select class="form-control select2" style="width: 100%;" name="gradenumbersss" id="gradenumbersss">
                                        <option selected="selected" value=""> -- Grade Number -- </option>
                                        <?php 
                                        $result = $mat->SelectallGradeNumber();
                                        foreach($result as $row){
                                            ?>
                                            <option value="<?=$row['id']?>"><?=$row['gradenumber']." ".$row['gradesection']?></option>
                                            <?php 
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="Year">Year</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" id="year" name="year" placeholder="Year" readonly value="<?=$year?>">
                                    </div>
                                    <span class="help-block" id="error"></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="TimeTable  Name">TimeTable Name</label>
                                    <input type="text" class="form-control" id="nameoftimtbl" name="nameoftimtbl" placeholder="TimeTable Name" autocomplete="off">
                                    <span class="help-block" id="error"></span>
                                </div>
                            </div>
                            <div class="col-lg-2" style="padding-top: 24px">
                                <button type="button" class="btn btn-primary" id="settingup" name="settingup" data-toggle="modal" data-target="#myModal">Set Week Days</button> 
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><center>Select Working Days</center></h4>
                                            </div>
                                            <div class="modal-body">
                                                <center><b>WeekDays</b></center><hr>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="loadpaidDetails" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><input type="checkbox" name="chek[]" id="workchecks1"></th> 
                                                                <th scope="col"><center>Sunday</center></th>                                
                                                            </tr>
                                                            <tr>
                                                                <th scope="col"><input type="checkbox" name="chek[]" id="workchecks2"></th> 
                                                                <th scope="col"><center>Monday</center></th>                              
                                                            </tr>
                                                            <tr>
                                                                <th scope="col"><input type="checkbox" name="chek[]" id="workchecks3"></th> 
                                                                <th scope="col"><center>Tuesday</center></th>                                     
                                                            </tr>
                                                            <tr>
                                                                <th scope="col"><input type="checkbox" name="chek[]" id="workchecks4"></th> 
                                                                <th scope="col"><center>Wednesday</center></th>                                   
                                                            </tr>
                                                            <tr>
                                                                <th scope="col"><input type="checkbox" name="chek[]" id="workchecks5"></th> 
                                                                <th scope="col"><center>Thursday</center></th>                                   
                                                            </tr>
                                                            <tr>
                                                                <th scope="col"><input type="checkbox" name="chek[]" id="workchecks6"></th> 
                                                                <th scope="col"><center>Friday</center></th>                                     
                                                            </tr>
                                                            <tr>
                                                                <th scope="col"><input type="checkbox" name="chek[]" id="workchecks7"></th> 
                                                                <th scope="col"><center>Saturday</center></th>                                   
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>  
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <a href="javascript:createWeeeks();" class="btn btn-primary" id="savewrkdays" name="savewrkdays">Save Changes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="myModalsub" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 id="nammak" class="modal-title">Create Period Timings For </h4>
                                                <input type="hidden" name="nums" id="nums" value="1">
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped"  width="100%" id="displaytimetable">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Subject Name</th>
                                                                <th scope="col">Start Time</th>
                                                                <th scope="col">End Time</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td width="25%">
                                                                    <div class="form-group">
                                                                        <select class="form-control select2" style="width: 100%;" name="subjectid" id="subjectid">
                                                                            <option selected="selected" value>Interval</option>
                                                                            <?php 
                                                                            $result = $mat->AllClassSubjects();
                                                                            foreach($result as $row){
                                                                                ?>
                                                                                <option value="<?=$row['id']?>"><?=$row['sub_name']?></option>
                                                                                <?php 
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <input type="hidden" name="subjectnamesel" id="subjectnamesel">
                                                                    </div>
                                                                </td>
                                                                <td width="25%">
                                                                    <div class="form-group">
                                                                        <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                                                                            <input type="text" class="form-control" id="start" name="start" type="text" placeholder="Start Time">
                                                                            <span class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-time"></span>
                                                                            </span>
                                                                        </div>
                                                                        <span class="help-block" id="error"></span>
                                                                    </div>
                                                                </td>
                                                                <td width="25%">
                                                                    <div class="form-group">
                                                                        <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                                                                            <input type="text" class="form-control" id="end" name="end" type="text" placeholder="Start Time">
                                                                            <span class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-time"></span>
                                                                            </span>
                                                                        </div>
                                                                        <span class="help-block" id="error"></span>
                                                                    </div>
                                                                </td>
                                                                <td width="25%">
                                                                    <div class="form-group">
                                                                        <a href="javascript:AddnewPeriod()" class="btn btn-primary" name="addperiod" id="addperiod" >Add Period</a>
                                                                    </div>
                                                                </td>
                                                            </tr>                                
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-bordered table-striped"  width="100%" id="displaytimetable1">
                                                        <tbody></tbody>
                                                    </table>
<!--                                                    <div id="loadperiods" class="col-lg-12"></div>-->
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <a href="javascript:createTableview()" class="btn btn-primary" id="savetimetableperiod" name="savetimetableperiod">Set Time Table</a>
                                                <input type="hidden" name="nums" id="nums" value="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="facultymodal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><center>Select Teacher</center></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <select class="form-control select2" style="width: 100%;" name="teacherfaculty" id="teacherfaculty"></select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <a href="javascript:savefaculty();" class="btn btn-primary" id="savewrkdays" name="savewrkdays">Save Changes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-lg-3">
                                <h3 class="box-title">Create TimeTable</h3>
                            </div>
                            <div class="col-lg-6"></div>
                            <div class="col-lg-3">
                                <h5 class="box-title">TimeTable No : &nbsp;<?=$reciptId?></h5>
                                <input type="hidden" name="timetableno" id="timetableno" value="<?=$reciptId?>">
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="loadcreation"></div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped"  width="100%" id="finish_tb">
                                <thead>
                                    <tr></tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>                        
                    </div>
                    <div class="box-body">
                        <a href="javascript:saveTable()" class="btn btn-warning" name="Save" id="Save">Save TimeTable</a>
                    </div>
                </div>            
            </div>            
        </div>
    </section>
</form>
</div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 2019<a href="https://www.linkedin.com/in/mohammed-fashan-a59092187/" target="_blank">Fashan</a>.</strong> All rights
    reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<script>
function checkatleastonweek()
{
    var oneischecked = $('input[name]="chek[]"]:checked').length > 0;
    if(oneischecked == true)
    {
        return 0;
    }
    else
    {
        alert('Please Set altleast one week');//correct the statemet
        return 1;
    }
}

function AddnewPeriod()
{
    var subjectnameAdd = $('#subjectid option:selected').text();
    var subjectidAdd = $('#subjectid option:selected').val();
    var start = $('#start').val();
    var end = $('#end').val();
    $('#displaytimetable1 tbody').append('<tr><td data-id="'+ subjectidAdd +'">' + subjectnameAdd + '</td><td>' + start + '</td><td>' + end + '</td><td><a href="#"><i class="fa fa-window-close"></i></a></td></tr>');
}
    
function showTimetable()
{
    var result = checkatleastonweek();
    if(result == 0)
    {
        $('#myModalsub').modal('show');
    }
}
    
function createWeeeks()
{
    $('#finish_tb thead tr').empty();
    $('#finish_tb tbody').empty();
    
    if($('#workchecks1').is(":checked"))
    {
        $('#finish_tb tbody').append("<tr data-id='1'><td>Sunday <br><input type='hidden' name='assigns1' id='assigns1' value='1'><a href='javascript:assign(1)'>Assign</a></td></tr>");
    }
    if($('#workchecks2').is(":checked"))
    {
        $('#finish_tb tbody').append("<tr data-id='2'><td>Monday <br><input type='hidden' name='assigns2' id='assigns2' value='2'><a href='javascript:assign(2)'>Assign</a></td></tr>");
    }
    if($('#workchecks3').is(":checked"))
    {
        $('#finish_tb tbody').append("<tr data-id='3'><td>Tuesday <br><input type='hidden' name='assigns3' id='assigns3' value='3'><a href='javascript:assign(3)'>Assign</a></td></tr>");
    }
    if($('#workchecks4').is(":checked"))
    {
        $('#finish_tb tbody').append("<tr data-id='4'><td>Wednesday <br><input type='hidden' name='assigns4' id='assigns4'  value='4'><a href='javascript:assign(4)'>Assign</a></td></tr>");
    }
    if($('#workchecks5').is(":checked"))
    {
        $('#finish_tb tbody').append("<tr data-id='5'><td>Thursday <br><input type='hidden' name='assigns5' id='assigns5' value='5'><a href='javascript:assign(5)'>Assign</a></td></tr>");
    }
    if($('#workchecks6').is(":checked"))
    {
        $('#finish_tb tbody').append("<tr data-id='6'><td>Friday <br><input type='hidden' name='assigns6' id='assigns6' value='6'><a href='javascript:assign(6)'>Assign</a></td></tr>");
    }
    if($('#workchecks7').is(":checked"))
    {
        $('#finish_tb tbody').append("<tr data-id='7'><td>Saturday <br><input type='hidden' name='assigns7' id='assigns7'  value='7'><a href='javascript:assign(7)'>Assign</a></td></tr>");
    }
}
    
function assign(id)
{
    var week;
    $('#myModalsub').modal('show');
    if(id == 1)
        week = "Sunday";
    else if(id == 2)
        week = "Monday";
    else if(id == 3)
        week = "Tuesday";
    else if(id == 4)
        week = "Wednesday";
    else if(id == 5)
        week = "Thursday";
    else if(id == 6)
        week = "Friday";
    else if(id == 7)
        week = "Saturday";
    $('#nums').val(id);
    $('#nammak').html("Create Period Timings for " + week);
}

var keyColoumn = 0;
function createTableview()
{
    var id = $('#nums').val();
    var rowCount = $('#displaytimetable1 tr').length;
    $('#finish_tb tbody tr[data-id=' + id + ']').find("td:gt(0)").remove();
    
    $('#displaytimetable1 tr').each(function (row, tr){
        var faculty; var subj;
        var fn = $(tr).find('td:eq(0)').text();
        var subid = $(tr).find('td:eq(0)').data("id");
        
        if($(tr).find('td:eq(0)').text() === 'Interval')
        {
            faculty = $(tr).find('td:eq(0)').text();
            subj = $(tr).find('td:eq(0)').text();
        }
        else
        {
            faculty = $(tr).find('td:eq(0)').text();
            subj = $(tr).find('td:eq(0)').data("id");
            keyColoumn = keyColoumn + 1;
        }
        
        $('#finish_tb tbody tr[data-id=' + id + ']').append('<td><p><i>' + faculty + '<i><input type="hidden" name="subjectcellid" id="subjectcellid" value="'+subj+'"><input type="hidden" name="subjectcelltime" id="subjectcelltime" value="'+$(tr).find('td:eq(1)').text() + ' - ' + $(tr).find('td:eq(2)').text()+'"><p><p><i>' + $(tr).find('td:eq(1)').text() + ' - ' + $(tr).find('td:eq(2)').text() +'</i></p></td>');
    });
}
    
function saveTable()
{
    //gradenumbersss nameoftimtbl term
    if($('#term option:selected').val() === '')
    {
        alert("Please Select The Term");
        return;
    }
    
    if($('#gradenumbersss option:selected').val() === '')
    {
        alert("Please Select The Grade");
        return;
    }
    
    if($('#nameoftimtbl').val() === '')
    {
        alert("Please Enter A Name For The TimeTable");
        return;
    }
    
    var items = [];
    var grade = $('#gradenumbersss option:selected').val();
    var timetablename = $('#nameoftimtbl').val();
    var term = $('#term option:selected').val();
    var year = $('#year').val();
    var timetableno = $('#timetableno').val();
    
    items.push(grade); items.push(timetablename); items.push(term); items.push(year); items.push(timetableno);
    
    $('#finish_tb tbody tr').each(function (key, value){
        var $tds = $(this).find('td');
        var flag = 0;
        console.log("start");
        
        $.each($tds, function(){
            
            var res = $(this).text().replace(' Assign', '');
            var subjectid = $(this).find('input').val();
            var l = document.getElementById("finish_tb").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;

            if(flag == 0)
            {
//                items.push("#");
                flag = 1;
            }
            items.push(res);
            
            var inputString = res;
            var findme = "Interval";
            
            if(inputString.indexOf(findme) > -1)
            {
                items.push('0');
                items.push('0');
            }
            else{}
            var data = [
                term, grade, year, timetablename, res, subjectid, timetableno
            ];
            
            $.ajax({
                url: "SaveSpecialTimetable",
                method: "POST",
                data:{data:data}
            });
        });
    });
}
   
//function selectFacultyfn(subject, tablelocation2)
//{
//    var timestring = $('#location' + tablelocation2).parent().parent().find('p:first').text();
//    var myday = $('#location' + tablelocation2).parent().parent().parent().find('td:first').text();
//    myday = myday.replace(' Assign', '');
//    myday = '"' + myday + '"';
//    var res = timestring.split("-");
//    var starttime = res[0];
//    var x = res[0].split(" ");
//    var startampm = x[1];
//    var y = x[0].split(":");
//    var starthour = y[0];
//    
//    starthour = parseInt(starthour);
//    if(startampm === "PM"){
//        if(starthour === 12){}
//        else
//        {
//            starthour = starthour + 12;
//        }
//    }
//    var startminute = y[1];
//    
//    var endtime = res[1];
//    var x1 = res[1].split(" ");
//    var endampm = x1[1];
//    var y1 = x1[0].split(":");
//    var endhour = y1[0];
//    endhour = parseInt(endhour);
//    
//    if(endampm === 'PM')
//    {
//        if(endhour === 12){}
//        else
//        {
//            endhour = endhour + 12; 
//        }
//    }
//    
//    var endminute = y1[1];
//    if(starthour > endhour)
//    {
//        alert("Please Check Start And End Hours");
//        return;
//    }
//    
//    if(starthour === endhour)
//    {
//        if(startminute > endminute)
//        {
//            alert("Please Check Start And End Minutes");
//            return;
//        }
//    }
//    
//    if(res[0] === res[1])
//    {
//        alert("Please Check Time");
//        return;
//    }
//    
//    tablelocation = tablelocation2;
//    $('#teacherfaculty').empty();
//    $.ajax({
//        url: "getTeachers",
//        type: "POST",
//        data:{subject:subject, starttime: x, endtime: x1, day: myday, grade: $('#gradenumbersss option:selected').val()},
//        dataType: "html",
//        success: function(jsonData){
//            if(data == 'error')
//            {}
//            else
//            {
//                $('#teacherfaculty').append(jsonData);
//                $('#facultymodal').modal('show');
//            }
//        }
//        
//    });
//}
//    
//function savefaculty()
//{
//    console.log("location" + tablelocation);
//    var changetoid = "#location" + tablelocation;
//    $(changetoid).text($('#teacherfaculty option:selected').text());
//    $(changetoid).attr("data-myval", $('#teacherfaculty option selected').val());
//}
    
$(document).ready(function () {    
    $('.select2').select2();
    $('#purchasedate').datepicker({
        format: 'yyyy-mm-dd'
    });
});
//$(document).on('click', '#savewrkdays', function(){
//    var workchecks1 = $('input[name="workchecks1"]').prop('checked');
//    var workchecks2 = $('input[name="workchecks2"]').prop('checked');
//    var workchecks3 = $('input[name="workchecks3"]').prop('checked');
//    var workchecks4 = $('input[name="workchecks4"]').prop('checked');
//    var workchecks5 = $('input[name="workchecks5"]').prop('checked');
//    var workchecks6 = $('input[name="workchecks6"]').prop('checked');
//    var workchecks7 = $('input[name="workchecks7"]').prop('checked');
//    
//    $.ajax({
//        url: "loadTimeTabletoCreate",
//        method: "POST",
//        data:{workchecks1:workchecks1, workchecks2:workchecks2, workchecks3:workchecks3, workchecks4:workchecks4, workchecks5:workchecks5, workchecks6:workchecks6, workchecks7:workchecks7},
//        success: function(jsonData){
//            $('#loadcreation').html(jsonData);
//        }
//    });    
//});
$('.clockpicker').clockpicker()
    .find('input').change(function(){
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
            init: function() { 
            console.log("colorpicker initiated");
        },
            beforeShow: function() {
            console.log("before show");
        },
            afterShow: function() {
            console.log("after show");
        },
            beforeHide: function() {
            console.log("before hide");
        },
            afterHide: function() {
            console.log("after hide");
        },
            beforeHourSelect: function() {
            console.log("before hour selected");
        },
            afterHourSelect: function() {
            console.log("after hour selected");
        },
            beforeDone: function() {
            console.log("before done");
        },
            afterDone: function() {
            console.log("after done");
        }
    })
    .find('input').change(function(){
    console.log(this.value);
});
// Manually toggle to the minutes view
$('#check-minutes').click(function(e){
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