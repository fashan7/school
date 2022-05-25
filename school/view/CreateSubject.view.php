<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
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
  <script src="/../public/ajax/subjectCreate.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
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
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Subject</h3>
                </div>
                <div class="box-body">
                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                        <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                        <ul class="fc-color-picker" id="color-chooser">
                            <li><a class="text-aqua" href="#"><i class="fa fa-square" ></i></a></li>
                            <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                            <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                        </ul>
                    </div>
                    <form method="post" id="savesubjectForm" role="form" enctype="multipart/form-data">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <input id="newSubject" name="newSubject" type="text" class="form-control" placeholder="Subject">
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group-btn" id="hidebutton">
                                <button id="add-new-event" type="submit" class="btn btn-primary btn-flat">Add</button>
                            </div>
                        </div>
                    </form>
                </div>                
            </div>
        </div>            
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="subjectdetails" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
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
var dataTable = $('#subjectdetails').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax" :{
        url: "getAllSubjects",
        method: "POST"
    },
    "columnDefs":[
        {
            "targets": [1],
            "orderable": false
        },
    ],
});
$(document).on('click', '.delete', function(){
    var id = $(this).attr('id');
    $.ajax({
        url: "deleteSubject",
        method:"POST",
        data:{id:id},
        success:function()
        {
            dataTable.ajax.reload();
        }
    });
});
</script>
</body>
</html>