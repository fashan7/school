<?php
if (!isset($_SESSION['loguserid']))
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
        <link rel="stylesheet" href="/../public/css/select2.min.css">
        <script src="/../public/js/select2.min.js"></script>
        <script src="/../public/ajax/branchreg.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
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
                                    <h3 class="box-title">Check Exam Result Of Students</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="ChildrenGrade">Children with Grade</label>
                                                <select class="form-control select2" id="students" name="students" style="width: 100%;">
                                                    <option value="" >-- Select Child --</option>
                                                    <?php
                                                    foreach ($resultLoop as $row) {
                                                        ?>
                                                        <option value="<?= $row['studentid'] ?>"><?= $row['studentname'] . ' - ' . $row['studentcode'] . ' - ' . $row['grades'] ?></option>        
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span class="help-block" id="error"></span>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>   
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped" id="loadApplication">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Grade</th>
                                                            <th scope="col">Student Name</th>                                                            
                                                            <th scope="col">Subject</th>                                                            
                                                            <th scope="col">Exam Date</th>
                                                            <th scope="col">Exam Duration</th>
                                                            <th scope="col">Marks</th>
                                                            <th scope="col">Results</th>                                                            
                                                            <th scope="col">View</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <div class="box-body">
                                    <div id="ApplicantDet"></div>
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
                changeDaatable(0);
                function changeDaatable(studentid) {
                    var dataTable = $('#loadApplication').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": {
                            url: "getExamReusltfromStds",
                            method: "POST",
                            data: {studentid: studentid}
                        },
                        "columnDefs": [
                            {
                                "targets": [0, 1, 2, 3, 4, 5, 6],
                                "orderable": false
                            },
                        ],
                    });
                }
                $(document).on('change', '#students', function () {
                    var students = $('#students').val();
                    $('#ApplicantDet').html("");
                    if ($('#students').val() != "") {
                        
                        $('#loadApplication').DataTable().destroy();
                        changeDaatable(students);
                    } else {
                        $('#loadApplication').DataTable().destroy();                        
                    }
                });

            });
            $(document).on('click', '.viewc', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: "getExamResultDet",
                    method: "POST",
                    data: {id: id},
                    success: function (jsonData)
                    {
                        $('#ApplicantDet').html(jsonData);
                    }
                });
            });
        </script>
    </body>
</html>