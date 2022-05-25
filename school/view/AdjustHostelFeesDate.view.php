<?php
$mat = new materialController;
$hostelroomsid = $_POST['hostelroomsid'];
$monthOnly = $_POST['monthOnly'];
$resultfees = $mat->hostelFeesbyRoomID($hostelroomsid);
$month = substr("$monthOnly",0 ,2);
$year =  substr("$monthOnly",3 ,7);
?>
<script src="/../public/ajax/UpdateHostelFeesList.js"></script>
<div class="box-header with-border">
    <h3 class="box-title">Hostel Fees Dates</h3>
</div>    
<form method="post" id="updateFeesList" role="form">
<div class="box-body">
<?php 
$i = 1;
foreach($resultfees as $row){
    $date = $year."-".$month."-01";
    $effectiveDate = date('Y-m-d', strtotime("+$i months", strtotime($date)));
    $effectiveMonth = date('m', strtotime("+$i months", strtotime($date)));
    $effectiveYear = date('Y', strtotime("+$i months", strtotime($date)));
    
    $lastday = date("t", strtotime($effectiveDate));
    
    $startDate = $effectiveYear."-".$effectiveMonth."-01";
    $duedate = $effectiveYear."-".$effectiveMonth."-15";
    $endDate = $effectiveYear."-".$effectiveMonth."-".$lastday;
?>
<div class="col-lg-4">
    <div class="form-group">
        <label for="Start Date">Start Date</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="startdate<?=$i?>" name="startdate<?=$i?>" value="<?=$startDate?>" readonly>
        </div>
        <span class="help-block" id="error"></span>
    </div>
</div>
<div class="col-lg-4">
    <div class="form-group">
        <label for="Due Date">Due Date</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="duedate<?=$i?>" name="duedate<?=$i?>" value="<?=$duedate?>" readonly>
        </div>
        <span class="help-block" id="error"></span>
    </div>
</div>
<div class="col-lg-4">
    <div class="form-group">
        <label for="End Date">End Date</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="enddate<?=$i?>" name="enddate<?=$i?>" value="<?=$endDate?>" readonly>
            <input type="hidden" name="feestypeid<?=$i?>" id="feestypeid<?=$i?>" value="<?=$row['id']?>">
        </div>
        <span class="help-block" id="error"></span>
    </div>
</div>

        <?php
    $i++;
    }
    ?>
</div>
<div class=" col-lg-4">
    <div class="form-group" id="hidebuttonup">
        <input type="hidden" name="totalCOunt" id="totalCOunt" value="<?=$i?>">
        <button type="submit" class="btn btn-warning" id="update" name="update">Update</button> 
    </div>
</div>
</form>
<script>
$(document).ready(function (){
    $('.dpMonths').datepicker({});    
    for(var y = 1; y <= <?=$i?>; y++)
    {
        $('#startdate'+y).datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#duedate'+y).datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#enddate'+y).datepicker({
            format: 'yyyy-mm-dd'
        });
    }    
});
</script>