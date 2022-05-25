<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;

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
                            <div class="col-lg-3">
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
                            <div class="col-lg-3">
                                <div class="form-group" id="tmenoload">
                                    <label for="TimeTable No">TimeTable No</label>
                                    <select class="form-control select2" style="width: 100%;" name="timetblno" id="timetblno">
                                        <option selected="selected" value=""> -- Select -- </option>                                        
                                    </select>
                                </div>
                            </div>                            
                            <div class="col-lg-2" style="padding-top: 24px">
                                <button type="button" class="btn btn-primary" id="loadtb" name="loadtb">Load TimeTable</button> 
                            </div>
                        </div>
                    </div>                
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">View TimeTable</h3>                            
                    </div>
                    <div class="box-body">
                        <div id="loadcreation"></div>                        
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
$(document).on('change', '#gradenumbersss', function(){
    var grade = $('#gradenumbersss option:selected').val();
    if(grade != '')
    {
        $.ajax({
            url: "loadTimetableno",
            method: "POST",
            data:{grade:grade},
            success:function(jsonData)
            {
                $('#tmenoload').html(jsonData);
            }
        });
    }
    else
        $('#tmenoload').html("");
});
$(document).on('click', '#loadtb', function(){
    var timetblno = $('#timetblno option:selected').val();
    if(timetblno != '')
    {
        $.ajax({
            url: "loadFullTimetable",
            method: "POST",
            data:{timetblno:timetblno},
            success:function(jsonData)
            {
                $('#loadcreation').html(jsonData);
            }
        });
    }
    else 
    {
        $('#loadcreation').html("");
    }
});
</script>
</body>
</html>