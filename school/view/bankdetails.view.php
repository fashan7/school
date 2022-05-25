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
  <script src="/../public/ajax/bank.js"></script>
  <script src="/../public/ajax/EmpbankDetail.js"></script>
  <link rel="stylesheet" href="/../public/css/select2.min.css">
  <script src="/../public/js/select2.min.js"></script>
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
                    <h3 class="box-title">Bank Related</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#addbank" data-toggle="tab">Add Bank</a></li>
                                <li><a href="#employee" data-toggle="tab">Employee</a></li>
                                <li><a href="#list" data-toggle="tab">List</a></li>
                            </ul>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="addbank">
                                        <div class="post">
                                            <div class="user-block">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Bank Details</h3>
                                                        </div>
                                                        <form method="post" id="bankReg" role="form">
                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                    <label for="Bank Name">Bank Name</label>
                                                                    <input type="text" class="form-control" id="bankname" name="bankname" placeholder="Enter Bank Name" autocomplete="off">
                                                                    <span class="help-block" id="error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="box-footer" id="hidebutton">
                                                                <button type="submit" class="btn btn-warning" id="save" name="save">Save</button>   
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="box-body">      
                                                            <table class="table order-list">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Bank Name</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="loadbank"></tbody>
                                                            </table>            
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="employee">
                                        <div class="user-block">
                                            <div class="col-lg-12">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Bank Details</h3>
                                                </div>
                                                <form method="post" id="EmployeebankReg" role="form">
                                                    <div class="box-body">                                                        
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="Staff Members">Staff Members</label>
                                                                <select name="staffno" id="staffno" class="form-control select2" style="width: 100%;">
                                                                    <option value="">-- Select Member --</option>
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
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="Bank Name">Bank Name</label>
                                                                <select name="banknameload" id="banknameload" class="form-control select2" style="width: 100%;">
                                                                    <option value="">-- Select Bank --</option>
                                                                    <?php 
                                                                    $result1 = $mat->SelectallBanks();
                                                                    foreach($result1 as $row){
                                                                    ?>
                                                                        <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                                                    <?php 
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="Branch">Branch</label>
                                                                <input type="text" class="form-control" id="branchname" name="branchname" placeholder="Enter Branch Name" autocomplete="off">
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="Account No">Account No</label>
                                                                <input type="text" class="form-control" id="accountno" name="accountno" placeholder="Enter Account No" autocomplete="off">
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="Bank Address">Bank Address</label>
                                                                <input type="text" class="form-control" id="bAddress" name="bAddress" placeholder="Enter Bank Address" autocomplete="off">
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="box-footer" id="hidebutton">
                                                        <button type="submit" class="btn btn-warning" id="save1" name="save1">Save</button>   
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="list">
                                        <div class="user-block">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">List</h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="Staff Members">Staff Members</label>
                                                            <select name="staffmember" id="staffmember" class="form-control select2" style="width: 100%;">
                                                                <option value="">-- Grade Number --</option>
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
                                                </div>
                                                <div class="col-lg-8">
                                                    <div id="loadAllEmployeeBank"></div>
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
<script>
$(document).ready(function () {    
    $('.select2').select2();
    function fetch_bank()
    {
        $.ajax({
            url: "loadbankDetailsToedit",
            method: "POST",
            success:function(jsonData)
            {
                $('#loadbank').html(jsonData);
            }
        });
    }
    fetch_bank();
    
    $(document).on('change', '#staffmember', function(){
        var staffmember = $('#staffmember').val();
        $.ajax({
            url: "loadEmployeewithBanks",
            method: "POST",
            data:{staffmember:staffmember},
            success:function(jsonData)
            {
                $('#loadAllEmployeeBank').html(jsonData);
            }
        });
    });
    
    $('#loadbank').editable({
        container: 'body',
        selector: 'td.name',
        url: 'updatebank',
        title: 'User Type',
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