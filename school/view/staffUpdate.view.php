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
  <link rel="stylesheet" href="/../public/css/select2.min.css">
  <script src="/../public/js/select2.min.js"></script>
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
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<link href="/../public/css/tableresponsive.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<style>
table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  max-width: 100%;
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
?>
<div class="content-wrapper" id="loadAllDetails">    
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Staff Updation</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Staff Members">Staff Members</label>
                                <select name="staffno" id="staffno" class="form-control select2" style="width: 100%;">
                                    <option value="">-- Select Staff --</option>
                                    <?php 
                                    $result = $mat->getEmployeesAll();
                                    foreach($result as $row){
                                    ?>
                                        <option value="<?=$row['id']?>"><?=$row['fullname']?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
                <div class="box-body">      
                    <table class=" table order-list">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Code</th>
                                <th scope="col">Address</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Date of Birth</th>
                                <th scope="col">Mobile No</th>
                                <th scope="col">Email Address</th>
                                <th scope="col">Joined Date</th>
                                <th scope="col">Department</th>
                            </tr>
                        </thead>
                        <tbody id="staffDetailsLoad"></tbody>
                    </table>
                    
                </div>            
            </div>
        </div>
    </div>
<!--
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Staff Updation</h3>
        </div>
        <div class="box-body table-responsive">
            <table id="staff_Data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Address</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Date of Birth</th>
                        <th scope="col">Mobile No</th>
                        <th scope="col">Email Address</th>
                    </tr>
                </thead>
            </table>                        
        </div>
    </div>
-->
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
//$(document).ready(function(){
//    fetch_Data();
//    function fetch_Data()
//    {
//        var datatable = $('#staff_Data').DataTable({
//            "processing": true,
//            "serverSide": true,
//            "order": [],
//            "ajax": {
//                url: "loadStaffDetailsinDataTableToedit",
//                type: "POST"
//            }
//        });
//    }
//    
//    $(document).on("blur", ".update", function(){
//        var id = $(this).data("id");
//        var column_name = $(this).data("column");   
//        var value = $(this).text();
//        $.ajax({
//            url: "updateStaffs",
//            method: "POST",
//            data: {id:id, column_name:column_name, value: value},
//            success:function(jsonData)
//            {
//                $('#staff_Data').DataTable().destroy();
//                fetch_Data();
//            }
//        });
//    });
//});
</script>
<script>
$(document).ready(function () {
    $('.select2').select2();
    
    
    
    function fetch_staff_details(staffno)
    {
        $.ajax({
            url: "loadStaffDetailsToedit",
            method: "POST",
            data:{staffno:staffno},
            success:function(jsonData)
            {
//                alert(jsonData);
                $('#staffDetailsLoad').html(jsonData);
            }
        });
    }
    $(document).on('change', '#staffno', function(){
        var staffno = $(this).val();
//        $('#allstudents').DataTable().destroy();
        if(staffno != '')
        {
            fetch_staff_details(staffno);
        }
        else{
            fetch_staff_details();
        }
    });
    fetch_staff_details();
    $('#staffDetailsLoad').editable({
        container: 'body',
        selector: 'td.fullname',
        url: 'updateStaff',
        title: 'Name With Intials',
        type: 'POST',
        validate: function(value){
            if($.trim(value) == "")
            {
                return 'This Field is required';
            }
        }
    });
    
    $('#staffDetailsLoad').editable({
        container: 'body',
        selector: 'td.code',
        url: 'updateStaff',
        title: 'Staff Code',
        type: 'POST',
        validate: function(value){
            if($.trim(value) == "")
            {
                return 'This Field is required';
            }
        }
    });
    
    $('#staffDetailsLoad').editable({
        container: 'body',
        selector: 'td.address',
        url: 'updateStaff',
        title: 'Address',
        type: 'POST',
        validate: function(value){            
            if($.trim(value) == "")
            {
                return 'This Field is required';
            }
        }
    });
    
    $('#staffDetailsLoad').editable({
        container: 'body',
        selector: 'td.gender',
        url: 'updateStaff',
        title: 'Gender',
        type: 'POST',
        source: [{value: "male", text: "Male"}, {value: "female", text: "Female"}],
        validate: function(value){
            if($.trim(value) == "")
            {
                return 'This Field is required';
            }
        }
    });
    
    $('#staffDetailsLoad').editable({
        container: 'body',
        selector: 'td.dob',
        url: 'updateStaff',
        title: 'Date Of Birth',
        type: 'POST',
        validate: function(value){
            if($.trim(value) == "")
            {
                return 'This Field is required';
            }
        }
    });
    
    $('#staffDetailsLoad').editable({
        container: 'body',
        selector: 'td.mobile',
        url: 'updateStaff',
        title: 'Mobile No',
        type: 'POST',
        validate: function(value){
            if($.trim(value) == "")
            {
                return 'This Field is required';
            }
            var expression = /^[0-9]+$/;
            if(!expression.test(value))
            {
                return "Numbers Only!";
            }
        }
    });
    
    $('#staffDetailsLoad').editable({
        container: 'body',
        selector: 'td.email',
        url: 'updateStaff',
        title: 'Email Address',
        type: 'POST',
        validate: function(value){
            if($.trim(value) == "")
            {
                return 'This Field is required';
            }
        }
    });
});
</script>
</body>
</html>