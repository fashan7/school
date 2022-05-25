<?php
$mat = new materialController;
$gradenumberlist = $_POST['gradenumberlist'];
$year = $_POST['year'];
$month = $_POST['month'];
$rowGrade = $mat->SelectGradeNumberbyid($gradenumberlist);

$monthname = array('choose month', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$monthOnlyMonthName = '';
for ($i = 0; $i < 14; $i++) {
    if ($month == $i)
        $monthOnlyMonthName = $monthname[$i];
}
?>
<div class="box-header with-border">
    <h3 class="box-title">Attendance Report of <?= $rowGrade['gradenumber'] . "-" . $rowGrade['gradesection'] ?> - <?= $monthOnlyMonthName ?> </h3>
</div>
<?php
if ($gradenumberlist != '' && $month != '' && $year != '') {
    ?>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="allstudents">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Student Name</td>
                        <td>Student Code</td>
                        <?php
                        $replica = $year . "-" . $month . "-01";
                        $realName = date("D", strtotime($replica));
                        $countMonth = date("t", strtotime($replica));
                        for ($i = 1; $i <= $countMonth; $i++) {
                            $realName = date("D", strtotime($year . "-" . $month . "-" . $i));
                            ?>
                            <td><?= $i ?><br><?= $realName ?></td>
                            <?php
                        }
                        ?>
                        <td style="background-color:#43A047;color:white">Total Present</td>
                        <td style="background-color:#E53935;color:white">Total Absent</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $mat->GetAttendanceStudent($gradenumberlist, $month, $year);
                    $x = 1;
                    foreach ($result as $row) {
                        $rowStudent = $mat->SelectStudentbyid($row['studentid']);
                        ?>
                        <tr>
                            <td><?= $x ?></td>
                            <td><?= $rowStudent['studentname'] ?></td>
                            <td><?= $rowStudent['studentcode'] ?></td>
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
                                $resultSpec = $mat->GetAttendanceStudentSingle($gradenumberlist, $fullDate, $studentid);
                                $countAttendance = $mat->CountStudentAttendance($gradenumberlist, $fullDate, $studentid);
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
                        <td colspan="3" style="background-color:#43A047;color:white">Total Present</td>
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
                            $resultColumn = $mat->GetAttendanceColumnStudent($gradenumberlist, $fullDate);
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
                        <td colspan="3" style="background-color:#E53935;color:white">Total Absent</td>
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
                            $resultColumn = $mat->GetAttendanceColumnStudent($gradenumberlist, $fullDate);
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
    <div class="box-body">
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <div class="form-group">
                        <a href="printStudentAttendance?grade=<?= $gradenumberlist ?>&month=<?= $month ?>&year=<?= $year ?>" target="_blank" class="btn btn-block btn-primary btn-flat">Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    echo "<center><b></i>Select All Fields</i></b></center>";
}
?>