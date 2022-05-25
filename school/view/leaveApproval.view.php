<?php
session_start();
if (!isset($_SESSION['loguserid']))
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
                                    <h3 class="box-title">Leave Approval List</h3>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="nav-tabs-custom">                            
                                            <div>
                                                <div class=" tab-pane" id="approval">
                                                    <div class="post">
                                                        <div class="user-block">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <td>#</td>
                                                                                    <td>Department</td>
                                                                                    <td>Staff Name</td>
                                                                                    <td>Staff Code</td>
                                                                                    <td>From Date</td>
                                                                                    <td>To Date</td>
                                                                                    <td>Leave Type</td>
                                                                                    <td>No Of Days</td>
                                                                                    <td>Remaining Leave</td>
                                                                                    <td>Actions</td>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                $result = $mat->leaveApprovalPending();
                                                                                $i = 1;
                                                                                foreach ($result as $row) {
                                                                                    $resultMain = $mat->SelectdetailLeaveCate($row['parent_app']);
                                                                                    $resultMaSu = $mat->getSingsubLeavesCate($resultMain['leave_category']);
                                                                                    $resultDept = $mat->departmentDetails($resultMain['department']);
                                                                                    $resultStaff = $mat->SelectStaffbyid($resultMain['staff']);
                                                                                    $resultCategory = $mat->SelectCategory($resultMaSu['category']);
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td><?= $i ?></td>
                                                                                        <td><?= $resultDept['name'] ?></td>
                                                                                        <td><?= $resultStaff['fullname'] ?></td>
                                                                                        <td><?= $resultStaff['code'] ?></td>
                                                                                        <td><?= $row['fdate'] ?></td>
                                                                                        <td><?= $row['tdate'] ?></td>
                                                                                        <td><?= $resultCategory['name'] ?></td>
                                                                                        <td><?= $row['count_leaves'] ?></td>
                                                                                        <td><?= $resultMain['remaining_leave'] ?></td>
                                                                                        <td>
                                                                                            <a class="prove" id="<?= $row['id'] ?>" style="font-size: 16px"><i class="fa fa-check-square"></i></a>&nbsp;<a class="reject" style="font-size: 16px" id="<?= $row['id'] ?>"><i class="fas fa-minus-circle"></i></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                    $i++;
                                                                                }
                                                                                ?>
                                                                            </tbody>
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
            $(document).on('click', '.prove', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: "updateLeaveofStaff",
                    method: "POST",
                    data: {id: id},
                    success: function ()
                    {
                        setTimeout("location.href = 'leaveApproval';", 0);
                    }
                });
            });
            $(document).on('click', '.reject', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: "updaterejectLeaveofStaff",
                    method: "POST",
                    data: {id: id},
                    success: function ()
                    {
                        setTimeout("location.href = 'leaveApproval';", 0);
                    }
                });
            });
        </script>
    </body>
</html>