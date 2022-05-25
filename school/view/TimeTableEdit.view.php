<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$timetblno = $_GET['timetblno'];




$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;
$det = new detailsController;

$Result12 = $mat->getWeekTimeSubject($timetblno);
$startperiod = $Result12['firstperiod'];
$oneperioddur = $Result12['period_dur'];
$intervalperiod = $Result12['period_int'];
$noofperiod = $Result12['no_of_period'];
$Intduration = $Result12['interval_dur']; 

if($intervalperiod == 1)
{
    $intervalperiod = 2;
}

$Result123 = $mat->getWeekTimeSubjectClassTimetable($timetblno);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>School</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="/../public/img/school.png">
  <link rel="stylesheet" href="/../public/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="https://use.fontawesome.com/releases/v5.0.6/js/brands.js"></script>
<!--<script src="https://use.fontawesome.com/releases/v5.0.6/js/solid.js"></script>-->
<script src="https://use.fontawesome.com/releases/v5.0.6/js/fontawesome.js"></script>  
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
<link rel="stylesheet" href="/../public/css/dragtimetable/style.css" type="text/css" media="screen"/>
<script type="text/javascript" src="/../public/js/dragtimetable/redips-drag-min.js"></script>
<script type="text/javascript" src="/../public/js/dragtimetable/script.js"></script>
<style>
table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}
table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}
table tr {
  background: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}
