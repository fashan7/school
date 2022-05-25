<?php 
class materialController
{
    public function SearchStudent($search)
    {
        $fields = "id, studentname, studentcode";
        $table = "studentreg WHERE studentname LIKE '%$search%' OR studentcode LIKE '%$search%'";
        
        $obj = new dataModal;
        return $obj->displaySum($fields, $table);
    }
    
    public function SelectStudentbyid($id)
    {
        $table = "studentreg WHERE id = '$id'";
        
        $obj = new commonSql;
        return $obj->display($table);   
    }
    
    public function tablesubjectAllbygrade($grade)
    {
        $fields = "subject_id, subject_name_id, grade, language, unit";
        $table = "tbl_subject WHERE status = 'closed' AND grade = '$grade'";
        
        $obj = new dataModal;
        return $obj->displaySum($fields, $table);
    }
    
    public function examBookingDetailbySubject($tblsubject, $studentid)
    {
        $table = "tbl_exam_book WHERE subject_id = '$tblsubject' AND student_id = '$studentid' AND status = 'booked'";
        
        $obj = new commonSql;
        return $obj->display($table);   
    }
    
    public function examBookingDetailbySubjectbooked($tblsubject, $studentid)
    {
        $fields = "COUNT(id)";
        $table = "tbl_exam_book WHERE subject_id = '$tblsubject' AND student_id = '$studentid' AND status = 'booked'";
        
        $obj = new commonSql;
        return $obj->displayCount($fields, $table);   
    }
    
    public function getSubjecSIngle($id)
    {
        $table = "class_subject WHERE id = '$id'";
        
        $obj = new commonSql;
        return $obj->display($table);
    }
    
    public function exambooking($id)
    {
        $table = "tbl_exam_book WHERE id = '$id'";
        
        $obj = new commonSql;
        return $obj->display($table);
    }
    
    public function getAllBooking($status, $studentid){
        $fields = "teb.*, sreg.studentname, sreg.studentcode, classsub.sub_name, tbs.language";
        $table = "tbl_exam_book teb JOIN studentreg sreg ON teb.student_id = sreg.id JOIN tbl_subject tbs ON teb.subject_id = tbs.subject_id JOIN tbl_exam_paper tep ON teb.paperid = tep.paper_id JOIN class_subject classsub ON tbs.subject_name_id = classsub.id WHERE teb.status = '$status' AND teb.student_id = '$studentid'";
        
        $obj = new dataModal;
        return $obj->displaySum($fields, $table);
    }
    
    public function getQuestioncount($paperno)
    {
        $fields = "COUNT(question_id)";
        $table = "tbl_question WHERE paper_id = '$paperno'";
        
        $obj = new commonSql;
        return $obj->displayCount($fields, $table);   
    }
}
?>