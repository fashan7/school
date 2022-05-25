<?php

class pageController {

    public function home() {
        view("index");
    }

    public function login() {
        view("login");
    }

    public function errorpage() {
        view("404");
    }

    public function checkLogin() {
        view("checkLogin");
    }

    public function header() {
        view("header");
    }

    public function dashboard() {
        view("dashboard");
    }

    public function menu() {
        view("menu");
    }

    public function testsubmit() {
        view("submit");
    }

    public function formloaddetails() {
        view("detail");
    }

    public function staffRegister() {
        view("staffRegister");
    }

    public function staffUpdate() {
        view("staffUpdate");
    }

    public function staffView() {
        view("staffView");
    }

    public function userPrivilege() {
        view("userPrivilege");
    }

    public function getDetailsofUserPrivilage() {
        view("getDetailsofUserPrivilage");
    }

    public function userRegister() {
        view("userRegister");
    }

    public function userPasswordChange() {
        view("userPasswordChange");
    }

    public function userType() {
        view("userType");
    }

    public function classSchedule() {
        view("classSchedule");
    }

    public function gradeCreation() {
        view("gradeCreation");
    }

    public function classtimeTb() {
        view("classtimeTb");
    }

    public function test() {
        view("test");
    }

    public function classTimeTablePrint() {
        view("classTimeTablePrint");
    }

    public function printClass() {
        view("printClass");
    }

    public function examinationSchedule() {
        view("examinationSchedule");
    }

    public function ExamTimeTablePrint() {
        view("ExamTimeTablePrint");
    }

    public function printExam() {
        view("printExam");
    }

    public function staffAttendance() {
        view("staffAttendance");
    }

    public function studentRegister() {
        view("studentRegister");
    }

    public function studentUpdate() {
        view("studentUpdate");
    }

    public function studentFees() {
        view("studentFees");
    }

    public function paymentProcess() {
        view("paymentProcess");
    }

    public function printStudentSlip() {
        view("printStudentSlip");
    }

    public function CreateSubject() {
        view("CreateSubject");
    }

    public function CreateExamTime() {
        view("CreateExamTime");
    }

    public function staffSalary() {
        view("staffSalary");
    }

    public function SalaryProcess() {
        view("SalaryProcess");
    }

    public function printSalarySlip() {
        view("printSalarySlip");
    }

    public function searchSalary() {
        view("searchSalary");
    }

    public function searchStudentFees() {
        view("searchStudentFees");
    }

    public function staffDepartment() {
        view("staffDepartment");
    }

    public function bankdetails() {
        view("bankdetails");
    }

    public function Attendance() {
        view("Attendance");
    }

    public function AttendanceReport() {
        view("AttendanceReport");
    }

    public function printStaffAttendance() {
        view("printStaffAttendance");
    }

    public function leaveCategory() {
        view("leaveCategory");
    }

    public function leaveDetails() {
        view("leaveDetails");
    }

    public function leaveApplication() {
        view("leaveApplication");
    }

    public function getLeaveApplicantDet() {
        view("getLeaveApplicantDet");
    }

    public function leaveApproval() {
        view("leaveApproval");
    }

    public function libraryCategory() {
        view("libraryCategory");
    }

    public function AddBooks() {
        view("AddBooks");
    }

    public function getUpdateBookCategory() {
        view("getUpdateBookCategory");
    }

    public function AddBooksRegister() {
        view("AddBooksRegister");
    }

    public function issueBooks() {
        view("issueBooks");
    }

    public function ShowUpDetails() {
        view("ShowUpDetails");
    }

    public function AutoCompleteUserType() {
        view("AutoCompleteUserType");
    }

    public function bookReturn() {
        view("bookReturn");
    }

    public function ShowsUpDetails() {
        view("ShowsUpDetails");
    }

    public function hostelDetails() {
        view("hostelDetails");
    }

    public function hostelTypeUpdate() {
        view("hostelTypeUpdate");
    }

    public function UpdateHostelDetails() {
        view("UpdateHostelDetails");
    }

    public function hostelRooms() {
        view("hostelRooms");
    }

    public function HostelFeesType() {
        view("HostelFeesType");
    }

    public function hostelAllocation() {
        view("hostelAllocation");
    }

    public function qbank() {
        view("qbank");
    }

    public function RoomsDetails() {
        view("RoomsDetails");
    }

    public function hostelTransfer() {
        view("hostelTransfer");
    }

    public function HostelFeeCollection() {
        view("HostelFeeCollection");
    }

    public function GetFeesHostel() {
        view("GetFeesHostel");
    }

    public function hostelInvoice() {
        view("hostelInvoice");
    }

    public function studentAttendance() {
        view("studentAttendance");
    }

    public function AttendanceStudent() {
        view("AttendanceStudent");
    }

    public function AttendanceReportStudent() {
        view("AttendanceReportStudent");
    }

    public function printStudentAttendance() {
        view("printStudentAttendance");
    }

    public function addVehicle() {
        view("addVehicle");
    }

    public function FeeCategory() {
        view("FeeCategory");
    }

