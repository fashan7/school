<?php 
$feetype = $_POST['feetype'];
date_default_timezone_set('Asia/Colombo');
$date = date('Y-m-d');
$year = date('Y');
$month = date('m');

$increment = 0;
if($feetype == 'Annual')
{
    $increment = 1;
}
else if($feetype == 'Bi-Annual')
{
    $increment = 2;
}
else if($feetype == 'Tri-Annual')
{
    $increment = 3;
}
else if($feetype == 'Quaterly')
{
    $increment = 4;
}
else if($feetype == 'Monthly')
{
    $increment = 12;
}
else if($feetype == 'One-Time')
{
    $increment = 1;
}
?>
<link rel="stylesheet" href="/../public/js/bootstrap-datepicker/css/datepicker.css">
<script type="text/javascript" src="/../public/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<div class="col-lg-12">
    <div class="box-header">
        <h3 class="box-title"><b>Fees Dates</b></h3>
    </div>
</div>
<?php 
for($i = 1; $i <= $increment; $i++)
{
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
        </div>
        <span class="help-block" id="error"></span>
    </div>
</div>
<?php 
}
?>
<script>
$(document).ready(function (){
    for(var i = 1; i <= <?=$increment?>; i++)
    {
        $('#startdate'+i).datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#duedate'+i).datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#enddate'+i).datepicker({
            format: 'yyyy-mm-dd'
        });
    }
    
});
</script>