<?php 
$mat = new materialController;
$id = $_POST['id'];
$result = $mat->bookcategorybyID($id);
?>
<script src="/../public/ajax/bookcategoryupd.js"></script>
<div class="box-body">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <form method="post" id="bookcateUpd" role="form">
                <div class="form-group">
                   <label for="Category Name">Category Name</label>
                    <input type="text" class="form-control" id="categorynameupd" name="categorynameupd" placeholder="Enter Category Name" autocomplete="off" value="<?=$result['name']?>">
                    <input type="hidden" id="cid" name="cid" value="<?=$id?>">
                    <span class="help-block" id="error"></span>
                </div>
                <div class="form-group">
                    <label for="Section Code">Section Code</label>
                    <input type="text" class="form-control" id="sectioncodeupd" name="sectioncodeupd" placeholder="Enter Section Code" autocomplete="off" value="<?=$result['code']?>">
                    <span class="help-block" id="error"></span>
                </div>
                <div class="form-group" id="hidebuttons">
                    <button type="submit" class="btn btn-success" id="update" name="update">Update</button>   
                </div>
            </form>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>