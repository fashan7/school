<?php

class SaveController {

    public function result() {
        $dm = new dataModal();

        $totmarks = $_POST['totmarks'];
        $result = $_POST['result'];
        $student_id = $result[0];
        $exam_id = $result[1];
        $exam_result = $result[2];
        $id = '';
        $track = $result[3]; //Esacape the string. Before store
        //write query for save result table
        // id | student id | exam id | track | result // table structure
        $query_que = sprintf("INSERT INTO `tbl_result`(`student_id`, `exam_id`, `track`,`result`, `marks`) VALUES (%s,'%s','%s',%s, %s)", $student_id, $exam_id, $track, $exam_result, $totmarks);      
        $dm->savedb($query_que);

        $boookingid = $_POST['boookingid'];

        $query_que1 = sprintf("UPDATE `tbl_exam_book` SET `status`='finished' WHERE `id`=%s", $boookingid);
        $dm->savedb($query_que1);
        $strfromemail = "From: Exam Engine <fashanzak4@thewebaxis.com>";
        $stremail = "fashanzak4@gmail.com"; // student email address

        $headers = "From: $strfromemail" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        $stremailbody = ""; // type some message.. dont send track to student. paper can be leaked for next time
        // better you prepare mails in a table and call here and send
        $strsubject = "Exam Results - " . $exam_id;

        mail($stremail, $strsubject, $stremailbody, $headers);
    }
}
?>