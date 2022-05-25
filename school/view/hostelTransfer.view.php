<?php
session_start();
if(!isset($_SESSION['loguserid']))
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
  <script src="/../public/ajax/HostelTransfer.js"></script>
  <link rel="stylesheet" href="/../public/css/select2.min.css">
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
<section class="content">
    <div class="row">        
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Room Transfer &amp; Vacate Related </h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#hostelregis" data-toggle="tab">Room Transfer &amp; Vacate</a></li>
                                <li><a href="#list" data-toggle="tab">Vacate List</a></li>
                            </ul>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="hostelregis">
                                        <div class="post">
                                            <div class="user-block">
                                                <form method="post" id="hostelTranferUpd" role="form">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="UserType">UserType</label>
                                                                <select name="usertype" id="usertype" class="form-control select2" style="width: 100%;">
                                                                    <option value="">-- Select Type --</option>
                                                                    <option value="student">Student</option>
                                                                    <option value="employee">Employee</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4" id="loadAutocomplete">
                                                            <div class="form-group">
                                                                <label for="User Name">User Name</label>
                                                                <input type="text" class="form-control" id="usernamedp" name="usernamedp" placeholder="Search From Student Name" autocomplete="off" readonly>
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4" style="padding-top: 24px">
                                                            <button type="button" class="btn btn-primary" id="Go" name="Go">Go</button> 
                                                        </div>
                                                    </div>
                                                    <div class="row" id="getUserRoomsDetails"></div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="Select Option">Select Option</label>
                                                                <select name="optionofEdit" id="optionofEdit" class="form-control select2" style="width: 100%;">
                                                                    <option value="">-- Please Select --</option>
                                                                    <option value="Transfer">Transfer</option>
                                                                    <option value="Vacate">Vacate</option>
                                                                </select>
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8"></div>
                                                    </div>
                                                    <div class="row" style="display: none" id="OptionDisplay">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="Hostel Type">Hostel Type</label>
                                                                <select name="hosteltype" id="hosteltype" class="form-control select2" style="width: 100%;">
                                                                    <option value="">-- Select Hostel Type --</option>
                                                                    <?php 
                                                                    $result1 = $mat->hostelsType();
                                                                    foreach($result1 as $row){
                                                                    ?>
                                                                        <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                                                    <?php 
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div id="hostelnameload"></div>                                                       
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div id="loadhostelrooms"></div>                                                     
                                                        </div>
                                                    </div>  
                                                    <div class="row" id="indetailsHostelRooms"></div>
                                                    <div class="row col-lg-4">
                                                        <div class="form-group" id="hidebutton">
                                                            <input type="hidden" name="countRooms" id="countRooms" value="1">
                                                            <button type="submit" class="btn btn-warning" id="save" name="save">Save</button> 
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="list">
                                        <div class="user-block">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped" id="loadVacateDetails" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">User Type</th>
                                                                    <th scope="col">User</th>
                                                                    <th scope="col">Hostel Type</th>
                                                                    <th scope="col">Hostel Name</th>
                                                                    <th scope="col">Floor</th>
                                                                    <th scope="col">Room No</th>
                                                                    <th scope="col">Vacate Date</th>
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
    $('#hostelregDate').datepicker({
        format: 'yyyy-mm-dd'
    });
    $('#vacatingDate').datepicker({
        format: 'yyyy-mm-dd'
    });
    var dataTable = $('#loadVacateDetails').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax" :{
            url: "getAllVacateRooms",
            method: "POST"
        },
        "columnDefs":[
            {
                "targets": [0, 2, 3, 4, 5, 6],
                "orderable": false
            },
        ],
    });
});
$(document).on('change', '#usertype', function(){
    var usertype = $('#usertype').val();
    if(usertype != '')
    {
        $.ajax({
            url: "AutoCompleteUserType",
            method: "POST",
            data:{usertype:usertype},
            success: function(jsonData)
            {
                $('#loadAutocomplete').html(jsonData);
            }
        });
    }
    else
    {
        $('#loadAutocomplete').html("");
    }
});
    
$(document).on('click', '#Go', function(){
    var usertype = $('#usertype').val();
    if(usertype == 'student') 
    {
        var userid = $('#studentid').val(); 
        if(usertype != '' && userid != '')
        {
            $.ajax({
                url: "SmallMemberDetails",
                method: "POST",
                data:{usertype:usertype, userid:userid},
                success: function(jsonData){
                    $('#getUserRoomsDetails').html(jsonData);
                }
            });
        }
    }
    else if(usertype == 'employee')
    {
        var userid = $('#staffid').val();
        if(usertype != '' && userid != '')
        {
            $.ajax({
                url: "SmallMemberDetails",
                method: "POST",
                data:{usertype:usertype, userid:userid},
                success: function(jsonData){
                    $('#getUserRoomsDetails').html(jsonData);
                }
            });
        }
    }
});
$(document).on('change', '#optionofEdit', function(){
    var optionofEdit = $('#optionofEdit').val();
    if(optionofEdit == 'Transfer')
    {
        document.getElementById("OptionDisplay").style.display="block";   
    }
    else if(optionofEdit == 'Vacate')
    {
        document.getElementById("OptionDisplay").style.display="none";
    }
    else 
    {
        document.getElementById("OptionDisplay").style.display="none";
    }
});
$(document).on('change', '#hosteltype', function(){
    var hosteltype = $('#hosteltype').val();
    if(hosteltype != '')
    {
        $.ajax({
            url:"getHostelName",
            method:"POST",
            data:{hosteltype:hosteltype},
            success:function(jsonData)
            {
                $('#hostelnameload').html(jsonData);
                $('#loadhostelrooms').html("");
                $('#indetailsHostelRooms').html("");
            }
        });
    }
    else
    {
        $('#hostelnameload').html("");
        $('#loadhostelrooms').html("");
        $('#indetailsHostelRooms').html("");
    }
});
$(document).on('change', '#hostelname', function(){
    var hostelname = $('#hostelname').val();
    $.ajax({
        url:"getHostelRooms",
        method:"POST",
        data:{hostelname:hostelname},
        success:function(jsonData)
        {
            $('#loadhostelrooms').html(jsonData);
            $('#indetailsHostelRooms').html("");
        }
    });
});
$(document).on('change', '#hostelroomID', function(){
    var hostelroomID = $('#hostelroomID').val();
    if(hostelroomID != '')
    {
        $.ajax({
            url:"RoomsDetails",
            method:"POST",
            data:{hostelroomID:hostelroomID},
            success:function(jsonData)
            {
                $('#indetailsHostelRooms').html(jsonData);
            }
        });
    }
    else
    {
        $('#indetailsHostelRooms').html("");   
    }
});
</script>
</body>
</html>