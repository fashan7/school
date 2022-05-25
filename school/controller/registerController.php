<?php
session_start();

class registerController {

    public function eventRegisteronDashboard() {
        $id = '';
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $userid = $_SESSION['loguserid'];
        $status = 'yes';


        $table = 'school_events';
        $obj = new commonSql;
        $obj->insertion($table, compact('id', 'title', 'start', 'end', 'userid', 'status'));
    }

    public function eventUpdateonDashboard() {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $userid = $_SESSION['loguserid'];
        $status = 'yes';

        $table = 'school_events';
        $obj = new commonSql;

        $collect = "id = '$id', title = '$title', start_event = '$start', end_event = '$end', loguserid = '$userid', status = '$status' WHERE id = '$id'";
        $arr = array();
        $arr[0] = $collect;
        $obj->updation($table, $arr);
    }

    public function eventDeleteonDashboard() {
        $id = $_POST['id'];
        $table = "school_events WHERE id = '$id'";
        $obj = new commonSql;
        $obj->deletion($table);
    }

    public function staffregistersubmit() {
        $obj = new commonSql;

        $fullname = $_POST['fullname'];
        $code = $_POST['code'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $phone1 = $_POST['phone1'];
        $phone2 = $_POST['phone2'];
        $email = $_POST['email'];
        $olnums = $_POST['olnums'];
        $dob = $_POST['day'] . "/" . $_POST['month'] . "/" . $_POST['year'];
        $alnums = $_POST['alnums'];
        $schoolname = $_POST['schoolname'];
        $designation = $_POST['designation'];
        $workperiod = $_POST['workperiod1'] . "/" . $_POST['workperiod2'] . "/" . $_POST['workperiod3'];
        $attachmentpic = ''; //$_POST['attachmentpic']
        if (isset($_POST['olcheck']) == "on") {
            $olcheck = 'yes';
        } else {
            $olcheck = 'no';
        }

        if (isset($_POST['alcheck']) == "on") {
            $alcheck = 'yes';
        } else {
            $alcheck = 'no';
        }

        if (isset($_POST['workcheck']) == "on") {
            $workcheck = 'yes';
        } else {
            $workcheck = 'no';
        }

        $staffid = "id";
        $staffactive = "yes";
        $datepicker = $_POST['datepicker'];
        $department = $_POST['department'];

        $table = "staff_reg";

        date_default_timezone_set('Asia/Colombo');
        $time = date('H:i:s:A');

        if ($obj->insertion($table, compact('code', 'fullname', 'address', 'gender', 'dob', 'phone1', 'phone2', 'email', 'olcheck', 'alcheck', 'workcheck', 'schoolname', 'designation', 'workperiod', 'attachmentpic', 'staffactive', 'staffid', 'datepicker', 'department')) == 1) {
            $dataA = array(
                "id" => '',
                "nic" => '',
                'first_name' => $fullname,
                'last_name' => '',
                'address' => $address,
                'mobile' => $phone1,
                'username' => $code,
                'password' => base64_encode($code),
                'birthday' => $dob,
                'usertype' => '4',
                'email' => $email,
                'status' => 'yes',
                'time' => $time,
                'gender' => $gender,
                'branchname' => '1'
            );
            $obj->insertion("user_reg", $dataA);
            echo "ok";
        } else {
            echo "notok";
        }

        $staffolid = "id";
        $staffolactive = "active";
        $staffoltable = "olevelofstaff";

        if ($olcheck == 'yes') {
            for ($i = 1; $i <= $olnums; $i++) {
                $olresult = $_POST['olresult' . $i];
                $olSubject = $_POST['olSubject' . $i];
                $obj->insertion($staffoltable, compact('code', 'olresult', 'olSubject', 'staffolactive', 'staffolid'));
            }
        }


        $staffalid = "id";
        $staffalactive = "active";
        $staffaltable = "alevelofstaff";

        if ($alcheck == 'yes') {
            for ($i = 1; $i <= $alnums; $i++) {
                $alresult = $_POST['alresult' . $i];
                $alSubject = $_POST['alSubject' . $i];
                $obj->insertion($staffaltable, compact('code', 'alresult', 'alSubject', 'staffalactive', 'staffalid'));
            }
        }
    }

    public function UserRegisterSubmit() {
        date_default_timezone_set('Asia/Colombo');
        $time = date('H:i:s:A');

        $obj = new commonSql;
        "id, username, nic, first_name, last_name, address, mobile, password, birthday, usertype, email, status, reg_time";
        $id = "";
        $nic = $_POST['nic'];
        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $address = $_POST['address'];
        $mobile = $_POST['mobile'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $usertype = $_POST['usertype'];
        $email = $_POST['email'];
        $status = 'yes';
        $password = base64_encode($password);
        $birthday = $_POST['day'] . "/" . $_POST['month'] . "/" . $_POST['year'];
        $gender = $_POST['gender'];
        $branchname = $_POST['branchname'];
        $fullname = $first_name . " " . $last_name;

        $table = "user_reg";

        $tableportal = "portal_users";
        $obj->insertion($tableportal, compact('id', 'fullname', 'username', 'password', 'gender', 'birthday', 'mobile', 'email', 'usertype', 'status'));

        if ($obj->insertion($table, compact('id', 'nic', 'first_name', 'last_name', 'address', 'mobile', 'username', 'password', 'birthday', 'usertype', 'email', 'status', 'time', 'gender', 'branchname')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function usertypeRegister() {
        $id = '';
        $usertype = $_POST['usertype'];
        $active = "yes";
        $obj = new commonSql;
        $table = "user_type";

        if ($obj->insertion($table, compact('id', 'usertype', 'active')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function AddNewPrivilagePage($user, $id, $sign) {
        $obj = new commonSql;
        $table = "user_priviledge";

        return $obj->insertion($table, compact('user', 'id', 'sign', ''));
    }

    public function noRecordInPrivilagePage($user, $pageid) {
        $sign = 'no';
        $id = 'id';
        $obj = new commonSql;
        $table = "user_priviledge";

        return $obj->insertion($table, compact('user', 'pageid', 'sign', 'id'));
    }

    public function selectNewPagePrivilage($user, $newId) {
        $sign = 'no';
        $id = 'id';
        $obj = new commonSql;
        $table = "user_priviledge";

        return $obj->insertion($table, compact('user', '$newId', 'sign', 'id'));
    }

    public function ClassRegister() {
        $gradenumber = $_POST['gradenumber'];
        $gradesection = $_POST['gradesection'];
        $id = "";
        $obj = new commonSql;
        $table = "class_register";

        if ($obj->insertion($table, compact('gradenumber', 'gradesection', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function subjectRegister() {
        $newSubject = $_POST['newSubject'];
        $color = $_POST['currColor'];
        $id = "";
        $subjectid = substr($newSubject, 0, 2);
        $obj = new commonSql;
        $table = "class_subject";

        if ($obj->insertion($table, compact('subjectid', 'newSubject', 'color', "id")) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function TimetableRegister() {
        $term = $_POST['term'];
        $year = $_POST['year'];
        $timetableno = $_POST['timetableno'];
        $classname = '';
        $id = '';
        $grade = $_POST['classno'];
        $table = "school_timetable";
        $obj = new commonSql;
        $mat = new materialController;



        $result = $mat->SelectGradeNumberbyid($grade);
        $classname = $result['gradenumber'] . " " . $result['gradesection'];

        $p = @$_POST['p'];
        list($sub_id, $tbl1, $row1, $col1, $tbl0, $row0, $col0) = explode('_', $p);
        $sub_id = substr($sub_id, 0, 2);
        if ($tbl0 == 0) {
            $obj->insertion($table, compact('id', 'sub_id', 'row1', 'col1', 'classname', 'term', 'year', 'timetableno', 'grade'));
        } else {

            $collect = "tbl_row = '$row1', tbl_col = '$col1' WHERE sub_id = '$sub_id' and tbl_row = '$row0' and tbl_col = '$col0'";
            $arr = array();
            $arr[0] = $collect;
            $obj->updation($table, $arr);
        }

        $dataa = $_POST['dataa'];
        $firstperiod = $dataa[0];
        $oneperioddur = $dataa[1];
        $periodInterval = $dataa[2];
        $intervalduration = $dataa[3];
        $noofperiod = $dataa[4];

        $res = $mat->CountMaxWeektimesubject($timetableno);
        if ($res < 1) {
            $table12 = 'school_timetable_child';
            $obj->insertion($table12, compact('timetableno', 'firstperiod', 'oneperioddur', 'intervalduration', 'periodInterval', 'noofperiod', "id"));
        }
    }

    public function SaveTimePeriod() {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $timeperiod = $_POST['time1'] . " - " . $_POST['time2'];
        $color = $_POST['currColor'];
        $active = "yes";
        $id = '';
        $obj = new commonSql;
        $table = "exam_time";
        $subid = substr($randomString, 0, 2);

        if ($obj->insertion($table, compact('timeperiod', 'subid', 'color', 'active', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function ExamTimetableRegister() {
        $term = $_POST['term'];
        $year = $_POST['year'];
        $classname = '';
        $id = '';
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $fullrange = $fromDate . " To " . $toDate;
        $table = "school_exam";
        $obj = new commonSql;

        $field1 = "gradenumber, gradesection";
        $table1 = "class_register WHERE id = '{$_POST['classno']}'";

        $grade = $_POST['classno'];
        $tableid = '1';

        $result = $obj->displaySum($field1, $table1);
        foreach ($result as $rows) {
            $classname = $rows['gradenumber'] . " " . $rows['gradesection'];
        }

        $p = @$_POST['p'];

        list($sub_id, $tbl1, $row1, $col1, $tbl0, $row0, $col0) = explode('_', $p);
//         echo $sub_id;
        $sub_id = substr($sub_id, 0, 2);
        if ($tbl0 == 0 || $tbl0 == 1) {
            echo $obj->insertion($table, compact('id', 'sub_id', 'row1', 'col1', 'classname', 'term', 'year', 'fullrange', 'tableid', 'grade'));
        } else {

            $collect = "tbl_row = '$row1', tbl_col = '$col1' WHERE sub_id = '$sub_id' and tbl_row = '$row0' and tbl_col = '$col0'";
            $arr = array();
            $arr[0] = $collect;
            $obj->updation($table, $arr);
        }
    }

//    public function saveStaffAttendance()
//    {
//        $count = $_POST['count'];
//        for($i = 0; $i < $count; $i++)
//        {
//            echo $_POST['hiddenaction'.$i];
//        }
//    }

    public function studentregistersubmit() {
        $obj = new commonSql;

        date_default_timezone_set('Asia/Colombo');
        $date = date('m-d-Y');

        $id = '';
        $studentname = $_POST['studentname'];
        $studentcode = "STU786" . $_POST['studentcode'];
        $rollno = $_POST['rollno'];
        $studentaddress = $_POST['studentaddress'];
        $studentgender = $_POST['studentgender'];
        $schoolname = $_POST['schoolname'];
        $grade = $_POST['grade'];
        $parentname = $_POST['parentname'];
        $parentaddress = $_POST['parentaddress'];
        $phone1 = $_POST['phone1'];
        $phone2 = $_POST['phone2'];
        $email = $_POST['email'];
        $dob = $_POST['day'] . "/" . $_POST['month'] . "/" . $_POST['year'];
        $joined = $_POST['joindday'] . "/" . $_POST['joindmonth'] . "/" . $_POST['joindyear'];
        $left = $_POST['leftday'] . "/" . $_POST['leftmonth'] . "/" . $_POST['leftyear'];
        $active = "yes";
        $cgrade = $_POST['classno'];
        $datepicker = $_POST['datepicker'];
        $bloodgrp = $_POST['bloodgrp'];
        $nationality = $_POST['nationality'];
        $studentemail = $_POST['studentemail'];

        $portmobile = '';
        $portemail = '';
        $portusertype = '2';
        $duplicatepassword = $studentcode;
        $duplicatepassword = base64_encode($duplicatepassword);

        date_default_timezone_set('Asia/Colombo');
        $time = date('H:i:s:A');

        $table = "studentreg";
        $tableportal = "portal_users";
        $obj->insertion($tableportal, compact('id', 'studentname', 'studentcode', 'duplicatepassword', 'studentgender', 'dob', 'portmobile', 'portemail', 'portusertype', 'active'));

        if ($obj->insertion($table, compact('id', 'studentname', 'studentcode', 'rollno', 'studentaddress', 'studentgender', 'dob', 'parentname', 'parentaddress', 'phone1', 'phone2', 'email', 'schoolname', 'grade', 'joined', 'left', 'date', 'active', 'cgrade', 'datepicker', 'bloodgrp', 'nationality', 'studentemail')) == 1) {
            $dataA = array(
                "id" => '',
                "nic" => '',
                'first_name' => $studentname,
                'last_name' => '',
                'address' => $parentaddress,
                'mobile' => $phone1,
                'username' => $studentcode,
                'password' => base64_encode($studentcode),
                'birthday' => $dob,
                'usertype' => '6',
                'email' => $email,
                'status' => 'yes',
                'time' => $time,
                'gender' => $studentgender,
                'branchname' => '1'
            );
            $obj->insertion("user_reg", $dataA);
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function registerNotes() {
        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d');

        $logusrnme = $_POST['logusrnme'];
        $value = $_POST['value'];
        $status = 'yes';
        $id = '';

        $obj = new commonSql;
        $table = "short_notes";

        if ($obj->insertion($table, compact('date', 'value', 'status', 'logusrnme', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function StudentFeesProcess() {
        $mat = new materialController;

        $rowmaxreciptId = $mat->getMaxStudentInvoice();
        if ($rowmaxreciptId == '0') {
            $reciptId = '0001';
        } else {
            $incrementorder = $rowmaxreciptId + 1;
            $reciptId = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
        }

        $monthname = array('choose month', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $monthOnly = $_POST['monthOnly'];
        $monthOnlyMonth = substr($monthOnly, 0, 2);
        $monthOnlyYear = substr($monthOnly, 3, 7);

        $monthOnlyMonthName = '';
        for ($i = 0; $i < 14; $i++) {
            if ($monthOnlyMonth == $i)
                $monthOnlyMonthName = $monthname[$i];
        }
        $studentid = $_POST['stuid'];
        $studentname = $_POST['studentname'];
        $studentcode = $_POST['studentcode'];
        $datepicker = $_POST['datepicker'];
        $noofmonths = $_POST['noofmonths'];
        $permonthamount = $_POST['permonthamount'];
        $totalamount = $_POST['totalamount'];
        $payingamount = $_POST['payingamount'];
        $balanceamount = $_POST['balanceamount'];
        $paystatus = '';
        $status = 'yes';
        $id = '';


        if ($balanceamount > 0 || $balanceamount < 0)
            $paystatus = 'open';
        else
            $paystatus = 'close';

        $table = "student_fees";
        $obj = new commonSql;

        if ($obj->insertion($table, compact('reciptId', 'studentid', 'studentname', 'studentcode', 'monthOnly', 'monthOnlyMonthName', 'monthOnlyYear', 'datepicker', 'noofmonths', 'permonthamount', 'totalamount', 'payingamount', 'balanceamount', 'paystatus', 'status', 'id')) == 1) {
            echo $reciptId;
        } else {
            echo "notok";
        }
    }

    public function salaryProcess() {
        $mat = new materialController;

        $rowmaxreciptId = $mat->getMaxStaffSalaryRecipt();
        if ($rowmaxreciptId == '0') {
            $reciptId = '0001';
        } else {
            $incrementorder = $rowmaxreciptId + 1;
            $reciptId = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
        }

        $monthname = array('choose month', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $monthOnly = $_POST['monthOnly'];
        $monthOnlyMonth = substr($monthOnly, 0, 2);
        $monthOnlyYear = substr($monthOnly, 3, 7);

        $monthOnlyMonthName = '';
        for ($i = 0; $i < 14; $i++) {
            if ($monthOnlyMonth == $i)
                $monthOnlyMonthName = $monthname[$i];
        }

        $staffid = $_POST['staffid'];
        $staffcode = $_POST['staffcode'];
        $staffname = $_POST['staffname'];
        $monthOnly = $_POST['monthOnly'];
        $datepicker = $_POST['datepicker'];
        $salaryamount = $_POST['salaryamount'];
        $paidstatus = 'paid';
        $status = 'yes';
        $id = '';

        $table = "staff_salary";
        $obj = new commonSql;

        if ($obj->insertion($table, compact('reciptId', 'staffid', 'staffname', 'staffcode', 'monthOnly', 'monthOnlyMonthName', 'monthOnlyYear', 'datepicker', 'salaryamount', 'paidstatus', 'status', 'id')) == 1) {
            echo $reciptId;
        } else {
            echo "notok";
        }
    }

    public function DepartmentRegister() {
        $id = '';
        $depname = $_POST['depname'];
        $active = "yes";
        $obj = new commonSql;
        $table = "staff_department";

        if ($obj->insertion($table, compact('depname', 'active', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function bankRegister() {
        $id = '';
        $bankname = $_POST['bankname'];
        $active = "yes";
        $obj = new commonSql;
        $table = "banks";

        if ($obj->insertion($table, compact('bankname', 'active', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function EmployeeBankRegister() {
        $id = '';
        $banknameload = $_POST['banknameload'];
        $staffno = $_POST['staffno'];
        $branchname = $_POST['branchname'];
        $accountno = $_POST['accountno'];
        $bAddress = $_POST['bAddress'];
        $active = "yes";
        $obj = new commonSql;
        $table = "employeebank";

        if ($obj->insertion($table, compact('banknameload', 'staffno', 'branchname', 'accountno', 'bAddress', 'active', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function AttendanceMarking() {
        $obj = new commonSql;

        $i = $_POST['lasti'];
        $department = $_POST['department'];
        $datepicker = $_POST['datepicker'];
        $month = date("m", strtotime($datepicker));
        $day = date("d", strtotime($datepicker));
        $year = date("Y", strtotime($datepicker));
        $bool = '';
        for ($x = 1; $x < $i; $x++) {
            $staffname = $_POST['staffname' . $x];
            $staffcode = $_POST['staffcode' . $x];
            $staffid = $_POST['staffid' . $x];
            $remarks = $_POST['remarks' . $x];
            $status = 'yes';
            $id = '';
            $attendance = '';
            if (isset($_POST['presAbs' . $x])) {
                $attendance = 'present';
            } else {
                $attendance = 'absent';
            }

            $fields = "COUNT(id)";
            $table1 = "staffattendance WHERE staffid = '$staffid' AND date = '$datepicker'";
            $result = $obj->displayCount($fields, $table1);

            if ($result < 1) {
                $table = "staffattendance";
                if ($obj->insertion($table, compact('id', 'staffcode', 'staffname', 'staffid', 'datepicker', 'day', 'month', 'year', 'attendance', 'remarks', 'status', 'department')) == 1)
                    $bool = "ok";
                else
                    $bool = "notok";
            }
            else {
                $bool = "oops";
            }
        }
        echo $bool;
    }

    public function LeaveCategoryRegister() {
        $id = '';
        $leaveCat = $_POST['leaveCat'];
        $active = "yes";
        $obj = new commonSql;
        $table = "leave_category";

        if ($obj->insertion($table, compact('leaveCat', 'active', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function LeaveDetailsRegister() {
        $mat = new materialController;

        $leaveCategory = $_POST['leaveCategory'];

        $result = $mat->SelectCategory($leaveCategory);
        $categoryname = $result['name'];
        $id = '';
        $department = $_POST['department'];
        $leavecount = $_POST['leavecount'];
        $active = "yes";
        $obj = new commonSql;
        $table = "leave_detail_category";

        if ($obj->insertion($table, compact('leaveCategory', 'categoryname', 'department', 'leavecount', 'active', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function LeaveApplicationRegister() {
        $mat = new materialController;
        $obj = new commonSql;
        $table = 'leave_application';
        $leaveCategory = $_POST['leaveCategory'];
        $staffmem = $_POST['staffmem'];
        $department = $_POST['department'];
        $fromdate = $_POST['fromdate'];
        $todate = $_POST['todate'];
        $status = 'Open';
        $reason = $_POST['reason'];
        $active = "yes";
        $id = '';

        $date1_ts = strtotime($fromdate);
        $date2_ts = strtotime($todate);
        $diff = $date2_ts - $date1_ts;
        $countdays = round($diff / 86400);
        $countdays = ++$countdays;


        $resultStaff = $mat->SelectStaffbyid($staffmem);
        $resultSubCatel = $mat->getLeavesCate($leaveCategory, $department);
        $leavecount = $resultSubCatel["leave_count"];
        $category = $resultSubCatel["category"];

        $joiningDate = $resultStaff['joiningdate'];
        $monthday = substr($joiningDate, 5);
        date_default_timezone_set('Asia/Colombo');
        $year = date('Y');
        $effectiveDate = date('Y', strtotime("+1 Year", strtotime($year)));
        $date = $effectiveDate . "-" . $monthday;

        $Result = $mat->leaveCheckRemainingxbyDate($leaveCategory, $staffmem, $date);
        $count = COUNT($Result);

        $resultSingle = $mat->leaveCheckRemainingxbyDateSingle($leaveCategory, $staffmem, $date);
        $table1 = 'leave_application_child';
        $status1 = 'Awaiting Approval';

        if ($count > 0) {
            if ($countdays > $resultSingle['remaining_leave']) {
                echo "oops";
            } else {
                $parentID = $resultSingle['id'];
                if ($resultSingle['remaining_leave'] > 0) {
                    if ($obj->insertion($table1, compact('parentID', 'fromdate', 'todate', 'countdays', 'reason', 'status1', 'active', 'id')) == 1)
                        echo "ok";
                    else
                        echo "notok";

                    $remainingLeaves = $resultSingle['remaining_leave'] - $countdays;
                    $collect = "remaining_leave = '$remainingLeaves' WHERE id = '$parentID'";
                    $arr = array();
                    $arr[0] = $collect;
                    $obj->updation($table, $arr);

                    if ($remainingLeaves == 0) {
                        $updstatus = 'Close';
                        $collect1 = "status = '$updstatus' WHERE id = '$parentID'";
                        $arr1 = array();
                        $arr1[0] = $collect1;
                        $obj->updation($table, $arr1);
                    }
                } else {
                    $updstatus = 'Close';
                    $collect = "status = '$updstatus' WHERE id = '$parentID'";
                    $arr = array();
                    $arr[0] = $collect;
                    $obj->updation($table, $arr);
                }
            }
        } else {
            $remainingLeaves = $leavecount - $countdays;
            if ($countdays > $leavecount) {
                echo "oops";
            } else {
                $lastid = $obj->insertionLastID($table, compact('leaveCategory', 'department', 'staffmem', 'date', 'status', 'active', 'id', 'remainingLeaves'));
                if ($obj->insertion($table1, compact('lastid', 'fromdate', 'todate', 'countdays', 'reason', 'status1', 'active', 'id')) == 1)
                    echo "ok";
                else
                    echo "notok";
            }
        }
    }

    public function bookCategoryRegister() {
        $id = '';
        $categoryname = $_POST['categoryname'];
        $sectioncode = $_POST['sectioncode'];
        $active = "yes";
        $obj = new commonSql;
        $table = "book_category";

        if ($obj->insertion($table, compact('categoryname', 'sectioncode', 'active', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function AddBooksRegister() {
        $purchasedate = $_POST['purchasedate'];
        $billno = $_POST['billno'];
        $isbnno = $_POST['isbnno'];
        $bookno = $_POST['bookno'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $edition = $_POST['edition'];
        $bookcategory = $_POST['bookcategory'];
        $publisher = $_POST['publisher'];
        $noofcopies = $_POST['noofcopies'];
        $shelfno = $_POST['shelfno'];
        $bookposition = $_POST['bookposition'];
        $bookcost = $_POST['bookcost'];
        $language = $_POST['language'];
        $bookconition = $_POST['bookconition'];
        $status = 'yes';
        $id = '';

        $obj = new commonSql;
        $table = "librarybooks";
        $bool = "";

        $lastid = $obj->insertionLastID($table, compact('purchasedate', 'billno', 'isbnno', 'bookno', 'title', 'author', 'edition', 'bookcategory', 'publisher', 'noofcopies', 'shelfno', 'bookposition', 'bookcost', 'language', 'bookconition', 'status', 'id'));

        for ($i = 1; $i <= $noofcopies; $i++) {
            $booknoInc = $bookno . "" . $i;
            $bookstatus = 'Available';
            $table1 = 'librarybooks_child';
            if ($obj->insertion($table1, compact('lastid', 'booknoInc', 'isbnno', 'bookstatus', 'title', 'publisher', 'author', 'status', 'id')) == 1)
                $bool = "ok";
            else
                $bool = "notok";
        }
        echo $bool;
    }

    public function issueBookRegister() {
        $upd = new updateController;
        $obj = new commonSql;

        $searchby = $_POST['searchby'];
        $childTbID = $_POST['childTbID'];
        $usertype = $_POST['usertype'];
        $bookissuedate = $_POST['bookissuedate'];
        $duedate = $_POST['duedate'];
        $fine = 0;
        $status = 'issued';
        $returndate = '';
        $active = 'yes';
        $id = '';
        $remark = '';
        $table = 'issue_books';
        if ($usertype == 'student') {
            $SearchStudent = $_POST['SearchStudent'];
            $studentid = $_POST['studentid'];
            $upd->UpdatebookStatus($childTbID);
            if ($obj->insertion($table, compact('childTbID', 'searchby', 'usertype', 'studentid', 'bookissuedate', 'duedate', 'fine', 'status', 'returndate', 'active', 'id', 'remark')) == 1)
                echo "ok";
            else
                echo "notok";
        }
        else if ($usertype == 'employee') {
            $Searchemployee = $_POST['Searchemployee'];
            $staffid = $_POST['staffid'];
            $upd->UpdatebookStatus($childTbID);
            if ($obj->insertion($table, compact('childTbID', 'searchby', 'usertype', 'staffid', 'bookissuedate', 'duedate', 'fine', 'status', 'returndate', 'active', 'id', 'remark')) == 1)
                echo "ok";
            else
                echo "notok";
        }
    }

    public function hosteltypeRegister() {
        $id = '';
        $hosteltype = $_POST['hosteltype'];
        $active = "yes";
        $obj = new commonSql;
        $table = "hostel_type";

        if ($obj->insertion($table, compact('hosteltype', 'active', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function hostelRegister() {
        $id = '';
        $hosteltype = $_POST['hosteltype'];
        $hostelname = $_POST['hostelname'];
        $hosteladdr = $_POST['hosteladdr'];
        $hostelpno = $_POST['hostelpno'];
        $wardenname = $_POST['wardenname'];
        $wardenaddr = $_POST['wardenaddr'];
        $wardenpno = $_POST['wardenpno'];
        $active = "yes";
        $obj = new commonSql;
        $table = "hostels_details";

        if ($obj->insertion($table, compact('hosteltype', 'hostelname', 'hosteladdr', 'hostelpno', 'wardenname', 'wardenaddr', 'wardenpno', 'active', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function HostelRoomsRegister() {
        $obj = new commonSql;
        $hosteltype = $_POST['hosteltype'];
        $hostelname = $_POST['hostelname'];
        $floorname = $_POST['floorname'];
        $RoomNo1 = $_POST['RoomNo1'];
        $NoofBed1 = $_POST['NoofBed1'];
        $RentAmount1 = $_POST['RentAmount1'];
        $feetype = $_POST['feetype'];
        $countRooms = $_POST['countRooms'];
        $status = 'Available';
        $active = 'yes';
        $id = '';
        $accpedbed = 0;
        $allctedbed = 0;
        $lastinsertid = "";
        $bool = "";
        for ($i = 1; $i <= $countRooms; $i++) {
            $roomno = $_POST['RoomNo' . $i];
            $noofbeds = $_POST['NoofBed' . $i];
            $amount = $_POST['RentAmount' . $i];
            $availablebds = $noofbeds;
            $table = 'hostel_rooms';
            $insertid = $obj->insertionLastID($table, compact('hosteltype', 'hostelname', 'floorname', 'roomno', 'noofbeds', 'amount', 'feetype', 'status', 'active', 'id', 'availablebds', 'accpedbed', 'allctedbed'));
            $lastinsertid = $insertid;

            $increment = 0;
            if ($feetype == 'Annual') {
                $increment = 1;
            } else if ($feetype == 'Bi-Annual') {
                $increment = 2;
            } else if ($feetype == 'Tri-Annual') {
                $increment = 3;
            } else if ($feetype == 'Quaterly') {
                $increment = 4;
            } else if ($feetype == 'Monthly') {
                $increment = 12;
            }

            for ($y = 1; $y <= $increment; $y++) {
                $table1 = 'hostel_fees';
                $startdate = $_POST['startdate' . $y];
                $duedate = $_POST['duedate' . $y];
                $enddate = $_POST['enddate' . $y];
                if ($obj->insertion($table1, compact('lastinsertid', 'startdate', 'duedate', 'enddate', 'active', 'id')) == 1) {
                    $bool = "ok";
                } else {
                    $bool = "notok";
                }
            }
        }
        echo $bool;
    }

    public function HostelMemberRegister() {
        $obj = new commonSql;
        $mat = new materialController;
        $val = new validationController;

        $usertype = $_POST['usertype'];
        $hosteltype = $_POST['hosteltype'];
        $hostelname = $_POST['hostelname'];
        $hostelroomID = $_POST['hostelroomID'];
        $hostelregDate = $_POST['hostelregDate'];
        $vacatingDate = $_POST['vacatingDate'];
        $status = 'rent';
        $active = 'yes';
        $id = '';



        $resultRooms = $mat->hostelRoomsDetails($hostelroomID); //getting details 
        $availablebeds = $resultRooms['available_beds'];
        $remainingbeds = $availablebeds - 1;
        $tranferbeds = $resultRooms['allocated_bed'] + 1;
        $hostelsRoomtblid = $resultRooms['id'];

        $statusAvailble = '';
        if ($remainingbeds == 0) {
            $statusAvailble = 'Closed';
        } else {
            $statusAvailble = 'Available';
        }

        $table = 'hostelmem_reg';
        if ($remainingbeds >= 0) {
            $collect = "available_beds = '$remainingbeds', allocated_bed = '$tranferbeds', status = '$statusAvailble' WHERE id = '$hostelsRoomtblid'";
            $arr = array();
            $arr[0] = $collect;
            $table1 = 'hostel_rooms'; //update beds

            if ($usertype == 'student') {
                $SearchStudent = $_POST['SearchStudent'];
                $studentid = $_POST['studentid'];
                $counting = $val->hostelRoomsCountUsers1($studentid, $usertype);
                if ($counting > 0) {
                    echo "oops";
                } else {
                    if ($obj->insertion($table, compact('usertype', 'studentid', 'hosteltype', 'hostelname', 'hostelroomID', 'hostelregDate', 'vacatingDate', 'status', 'active', 'id')) == 1)
                        echo "ok";
                    else
                        echo "notok";
                    $obj->updation($table1, $arr);   //update process
                }
            }
            else if ($usertype == 'employee') {
                $Searchemployee = $_POST['Searchemployee'];
                $staffid = $_POST['staffid'];
                $counting = $val->hostelRoomsCountUsers1($staffid, $usertype);

                if ($counting > 0) {
                    echo "oops";
                } else {
                    if ($obj->insertion($table, compact('usertype', 'staffid', 'hosteltype', 'hostelname', 'hostelroomID', 'hostelregDate', 'vacatingDate', 'status', 'active', 'id')) == 1)
                        echo "ok";
                    else
                        echo "notok";
                    $obj->updation($table1, $arr); //update process
                }
            }
        }
        else {
            echo "cannot";
        }
    }

    public function HostelFeeCollection() {
        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d');
        $year = date('Y');
        $month = date('m');
        $mat = new materialController;
        $obj = new commonSql;
        $table = 'hostelfee_pay';

        $rowmaxreciptId = $mat->getMaxHostelInvoice();
        if ($rowmaxreciptId == '0') {
            $reciptId = '0001';
        } else {
            $incrementorder = $rowmaxreciptId + 1;
            $reciptId = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
        }
        //             SearchStudent Searchemployee    
        $usertype = $_POST['usertype'];
        $fine = $_POST['fine'];
        $discount = $_POST['discount'];
        $modeofpay = $_POST['modeofpay'];
        $banknameload = '';
        $chequeno = '';
        $chequedate = '';
        $payingamount = $_POST['payingamount'];
        $reciptno = $reciptId;
        $amount = $_POST['amount'];
        $remarks = $_POST['remarks'];
        $status = 'paid';
        $active = 'yes';
        $id = '';

        if ($modeofpay == 'cheque') {
            $banknameload = $_POST['banknameload'];
            $chequeno = $_POST['chequeno'];
            $chequedate = $_POST['chequedate'];
        }

        $bool = "";
        if ($usertype == 'student') {
            $studentid = $_POST['studentid'];
            if (isset($_POST['feetypes'])) {
                $getInput = $_POST['feetypes']; // select_name will be replaced with your input filed name
                $selectedOption = "";
                foreach ($getInput as $option => $value) {
                    if ($obj->insertion($table, compact('value', 'date', 'amount', 'payingamount', 'fine', 'discount', 'modeofpay', 'banknameload', 'chequeno', 'chequedate', 'reciptno', 'remarks', 'usertype', 'studentid', 'status', 'active', 'id')) == 1)
                        $bool = $reciptId;
                    else
                        $bool = "notok";
                }
            }
        }
        else if ($usertype == 'employee') {
            $staffid = $_POST['staffid'];
            if (isset($_POST['feetypes'])) {
                $getInput = $_POST['feetypes']; // select_name will be replaced with your input filed name
                $selectedOption = "";
                foreach ($getInput as $option => $value) {
                    if ($obj->insertion($table, compact('value', 'date', 'amount', 'payingamount', 'fine', 'discount', 'modeofpay', 'banknameload', 'chequeno', 'chequedate', 'reciptno', 'remarks', 'usertype', 'staffid', 'status', 'active', 'id')) == 1)
                        $bool = $reciptId;
                    else
                        $bool = "notok";
                }
            }
        }
        echo $bool;
    }

    public function AttendanceStudentMarking() {
        $obj = new commonSql;

        $i = $_POST['lasti'];
        $gradenumber = $_POST['gradenumber'];
        $datepicker = $_POST['datepicker'];
        $month = date("m", strtotime($datepicker));
        $day = date("d", strtotime($datepicker));
        $year = date("Y", strtotime($datepicker));
        $bool = '';
        for ($x = 1; $x < $i; $x++) {
            $studentname = $_POST['studentname' . $x];
            $studentcode = $_POST['studentcode' . $x];
            $studentid = $_POST['studentid' . $x];
            $remarks = $_POST['remarks' . $x];
            $status = 'yes';
            $id = '';
            $attendance = '';
            if (isset($_POST['presAbs' . $x])) {
                $attendance = 'present';
            } else {
                $attendance = 'absent';
            }

            $fields = "COUNT(id)";
            $table1 = "studentattendance WHERE studentid = '$studentid' AND date = '$datepicker'";
            $result = $obj->displayCount($fields, $table1);

            if ($result < 1) {
                $table = "studentattendance";
                if ($obj->insertion($table, compact('id', 'studentcode', 'studentname', 'studentid', 'datepicker', 'day', 'month', 'year', 'attendance', 'remarks', 'status', 'gradenumber')) == 1)
                    $bool = "ok";
                else
                    $bool = "notok";
            }
            else {
                $bool = "oops";
            }
        }
        echo $bool;
    }

    public function VehicleeRegister() {
        $obj = new commonSql;
        $table = 'vehicle_reg';
        $vehicleno1 = $_POST['vehicleno1'];
        $vehicleno2 = $_POST['vehicleno2'];
        $vehicle = $_POST['vehicleno1'] . "-" . $_POST['vehicleno2'];
        $noofseats = $_POST['noofseats'];
        $maximumallowed = $_POST['maximumallowed'];
        $vehicletype = $_POST['vehicletype'];
        $contactperson = $_POST['contactperson'];
        $insurancerenewal = $_POST['insurancerenewal'];
        $trackid = $_POST['trackid'];
        $status = 'yes';
        $id = '';
        if ($obj->insertion($table, compact('vehicleno1', 'vehicleno2', 'vehicle', 'noofseats', 'maximumallowed', 'vehicletype', 'contactperson', 'insurancerenewal', 'trackid', 'status', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function feeCategoryRegister() {
        $id = '';
        $feecategory = $_POST['feecategory'];
        $prefixreciptno = $_POST['prefixreciptno'];
        $description = $_POST['description'];
        $active = "yes";
        $obj = new commonSql;
        $table = "fee_category";

        if ($obj->insertion($table, compact('feecategory', 'prefixreciptno', 'description', 'active', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function SubfeeCategoryRegister() {
        $obj = new commonSql;
        $feecategory = $_POST['feecategory'];
        $feesubcategoryname = $_POST['feesubcategoryname'];
        $amount = $_POST['amount'];
        $feetype = $_POST['feetype'];
        $active = "yes";
        $id = '';
        $table = "sub_fee_category";
        $insertid = $obj->insertionLastID($table, compact('feecategory', 'feesubcategoryname', 'amount', 'feetype', 'active', 'id'));
        $lastinsertid = $insertid;
        $bool = "";

        $increment = 0;
        if ($feetype == 'Annual') {
            $increment = 1;
        } else if ($feetype == 'Bi-Annual') {
            $increment = 2;
        } else if ($feetype == 'Tri-Annual') {
            $increment = 3;
        } else if ($feetype == 'Quaterly') {
            $increment = 4;
        } else if ($feetype == 'Monthly') {
            $increment = 12;
        } else if ($feetype == 'One-Time') {
            $increment = 1;
        }

        for ($y = 1; $y <= $increment; $y++) {
            $table1 = 'fees_types';
            $startdate = $_POST['startdate' . $y];
            $duedate = $_POST['duedate' . $y];
            $enddate = $_POST['enddate' . $y];
            if ($obj->insertion($table1, compact('lastinsertid', 'startdate', 'duedate', 'enddate', 'active', 'id')) == 1) {
                $bool = "ok";
            } else {
                $bool = "notok";
            }
        }
        echo $bool;
    }

    public function FineofSubCategoryRegister() {
        $feecategory = $_POST['feecategory'];
        $feesubcategoryname = $_POST['feesubcategoryname'];
        $type = $_POST['type'];
        $finepercentage = 0;
        $fineamount = 0;
        $fineincrementin = '';
        $days = '';
        $maximumPercentage = '';
        $finetypestatus = $_POST['finetypestatus'];
        $active = 'yes';
        $id = '';
        if ($type == 'Amount') {
            $fineamount = $_POST['fineamount'];
        } else if ($type == 'Percentage') {
            $finepercentage = $_POST['finepercentage'];
        }

        if ($finetypestatus == 'Incremental') {
            $fineincrementin = $_POST['fineincrementin'];
        }

        if ($fineincrementin == 'Daily') {
            $days = $_POST['days'];
            $maximumPercentage = $_POST['maximumPercentage'];
        }

        $obj = new commonSql;
        $table = "sub_fee_category_fine";

        if ($obj->insertion($table, compact('feecategory', 'feesubcategoryname', 'type', 'fineamount', 'finepercentage', 'finetypestatus', 'fineincrementin', 'days', 'maximumPercentage', 'active', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function feeAllocationRegister() {
        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d');

        date_default_timezone_set('Asia/Colombo');
        $time = date('H:i:s:A');

        $obj = new commonSql;
        $mat = new materialController;
        $table = "fee_allocation";
        $feecategory = $_POST['feecategory'];
        $subCategory = $_POST['feesubcategoryname'];
        $feesfor = $_POST['feesfor'];
        $gradenumberlist = $_POST['gradenumberlist'];
        $students = '';
        $active = 'yes';
        $id = '';
        $bool = '';
        $amount = $_POST['amount'];

        $SubCategoryResult = $mat->getSubcategoryFee($subCategory); //subcategory table
        $resultFeetype = $mat->feeStype($subCategory);

        $paydate = '';
        $amount1 = $amount;
        $amount2 = 0;
        $balance = $amount;
        $TotalAmount = 0;
        $fine = '0';
        $dis = '0';
        $prefix = '';
        $indi = '';
        $rec = '';
        $Mod = '';
        $bnk = '';
        $chq = '';
        $chqD = '';
        $tot = '0';
        $rmk = '';
        $status1 = 'notpaid';

        $tableEx = 'studentfee_pay';
        if (isset($_POST['students'])) {
            $students = $_POST['students'];

            $selectedOption = "";
            foreach ($students as $option => $value) {
                if ($obj->insertion($table, compact('feecategory', 'subCategory', 'feesfor', 'amount', 'gradenumberlist', 'value', 'time', 'date', 'active', 'id')) == 1)
                    $bool = "ok";
                else
                    $bool = "notok";

                foreach ($resultFeetype as $rowFeetype) {
                    $feeid = $rowFeetype['id'];
                    $obj->insertion($tableEx, compact('subCategory', 'feeid', 'value', 'paydate', 'amount1', 'amount2', 'balance', 'TotalAmount', 'fine', 'dis', 'prefix', 'indi', 'rec', 'Mod', 'bnk', 'chq', 'chqD', 'tot', 'rmk', 'status1', 'active', 'id'));
                }
            }
        } else {
            if ($obj->insertion($table, compact('feecategory', 'subCategory', 'feesfor', 'amount', 'gradenumberlist', 'students', 'time', 'date', 'active', 'id')) == 1)
                $bool = "ok";
            else
                $bool = "notok";
            $getstudentid = $mat->SelectStudentbyGrade($gradenumberlist);
            foreach ($getstudentid as $rowgetid) {
                $studendid = $rowgetid['id'];
                foreach ($resultFeetype as $rowFeetype) {
                    $feeid = $rowFeetype['id'];
                    $obj->insertion($tableEx, compact('subCategory', 'feeid', 'studendid', 'paydate', 'amount1', 'amount2', 'balance', 'TotalAmount', 'fine', 'dis', 'prefix', 'indi', 'rec', 'Mod', 'bnk', 'chq', 'chqD', 'tot', 'rmk', 'status1', 'active', 'id'));
                }
            }
        }
        echo $bool;
    }

    public function VehicleeDriverRegister() {
        $vehicle = $_POST['vehicle'];
        $drivername = $_POST['drivername'];
        $caddress = $_POST['caddress'];
        $paddress = $_POST['paddress'];
        $dob = $_POST['dob'];
        $Phone = $_POST['Phone'];
        $license = $_POST['license'];

        $id = 'id';
        $active = 'yes';
        $status = 'free';
        $table = "vehicle_drive";

        $obj = new commonSql;
        if ($obj->insertion($table, compact('vehicle', 'drivername', 'caddress', 'paddress', 'dob', 'Phone', 'license', 'status', 'active', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function AddRouteRegister() {
        $vehicle = $_POST['vehicle'];
        $routecode = $_POST['routecode'];
        $routestartplace = $_POST['routestartplace'];
        $routestopplace = $_POST['routestopplace'];

        $id = 'id';
        $active = 'yes';
        $status = 'booked';
        $table = "vehicle_route";

        $obj = new commonSql;
        if ($obj->insertion($table, compact('vehicle', 'routecode', 'routestartplace', 'routestopplace', 'status', 'active', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function VehicleeDestinationReg() {
        $obj = new commonSql;
        $routecode = $_POST['routecode'];
        $pickupanddrop = $_POST['pickupanddrop'];
        $stoptime = $_POST['stoptime'];
        $amount = $_POST['amount'];
        $feetype = $_POST['feetype'];
        $id = '';
        $active = 'yes';
        $status = 'booked';
        $table = 'destination';


        $lastid = $obj->insertionLastID($table, compact('routecode', 'pickupanddrop', 'stoptime', 'amount', 'feetype', 'status', 'active', 'id'));
        $lastinsertid = $lastid;
        $bool = '';

        $increment = 0;
        if ($feetype == 'Annual') {
            $increment = 1;
        } else if ($feetype == 'Bi-Annual') {
            $increment = 2;
        } else if ($feetype == 'Tri-Annual') {
            $increment = 3;
        } else if ($feetype == 'Quaterly') {
            $increment = 4;
        } else if ($feetype == 'Monthly') {
            $increment = 12;
        }

        for ($y = 1; $y <= $increment; $y++) {
            $table1 = 'destination_fees';
            $startdate = $_POST['startdate' . $y];
            $duedate = $_POST['duedate' . $y];
            $enddate = $_POST['enddate' . $y];
            if ($obj->insertion($table1, compact('lastinsertid', 'startdate', 'duedate', 'enddate', 'active', 'id')) == 1) {
                $bool = "ok";
            } else {
                $bool = "notok";
            }
        }
        echo $bool;
    }

    public function TransportAllocationRegister() {
        $routecode = $_POST['routecode'];
        $destination = $_POST['destination'];
        $usertype = $_POST['usertype'];
        $sFrequency = $_POST['sFrequency'];
        $eFrequency = $_POST['eFrequency'];
        $bool = '';
        $gradenumberlist = '';
        $active = 'yes';
        $status = 'allocate';
        $id = '';

        $table = 'transport_allocation';
        $obj = new commonSql;
        if ($usertype == 'student') {
            $gradenumberlist = $_POST['gradenumberlist'];
            $students = $_POST['students'];
            foreach ($students as $option => $value) {
                if ($obj->insertion($table, compact('routecode', 'destination', 'usertype', 'gradenumberlist', 'value', 'sFrequency', 'eFrequency', 'status', 'active', 'id')) == 1) {
                    $bool = "ok";
                } else {
                    $bool = "notok";
                }
            }
        } else if ($usertype == 'employee') {
            $Searchemployee = $_POST['Searchemployee'];
            $staffid = $_POST['staffid'];
            if ($obj->insertion($table, compact('routecode', 'destination', 'usertype', 'gradenumberlist', 'staffid', 'sFrequency', 'eFrequency', 'status', 'active', 'id')) == 1) {
                $bool = "ok";
            } else {
                $bool = "notok";
            }
        }
        echo $bool;
    }

    public function SaveSpecialTimetable() {
        $data = $_POST['data'];
        $term = $data[0];
        $grade = $data[1];
        $year = $data[2];
        $timetablename = $data[3];
        $res = $data[4];
        $timetableno = $data[6];
        $active = 'yes';
        $id = '';

        $obj = new commonSql;
        $table = "multi_timetable";

        if ($obj->insertion($table, compact('term', 'year', 'grade', 'timetablename', 'timetableno', 'res', 'active', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function branchRegister() {
        $id = '';
        $branchname = $_POST['branchname'];
        $active = "yes";
        $obj = new commonSql;
        $table = "branch";

        if ($obj->insertion($table, compact('branchname', 'active', 'id')) == 1)
            echo "ok";
        else
            echo "notok";
    }

    public function savetbl_SubjectExam() {
        $mat = new materialController;
        $obj = new commonSql;
        $table = "tbl_subject";
        $grade = $_POST['grade'];
        $newsubject = $_POST['newsubject'];
        $term = $_POST['term'];
        $language = $_POST['language'];
        $id = '';
        $status = 'pending';

        $result = $mat->CheckDuplicationExamSUbjectPaper($newsubject, $grade, $language, $term);
        if ($result > 0) {
            echo "Dup";
        } else {
            if ($obj->insertion($table, compact('id', 'newsubject', 'grade', 'language', 'term', 'status')) == 1)
                echo "ok";
            else
                echo "notok";
        }
    }

    public function CreateExamRegister() {
        $mat = new materialController;
        $obj = new commonSql;
        $table = "tbl_exam_paper";
        $subjectid = $_POST['subjectid'];
        $examduration = $_POST['examduration'];
        $noofquestions = $_POST['noofquestions'];
        $username = $_POST['username'];
        $status = 'pending';
        $id = '';

        $rowmaxreciptId = $mat->MaxExamPaperNo();
        $rowmaxreciptId = intval($rowmaxreciptId);
        if ($rowmaxreciptId == '0') {
            $paperno = '0001';
        } else {
            $incrementorder = $rowmaxreciptId + 1;
            $paperno = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
        }

        $second = $examduration * 60;

        $result = $mat->CheckDuplicationExamPaper($subjectid);
        if ($result > 0) {
            echo "Dup";
        } else {
            if ($obj->insertion($table, compact('id', 'subjectid', 'second', 'username', 'status', 'noofquestions', 'paperno')) == 1)
                echo "ok";
            else
                echo "notok";
        }
    }

//    public function result()
//	{
//		$dm = new commonSql();
//
//		$result = $_POST['result'];
//		$student_id = $result[0];
//		$exam_id = $result[1];
//		$exam_result = $result[2];
//		$track = $result[3];//Esacape the string. Before store
//		//write query for save result table
//		// id | student id | exam id | track | result // table structure
//		$query_que = sprintf("INSERT INTO `tbl_result`(`student_id`, `exam_id`, `track`,`result`) VALUES (%s,'%s','%s',%s)",$student_id, $exam_id, $track, $exam_result);
//		$dm->save($query_que);
//
//		$strfromemail="From: Exam Engine <info@rubiikx.com>";
//		$strbccemail="Bcc: fashan@gmail.com";
//		$strccemail="cc: result@thewebaxis.com";
//		$stremail = ""; // student email address
//
//		$headers = "From: $strfromemail" . "\r\n";
//		$headers .= $strbccemail . "\r\n";
//		$headers .= $strccemail . "\r\n";
//		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
//
//		$stremailbody = ""; // type some message.. dont send track to student. paper can be leaked for next time
//		// better you prepare mails in a table and call here and send
//		$strsubject = "Exam Results - ".$exam_id;
//		
//		mail($stremail,$strsubject,$stremailbody,$headers);
//	}

    public function exambooking() {
        //SearchStudent studentid paperno getsecond time1
        $studentid = $_POST['studentid'];
        $paperno = $_POST['paperno'];
        $getsecond = $_POST['getsecond'];
        $time1 = $_POST['time1'];
        $date = $_POST['datepicker'];

        $fromTime = date("H:i:s", strtotime($time1));
        $caltime = strtotime($time1) + ($getsecond / 60) * 60;
        $toTime = date("H:i:s", $caltime);

        $from = strtotime($fromTime);
        $to = strtotime($toTime);
        $diff = ($to - $from) / 3600;



        $mat = new materialController;
        $resutlPaper = $mat->getExactTime($paperno);

        $subjectid = $resutlPaper['subject_id'];

        $rowmaxEid = $mat->getExamBooking();
        if ($rowmaxEid == '0') {
            $Examid = 'E0001';
        } else {
            $incrementorder = $rowmaxEid + 1;
            $Examid = "E" . str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
        }

        $data = array(
            "id" => '',
            "exam_id" => $Examid,
            "school_id" => 1,
            "student_id" => $studentid,
            "subject_id" => $subjectid,
            "exam_date" => $date,
            "exam_start" => $fromTime,
            "exam_end" => $toTime,
            "user" => $_SESSION['loguserid'],
            "status" => "booked",
            "paperid" => $paperno
        );

        $table = 'tbl_exam_book';
        $obj = new commonSql;

        if ($mat->CheckbookingDup($paperno, $studentid) > 0) {
            echo "oops";
        } else {
            if ($obj->insertion($table, $data)) {
                echo "ok";
            } else {
                echo "notok";
            }
        }
    }

    public function parentRegRegister() {
        $obj = new commonSql;
        date_default_timezone_set('Asia/Colombo');
        $time = date('H:i:s:A');
        //  student1  grade1 gradeid1
        $countStudents = $_POST['countStudents'];
        $email = $_POST['parentemail'];
        $Username = $_POST['username'];
        $npassword = base64_encode($_POST['npassword']);
        $mat = new materialController;


        $dataA = array(
            "id" => '',
            "nic" => '',
            'first_name' => $Username,
            'last_name' => '',
            'address' => '',
            'mobile' => '',
            'username' => $Username,
            'password' => $npassword,
            'birthday' => '',
            'usertype' => '5',
            'email' => $email,
            'status' => 'yes',
            'time' => $time,
            'gender' => 'male',
            'branchname' => '1'
        );
        $lastinsertid = $obj->insertionLastID("user_reg", $dataA);
        if ($lastinsertid) {
            $flag = FALSE;
            for ($i = 1; $i <= $countStudents; $i++) {
                $studentid = $_POST['studentid' . $i];
                $data = array(
                    'id' => '',
                    'studentid' => $studentid,
                    'parentid' => $lastinsertid,
                    'status' => 'yes'
                );
                if ($mat->ChecchilparentDup($studentid) > 0) {
                    $flag = TRUE;
                } else {
                    $obj->insertionLastID("parent_children", $data);
                }
            }
            if ($flag) {
                echo "oops";
            } else {
                echo "ok";
            }
        } else {
            echo "notok";
        }
    }

    public function composemaild() {
        $mat = new materialController;
        $obj = new commonSql;
        $resultMai = $mat->userregDetails($_SESSION['loguserid']);



        $toemails = $_POST['herodemo'];
        $toemails = explode(",", $toemails);
        $flag = FALSE;
        foreach ($toemails as $mails) {
            $subject = $_POST['subject'];
            $composetextarea = $_POST['composetextarea'];

            $result = $mat->getuserdetails($mails);
            if (!empty($result['id'])) {
                $data = array(
                    'id' => '',
                    'frommail' => $resultMai['email'],
                    'tomail' => $mails,
                    'subject' => $subject,
                    'remarks' => $composetextarea,
                    'status' => '0',
                    'active' => 'yes',
                    'fromid' => $_SESSION['loguserid'],
                    'toid' => $result['id']
                );
                if ($obj->insertionLastID("message_mail", $data)) {
                    $flag = TRUE;
                }
            }
        }
        if ($flag) {
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function classAllocaRegister() {
        $mat = new materialController;

        $class_reg_id = $_POST['gradenumberlist'];
        $staff_reg_id = $_POST['staffno'];

        $data = array(
            'id' => '',
            'class_reg_id' => $class_reg_id,
            'staff_reg_id' => $staff_reg_id,
            'active' => '1'
        );

        $obj = new commonSql;
        $table = "class_allocation";
        if ($mat->getTotClassAllocation($staff_reg_id, $class_reg_id) > 0) {
            echo "oops";
        } else if ($mat->getTotClassAllocationagin($staff_reg_id) > 0) {
            echo "oops";
        } else {
            if ($obj->insertion($table, $data) == 1)
                echo "ok";
            else
                echo "notok";
        }
    }

}
