<?php 
$mat = new materialController;
$result = $mat->SelectStudentbyGrade($_POST['gradenumber']);
$count = COUNT($result);
if($count > 0)
{
?>
<script src="/../public/ajax/attendanceStudentReg.js"></script>
<div class="box-body">
    <form method="post" id="attendanceReg" role="form">
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="allstudents">
            <thead>
                <tr>
                    <td><input type="checkbox" name="checkall" id="checkall" onclick="SetAllCheckBoxes()">&nbsp;&nbsp;Check All</td>
                    <td>Student Name</td>
                    <td>Student Code</td>
                    <td>Remarks</td>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i = 1;
            foreach($result as $row){
                ?>
                <tr>
                    <td><input type="checkbox" name="presAbs<?=$i?>" id="presAbs<?=$i?>" value="yes"></td>
                    <td>                        
                        <i><?=$row['studentname']?></i>
                        <input type="hidden" name="studentname<?=$i?>" id="studentname<?=$i?>" value="<?=$row['studentname']?>">
                        <input type="hidden" name="studentid<?=$i?>" id="studentid<?=$i?>" value="<?=$row['id']?>">
                    </td>
                    <td>                        
                        <i><?=$row['studentcode']?></i>
                        <input type="hidden" name="studentcode<?=$i?>" id="studentcode<?=$i?>" value="<?=$row['studentcode']?>">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="remarks<?=$i?>" name="remarks<?=$i?>" placeholder="Remarks">
                    </td>
                </tr>
                <?php
                $i++;
            }    
            ?>
            </tbody>
        </table>
        <input type="hidden" class="form-control" id="lasti" name="lasti" value="<?=$i?>">
        <input type="hidden" class="form-control" id="gradenumber" name="gradenumber" value="<?=$_POST['gradenumber']?>">
        <input type="hidden" class="form-control" id="datepicker" name="datepicker" value="<?=$_POST['datepicker']?>">
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <div class="form-group" id="hidebutton">
                    <button type="submit" class="btn btn-block btn-success btn-flat">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<?php 
} else{
    echo "<center><i>No Details Found</i></center>";
}
?>
<script>

function SetAllCheckBoxes()
{
	var i = document.getElementById("lasti").value;
    if(document.getElementById("checkall").checked == true)
    {
        for(var x = 1; x < i; x++)
        {
            $("#presAbs"+x).attr('checked', true);
        }
    }
    else
    {
        for(var y = 1; y < i; y++)
        {
            $("#presAbs"+y).attr('checked', false);
        }
    }
}
</script>