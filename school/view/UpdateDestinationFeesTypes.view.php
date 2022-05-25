<?php 
$mat = new materialController;
$id = $_POST['id'];
$res = $mat->destinationGetbyid($id);
$resulta = $mat->getVehiclesRoute($res['id']);
date_default_timezone_set('Asia/Colombo');
$date = date('Y-m-d');
$year = date('Y');
$month = date('m');
?>
<link rel="stylesheet" href="/../public/js/bootstrap-datepicker/css/datepicker.css">
<script type="text/javascript" src="/../public/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<div class="row">
    <div class="col-lg-3">
        <div class="form-group">
            <label for="Route Code">Route Code</label>
            <input type="text" class="form-control" id="duproutecode" name="duproutecode"autocomplete="off" value="<?=$resulta['r_code']?>" readonly>
            <input type="hidden" name="destinationid" id="destinationid" value="<?=$res['id']?>">
            <span class="help-block" id="error"></span>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="Amount">Amount</label>
            <input type="text" class="form-control" id="amountdup" name="amountdup" placeholder="Enter Amount" autocomplete="off" value="<?=$res['amount']?>" readonly>
            <span class="help-block" id="error"></span>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="Adjust Fees Month">Adjust Fees Month</label>
            <div class="input-group date" id="hell" >
                <div class="input-group input-append date dpMonths"  data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="<?=$month?>/<?=$year?>" >
                    <div class="input-group-addon add-on" >
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" readonly class="form-control" name="monthOnly" id="monthOnly" placeholder="Click The Icon">
                </div>
            </div>
        </div> 
    </div>
    <div class="col-lg-3" style="padding-top: 24px">
        <button type="button" class="btn btn-primary" id="Go" name="Go">Go</button> 
    </div>   
</div>
<div class="row col-lg-12" id="loadDates"></div>
<script>
$(document).ready(function (){
    $('.dpMonths').datepicker({});    
});
$(document).on('click', '#Go', function(){
    var monthOnly = $('#monthOnly').val();  
    if(monthOnly == '')
    {
         $.confirm({
            icon: 'fa fa-bolt',
            title: "Warning!",
            content: "Please Select The Month To Update", 
            type: 'orange',
            typeAnimated: true
        }); 
    }
    else
    {
        var destinationid = $('#destinationid').val();
        $.ajax({
            url: "AdjustDestinationFeesDate",
            method:"POST",
            data: {destinationid:destinationid, monthOnly:monthOnly},
            success:function(jsonData)
            {
                $('#loadDates').html(jsonData);
            }
        });
    }
});
</script>