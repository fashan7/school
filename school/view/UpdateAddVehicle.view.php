<?php 
$id = $_POST['id'];
$mat = new materialController;
$result = $mat->getVehicles($id);
?>
<script src="/../public/ajax/VehicleUpdate.js"></script>
<form method="post" id="VehicleUpd" role="form">
    <div class="form-group">
        <label for="Vehicle No">Vehicle No</label>
            <div class="row">
                <div class="col-lg-3">
                    <input type="text" class="form-control" id="vehicleno1Upd" name="vehicleno1Upd" placeholder="CAE" autocomplete="off" maxlength="3" value="<?=$result['firstno']?>">
                    <span class="help-block" id="error"></span>
                </div>
                <div class="col-lg-1">_</div>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="vehicleno2Upd" name="vehicleno2Upd" placeholder="1111" autocomplete="off" maxlength="4" value="<?=$result['secondno']?>">
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="No Of Seats">No Of Seats</label>
            <input type="text" class="form-control" id="noofseatsUpd" name="noofseatsUpd" placeholder="Enter No Of Seats" autocomplete="off" value="<?=$result['no_of_seats']?>">
            <input type="hidden" name="vehicleid" id="vehicleid" value="<?=$id?>">
            <span class="help-block" id="error"></span>
        </div>
        <div class="form-group">
            <label for="Maximum Allowed">Maximum Allowed</label>
            <input type="text" class="form-control" id="maximumallowedUpd" name="maximumallowedUpd" placeholder="Enter Maximum Allowed" autocomplete="off" value="<?=$result['maximum_allo']?>">
            <span class="help-block" id="error"></span>
        </div>
        <div class="form-group">
            <label for="Vehicle Type">Vehicle Type</label>
            <select name="vehicletypeUpd" id="vehicletypeUpd" class="form-control select2" style="width: 100%;">
                <option value="">-- Please Select --</option>
                <?php 
                if($result['vehicle_type'] == 'Contract')
                {
                    ?>
                <option value="Contract" selected>Contract</option>
                <option value="Ownership">Ownership</option>
                    <?php
                }
                else if($result['vehicle_type'] == 'Ownership')
                {
                    ?>
                <option value="Contract">Contract</option>
                <option value="Ownership" selected>Ownership</option>
                    <?php
                }
                else
                {
                    ?>
                <option value="Contract">Contract</option>
                <option value="Ownership">Ownership</option>
                    <?php
                }
                ?>                
            </select>
            <span class="help-block" id="error"></span>
        </div>
        <div class="form-group">
            <label for="Contact Person">Contact Person</label>
            <input type="text" class="form-control" id="contactpersonUpd" name="contactpersonUpd" placeholder="Contact Person" autocomplete="off" value="<?=$result['contact_person']?>">
            <span class="help-block" id="error"></span>
        </div>
        <div class="form-group">
            <label for="Insurance Renewal Date">Insurance Renewal Date</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="insurancerenewalUpd" name="insurancerenewalUpd" value="<?=$result['renew_date']?>" readonly >
            </div>
            <span class="help-block" id="error"></span>
        </div>
        <div class="form-group">
            <label for="Track ID">Track ID</label>
            <input type="text" class="form-control" id="trackidUpd" name="trackidUpd" autocomplete="off" value="<?=$result['track_id']?>">
            <span class="help-block" id="error"></span>
        </div>
        <div class="form-group" id="hidebuttons">
            <button type="submit" class="btn btn-warning" id="update" name="update">Update</button>   
            <button type="button" class="btn btn-primary" id="back" name="back">Back</button>   
        </div>
</form>
<script>
$('#back').click(function() {
    location.reload();
});
$(document).ready(function () {  
    $('#insurancerenewalUpd').datepicker({
        format: 'yyyy-mm-dd'
    });
});
</script>