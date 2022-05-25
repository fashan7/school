<?php

class ShowController {

    public function getAllTime() {
        $examid = $_GET['exid'];
        $obj = new dataModal;
        $query = sprintf("tbl_exam_book LEFT JOIN tbl_exam_paper ON  tbl_exam_book.paperid = tbl_exam_paper.paper_id WHERE tbl_exam_book.status = 'booked' AND tbl_exam_book.id = '%s'", $examid);
        $result = $obj->display($query);
//        foreach ($result as $key) {
//           
//        }
        $date = $result[0]->exam_date;
        $startT = $result[0]->exam_start;
        $endT = $result[0]->exam_end;
        $noq = $result[0]->no_of_question;

        $startTime = date_create($date . " " . $startT, timezone_open("Asia/Colombo"));
        $startStamp = date_timestamp_get($startTime);

        $endTime = date_create($date . " " . $endT, timezone_open("Asia/Colombo"));
        $endStamp = date_timestamp_get($endTime);


        $duration = $endStamp - $startStamp;
        $current = $endStamp - $startStamp;


        echo json_encode(array($duration, $current, $noq, $date, $startT, $endT));
    }

    public function getAllQuestion() {
        $examid = $_GET['exid'];
        $query = "`tbl_exam_book` WHERE status = 'booked' AND `id` = '$examid'";
        $obj = new dataModal;
        $result = $obj->display($query);

        foreach ($result as $r) {
            $query_extended = "tbl_question INNER JOIN `tbl_exam_paper` ON tbl_exam_paper.paper_id = tbl_question.paper_id WHERE subject_id = '" . $r->subject_id . "'";
            $result_extended = $obj->display($query_extended);
            $i = 1;
            foreach ($result_extended as $ext) {
                ?>
                <div id="Question<?= $i ?>" style="display: none">
                    <div class="well" style="height: 200px" id="Queno">
                        <div class="row">
                            <div class="col-sm-12" style="font-size: 16px;"><strong id="QNO"><?= $i ?></strong></div>
                            <div class="col-sm-12 QueTXT<?= $i ?>" id="QueTXT<?= $i ?>" style="height:100%;overflow-y: auto"><?= $ext->question_text ?></div>
                        </div>
                        <div class="col-sm-12"><a href="javascript:void(0)" class="pull-right" style="bottom: 0;" onclick="$.alert($('.QueTXT<?= $i ?>').html())">Preview</a></div>
                    </div>
                    <div class="row" id="anspanel<?= $i ?>">
                        <?php
                        //answer formula
                        $query_ans = "`tbl_answers` WHERE `question_id` = '" . $ext->question_id . "' ORDER BY `answer_order`";
                        $result_ans = $obj->display($query_ans);
                        $j = 1;
                        foreach ($result_ans as $ans) {
                            ?>
                            <div class="well col-md-6 Q<?= $i ?> Q<?= $i . '-' . $j ?>" style="height: 100px;">
                                <div class="col-sm-2">
                                    <input type="radio" id="ansOpt<?= $j ?>" name="ansOpt" value="<?= $j ?>" class="form-control" onchange="selectDiv('Q<?= $i ?>', '<?= $j ?>', '<?=$i?>')" />
                                </div>
                                <div class="col-sm-10 D<?= $i . '-' . $j ?>" style="height:100%;overflow-y: auto">
                                    <?= $ans->answer_text ?>
                                </div>
                                <a href="javascript:void(0)" class="pull-right" onclick="$.alert($('.D<?= $i . '-' . $j ?>').html())">Preview</a>
                            </div>
                            <?php
                            $j++;
                        }
                        ?>
                    </div>
                    <input type="hidden" id="ans<?= $i ?>" value="<?= $ext->correct ?>" />
                </div>
                <?php
                $i++;
            }
        }
    }

}
