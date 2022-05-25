<?php 
$mat = new materialController;
$id = $_POST['id'];
$result = $mat->getVehiclesRoute($id);
?>
<script src="/../public/ajax/addRouteUpdate.js"></script>
<form method="post" id="addRouteUpd" role="form">
    <div class="form-group">
        <label for="Vehicle No">Vehicle No</label>
        <select name="vehicleUpd" id="vehicleUpd" class="form-control select2" style="width: 100%;">
            <option value="">Select Vehicle</option>
            <?php 
            $result1 = $mat->vehicleNo();
            foreach($result1 as $row){
                if($result['vehicle'] == $row['id'])
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
        <label for="Route Code">Route Code</label>
        <input type="text" class="form-control" id="routecodeUpd" name="routecodeUpd" placeholder="Enter Route Code" autocomplete="off" value="<?=$result['r_code']?>">
        <input type="hidden" name="routeid" id="routeid" value="<?=$id?>">
        <span class="help-block" id="error"></span>
    </div>
    <div class="form-group">
        <label for="Route Start Place">Route Start Place</label>
        <input type="text" class="form-control" id="routestartplaceUpd" name="routestartplaceUpd" placeholder="Enter Route Start Place" autocomplete="off" value="<?=$result['start_place']?>">
        <span class="help-block" id="error"></span>
    </div>
    <div class="form-group">
        <label for="Route Stop Place">Route Stop Place</label>
        <input type="text" class="form-control" id="routestopplaceUpd" name="routestopplaceUpd" placeholder="Enter the Route Stop Place" autocomplete="off" value="<?=$result['stop_place']?>">
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
</script>