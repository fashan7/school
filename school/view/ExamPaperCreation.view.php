<?php
session_start();
if (!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new detailsController;
$objpage = new pageController;
$mat = new materialController;

$rowmaxreciptId = $mat->MaxExamPaperNo();
$rowmaxreciptId = intval($rowmaxreciptId);
if ($rowmaxreciptId == '0') {
    $paperno = '0001';
} else {
    $incrementorder = $rowmaxreciptId + 1;
    $paperno = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
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
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/solid.js"></script>
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
        <script src="/../public/js/select2.min.js"></script>      
        <link rel="stylesheet" href="/../public/css/select2.min.css">
        <script src="/../public/ajax/header.js"></script>
        <script src="/../public/js/alertify.min.js"></script>
        <script src="/../public/js/jquery-ui.min.js"></script>
        <script data-pace-options='{ "ajax": false }' src="/../public/js/pace.js"></script>    
        <script src="/../public/js/jquery.validate.min.js"></script>
        <script src="/../public/js/bootstrap.min.js"></script>
        <script src="/../public/js/admin.min.js"></script>
        <script src="/../public/js/fuelux/js/spinner.js"></script>
        <script src="/../public/ajax/CreateExamPaper.js"></script>
        <script src="/../public/ajax/abc.js"></script>
        <style>
            table {
                border: 1px solid #ccc;
                border-collapse: collapse;
                margin: 0;
                padding: 0;
                width: 100%;
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
            <div class="content-wrapper" >    
                <section class="content" id="loadQbank">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <h3 class="box-title">Create Exam Papers</h3>
                                        </div>
                                        <div class="col-lg-6"></div>
                                        <div class="col-lg-3">Exam Paper No <?= $paperno ?></div>
                                    </div>

                                </div> 
                                <form method="post" id="createExampap" role="form">
                                    <div class="box-body">
                                        <div class="row"> 
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="Subjects">Subjects</label>
                                                    <input type="text" class="form-control" id="subjectname" name="subjectname" autocomplete="off" readonly placeholder="Click Here To Load The Subject" data-toggle="modal" data-target="#mySubjects">
                                                    <input type="hidden" class="form-control" id="subjectid" name="subjectid" autocomplete="off" readonly>
                                                    <span class="help-block" id="error"></span>
                                                    <input type="hidden" name="username" id="username" value="<?= $loguserid ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="Set Exam Duration">Set Exam Duration</label>
                                                    <input type="text" class="form-control" id="examduration" name="examduration" placeholder="Set Exam Duration" autocomplete="off" onkeypress="return numOnly(event);">
                                                    <span class="help-block" id="error"></span>
                                                </div>
                                            </div> 
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="No Of Questions">No Of Questions</label>
                                                    <div id="spinner4">
                                                        <div class="input-group">
                                                            <div class="spinner-buttons input-group-btn">
                                                                <button type="button" class="btn spinner-up btn-primary">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </div>
                                                            <input type="text" class="spinner-input form-control" maxlength="3" readonly id="noofquestions" name="noofquestions" >
                                                            <div class="spinner-buttons input-group-btn">
                                                                <button type="button" class="btn spinner-down btn-warning">
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2" style="padding-top: 23px">
                                                <button type="submit" class="btn btn-primary" id="setPaper" name="setPaper">Ok</button> 
                                                <div id="mySubjects" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Exist Subject</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-striped">
                                                                        <thead>
                                                                        <th scope="col">Subject Name</th>
                                                                        <th scope="col">Grade</th>
                                                                        <th scope="col">Term</th>
                                                                        <th scope="col">Language</th>
                                                                        <th scope="col">Status</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $result = $mat->tableSubjectExam();
                                                                            foreach ($result as $row) {
                                                                                $subjectRes = $mat->getSubjecSIngle($row['subject_name_id']);
                                                                                $classRes = $mat->SelectGradeNumberbyid($row['grade']);
                                                                                $term = '';
                                                                                if ($row['unit'] == 1) {
                                                                                    $term = 'First Term';
                                                                                } else if ($row['unit'] == 2) {
                                                                                    $term = 'Second Term';
                                                                                } else if ($row['unit'] == 3) {
                                                                                    $term = 'Third Term';
                                                                                }
                                                                                ?>
                                                                                <tr id="<?= $row['subject_id'] ?>" data-id="<?= $subjectRes['sub_name'] ?>" class='clickable' style="cursor: pointer;">
                                                                                    <td><?= $subjectRes['sub_name'] ?></td>
                                                                                    <td><?= $classRes['gradenumber'] . "-" . $classRes['gradesection'] ?></td>
                                                                                    <td><?= $term ?></td>
                                                                                    <td><?= $row['language'] ?></td>
                                                                                    <td><?= $row['status'] ?></td>
                                                                                </tr>
                                                                                <?php
                                                                            }
                                                                            ?>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <a href="javascript:void(0)" id="createnew" name="createnew">Create New</a>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Select Paper No To Load Exam Question!</h3>
                                </div> 
                                <form method="post" id="createExampap" role="form">
                                    <div class="box-body">
                                        <div class="row"> 
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="Paper No">Paper No</label>
                                                    <select name="paperno" id="paperno" class="form-control select2" style="width: 100%;">
                                                        <option value="">-- Select Type --</option>    
                                                        <?php
                                                        $resultPaper = $mat->fullPaperno();
                                                        foreach ($resultPaper as $row) {
                                                            ?>
                                                            <option value="<?= $row['paper_id'] ?>"><?= $row['exampaper_no'] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group" style="padding-top: 23px">
                                                    <button type="button" class="btn btn-primary" id="loadpaper" name="loadpaper">Ok</button>
                                                </div>
                                            </div>                             
                                        </div>
                                    </div> 
                                </form>
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
                    $(document).ready(function(){
            $('.select2').select2();
                    $('#spinner4').spinner({value:40, step: 5, min: 40, max: 60});
            });
                    function numOnly(e)
                    {
                    var k;
                            document.all ? k = e.keyCode : k = e.which;
                            return ((k > 47 && k < 58 || k == 46));
                    }
            $(document).on('click', '.clickable', function(){
            var id = $(this).attr('id');
                    var nameid = $(this).attr('data-id');
                    $('#subjectid').val(id);
                    $('#subjectname').val(nameid);
                    $('#mySubjects').modal('toggle');
            });
                    $(document).on('click', '#createnew', function(){
            $.confirm({
            title: 'Prompt!',
                    content: '' +
                    '<form action="" class="formName" id="saveConfirmSubjeects">' +
                    '<div class="form-group">' +
                    '<label>Grade</label>' +
                    '<select name="grade" id="grade" class="grade form-control select2" style="width: 100%;">' +
                    '<option value="">-- Select Subject --</option>' +
<?php
$resultgr = $mat->SelectallGradeNumber();
foreach ($resultgr as $row) {
    ?>
                '<option value="<?= $row['id'] ?>"><?= $row['gradenumber'] . "-" . $row['gradesection'] ?></option>' +
    <?php
}
?>
            '</select>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Subject Name</label>' +
                    '<select name="newsubject" id="newsubject" class="newsubject form-control select2" style="width: 100%;">' +
                    '<option value="">-- Select Subject --</option>' +
<?php
$result123 = $mat->AllClassSubjects();
foreach ($result123 as $row) {
    ?>
                '<option value="<?= $row['id'] ?>"><?= $row['sub_name'] ?></option>' +
    <?php
}
?>
            '</select>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Subject Name</label>' +
                    '<select name="term" id="term" class="term form-control select2" style="width: 100%;">' +
                    '<option value="">-- Select Term --</option>' +
                    '<option value="1">First Term</option>' +
                    '<option value="2">Second Term</option>' +
                    '<option value="3">Third Term</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Language</label>' +
                    '<select name="term" id="language" class="language form-control select2" style="width: 100%;">' +
                    '<option value="">-- Select Language --</option>' +
                    '<option value="English">English</option>' +
                    '<option value="Sinhala">Sinhala</option>' +
                    '<option value="Tamil">Tamil</option>' +
                    '</select>' +
                    '</div>' +
                    '</form>',
                    buttons: {
                    formSubmit: {
                    text: 'Save',
                            btnClass: 'btn-blue',
                            action: function () {

                            var grade = this.$content.find('.grade').val();
                                    if (!grade){
                            $.alert('Select A Grade');
                                    return false;
                            }

                            var newsubject = this.$content.find('.newsubject').val();
                                    if (!newsubject){
                            $.alert('Select A Subject');
                                    return false;
                            }

                            var term = this.$content.find('.term').val();
                                    if (!term){
                            $.alert('Select The Term');
                                    return false;
                            }

                            var language = this.$content.find('.language').val();
                                    if (!language){
                            $.alert('Select A Language');
                                    return false;
                            }

                            $.ajax({
                            url: "savetbl_SubjectExam",
                                    method: "POST",
                                    data:{grade:grade, newsubject:newsubject, term:term, language:language},
                                    success: function(jsonData)
                                    {
                                    if (jsonData == "ok")
                                    {
                                    location.reload();
                                    }
                                    else if (jsonData == "Dup")
                                    {
                                    $.alert('These Filled Data Already Exist With Paper Pending');
                                    }
                                    else
                                    {
                                    $.alert('Some Thing Went Wrong :(');
                                    }
                                    }
                            });
                            }
                    },
                            cancel: function () {
                            //close
                            },
                    },
                    onContentReady: function () {
                    // bind to events
                    var jc = this;
                            this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                            jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                    }
            });
            });
                    $(document).on('click', '#loadpaper', function(){
            var paperno = $('#paperno').val();
                    if (paperno != '')
            {
            $.ajax({
            url: "qbank",
                    method: "POST",
                    data:{paperno:paperno},
                    success:function(jsonData)
                    {
                    $('#loadQbank').html(jsonData);
                    }
            });
            }
            });

        </script>
    </body>
</html>