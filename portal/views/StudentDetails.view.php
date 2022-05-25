<?php 
$mat = new materialController;
$studentid = $_POST['studentid'];

$resultStudent = $mat->SelectStudentbyid($studentid);

$grade = $resultStudent['grade'];

$fulltableRes = $mat->tablesubjectAllbygrade($grade);
$results = $mat->getAllBooking("booked", $studentid);
?>
<div class="col-lg-12">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Subject Name</th>
                    <th scope="col">Language</th>
                    <th scope="col">Exam Date</th>
                    <th scope="col">Exam Starts</th>
                    <th scope="col">Exam Ends</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($results as $row){
                    ?>
                    <tr>
                        <td><?=$row['sub_name']?></td>
                        <td><?=$row['language']?></td>
                        <td><?=$row['exam_date']?></td>
                        <td><?=$row['exam_start']?></td>
                        <td><?=$row['exam_end']?></td>
                        <td>
                            <a href="Exam?dontRefresh=<?=$row['id']?>" class="btn btn-success pull-right startex" id="<?=$row['id']?>">Start Exam</a>
                        </td>
                    </tr>
                    <?php                   
                }
                ?>                
            </tbody>
        </table>
    </div>
</div>