    public function FeeSubCategory() {
        view("FeeSubCategory");
    }

    public function getUpdateFeeCategory() {
        view("getUpdateFeeCategory");
    }

    public function FeesTypes() {
        view("FeesTypes");
    }

    public function UpdateFeesDates() {
        view("UpdateFeesDates");
    }

    public function AdjustFeesDate() {
        view("AdjustFeesDate");
    }

    public function FeeSubCategoryFine() {
        view("FeeSubCategoryFine");
    }

    public function FeeAllocation() {
        view("FeeAllocation");
    }

    public function FeeCollection() {
        view("FeeCollection");
    }

    public function StudentDetails() {
        view("StudentDetails");
    }

    public function StudentPaymentDetailsForm() {
        view("StudentPaymentDetailsForm");
    }

    public function UpdateAddVehicle() {
        view("UpdateAddVehicle");
    }

    public function addDriver() {
        view("addDriver");
    }

    public function UpdateAddVehicleDriver() {
        view("UpdateAddVehicleDriver");
    }

    public function UpdateHostelFeesDates() {
        view("UpdateHostelFeesDates");
    }

    public function AdjustHostelFeesDate() {
        view("AdjustHostelFeesDate");
    }

    public function addRoute() {
        view("addRoute");
    }

    public function UpdateVehicleRoute() {
        view("UpdateVehicleRoute");
    }

    public function addDestination() {
        view("addDestination");
    }

    public function TransportFeesTypes() {
        view("TransportFeesTypes");
    }

    public function UpdateDestination() {
        view("UpdateDestination");
    }

    public function UpdateDestinationFeesTypes() {
        view("UpdateDestinationFeesTypes");
    }

    public function AdjustDestinationFeesDate() {
        view("AdjustDestinationFeesDate");
    }

    public function transportAllocation() {
        view("transportAllocation");
    }

    public function AutoCompleteUserTypeforVehicle() {
        view("AutoCompleteUserTypeforVehicle");
    }

    public function AllocatedUsersforTransport() {
        view("AllocatedUsersforTransport");
    }

    public function TransportCollection() {
        view("TransportCollection");
    }

    public function mail() {
        view("mail");
    }

    public function compose() {
        view("compose");
    }

    public function inBox() {
        view("inBox");
    }

    public function setTimeTable() {
        view("setTimeTable");
    }

    public function viewTimeTable() {
        view("viewTimeTable");
    }

    public function LoadTimeTablePrint() {
        view("LoadTimeTablePrint");
    }

    public function createTimeTable() {
        view("createTimeTable");
    }

    public function editTimeTable() {
        view("editTimeTable");
    }

    public function TimeTableEdit() {
        view("TimeTableEdit");
    }

    public function Branch() {
        view("Branch");
    }

    public function ExamPaperCreation() {
        view("ExamPaperCreation");
    }

    public function bookExampage() {
        view("bookExam");
    }

    public function teacherlogin() {
        view("teacherlogin");
    }

    public function studentportal() {
        view("studentportal");
    }

    public function parent_reg() {
        view("parent_reg");
    }

    public function parentsportal() {
        view("parentsportal");
    }

    public function listinbox() {
        view("listinbox");
    }

    public function listsentbox() {
        view("listsentbox");
    }

    public function listallinbox() {
        view("listallinbox");
    }

    public function sentBox() {
        view("sentBox");
    }

    public function TeacherleaveApplication() {
        view("TeacherleaveApplication");
    }

    public function class_allocation() {
        view("class_allocation");
    }

    public function studentAttendanceMark() {
        view("studentAttendanceMark");
    }

    public function AttendanceReportStudentV() {
        view("AttendanceReportStudentV");
    }

    public function printStudentAttendanceV() {
        view("printStudentAttendanceV");
    }

    public function check_children() {
        session_start();
        $mat = new materialController;
        $data['resultLoop'] = $mat->getAllStudentbyParents($_SESSION['loguserid']);
        view("check_children", $data);
    }

    public function AttendanceReportStudentP() {
        view("AttendanceReportStudentP");
    }

    public function printStudentAttendanceP() {
        view("printStudentAttendanceP");
    }

    public function studentAttendanceV() {
        session_start();
        $mat = new materialController;
        $data['resultLoop'] = $mat->singStudentbysession($_SESSION['loguserid']);
        view("studentAttendanceV", $data);
    }

    public function AttendanceReportofMy() {
        view("AttendanceReportofMy");
    }

    public function check_child_payments() {
        session_start();
        $mat = new materialController;
        $data['resultLoop'] = $mat->getAllStudentbyParents($_SESSION['loguserid']);
        view("check_child_payments", $data);
    }

    public function check_examresults() {
        view("check_examresults");
    }

    public function getExamResultDet() {
        view("getExamResultDet");
    }

    public function check_examresultss() {
        view("check_examresultss");
    }

    public function check_children_examresult() {
        session_start();
        $mat = new materialController;
        $data['resultLoop'] = $mat->getAllStudentbyParents($_SESSION['loguserid']);
        view("check_children_examresult", $data);
    }

}
