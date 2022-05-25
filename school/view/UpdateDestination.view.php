<?php 
$id = $_POST['id'];
$mat = new materialController;
$res = $mat->destinationGetbyid($id);
?>
<script src="/../public/ajax/DestinationUpdate.js"></script>
<form method="post" id="DestinUpd" role="form">
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label for="Route Code">Route Code</label>
                <input type="hidden" name="destid" id="destid" value="<?=$id?>">
                <select name="routecodeUpd" id="routecodeUpd" class="form-control select2" style="width: 100%;">
                    <option value="">-- Select Route Code --</option>
                    <?php 
                    $result = $mat->vehicleRoute();
                    foreach($result as $row){
                        if($res['r_code'] == $row['id'])
                        {
                            ?>
                            <option value="<?=$row['id']?>" selected><?=$row['r_code']?></option>
                            <?php 
                        }
                        else
                        {
                            ?>
                            <option value="<?=$row['id']?>" ><?=$row['r_code']?></option>
                            <?php 
                        }                    
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="Pick Up &amp; Drop">Pick Up &amp; Drop</label>
                <input type="text" class="form-control" id="pickupanddropUpd" name="pickupanddropUpd" placeholder="Enter Pick Up &amp; Drop" autocomplete="off" value="<?=$res['pick_drop']?>">
                <span class="help-block" id="error"></span>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="Stop Time">Stop Time</label>
                <div class="input-group clockpickers pull-center" data-placement="left" data-align="top" data-autoclose="true">
                    <input type="text" class="form-control" id="stoptimeUpd" name="stoptimeUpd" type="text" placeholder="Stop TIme" value="<?=$res['stop_time']?>">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
                <span class="help-block" id="error"></span>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="Amount">Amount</label>
                <input type="text" class="form-control" id="amountUpd" name="amountUpd" placeholder="Enter Amount" autocomplete="off" value="<?=$res['amount']?>">
                <span class="help-block" id="error"></span>
            </div>
        </div>
    </div>
    <div class="form-group" id="hidebuttons">
        <button type="submit" class="btn btn-warning" id="update" name="update">Update</button>   
        <a href="javascript:void(0)" class="btn btn-success" id="updateFees" name="updateFees">Update Fees Type</a>           
        <button type="button" class="btn btn-primary" id="back" name="back">Back</button>   
    </div>
</form>
<script type="text/javascript">
$('.clockpickers').clockpicker()
	.find('input').change(function(){
		console.log(this.value);
	});
var input = $('#single-input').clockpicker({
	placement: 'bottom',
	align: 'left',
	autoclose: true,
	'default': 'now'
});

$('.clockpicker-with-callbacks').clockpicker({
		donetext: 'Done',
		init: function() { 
			console.log("colorpicker initiated");
		},
		beforeShow: function() {
			console.log("before show");
		},
		afterShow: function() {
			console.log("after show");
		},
		beforeHide: function() {
			console.log("before hide");
		},
		afterHide: function() {
			console.log("after hide");
		},
		beforeHourSelect: function() {
			console.log("before hour selected");
		},
		afterHourSelect: function() {
			console.log("after hour selected");
		},
		beforeDone: function() {
			console.log("before done");
		},
		afterDone: function() {
			console.log("after done");
		}
	})
	.find('input').change(function(){
		console.log(this.value);
	});

// Manually toggle to the minutes view
$('#check-minutes').click(function(e){
	// Have to stop propagation here
	e.stopPropagation();
	input.clockpicker('show')
			.clockpicker('toggleView', 'minutes');
});
if (/mobile/i.test(navigator.userAgent)) {
	$('input').prop('readOnly', true);
}
</script>
<script>
$('#back').click(function() {
    location.reload();
});
$(document).ready(function () {  
    $('#dobUpd').datepicker({
        format: 'yyyy-mm-dd'
    });
});
$(document).on('click', '#updateFees', function(){
    var id = $('#destid').val();
    $.ajax({
        url:"UpdateDestinationFeesTypes",
        method:"POST",
        data:{id:id},
        success:function(jsonData)
        {
            $('#editDates').html("");
            $('#editDates').html(jsonData);
        }
    });
});
</script>