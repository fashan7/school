<?php 
$mat = new materialController;
$usertype = $_POST['usertype'];
$userid = $_POST['userid'];
$amount = 0;
$roomid = '';$feestype = '';
if($usertype == 'student')
{
    $result = $mat->HostelMemRegSearch($userid, $usertype);
    $roomid = $result['hostel_room'];
    
    $resultRoom = $mat->hostelRoomsDetails($roomid);
    $amount = $resultRoom['amount'];
    $feestype = $resultRoom['fees_type'];
}
else if($usertype == 'employee')
{
    $result = $mat->HostelMemRegSearch($userid, $usertype);
    $roomid = $result['hostel_room'];
    
    $resultRoom = $mat->hostelRoomsDetails($roomid);
    $amount = $resultRoom['amount'];
    $feestype = $resultRoom['fees_type'];
}
?>

    <div class="col-lg-4">
        <div class="form-group">
            <label for="UserType">FeeType</label>
            <select  name="feetypes[]" id="feetypes" class="form-control select2" style="width: 100%;" multiple="multiple" onchange="FeesCal();Totalcal();">
                <option value="" disabled="disabled">-- Select Month --</option>
                <?php 
                $resultFees = $mat->hostelFeesbyRoomID($roomid);
                foreach($resultFees as $rowFees){
                    $checkResultFees = $mat->HostelCheckFeesByFeeid($userid, $usertype, $rowFees['id']);
                    if($checkResultFees['fees_id'] == $rowFees['id'])
                    {
                        ?>
                        <option value="<?=$rowFees['id']?>" disabled><?=$feestype?> (<?=$rowFees['start_date']?>/<?=$rowFees['end_date']?>)</option>
                        <?php
                    }
                    else
                    {
                       ?>
                        <option value="<?=$rowFees['id']?>"><?=$feestype?> (<?=$rowFees['start_date']?>/<?=$rowFees['end_date']?>)</option>
                        <?php 
                    }                    
                }
                $Nomonths = COUNT($resultFees);
                $totalamount = $Nomonths * $amount;
                ?>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="Amount">Amount</label>
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount Will AutoLoad" autocomplete="off" value="<?=$amount?>" onchange="Totalcal();" readonly>
            <input type="hidden" name="roomid" id="roomid" value="<?=$roomid?>">
            <input type="hidden" name="noofmonths" id="noofmonths" value="<?=$Nomonths?>">
            <input type="hidden" name="calculatedTotalAmount" id="calculatedTotalAmount" value="<?=$totalamount?>">
            <input type="hidden" name="singleAmount" id="singleAmount" value="<?=$amount?>">
            <span class="help-block" id="error"></span>
        </div>
    </div>
    <div class="col-lg-4"></div>
<script>
$(document).ready(function () {    
    $('.select2').select2(); 
});
</script>