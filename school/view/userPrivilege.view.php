<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new materialController;
$objpage = new pageController;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>School</title>
  <link rel="shortcut icon" href="/../public/img/school.png">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/../public/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://use.fontawesome.com/releases/v5.0.6/js/brands.js"></script>
<script src="https://use.fontawesome.com/releases/v5.0.6/js/solid.js"></script>
<script src="https://use.fontawesome.com/releases/v5.0.6/js/fontawesome.js"></script>
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
  <link rel="stylesheet" href="/../public/css/select2.min.css">
  <script src="/../public/js/select2.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini" id="bodytag">
<div class="wrapper" >
<?php 
$objpage->header();
?>
<div class="content-wrapper" id="loadAllDetails">    
<section class="content">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">User Privilage</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
              <select class="form-control select2" style="width: 100%;" name="userpriviledge" id="userpriviledge">
                  <option selected="selected" value=""> -- UserName -- </option>
                  <?php 
                  $result = $obj->SelectUsers();
                  foreach($result as $row){
                      ?>
                        <option value="<?=$row['id']?>"><?=$row['username']?></option>
                      <?php 
                  }
                  ?>
                </select>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3"></div>
  </div>
  <div class="row">
      <div class="col-lg-12">
          <div id="loadAllDetailsPrivilage"></div>
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
$(document).ready(function(){ 
    $('.select2').select2();
    
    $("#userpriviledge").change(function(){
        var user = $("#userpriviledge").val();        
        $.post("getDetailsofUserPrivilage", {
			user:user,
		},			
		function(data,status) {
			$("#loadAllDetailsPrivilage").empty();			
			$("#loadAllDetailsPrivilage").append(data);
		});
    });
});
    
    
function fillSpan(id) {
	if (document.getElementById('changeCon'+id).checked) {
		document.getElementById('viewCon'+id).innerHTML = '(Yes)';
	}
	else {
		document.getElementById('viewCon'+id).innerHTML = '(No)';
	}	
}

function fillNewSpan(id) {
	if (document.getElementById('changeNewCon'+id).checked) {
		document.getElementById('viewNewCon'+id).innerHTML = '(Yes)';
	}
	else {
		document.getElementById('viewNewCon'+id).innerHTML = '(No)';
	}	
}

function getUserPrivileges(id) {
	if (document.getElementById('userid').value != '') {
		if (document.getElementById('changeCon'+id).checked) {
			sign = "yes";
		}
		else {
			sign = "no";
		}
		        
        var user = $("#userpriviledge").val();        
        $.post("getDetailsofUserPrivilage", {
			user:user,
            id:id,
            sign:sign
		},			
		function(data,status) {
			$("#loadAllDetailsPrivilage").empty();			
			$("#loadAllDetailsPrivilage").append(data);
		});
	}
}

// For New Page Add Into Syatem
function getNewUserPrivileges(id) {
	if (document.getElementById('userid').value != '') {
		if (document.getElementById('changeNewCon'+id).checked) {
			sign = "yes";
		}
		else {
			sign = "no";
		}
	
        var user = $("#userpriviledge").val();        
        $.post("getDetailsofUserPrivilage", {
			user:user,
            id:id,
            sign:sign,
            newId: newId
		},			
		function(data,status) {
			$("#loadAllDetailsPrivilage").empty();			
			$("#loadAllDetailsPrivilage").append(data);
		});
		
	}
}
</script>
</body>
</html>