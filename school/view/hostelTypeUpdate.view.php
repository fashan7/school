<?php 
$mat = new materialController;
$id = $_POST['id'];

$result = $mat->hosteltypeID($id);
?>
<script src="/../public/ajax/hosteltypeUpdate.js"></script>
<form method="post" id="hosteltypeUpdate" role="form">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="Hostel Type">Hostel Type</label>
            <input type="text" class="form-control" id="hosteltypeupd" name="hosteltypeupd" placeholder="Enter Hostel Type" autocomplete="off" value="<?=$result['name']?>">
            <input type="hidden" name="htypeid" id="htypeid" value="<?=$id?>">
            <span class="help-block" id="error"></span>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group" id="hidebuttons">                                             
            <button type="submit" class="btn btn-warning" id="update" name="update">Update</button>   
            <button type="button" class="btn btn-primary" id="back" name="back">Back</button>   
        </div>
    </div>
</form>
<script>
$('#back').click(function() {
    location.reload();
});
</script>