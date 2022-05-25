<?php
session_start();
if (!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$mat = new materialController;
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
        <link rel="stylesheet" href="/../public/css/_all-skins.min.css">
        <link rel="stylesheet" href="/../public/css/pace/themes/silver/pace-theme-minimal.css">
        <link rel="stylesheet" href="/../public/css/alertify.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <script src="/../public/ajax/header.js"></script>
        <link rel="stylesheet" href="/../public/css/select2.min.css">
        <script src="/../public/js/select2.min.js"></script>
        <script src="/../public/js/alertify.min.js"></script>
        <script src="/../public/js/jquery-ui.min.js"></script>
        <script data-pace-options='{ "ajax": false }' src="/../public/js/pace.js"></script>    
        <script src="/../public/js/jquery.validate.min.js"></script>
        <script src="/../public/js/bootstrap.min.js"></script>
        <script src="/../public/js/admin.min.js"></script>
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
                        <div class="col-lg-12">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="Grade Number">Grade Number</label>
                                                <select class="form-control select2" style="width: 100%;" name="gradenumberlist" id="gradenumberlist">
                                                    <option selected="selected" value=""> -- Grade Number -- </option>
                                                    <?php
                                                    $resultgr = $mat->SelectallGradeNumber();
                                                    foreach ($resultgr as $row) {
                                                        ?>
                                                        <option value="<?= $row['id'] ?>"><?= $row['gradenumber'] . " " . $row['gradesection'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4" id="loadStudents">
                                            <input type="hidden" name="students" id="students">
                                        </div>  
                                    </div>
                                    <div class="table-responsive">
                                        <table id="StudentFeesdetails" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <td>Receipt No</td>
                                                    <td>Individual Receipt No</td>
                                                    <td>Student Name</td>
                                                    <td>Grade</td>
                                                    <td>Module</td>
                                                    <td>Payment Date</td>
                                                    <td>Frequency</td>
                                                    <td>Payment Method</td>
                                                    <td>Paid Amount(Rs)</td>
                                                    <td>Total Amount(Rs)</td>
                                                    <td>Action</td>
                                                </tr>
                                            </thead>
                                        </table>
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
            $(document).on('change', '#gradenumberlist', function () {
                var gradenumberlist = $('#gradenumberlist').val();

                if (gradenumberlist != '')
                {
                    $.ajax({
                        url: "getStudentsDetSingle",
                        method: "POST",
                        data: {gradenumberlist: gradenumberlist},
                        success: function (jsonData)
                        {
                            $('#SearchStudent').val("");
                            $('#studentid').val("");
                            $('#loadStudents').html(jsonData);
                        }
                    });
                }
                else
                {
                    $('#loadStudents').html("");
                }
            });


            $(document).ready(function () {
                $('.select2').select2();

                setDatatable("");
                function setDatatable(student) {
                    var dataTable = $('#StudentFeesdetails').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": {
                            url: "getAllFees",
                            type: "POST",
                            data: {studentid: student}
                        },
                        "columnDefs": [
                            {
                                "targets": [1, 3, 4, 6, 8, 9, 10],
                                "orderable": false
                            },
                        ],
                    });
                }

                $(document).on('change', '#students', function () {
                    var student = $('#students').val();
                    $('#StudentFeesdetails').DataTable().destroy();
                    setDatatable(student);
                });
            });
        </script>
    </body>
</html>