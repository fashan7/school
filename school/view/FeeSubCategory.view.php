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
  <script src="/../public/ajax/FeeSubCategoryReg.js"></script>
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
                    <h3 class="box-title">Fees Sub Category</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12" id="editDates">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#subcat" data-toggle="tab">Fees Sub Category</a></li>
                                <li><a href="#list" data-toggle="tab">List</a></li>
                            </ul>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="subcat">
                                        <div class="post">
                                            <div class="user-block">
                                                <form method="post" id="subCatReg" role="form">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="Fee Category">Fee Category</label>
                                                                <select name="feecategory" id="feecategory" class="form-control select2" style="width: 100%;">
                                                                    <option value="">-- Select Category --</option>
                                                                    <?php 
                                                                    $result = $mat->SelectFeeCategoryAll();
                                                                    foreach($result as $row){
                                                                    ?>
                                                                        <option value="<?=$row['id']?>"><?=$row['category_name']?></option>
                                                                    <?php 
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                               <label for="Fee Sub Category Name">Fee Sub Category Name</label>
                                                                <input type="text" class="form-control" id="feesubcategoryname" name="feesubcategoryname" placeholder="Enter Fee Sub Category" autocomplete="off">
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                               <label for="Amount">Amount</label>
                                                                <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount" autocomplete="off">
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="Fees Type">Fees Type</label>
                                                                <select name="feetype" id="feetype" class="form-control select2" style="width: 100%;">
                                                                    <option value="">-- Select Type --</option>
                                                                    <option value="Annual">Annual</option>
                                                                    <option value="Bi-Annual">Bi-Annual</option>
                                                                    <option value="Tri-Annual">Tri-Annual</option>
                                                                    <option value="Quaterly">Quaterly</option>
                                                                    <option value="Monthly">Monthly</option>   
                                                                    <option value="One-Time">One-Time</option>   
                                                                </select>
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="loadFeeTypes"></div>                                                     
                                                    <div class="row col-lg-4">
                                                        <div class="form-group" id="hidebutton">
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
                                                        <table class="table table-bordered table-striped" id="loaddetails" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Fee Category</th>
                                                                    <th scope="col">Fee Sub Category Name</th>
                                                                    <th scope="col">Amount</th>
                                                                    <th scope="col">Fees Type</th>
                                                                    <th scope="col">Action</th>
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
<script>
$(document).ready(function () {    
    $('.select2').select2();
    
    var dataTable = $('#loaddetails').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax" :{
            url: "getAllFeeSubCategories",
            method: "POST"
        },
        "columnDefs":[
            {
                "targets": [5],
                "orderable": false
            },
        ],
    });
    $(document).on('click', '.delete', function(){
        var id = $(this).attr('id');
        $.ajax({
            url: "deleteFeeSubCat",
            method:"POST",
            data:{id:id},
            success:function(json)
            {
                dataTable.ajax.reload();
            }
        });
    });
});
$(document).on('change', '#feetype', function(){
    var feetype = $('#feetype').val();
    $.ajax({
        url:"FeesTypes",
        method:"POST",
        data:{feetype:feetype},
        success:function(jsonData)
        {
            $('#loadFeeTypes').html(jsonData);
        }
    });
});
$(document).on('click', '.edit', function(){
    var id = $(this).attr('id');
    $.ajax({
        url:"UpdateFeesDates",
        method:"POST",
        data:{id:id},
        success:function(jsonData)
        {
            $('#editDates').html("");
            $('#editDates').html(jsonData);
        }
    });
});
</script>
</body>
</html>