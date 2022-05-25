<?php

class questionController {

    public function postAcceptor() {
        $accepted_origins = array("http://localhost:8001", "http://192.168.1.1");
        $imageFolder = "public/media/";
        reset($_FILES);
        $temp = current($_FILES);
        if (is_uploaded_file($temp['tmp_name'])) {
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
                } else {
                    header("HTTP/1.0 403 Origin Denied");
                    return;
                }
            }
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.0 500 Invalid file name.");
                return;
            }
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
                header("HTTP/1.0 500 Invalid extension.");
                return;
            }
            $filetowrite = $imageFolder . $temp['name'];
            move_uploaded_file($temp['tmp_name'], $filetowrite);
            echo json_encode(array('location' => $filetowrite));
        } else {
            header("HTTP/1.0 500 Server Error");
        }
    }

    public function loadQpad() {
        $dm = new commonSql();
        $paperid = $_POST['paper'];
        $noofquestion = $_POST['noofquestion'];
        $savedQue = [];
        $query = sprintf("`tbl_question` WHERE paper_id = %s", $paperid);
        /* execute the query and get the results here */
        $result = $dm->displayQs($query);
        foreach ($result as $key) {
            array_push($savedQue, $key->question_order);
        }
        for ($i = 1; $i <= $noofquestion; $i++) {
            if (in_array($i, $savedQue)) {
                ?><div class="col-sm-2" style="padding: 1px"><button class="btn btn-primary col-sm-12" onclick="getQue('<?= $paperid ?>', '<?= $i ?>')"><?= $i ?></button></div><?php
            } else {
                ?><div class="col-sm-2" style="padding: 1px"><button class="btn btn-default col-sm-12" onclick="getQue(0, '<?= $i ?>')"><?= $i ?></button></div><?php
            }
        }
    }

    public function get_que() {
        $paper = $_POST['paper'];
        $que = $_POST['que'];
        $dm = new commonSql();
        $query = sprintf("`tbl_question` WHERE paper_id = %s AND question_order = %s", $paper, $que);
        $result = $dm->displayQs($query);
        $stack = [];
        foreach ($result as $key) {
            array_push($stack, $key->question_text);
            array_push($stack, $key->correct);
            $myid = $key->question_id;
        }

        $query2 = sprintf("`tbl_answers` WHERE question_id =  '%s' ORDER BY answer_order", $myid);
        $result2 = $dm->displayQs($query2);
        foreach ($result2 as $key) {
            array_push($stack, $key->answer_text);
        }
        echo json_encode($stack);
    }

    public function save_ques() {
        $data = $_POST['datum'];
        $dm = new commonSql();
      
        $query = sprintf("`tbl_question` WHERE paper_id = %s AND question_order = %s", $data[0], $data[2]);
        $result = $dm->displayQs($query);
        if (count($result) > 0) {
            //update
            foreach ($result as $key) {
                $query_que = sprintf("UPDATE `tbl_question` SET `question_text`='%s',`correct`='%s' WHERE `question_id`=%s", $data[1], $data[3], $key->question_id);
                $dm->save($query_que);
                $query_del = sprintf("DELETE FROM `tbl_answers` WHERE `question_id` = %s", $key->question_id);
                $dm->save($query_del);
                $query_ans = "INSERT INTO `tbl_answers`(`question_id`, `answer_text`, `answer_order`) VALUES ";
                for ($i = 1; $i <= 4; $i++) {
                    $query_ans .= sprintf("(%s,'%s','%s')", $key->question_id, $data[$i + 3], $i);
                    if ($i < 4) {
                        $query_ans .=",";
                    } else {
                        $query_ans .=";";
                    }
                }
                $dm->save($query_ans);
            }
        } else {
            $query_que = sprintf("INSERT INTO `tbl_question`(`paper_id`, `question_text`, `question_order`,`correct`) VALUES (%s,'%s','%s',%s)", $data[0], $data[1], $data[2], $data[3]);
            $dm->save($query_que);
            $query_id = sprintf("`tbl_question` WHERE paper_id = %s AND question_order = %s", $data[0], $data[2]);
            $question_id = $dm->displayQs($query_id);
            foreach ($question_id as $key) {
                $questionID = $key->question_id;
            }
            $query_ans = "INSERT INTO `tbl_answers`(`question_id`, `answer_text`, `answer_order`) VALUES ";
            for ($i = 1; $i <= 4; $i++) {
                $query_ans .= sprintf("(%s,'%s','%s')", $questionID, $data[$i + 3], $i);
                if ($i < 4) {
                    $query_ans .=",";
                }
            }
            // var_dump($question_id);
            $dm->save($query_ans);
        }
    }

}
?>