<?php
session_start();
if (!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$mat = new materialController;
$students = $_GET['studentid'];
$year = $_GET['year'];
$month = $_GET['month'];
$rowGrade = $mat->singStudentbyidj($students);

$monthname = array('choose month', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$monthOnlyMonthName = '';
for ($i = 0; $i < 14; $i++) {
    if ($month == $i)
        $monthOnlyMonthName = $monthname[$i];
}
?>
<html>
    <head>
        <title>School</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="/../public/css/bootstrap.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="shortcut icon" href="/../public/img/school.png">
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="/../public/js/jquery-confirm.min.js"></script>
        <link rel="stylesheet" href="/../public/css/admin.css">
        <link rel="stylesheet" href="/../public/css/_all-skins.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <script src="/../public/js/jquery.validate.min.js"></script>
        <script src="/../public/js/bootstrap.min.js"></script>
        <script src="/../public/js/admin.min.js"></script>
    </head>
    <body onload="doPrint();">
        <div class="box-header with-border">
            <h3 class="box-title">(<?= $monthOnlyMonthName ?>) Attendance Report of <?= $rowGrade['studentname'] . ' in ' . $rowGrade['gradename'] ?></h3>
        </div>
        <?php
        if ($students != '' && $month != '' && $year != '') {
            ?>
            <div >
                <div >
                    <table class="table table-bordered table-striped" id="allstudents" width="100%">
                        <thead>
                            <tr>
                                <td>Student Name</td>
                                <?php
                                $replica = $year . "-" . $month . "-01";
                                $countMonth = date("t", strtotime($replica));
                                for ($i = 1; $i <= $countMonth; $i++) {
                                    $realName = date("D", strtotime($year . "-" . $month . "-" . $i));
                                    ?>
                                    <td><?= $i ?><br><?= $realName ?></td>
                                    <?php
                                }
                                ?>
                                <td style="background-color:#43A047;">P</td>
                                <td style="background-color:#E53935;">A</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $mat->GetAttendanceStudentid($students, $month, $year);
                            $x = 1;
                            foreach ($result as $row) {
                                $rowStudent = $mat->SelectStudentbyid($row['studentid']);
                                ?>
                                <tr>
                                    <td><?= $rowStudent['studentname'] ?></td>
                                    <?php
                                    $present = 0;
                                    $absent = 0;
                                    for ($i = 1; $i <= $countMonth; $i++) {
                                        $day = "";
                                        if ($i < 10) {
                                            $day = "0" . $i;
                                        } else {
                                            $day = $i;
                                        }
                                        $studentid = $row['studentid'];
                                        $fullDate = $year . "-" . $month . "-" . $day;
                                        $resultSpec = $mat->GetAttendanceStudentSingle($row['grade'], $fullDate, $studentid);
                                        $countAttendance = $mat->CountStudentAttendance($row['grade'], $fullDate, $studentid);
                                        $status = "";
                                        $color = "";
                                        if ($resultSpec['attendance'] == 'present') {
                                            $status = '|';
                                            $color = "#15f038";
                                            $present += 1;
                                        } else if ($countAttendance == 0) {
                                            $status = 'X';
                                            $color = "#151ef0";
                                        } else if ($resultSpec['attendance'] == 'absent') {
                                            $status = 'O';
                                            $color = "#f70000";
                                            $absent += 1;
                                        }
                                        ?>
                                        <td><span style="color: <?= $color ?>"><?= $status ?></span></td>
                                        <?php
                                    }
                                    ?>
                                    <td><?= $present ?></td>
                                    <td><?= $absent ?></td>
                                </tr>
                                <?php
                                $x++;
                            }
                            ?>
                            <tr>
                                <td  style="background-color:#43A047;">Total P</td>
                                <?php
                                for ($y = 1; $y <= $countMonth; $y++) {
                                    $presentTotal = 0;
                                    $day = "";
                                    if ($y < 10) {
                                        $day = "0" . $y;
                                    } else {
                                        $day = $y;
                                    }
                                    $fullDate = $year . "-" . $month . "-" . $day;
                                    $resultColumn = $mat->GetAttendanceColumnStudentid($students, $fullDate);
                                    foreach ($resultColumn as $rowColumn) {
                                        if ($rowColumn['attendance'] == 'present') {
                                            $presentTotal += 1;
                                        } else {
                                            $presentTotal += 0;
                                        }
                                    }
                                    ?>
                                    <td><?= $presentTotal ?></td>
                                    <?php
                                }
                                ?>
                                <td colspan="2"></td>
                            </tr>
                            <tr>                    
                                <td style="background-color:#E53935;">Total A</td>
                                <?php
                                for ($y = 1; $y <= $countMonth; $y++) {
                                    $absentTotal = 0;
                                    $day = "";
                                    if ($y < 10) {
                                        $day = "0" . $y;
                                    } else {
                                        $day = $y;
                                    }
                                    $fullDate = $year . "-" . $month . "-" . $day;
                                    $resultColumn = $mat->GetAttendanceColumnStudentid($students, $fullDate);
                                    foreach ($resultColumn as $rowColumn) {
                                        if ($rowColumn['attendance'] == 'absent') {
                                            $absentTotal += 1;
                                        } else {
                                            $absentTotal += 0;
                                        }
                                    }
                                    ?>
                                    <td><?= $absentTotal ?></td>
                                    <?php
                                }
                                ?>
                                <td colspan="2"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>    
            </div>
            <?php
        } else {
            echo "<center><b></i>Select All Fields</i></b></center>";
        }
        ?>
        <script>
            function doPrint() {
                window.print();
            }
            function getBack() {
                document.location.href = "check_children";
            }
        </script>
        <button class="btn btn-warning" id="gotback" onclick="getBack()">Back</button>
    </body>
</html>