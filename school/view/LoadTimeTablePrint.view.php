<?php 
$obj = new detailsController;
$objpage = new pageController;
$mat = new materialController;
$arr = array();
$timetblno = $_POST['timetblno'];
$row = $obj->valueofTimetablesingle($timetblno);
$count= count($row);

$Result12 = $mat->getWeekTimeSubject($timetblno);
$startperiod = $Result12['firstperiod'];
$oneperioddur = $Result12['period_dur'];
$intervalperiod = $Result12['period_int'];
$noofperiod = $Result12['no_of_period'];
$Intduration = $Result12['interval_dur']; 

if($count != 0)
{
?>
    <div class="row">        
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <?php 
                    foreach($row as $res){
                        $arr[0] = $res['className'];
                        $arr[1] = $res['year'];
                    }
                    ?>
                    <h3 class="box-title">Class TimeTable of &nbsp;<?=$arr[0]?>&nbsp;<small><?=$arr[1]?></small></h3>
                </div>
                <div class="box-body">
                    <table id="table2" class="table order-list" border="1">
                        <tbody>
                            <tr>
                                <td class="redips-mark blank">Hours</td>
                                <td class="redips-mark dark">Monday</td>
                                <td class="redips-mark dark">Tuesday</td>
                                <td class="redips-mark dark">Wednesday</td>
                                <td class="redips-mark dark">Thursday</td>
                                <td class="redips-mark dark">Friday</td>
<!--                                <td class="redips-mark dark">Saturday</td>-->
                            </tr>
                            <?php 
                                $time = '';
                                for($i = 1; $i <= $noofperiod; $i++)
                                {                                                                       
                                    if($intervalperiod == $i)
                                    {
                                        $TimeDuration = date("H:i", strtotime('+' .$Intduration.' minutes', $time)); 
                                        $time = strtotime($TimeDuration);
                                        ?>
                                        <tr>
                                            <td class="redips-mark dark"><?=$TimeDuration?></td>
                                            <td class="redips-mark lunch" colspan="5">Interval</td>
                                        </tr>
                                        <?php
                                    }
                                    else if($i == 1)
                                    {
                                        $time = strtotime($startperiod);                                    
                                        $obj->ValuesOfClassTimetable($startperiod, $i, $timetblno); 
                                    }
                                    else
                                    {   
                                        $TimeDuration = date("H:i", strtotime('+' .$oneperioddur.' minutes', $time));
                                        $obj->ValuesOfClassTimetable($TimeDuration, $i, $timetblno); 
                                        $time = strtotime($TimeDuration);
                                    }
                                }                                
                                ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer" id="hidebutton">
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="printClass?TimeTableNo=<?=$timetblno?>"><button type="button" name="print" id="print" class="btn btn-warning btn-flat" >Print</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
    </div>
<?php 
} 
else
{
    echo "<i><b><center>All Data Are Removed  </center></b></i>";?><i><b><center><a href="classSchedule">Create a New TimeTable</a></center></b></i><?php
}
?>