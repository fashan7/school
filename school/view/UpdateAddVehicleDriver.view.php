<?php 
$id = $_POST['id'];
$mat = new materialController;
$res = $mat->getVehiclesDrivers($id);
?>
<script src="/../public/ajax/VehicleDriveUpdate.js"></script>
<form method="post" id="VehicledriverUpd" role="form">
    <div class="form-group">
        <label for="Vehicle No">Vehicle No</label>
            <select name="vehicleUpd" id="vehicleUpd" class="form-control select2" style="width: 100%;">
                <option value="">Select Vehicle</option>
                <?php 
                $result = $mat->vehicleNo();
                foreach($result as $row){
                    if($res['vehicle'] == $row['id'])
                    {
                        ?>
                        <option value="<?=$row['id']?>" selected><?=$row['vehicle_no']?></option>
                        <?php
                    }
                    else
                    {
                        ?>
                        <option value="<?=$row['id']?>"><?=$row['vehicle_no']?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" class="form-control" id="drivernameUpd" name="drivernameUpd" placeholder="Enter Drivers Name" autocomplete="off" value="<?=$res['name']?>">
            <span class="help-block" id="error"></span>
        </div>
        <div class="form-group">
            <label for="Current Address">Current Address</label>
            <input type="text" class="form-control" id="caddressUpd" name="caddressUpd" placeholder="Enter the Current Address" autocomplete="off" value="<?=$res['c_address']?>">
            <span class="help-block" id="error"></span>
        </div>
        <div class="form-group">
            <label for="Permanent Address">Permanent Address</label>
            <input type="text" class="form-control" id="paddressUpd" name="paddressUpd" placeholder="Enter the Permanent Address" autocomplete="off" value="<?=$res['p_address']?>">
            <span class="help-block" id="error"></span>
        </div>
        <div class="form-group">
            <label for="Date Of BirthInsurance Renewal Date">Date Of Birth</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
            <input type="text" class="form-control pull-right" id="dobUpd" name="dobUpd" placeholder="Date Of Birth" readonly value="<?=$res['dob']?>">
        </div>
        <span class="help-block" id="error"></span>
    </div>
    <div class="form-group">
        <label for="Phone">Phone</label>
        <input type="text" class="form-control" id="PhoneUpd" name="PhoneUpd" autocomplete="off" value="<?=$res['phone']?>">
        <span class="help-block" id="error"></span>
    </div>
    <div class="form-group">
        <label for="License Number">License Number</label>
        <input type="text" class="form-control" id="licenseUpd" name="licenseUpd" autocomplete="off" value="<?=$res['licence_no']?>">
        <input type="hidden" name="driverid" id="driverid" value="<?=$id?>">
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
    $('#dobUpd').datepicker({
        format: 'yyyy-mm-dd'
    });
});
</script>