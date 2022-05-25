<?php
if($_POST['usertype'] == 'student')
{
?>
<div class="col-lg-12">
    <div class="form-group">
        <label for="Student Name">Student Name</label>
        <input type="text" class="form-control" id="SearchStudent" name="SearchStudent" placeholder="Search From Student Name" autocomplete="off">
        <input type="hidden" name="studentid" id="studentid">
        <span class="help-block" id="error"></span>
    </div>
</div>
<?php
}
else if($_POST['usertype'] == 'employee')
{
?>
<div class="col-lg-12">
    <div class="form-group">
        <label for="Staff Name">Staff Name</label>
        <input type="text" class="form-control" id="Searchemployee" name="Searchemployee" placeholder="Search From Employee Name" autocomplete="off">
        <input type="hidden" name="staffid" id="staffid">
        <span class="help-block" id="error"></span>
    </div>
</div>
<?php 
}
else 
{
    echo "<center><i>Select a usertype</i></center>";
}
?>
<script>
$(document).on('keyup', '#SearchStudent', function(){
    $('#SearchStudent').autocomplete({
        source: "autoCompleteStudent",
        minLength: 2,
        select: function (event, ui)
        {
            $('#studentid').val(ui.item.studentid);
        }
    });     
});
$(document).on('keyup', '#Searchemployee', function(){
    $('#Searchemployee').autocomplete({
        source: "autoCompleteStaff",
        minLength: 2,
        select: function (event, ui)
        {
            $('#staffid').val(ui.item.staffid);
        }
    });     
});
</script>