table th,
table td {
  padding: .625em;
  text-align: center;
}
table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}
@media screen and (max-width: 600px) {
  table {
    border: 0;
  }
  table caption {
    font-size: 1.3em;
  }
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  table td:before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  table td:last-child {
    border-bottom: 0;
  }
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini" id="bodytag">
<div class="wrapper" >
<?php 
$objpage->header();

date_default_timezone_set('Asia/Colombo');
$year = date('Y');
?>
<div class="content-wrapper" id="loadAllDetails"> 
<form method="post" id="timetablesubmit" role="form" enctype="multipart/form-data" target="upload_frame">
<section class="content">
    <div class="row">        
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Class TimeTable Creation  </h3>
                </div>
                <div class="box-body">
                  <div class="row">
                      <div class="col-lg-3">
                          <label for="Grade Number">Term</label>
                          <select class="form-control select2" style="width: 100%;" name="term" id="term">
                              <?php 
                              if($Result123['term'] == 1)
                              {
                                ?><option value="1">1st Term</option><?php    
                              }
                              else if($Result123['term'] == 2)
                              {
                                  ?><option value="2">2nd Term</option><?php
                              }
                              else if($Result123['term'] == 3)
                              {
                                   ?><option value="3">3rd Term</option><?php  
                              } 
                              ?>                              
                          </select>
                      </div>
                      <div class="col-lg-3">
                          <div class="form-group">
                            <label for="Class No">Class No</label>
                            <select name="classno" id="classno" class="form-control select2" style="width: 100%;">
                                <?php 
                                $result = $mat->SelectallGradeNumber();
                                foreach($result as $row){
                                    if($Result123['grade'] == $row['id'])
                                    {
                                        ?>
                                            <option value="<?=$row['id']?>" selected><?=$row['gradenumber']." ".$row['gradesection']?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-lg-3">
                          <div class="form-group">
                          <label for="Year">Year</label>
                          <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" id="year" name="year" placeholder="Year" readonly value="<?=$Result123['year']?>">
                            </div>
                            <span class="help-block" id="error"></span>
                        </div>
                      </div>                      
                      <div class="col-lg-3 form-group" style="padding-top: 20px">
                          <input type="hidden" name="firstperiodst" id="firstperiodst" value="<?=$startperiod?>">
                          <input type="hidden" name="periodduration" id="periodduration" value="<?=$oneperioddur?>">
                          <input type="hidden" name="intervalperiod" id="intervalperiod" value="<?=$intervalperiod?>">
                          <input type="hidden" name="intervalduration" id="intervalduration" value="<?=$Intduration?>">
                          <input type="hidden" name="noofperiod" id="noofperiod" value="<?=$noofperiod?>">
                          <input type="hidden" name="timetblno" id="timetblno" value="<?=$timetblno?>">
                      </div>
                  </div>    
                </div>
            </div>
        </div>            
    </div>
<div id="loadtimetable">
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-lg-3">
                <h3 class="box-title">Drag &amp; Drop The Subjects</h3>
            </div>
            <div class="col-lg-6"></div>
            <div class="col-lg-3" style="align: right">
                TimeTable No :-&nbsp;<?=$timetblno?>
                <input type="hidden" name="timetableno" id="timetableno" value="<?=$timetblno?>">
            </div>
        </div>        
    </div>
    <div class="box-body" id="loadTimetable">
      <div class="row">
          <div class="col-lg-12">
              <div id="main_container">
                  <div id="redips-drag">
                      <div class="col-lg-3" >
                          <table id="table1" class="table order-list">
                            <tbody>
                                <?php 
                                $det->subjects();
                                ?>
                                <tr><td class="redips-trash" title="Trash" data-label="Trash"><i class="fa fa-trash fa-3x"></i></td></tr>
                            </tbody>
                          </table>
                      </div>
                      <div style="width: 66.66666667%; margin-left: auto;" >
                          <table id="table2" class="table order-list">
                            <tbody>
                                <tr>
                                    <!-- if checkbox is checked, clone school subjects to the whole table row  -->
                                    <td class="redips-mark blank">
                                        <input id="week" type="checkbox" title="Apply school subjects to the week" checked/>
                                        <input id="report" type="checkbox" title="Show subject report"/>
                                    </td>
                                    <td class="redips-mark dark">Monday</td>
                                    <td class="redips-mark dark">Tuesday</td>
                                    <td class="redips-mark dark">Wednesday</td>
                                    <td class="redips-mark dark">Thursday</td>
                                    <td class="redips-mark dark">Friday</td>
<!--                                    <td class="redips-mark dark">Saturday</td>-->
                                </tr>
                                <?php 
                                $time = '';
                                for($i = 1; $i <= $noofperiod; $i++)
                                {                                                                        
                                    if($intervalperiod == $i)
                                    {
                                        $TimeDuration = date("H:i", strtotime('+' .$Intduration.' minutes', $time)); 
                                        $time = strtotime($TimeDuration);
                                        ?>
                                        <tr>
                                            <td class="redips-mark dark"><?=$TimeDuration?></td>
                                            <td class="redips-mark lunch" colspan="5">Interval</td>
                                        </tr>
                                        <?php
                                    }
                                    else if($i == 1)
                                    {
                                        $time = strtotime($startperiod);                                    
                                        $det->ValuesOfClassTimetable($startperiod, $i, $timetblno); 
                                    }
                                    else
                                    {   
                                        $TimeDuration = date("H:i", strtotime('+' .$oneperioddur.' minutes', $time));
                                        $det->ValuesOfClassTimetable($TimeDuration, $i, $timetblno); 
                                        $time = strtotime($TimeDuration);
                                    }
                                }
                                
                                ?>
                                
                            </tbody>
                        </table>
                      </div>                      
                  </div>
              </div>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="box-footer" id="hidebutton">
                    <button type="button" class="btn btn-danger btn-flat" id="delete" name="delete">Reset TimeTable</button>   
                </div>
            </div>
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
    <strong>Copyright &copy; 2019 <a href="https://www.linkedin.com/in/mohammed-fashan-a59092187/" target="_blank">Fashan</a>.</strong> All rights
    reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<script>

$(document).ready(function(){ 
    $('.select2').select2();
});


$(document).ready(function(){
    var loading = false;
    $("#delete").click(function (event){
        event.preventDefault();
        
        if(loading){
            return ;
        }
        loading = true;
        var timetblno = $('#timetblno').val();
        $.ajax({
            url: 'DeleteClassTimetable',
            method: 'POST',
            data:{timetblno:timetblno},
            success: function(jsonData)
            {
                loading = false;
                setTimeout("location.href = 'editTimeTable';",0);
            }
        });
    });
});
</script>
</body>
</html>