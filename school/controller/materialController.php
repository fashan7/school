<?php
class materialController {

    public function maxStaff() {
        $fields = "MAX(id)";
        $table = "staff_reg";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function SelectUsers() {
        $fields = "id, username";
        $table = "user_reg WHERE status = 'yes'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function usertypebyid($id) {
        $table = "user_type WHERE active = 'yes' AND id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function usertypeSelect() {
        $fields = "id, name";
        $table = "user_type WHERE active = 'yes'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function userregDetails($id) {
//        $fields = "id, username, nic, first_name, last_name, address, mobile, password, birthday, usertype, email, status, reg_time";
        $table = "user_reg WHERE status = 'yes' AND id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function SelectGradeNumber() {
        $fields = "id, gradenumber";
        $table = "class_register GROUP BY gradenumber";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function getValueGradeValue() {
        $id = $_POST['gradenumber'];

        $fields = "gradenumber";
        $table = "class_register WHERE id = '$id'";

        $obj = new commonSql;
        echo $obj->displayCount($fields, $table);
    }

    public function getValueGradeValueSection() {
        $id = $_POST['gradenumber'];

        $fields = "gradesection";
        $table = "class_register WHERE id = '$id'";

        $obj = new commonSql;
        echo $obj->displayCount($fields, $table);
    }

    public function getEmployeesAll() {
        $fields = "code, fullname, id";
        $table = "staff_reg ORDER BY fullname";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function SelectallGradeNumber() {
        $fields = "id, gradenumber, gradesection";
        $table = "class_register ORDER BY gradenumber, gradesection";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function SelectGradeNumberbyid($id) {
        $table = "class_register WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function predictionPieChart() {
        $fields1 = "COUNT(id)";
        $table1 = "staff_reg";
        $obj0 = new commonSql;
        $teacher = $obj0->displayCount($fields1, $table1);

        $fields2 = "COUNT(id)";
        $table2 = "studentreg";
        $obj1 = new commonSql;
        $student = $obj1->displayCount($fields2, $table2);
        $arr = array();
        $arr[] = array(
            "std" => $student,
            "stf" => $teacher
        );

        echo json_encode($arr);
    }

    public function SelectStudent($id) {
        $fields = "id, studentname, studentcode, studentadress, studentgender, studentdob, parentname, parentaddress, parentmobile, parentland, parentemail, grade, date";
        $table = "studentreg WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function SelectStudentbyGrade($grade) {
        $fields = "id, studentname, studentcode, studentadress, studentgender, studentdob, parentname, parentaddress, parentmobile, parentland, parentemail, grade, date";
        $table = "studentreg WHERE grade = '$grade'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function SelectStudentbyGradedispl($grade) {
        $table = "studentreg WHERE grade = '$grade'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function getPaymentBalance($id) {
        $fields = "student_id, payment_date, no_of_months, amount_per_mon, amount_to_pay, paying_amount, balance_amount, payment_status";
        $table = "student_fees WHERE student_id = '$id' AND payment_status = 'open' AND balance_amount != 0";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function getMaxStudentInvoice() {
        $fields = "MAX(receipt_no)";
        $table = "student_fees";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function SelectStaff($id) {
        $fields = "id, code, fullname, address, gender, dob, mobile, landline, email";
        $table = "staff_reg WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function getMaxStaffSalaryRecipt() {
        $fields = "MAX(receipt_no)";
        $table = "staff_salary";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function totalStudentFees() {
        date_default_timezone_set('Asia/Colombo');
        $monthyear = date('Y');

        $fields = "payamount";
        $table = "studentfee_pay WHERE YEAR(pay_date) = '$monthyear' AND status = 'paid'";

        $obj = new commonSql;
        $rowcount = $obj->displayRow($fields, $table);

        $row = $obj->displaySum($fields, $table);

        $jsonData = array();

        $data = "";
        $data .= 'data-data= "[';
        $i = 1;
        foreach ($row as $result) {
            if ($i <= $rowcount - 1) {
                $data .= $result['payamount'] . ',';
            } else {
                $data .= $result['payamount'];
            }
            $jsonData = array($data);
            $i++;
        }
        $data .= ']"';
        echo $data;
    }

    public function CountStaff() {
        $fields = "COUNT(id)";
        $table = "staff_reg";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function CountStudent() {
        $fields = "COUNT(id)";
        $table = "studentreg";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function UpcomingEvents() {
        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d');

        $fields = "COUNT(id)";
        $table = "school_events WHERE start_event >= '$date'";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function CountUsers() {
        $fields = "COUNT(id)";
        $table = "user_reg";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function totalSalaryStaff() {
        date_default_timezone_set('Asia/Colombo');
        $monthyear = date('Y');

        $fields = "amount";
        $table = "staff_salary WHERE year = '$monthyear'";

        $obj = new commonSql;
        $rowcount = $obj->displayRow($fields, $table);

        $row = $obj->displaySum($fields, $table);

        $jsonData = array();

        $data = "";
        $data .= 'data-data= "[';
        $i = 1;
        foreach ($row as $result) {
            if ($i <= $rowcount - 1) {
                $data .= $result['amount'] . ',';
            } else {
                $data .= $result['amount'];
            }
            $jsonData = array($data);
            $i++;
        }
        $data .= ']"';
        echo $data;
    }

    public function SelectallDepartment() {
        $fields = "id, name";
        $table = "staff_department WHERE status = 'yes' ORDER BY name";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function departmentDetails($id) {
        $table = "staff_department WHERE status = 'yes' AND id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function SelectallBanks() {
        $fields = "id, name";
        $table = "banks WHERE status = 'yes' ORDER BY name";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function SelectStaffbyDept($id) {
        $fields = "id, code, fullname, address, gender, dob, mobile, landline, email";
        $table = "staff_reg WHERE department = '$id'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function GetAttendance($department, $month, $year) {
        $fields = "staffcode, staffName, staffid, date, day, month, year, attendance, remarks, department, id";
        $table = "staffattendance WHERE department = '$department' AND month = '$month' AND year = '$year' GROUP BY staffid";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function GetAttendanceStudent($grade, $month, $year) {
        $fields = "studentcode, studentName, studentid, date, day, month, year, attendance, remarks, grade, id";
        $table = "studentattendance WHERE grade = '$grade' AND month = '$month' AND year = '$year' GROUP BY studentid";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }
    
    public function GetAttendanceStudentid($sid, $month, $year) {
        $fields = "studentcode, studentName, studentid, date, day, month, year, attendance, remarks, grade, id";
        $table = "studentattendance WHERE studentid = '$sid' AND month = '$month' AND year = '$year' GROUP BY studentid";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function GetAttendanceSingle($department, $date, $staffid) {
        $table = "staffattendance WHERE department = '$department' AND date = '$date' AND staffid = '$staffid'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function GetAttendanceStudentSingle($grade, $date, $studentid) {
        $table = "studentattendance WHERE grade = '$grade' AND date = '$date' AND studentid = '$studentid'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function SelectStaffbyid($id) {
        $table = "staff_reg WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function SelectStudentbyid($id) {
        $table = "studentreg WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function CountAttendance($department, $date, $staffid) {
        $fields = "COUNT(id)";
        $table = "staffattendance WHERE department = '$department' AND date = '$date' AND staffid = '$staffid'";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function CountStudentAttendance($grade, $date, $studentid) {
        $fields = "COUNT(id)";
        $table = "studentattendance WHERE grade = '$grade' AND date = '$date' AND studentid = '$studentid'";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function GetAttendanceColumn($department, $date) {
        $fields = "staffcode, staffName, staffid, date, day, month, year, attendance, remarks, department, id";
        $table = "staffattendance WHERE department = '$department' AND date = '$date'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function GetAttendanceColumnStudent($grade, $date) {
        $fields = "studentcode, studentName, studentid, date, day, month, year, attendance, remarks, grade, id";
        $table = "studentattendance WHERE grade = '$grade' AND date = '$date'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }
    
    public function GetAttendanceColumnStudentid($studentid, $date) {
        $fields = "studentcode, studentName, studentid, date, day, month, year, attendance, remarks, grade, id";
        $table = "studentattendance WHERE studentid = '$studentid' AND date = '$date'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function SelectallLeaveCat() {
        $fields = "id, name";
        $table = "leave_category WHERE status = 'yes' ORDER BY name";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function SelectCategory($id) {
        $table = "leave_category WHERE status = 'yes' AND id = '$id' ORDER BY name";
        $obj = new commonSql;
        return $obj->display($table);
    }

    public function CheckLeave($staff, $category, $nextyear) {
        $fields = "id, leave_category, department, staff, fdate, tdate, count_leaves, remaining_leave";
        $table = "leave_application WHERE staff = '$staff' AND leave_category = '$category' AND fdate >= '$nextyear'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function SelectLeaveCat() {
        $fields = "id, category, category_name, department, leave_count";
        $table = "leave_detail_category WHERE status = 'yes' ORDER BY category_name";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function SelectLeaveCatbyid($id) {
        $fields = "id, category, category_name, department, leave_count";
        $table = "leave_detail_category WHERE status = 'yes' AND department = '$id' ORDER BY category_name";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function getRemainingLeavesCate($category) {
        $table = "leave_detail_category WHERE category = '$category'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function getSingsubLeavesCate($id) {
        $table = "leave_detail_category WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function SelectdetailLeaveCate($id) {
        $table = "leave_application WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function leaveApprovalPending() {
        $fields = "id, parent_app, fdate, tdate, reason, status, count_leaves";
        $table = "leave_application_child WHERE active = 'yes' AND status = 'Awaiting Approval' ORDER BY fdate";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function checkLeaveRemaining($id) {
        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d');
        $year = date('Y');
        $month = date('m');

        $fields = "id, leave_category, department, staff, fdate, tdate, reason, status, remaining_leave";
        $table = "leave_application WHERE staff = '$id' AND active = 'yes' AND YEAR(fdate) = '$year'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function bookcategorybyID($id) {
        $table = "book_category WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function bookcategory() {
        $fields = "id, name, code";
        $table = "book_category WHERE status = 'yes'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function bookListParent($id) {
        $table = "librarybooks WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function bookListChild($id) {
        $table = "librarybooks_child WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function SearchLibrary($search) {
        $fields = "id, librarybooks_parent, bookno, isbn_no, status, title, publisher, author";
        $table = "librarybooks_child WHERE status = 'Available' AND (bookno LIKE '%$search%' OR isbn_no LIKE '%$search%' OR title LIKE '%$search%' OR author LIKE '%$search%') ";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function SearchStudent($search) {
        $fields = "id, studentname, studentcode";
        $table = "studentreg WHERE studentname LIKE '%$search%' OR studentcode LIKE '%$search%'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function SearchStaff($search) {
        $fields = "id, fullname, code";
        $table = "staff_reg WHERE fullname LIKE '%$search%' OR code LIKE '%$search%'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function SearchLibraryIssued($search) {
        $fields = "id, librarybooks_parent, bookno, isbn_no, status, title, publisher, author";
        $table = "librarybooks_child WHERE status = 'issued' AND (bookno LIKE '%$search%' OR isbn_no LIKE '%$search%' OR title LIKE '%$search%' OR author LIKE '%$search%')";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function getDetailsIssuedBook($id) {
        $table = "issue_books WHERE booklibrary_child = '$id' AND status = 'issued'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function getissuedBookbId($id) {
        $table = "issue_books WHERE id = '$id'";
        $obj = new commonSql();
        return $obj->display($table);
    }

    public function hosteltypeID($id) {
        $table = "hostel_type WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function hostelsType() {
        $fields = "id, name";
        $table = "hostel_type WHERE active = 'yes'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function hostelDetails($id) {
        $table = "hostels_details WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function hostelDetailByType($type) {
        $fields = "id, hostel_type, hostel_name";
        $table = "hostels_details WHERE hostel_type = '$type'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function hostelRoomsDetails($id) {
        $table = "hostel_rooms WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function hostelAvailableRoom($parent) {
        $fields = "id, hostel_type, hostel_name, floor_name, room_no, no_of_beds, amount, fees_type, status";
        $table = "hostel_rooms WHERE hostel_name = '$parent' AND status = 'Available'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function hostelRoomByUser($user, $usertype) {
        $table = "hostelmem_reg WHERE user = '$user' AND usertype = '$usertype' AND status = 'rent'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function allHostelMemSingle($id) {
        $table = "hostelmem_reg WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function HostelMemRegSearch($user, $usertype) {
        $table = "hostelmem_reg WHERE user = '$user' AND usertype = '$usertype' AND status = 'rent'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function CountSingleMemberRooms($user, $usertype) {
        $fields = "COUNT(id)";
        $table = "hostelmem_reg WHERE user = '$user' AND usertype = '$usertype' AND status = 'rent'";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function hostelFeesbyRoomID($id) {
        $fields = "id, start_date, due_date, end_date";
        $table = "hostel_fees WHERE parent_hostel_rooms = '$id'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function HostelCheckFeesByFeeid($user, $usertype, $id) {
        $table = "hostelfee_pay WHERE user = '$user' AND usertype = '$usertype' AND fees_id = '$id' AND status = 'paid'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function getMaxHostelInvoice() {
        $fields = "MAX(recipt_no)";
        $table = "hostelfee_pay";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function HostelCheckFeesByrecipt($reciptno) {
        $table = "hostelfee_pay WHERE recipt_no = '$reciptno' AND status = 'paid'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function HostelCheckFeesByAllrecipt($reciptno) {
        $fields = "id, total_amount, fine, discount, payment_type, bankname, cheque_no, cheque_date, remarks, fees_id, paidamount";
        $table = "hostelfee_pay WHERE recipt_no = '$reciptno' AND status = 'paid'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function HostelFeeGetRoomID($feesid) {
        $table = "hostel_fees WHERE id = '$feesid'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function SelectBanks($id) {
        $table = "banks WHERE id = '$id";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function getSpecificeDetailsLeave($id) {
        $table = "leave_application WHERE active = 'yes' AND id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function getStaffremainingLeave($category, $staff) {
        $table = "leave_application WHERE active = 'yes' AND leave_category = '$category' AND staff = '$staff'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function SelectFeeCategory($id) {
        $table = "fee_category WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function SelectFeeCategoryAll() {
        $fields = "id, category_name, prefix, description";
        $table = "fee_category WHERE status = 'yes'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function getSubcategoryFee($id) {
        $table = "sub_fee_category WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function feeStype($id) {
        $fields = "id, parent_sub_category, start_date, due_date, end_date";
        $table = "fees_types WHERE parent_sub_category = '$id'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function SelectSubFeeCategoryAll($id) {
        $fields = "id, sub_category_name, amount, feetype";
        $table = "sub_fee_category WHERE fee_category = '$id'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function feeAllocationList($grade) {
        $fields = "fee_category, fee_category_sub, fee_for, amount, grade, student, time, date";
        $table = "fee_allocation WHERE grade = '$grade'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function feeAllocationListP1($grade, $student) {
        $table = "fee_allocation WHERE grade = '$grade' AND student = '$student'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function getMaxTotalInvoice() {
        $fields = "MAX(receipt_no)";
        $table = "studentfee_pay";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function getMaxInvoiceofFeepay($id) {
        $fields = "MAX(indvidual_receipt)";
        $table = "studentfee_pay WHERE subcategory = '$id'";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function StudentCheckFees($student, $subCat, $feeid) {
        $table = "studentfee_pay WHERE student = '$student' AND subcategory = '$subCat' AND feetype_id = '$feeid' AND status = 'paid'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function StudentCheckFeesAll($student, $subCat) {
        $fields = "*";
        $table = "studentfee_pay WHERE student = '$student' AND subcategory = '$subCat'";
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function StudentCheckFeesnotpaid($student, $subCat, $feeid) {
        $table = "studentfee_pay WHERE student = '$student' AND subcategory = '$subCat' AND feetype_id = '$feeid' AND status = 'notpaid'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public function StudentFeePay($id) {
        $fields = "subcategory, feetype_id, student, pay_date, actual_amount, payamount, balance_amount, total_amount, fine, discount";
        $table = "studentfee_pay WHERE status = 'notpaid' AND student = '$id' GROUP BY subcategory";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function studentfeesaalloc($student) {
        $fields = "sfc.sub_category_name, feea.amount, feea.id as allocid, sreg.id as studentid, sreg.studentname, sreg.studentcode, sfc.id as subcategory, sfc.feetype, fc.category_name, fc.prefix, fc.id as cat";
        $table = "fee_allocation feea JOIN studentreg sreg ON sreg.id = feea.student JOIN sub_fee_category sfc ON sfc.id = feea.fee_category_sub JOIN fee_category fc ON fc.id = sfc.fee_category WHERE feea.student = '$student'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function StudentFeePayP1($id, $sub) {
        $fields = "subcategory, feetype_id, student, pay_date, actual_amount, payamount, balance_amount, total_amount, fine, discount, id";
        $table = "studentfee_pay WHERE status = 'notpaid' AND student = '$id' AND subcategory = '$sub'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function StudentCheckFeesByrecipt($reciptno) {
        $table = "studentfee_pay WHERE receipt_no = '$reciptno' AND status = 'paid'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function staffCheckFeesbyRecept($reciptno) {
        $fields = "ss.*, sr.fullname, sr.address, sr.mobile, sr.email";
        $table = "staff_salary ss JOIN staff_reg sr ON sr.id = ss.staff_id WHERE ss.receipt_no = '$reciptno' AND ss.payment_status = 'paid'";
        $obj = new commonSql;
        return $obj->displaySingle($fields, $table);
    }

    public
            function getVehicles($id) {
        $table = "vehicle_reg WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function vehicleNo() {
        $fields = "id, vehicle_no";
        $table = "vehicle_reg";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function getVehiclesDrivers($id) {
        $table = "vehicle_drive WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function getVehiclesRoute($id) {
        $table = "vehicle_route WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function vehicleRoute() {
        $fields = "vehicle, r_code, start_place, stop_place, id";
        $table = "vehicle_route WHERE active = 'yes'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function destinationGetbyid($id) {
        $table = "destination WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function destinationfeeStype($id) {
        $fields = "id, desitnation, start_date, due_date, end_date";
        $table = "destination_fees WHERE desitnation = '$id'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function Selectdestinationbycode($code) {
        $fields = "id, r_code, pick_drop, stop_time, amount, fee_type, status";
        $table = "destination WHERE r_code = '$code'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function transAllocbyUsertyp($usertype) {
        $table = "transport_allocation WHERE usertype = '$usertype'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function SelecttransAllocationbyusers($usertype, $user) {
        $fields = "id, destination, route";
        $table = "transport_allocation WHERE usertype = '$usertype' AND user = '$user'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function leaveCheckRemainingxbyDate($leaveCat, $staff, $date) {
        $fields = "id, leave_category, department, staff, permanent_date, status, remaining_leave";
        $table = "leave_application WHERE leave_category = '$leaveCat' AND staff = '$staff' AND permanent_date <= '$date'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function leaveCheckRemainingxbyDateSingle($leaveCat, $staff, $date) {
//        $fields = "id, leave_category, department, staff, permanent_date, fdate, tdate, count_leaves, reason, status, remaining_leave";
        $table = "leave_application WHERE leave_category = '$leaveCat' AND staff = '$staff' AND permanent_date <= '$date'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function getLeavesCate($category, $department) {
        $table = "leave_detail_category WHERE id = '$category' AND department = '$department'";
        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function getSingleChildleaveApp($id) {
        $table = "leave_application_child WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function AllClassSubjects() {
        $fields = "id, sub_id, sub_name, color";
        $table = "class_subject";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function getSubjecSIngle($id) {
        $table = "class_subject WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function getExactTime($paperid) {
        $table = "tbl_exam_paper WHERE paper_id = '$paperid'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function getMaxTimetable() {
        $fields = "MAX(timetable_id)";
        $table = "multi_timetable";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public
            function getTimeTableid($grade) {
        $fields = "timetable_id";
        $table = "multi_timetable WHERE grade = '$grade' GROUP BY timetable_id";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function getTimeTableProfid($grade) {
        $fields = "timetable_id";
        $table = "school_timetable WHERE grade = '$grade' GROUP BY timetable_id";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function loadtimetblbyTBno($timetable_id) {
        $fields = "term, year, grade, name_of_timetbl, timetable_id, subject_det, id";
        $table = "multi_timetable WHERE timetable_id = '$timetable_id'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function ProfDraggetMaxTimetable() {
        $fields = "MAX(timetable_id)";
        $table = "school_timetable";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public
            function ProfDraggetMaxExamTimetable() {
        $fields = "MAX(timetable_id)";
        $table = "school_exam";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public
            function CountMaxWeektimesubject($timetable_id) {
        $fields = "COUNT(id)";
        $table = "school_timetable_child WHERE timetable_id = '$timetable_id'";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public
            function getWeekTimeSubject($timetable_id) {
        $table = "school_timetable_child WHERE timetable_id = '$timetable_id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function getWeekTimeSubjectClassTimetable($timetable_id) {
        $table = "school_timetable WHERE timetable_id = '$timetable_id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function StudentCheckFeesByAllrecipt($reciptno) {
        $fields = "id, subcategory, feetype_id, student, pay_date, actual_amount, payamount, balance_amount, total_amount, fine, discount, prefix, indvidual_receipt, receipt_no, modeof_pay, bank, chequeno, chequedate, totalamount, remarks";
        $table = "studentfee_pay WHERE receipt_no = '$reciptno' AND status = 'paid'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function StudentfeeStype($id) {
        $table = "fees_types WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function branchSelect() {
        $fields = "name, id";
        $table = "branch WHERE active = 'yes'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function tableSubjectExam() {
        $fields = "subject_id, subject_name_id, grade, language, unit,  status";
        $table = "tbl_subject WHERE status = 'pending'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function CheckDuplicationExamSUbjectPaper($subject, $grade, $lang, $term) {
        $fields = "COUNT(subject_id)";
        $table = "tbl_subject WHERE subject_name_id = '$subject' AND grade = '$grade' AND language = '$lang' AND unit = '$term' AND status = 'pending'";
        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public
            function CheckDuplicationExamPaper($subjectid) {
        $fields = "COUNT(paper_id)";
        $table = "tbl_exam_paper WHERE subject_id = '$subjectid' AND status = 'pending'";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public
            function MaxExamPaperNo() {
        $fields = "MAX(exampaper_no)";
        $table = "tbl_exam_paper";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public
            function fullPaperno() {
        $fields = "exampaper_no, paper_id";
        $table = "tbl_exam_paper WHERE status = 'pending'";

        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function ExamPaper($id) {
        $table = "tbl_exam_paper WHERE paper_id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function getSubjectsbyPaperid($id) {
        $table = "tbl_subject WHERE subject_id = '$id'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function NoOfQuestioninQuestiontb($paperid) {
        $fields = "COUNT(question_id)";
        $table = "tbl_question WHERE paper_id = '$paperid'";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public
            function getallPapers() {
        $fields = "tep.paper_id as id, tep.exampaper_no as exampaper_no, cs.sub_name as subject";
        $table = "tbl_exam_paper tep JOIN tbl_subject ts ON tep.subject_id = ts.subject_id JOIN class_subject cs ON ts.subject_name_id = cs.id WHERE tep.status = 'closed'";
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function getExamBooking() {
        $fields = "MAX(id)";
        $table = "tbl_exam_book";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public
            function CheckbookingDup($paperno, $student) {
        $fields = "COUNT(id)";
        $table = "tbl_exam_book WHERE student_id = '$student' AND paperid = '$paperno' AND status = 'booked'";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public
            function ChecchilparentDup($student) {
        $fields = "COUNT(id)";
        $table = "parent_children WHERE studentid = '$student' AND status = 'yes'";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public
            function getuserdetails($email) {
        $table = "user_reg WHERE email = '$email'";

        $obj = new commonSql;
        return $obj->display($table);
    }

    public
            function inboxmail($id) {
        $fields = "mm.id, mm.frommail, mm.tomail, mm.subject, mm.remarks, ur.first_name, (SELECT user_reg.first_name FROM user_reg WHERE user_reg.id = mm.fromid) as fromname";
        $table = "message_mail mm JOIN user_reg ur ON ur.id = mm.toid WHERE mm.status = '0' AND mm.toid = '$id'";
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function inboxallmail($id) {
        $fields = "mm.id, mm.frommail, mm.tomail, mm.subject, mm.remarks, ur.first_name, (SELECT user_reg.first_name FROM user_reg WHERE user_reg.id = mm.fromid) as fromname";
        $table = "message_mail mm JOIN user_reg ur ON ur.id = mm.toid WHERE mm.toid = '$id'";
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function sentboxmail($id) {
        $fields = "mm.id, mm.frommail, mm.tomail, mm.subject, mm.remarks, ur.first_name, (SELECT user_reg.first_name FROM user_reg WHERE user_reg.id = mm.toid) as toname";
        $table = "message_mail mm JOIN user_reg ur ON ur.id = mm.toid WHERE mm.fromid = '$id'";
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function inboxmailsingle($id) {

        $fields = "mm.id, mm.frommail, mm.tomail, mm.subject, mm.remarks, ur.first_name, (SELECT user_reg.first_name FROM user_reg WHERE user_reg.id = mm.fromid) as fromname";
        $table = "message_mail mm JOIN user_reg ur ON ur.id = mm.toid WHERE mm.id = '$id'";
        $obj = new commonSql;
        return $obj->displaySingle($fields, $table);
    }

    public
            function singleStafffs($id) {

        $fields = "ur.id as id, ur.username, sr.fullname, sr.address, sr.gender, sr.dob, sr.mobile, sr.email, sd.name, sd.id as depid, sr.id as staffid, ur.usertype";
        $table = "user_reg ur JOIN staff_reg sr ON sr.code = ur.username JOIN staff_department sd ON sd.id = sr.department WHERE ur.usertype = '4' AND ur.id = '$id'";
        $obj = new commonSql;
        return $obj->displaySingle($fields, $table);
    }

    public
            function CountFeeAllocation($subcat, $student) {
        $fields = "COUNT(id)";
        $table = "fee_allocation WHERE fee_category_sub = '$subcat' AND student = '$student' AND active = 'yes'";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public
            function listdownpayment($student, $subcat, $cat) {
        $fields = "feea.*, ft.start_date, ft.due_date, ft.end_date, ft.id as feetypeid, sreg.studentname, sreg.studentcode, sfc.feetype as feetypes";
        $table = "fees_types ft JOIN fee_allocation feea ON ft.parent_sub_category = feea.fee_category_sub JOIN studentreg sreg ON sreg.id = feea.student JOIN sub_fee_category sfc ON feea.fee_category_sub = sfc.id JOIN fee_category fc ON fc.id = feea.fee_category WHERE feea.student = '$student' AND feea.fee_category_sub = '$subcat' AND feea.fee_category = '$cat'";
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public
            function listdownpaymentWithoutCat($student, $subcat) {
        $fields = "feea.*, ft.start_date, ft.due_date, ft.end_date, ft.id as feetypeid, sreg.studentname, sreg.studentcode, sfc.feetype as feetypes";
        $table = "fees_types ft JOIN fee_allocation feea ON ft.parent_sub_category = feea.fee_category_sub JOIN studentreg sreg ON sreg.id = feea.student JOIN sub_fee_category sfc ON feea.fee_category_sub = sfc.id JOIN fee_category fc ON fc.id = feea.fee_category WHERE feea.student = '$student' AND feea.fee_category_sub = '$subcat'";
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function

    listSumpayment($student, $subcat, $cat) {
        $fields = "SUM(feea.amount) as sumamount, feea.amount as amount";
        $table = "fees_types ft JOIN fee_allocation feea ON ft.parent_sub_category = feea.fee_category_sub JOIN studentreg sreg ON sreg.id = feea.student JOIN sub_fee_category sfc ON feea.fee_category_sub = sfc.id JOIN fee_category fc ON fc.id = feea.fee_category WHERE feea.student = '$student' AND feea.fee_category_sub = '$subcat' AND feea.fee_category = '$cat'";
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function

    singStudenpayCount($sub, $feetpe, $student) {
        $fields = "COUNT(id)";
        $table = "studentfee_pay WHERE subcategory = '$sub' AND feetype_id = '$feetpe' AND student = '$student'";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function singStudenpay($sub, $feetpe, $student) {
        $fields = "id";
        $table = "studentfee_pay WHERE subcategory = '$sub' AND feetype_id = '$feetpe' AND student = '$student'";

        $obj = new commonSql;
        return $obj->displaySingle($fields, $table);
    }

    public function getTotClassAllocation($staff, $class) {
        $fields = "COUNT(id)";
        $table = "class_allocation WHERE class_reg_id = '$class' AND staff_reg_id = '$staff' AND active = '1'";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }
    public function getTotClassAllocationagin($staff) {
        $fields = "COUNT(id)";
        $table = "class_allocation WHERE staff_reg_id = '$staff' AND active = '1'";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function showclassallocation() {
        $fields = "CONCAT(cr.gradenumber,' - ',cr.gradesection) as classname, sr.fullname as name";
        $table = "class_allocation ca JOIN staff_reg sr ON sr.id = ca.staff_reg_id JOIN class_register cr ON cr.id = ca.class_reg_id WHERE ca.active = '1'";
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function getAllStudentAttendance($staffid) {
        $fields = "sreg.id as id, sreg.studentname as studentname, sreg.studentcode as studentcode";
        $table = "class_allocation ca JOIN staff_reg sr ON sr.id = ca.staff_reg_id JOIN class_register cr ON cr.id = ca.class_reg_id JOIN studentreg sreg ON sreg.grade = cr.id WHERE sr.id = '$staffid' GROUP BY sreg.id";
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function singClassAll($staffid) {
        $fields = "cr.id as classid, CONCAT(cr.gradenumber,' - ',cr.gradesection) as classname";
        $table = "class_allocation ca JOIN staff_reg sr ON sr.id = ca.staff_reg_id JOIN class_register cr ON cr.id = ca.class_reg_id WHERE ca.staff_reg_id = '$staffid' AND ca.active = '1'";

        $obj = new commonSql;
        return $obj->displaySingle($fields, $table);
    }

    public function singClassAllCOUNT($staffid) {
        $fields = "COUNT(cr.id)";
        $table = "class_allocation ca JOIN staff_reg sr ON sr.id = ca.staff_reg_id JOIN class_register cr ON cr.id = ca.class_reg_id WHERE ca.staff_reg_id = '$staffid' AND ca.active = '1'";

        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }

    public function getAllStudentbyParents($userid) {
        $fields = "pchild.id as parentcID, pchild.parentid as parentid, pchild.studentid, sreg.studentname, sreg.studentcode, CONCAT(creg.gradenumber,' - ',creg.gradesection) AS grades, creg.id as gradeid";
        $table = "parent_children pchild JOIN user_reg ureg ON ureg.id = pchild.parentid JOIN user_type utype ON utype.id = '5' JOIN studentreg sreg ON sreg.id = pchild.studentid JOIN class_register creg ON sreg.grade = creg.id WHERE pchild.parentid = '$userid' ORDER BY sreg.id";
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }

    public function singStudentbyidj($studentid) {
        $fields = "CONCAT(creg.gradenumber, ' - ', creg.gradesection) as gradename, creg.id as gradeid, sreg.studentname as studentname";
        $table = "studentreg sreg JOIN class_register creg ON creg.id = sreg.grade WHERE sreg.id = '$studentid' AND  sreg.active = 'yes'";

        $obj = new commonSql;
        return $obj->displaySingle($fields, $table);
    }
    
    public function singStudentbysession($sessionuser) {
        $fields = "sreg.id as studentid, sreg.grade as gradeid, CONCAT(g.gradenumber, ' - ', g.gradesection) as gradename";
        $table = "user_reg ureg INNER JOIN studentreg sreg ON sreg.studentcode = ureg.username JOIN user_type utype ON ureg.usertype = 6 JOIN class_register g ON g.id = sreg	.grade  WHERE ureg.id = '$sessionuser' GROUP BY ureg.id";

        $obj = new commonSql;
        return $obj->displaySingle($fields, $table);
    }
    
    public function singReultsheet($id) {
        $fields = "tbl.track";
        $table = " tbl_result tbl WHERE id = '$id'";

        $obj = new commonSql;
        return $obj->displaySingle($fields, $table);
    }

}
