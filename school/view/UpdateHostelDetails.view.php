<?php
$mat = new materialController;
$id = $_POST['id'];
$result = $mat->hostelDetails($id);
$result2 = $mat->hosteltypeID($result['hostel_type']);
?>
<script src="/../public/ajax/hostelupd.js"></script>
<form method="post" id="hostelUpdReg" role="form">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="Hostel Type">Hostel Type</label>
            <select name="hosteltypeupd" id="hosteltypeupd" class="form-control select2" style="width: 100%;">
                <option value="">-- Select Hostel Type --</option>
                <?php 
                $result1 = $mat->hostelsType();
                foreach($result1 as $row){
                    if($row['id'] == $result2['id'])
                    {
                        ?>
                        <option value="<?=$row['id']?>" selected><?=$row['name']?></option>
                        <?php    
                    }
                    else
                    {
                        ?>
                        <option value="<?=$row['id']?>"><?=$row['name']?></option>
                        <?php   
                    }                 
                }
                ?>
            </select>
            <span class="help-block" id="error"></span>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label for="Hostel Name">Hostel Name</label>
            <input type="text" class="form-control" id="hostelnameupd" name="hostelnameupd" placeholder="Enter Hostel Name" autocomplete="off" value="<?=$result['hostel_name']?>">
            <input type="hidden" name="hostelid" id="hostelid" value="<?=$id?>">
            <span class="help-block" id="error"></span>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label for="Hostel Address">Hostel Address</label>
            <textarea type="text" class="form-control" id="hosteladdrupd" name="hosteladdrupd" placeholder="Enter Hostel Address" autocomplete="off" rows="3" ><?=$result['hostel_address']?></textarea>
            <span class="help-block" id="error"></span>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label for="Hostel Phone Number">Hostel Phone Number</label>
            <input type="text" class="form-control" id="hostelpnoupd" name="hostelpnoupd" placeholder="Enter Hostel Phone Number" autocomplete="off" value="<?=$result['hostel_pno']?>">
            <span class="help-block" id="error"></span>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label for="Warden Name">Warden Name</label>
            <input type="text" class="form-control" id="wardennameupd" name="wardennameupd" value="<?=$result['warden_name']?>" placeholder="Enter Warden Name" autocomplete="off">
            <span class="help-block" id="error"></span>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label for="Warden Address">Warden Address</label>
            <textarea type="text" class="form-control" id="wardenaddrupd"  name="wardenaddrupd" placeholder="Enter Warden Address" autocomplete="off" rows="3"><?=$result['warden_address']?></textarea>
            <span class="help-block" id="error"></span>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label for="Warden Phone Number">Warden Phone Number</label>
            <input type="text" class="form-control" id="wardenpnoupd" value="<?=$result['warden_pno']?>" name="wardenpnoupd" placeholder="Enter Warden Phone Number" autocomplete="off">
            <span class="help-block" id="error"></span>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group" id="hidebuttonss">                                             
            <button type="submit" class="btn btn-warning" id="updates" name="updates">Update</button>   
            <button type="button" class="btn btn-primary" id="back" name="back">Back</button>   
        </div>
    </div>
</form>
<script>
$('#back').click(function() {
    location.reload();
});
$(document).ready(function(){
    $('.select2').select2();  
});
</script>