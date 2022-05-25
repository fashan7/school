<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;
$det = new detailsController;

$rowmaxreciptId = $mat->ProfDraggetMaxTimetable();
if($rowmaxreciptId == '0')
{
    $reciptId = '0001';
}
else
{
    $incrementorder = $rowmaxreciptId + 1;
    $reciptId = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
}
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
  <link rel="stylesheet" href="/../public/css/bootstrap-clockpicker.min.css">
  <script src="/../public/js/clock/bootstrap-clockpicker.min.js"></script>
  <script src="/../public/js/select2.min.js"></script>
  <script src="/../public/js/fuelux/js/spinner.js"></script>
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
                    <h3 class="box-title">Class TimeTable Configuration  </h3>
                </div>
                <div class="box-body">
                  <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group">
                            <label for="Current Address">First Period Starts @</label>
                            <div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
                                <input type="text" class="form-control" id="startperiod" name="startperiod" type="text" placeholder="Start Period" readonly>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                            <span class="help-block" id="error"></span>
                        </div>
                      </div>
                      <div class="col-lg-3">
                          <div class="form-group">
                            <label for="One Period Duration">One Period Duration</label>
                            <input type="text" class="form-control" id="oneperioddur" name="oneperioddur" placeholder="45 Minutes" autocomplete="off" onkeypress="return numOnly(event);">
                            <span class="help-block" id="error"></span>
                          </div>
                      </div>
                      <div class="col-lg-3">
                          <div class="form-group">
                            <label for="Interval Duration">In Which Period Interval Comes?</label>
                            <input type="text" class="form-control" id="intervalperiod" name="intervalperiod" placeholder="In 5th Period" autocomplete="off" onkeypress="return numOnly(event);">
                            <span class="help-block" id="error"></span>
                          </div>
                      </div>
                      <div class="col-lg-3">
                          <div class="form-group">
                            <label for="Interval Duration">Interval Duration</label>
                            <input type="text" class="form-control" id="intervaldur" name="intervaldur" placeholder="30 Min Break" autocomplete="off" onkeypress="return numOnly(event);">
                            <span class="help-block" id="error"></span>
                          </div>
                      </div>
                      <div class="col-lg-3">
                            <div class="form-group">
                                <label for="No Of Periods">No Of Periods</label>
                                <div id="spinner4">
                                    <div class="input-group">
                                        <div class="spinner-buttons input-group-btn">
                                            <button type="button" class="btn spinner-up btn-primary">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="spinner-input form-control" maxlength="3" readonly id="noofperiod" name="noofperiod">
                                        <div class="spinner-buttons input-group-btn">
                                            <button type="button" class="btn spinner-down btn-warning">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <span class="help-block" id="error"></span>
                            </div>
                      </div>                      
                      <div class="col-lg-3 form-group" style="padding-top: 20px">
                          <a onclick="SetCreateTimetable()" class="btn btn-primary" id="createtb" name="createtb">Create Time Table</a>
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
<script type="text/javascript">
function SetCreateTimetable()
{
    var startperiod = $('#startperiod').val();
    if(startperiod == '')
    {
        alert("Please Fill The Time");
    }
    var oneperioddur = $('#oneperioddur').val();
    if(oneperioddur == '')
    {
        alert("Please Fill The Subject Duration");
    }
    var intervalperiod = $('#intervalperiod').val();
    if(intervalperiod == '')
    {
        alert("Please Fill The Interval Period");
    }
    var intervaldur = $('#intervaldur').val();
    if(intervaldur == '')
    {
        alert("Please Fill The Break");
    }
    
    var noofperiod = $('#noofperiod').val();
    
    if(startperiod != '' && intervalperiod != '' && intervalperiod != '')
    {
        var a = document.getElementById('createtb'); //or grab it by tagname etc
        a.href = "classSchedule?startPeriod="+startperiod+"&oneperioddur="+oneperioddur+"&intervalperiod="+intervalperiod+"&Intduration="+intervaldur+"&noofperiod="+noofperiod;   
    }    
}
    
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
<script>
function numOnly(e) 
{
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 47 && k < 58 || k == 46));
}
$(document).ready(function(){
    $('#spinner4').spinner({value:1, step: 1, min: 1, max: 200}); 
});
</script>
</body>
</html>