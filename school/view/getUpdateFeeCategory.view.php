<?php 
$mat = new materialController;
$id = $_POST['id'];
$result = $mat->SelectFeeCategory($id);
?>
<script src="/../public/ajax/feecategoryUpdate.js"></script>
<form method="post" id="feecateUpd" role="form">
    <div class="form-group">
       <label for="Fee Category">Fee Category</label>
        <input type="text" class="form-control" id="feecategoryupd" name="feecategoryupd" placeholder="Enter Fee Category" autocomplete="off" value="<?=$result['category_name']?>">
        <input type="hidden" name="feesid" id="feesid" value="<?=$id?>">
        <span class="help-block" id="error"></span>
    </div>
    <div class="form-group">
        <label for="Receipt No. Prefix">Receipt No. Prefix</label>
        <input type="text" class="form-control" id="prefixreciptnoupd" name="prefixreciptnoupd" placeholder="Enter Receipt No. Prefix" autocomplete="off" value="<?=$result['prefix']?>">
        <span class="help-block" id="error"></span>
    </div>
    <div class="form-group">
       <label for="Description">Description</label>
        <textarea type="text" class="form-control" id="descriptionupd" name="descriptionupd" rows="4" autocomplete="off"><?=$result['description']?></textarea>
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