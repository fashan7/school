<?php
$mat = new materialController;
if($_POST['usertype'] == 'student')
{
?>
<div class="form-group">
    <label for="Grade Number">Grade Number</label>
    <select class="form-control select2" style="width: 100%;" name="gradenumberlist" id="gradenumberlist">
        <option selected="selected" value=""> -- Grade Number -- </option>
        <?php 
        $resultgr = $mat->SelectallGradeNumber();
        foreach($resultgr as $row){
            ?>
            <option value="<?=$row['id']?>"><?=$row['gradenumber']." ".$row['gradesection']?></option>
            <?php 
        }
        ?>
    </select>
</div>
<div class="form-group" id="loadStudents"></div>
<?php
}
else if($_POST['usertype'] == 'employee')
{
?>
<div class="form-group">
    <label for="Staff Name">Staff Name</label>
    <input type="text" class="form-control" id="Searchemployee" name="Searchemployee" placeholder="Search From Employee Name" autocomplete="off">
    <input type="hidden" name="staffid" id="staffid">
    <span class="help-block" id="error"></span>
</div>
<?php 
}
else 
{
    echo "<center><i>Select a usertype</i></center>";
}
?>
<script>
$(document).ready(function(){
    $(".select2").select2();
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
$(document).on('change', '#gradenumberlist', function(){
    var gradenumberlist = $('#gradenumberlist').val();
    if(gradenumberlist != '')
    {
        $.ajax({
            url: "getMultipleStudents",
            method: "POST",
            data:{gradenumberlist:gradenumberlist},
            success:function(jsonData)
            {
                $('#loadStudents').html("");
                $('#loadStudents').html(jsonData);
            }
        });
    }
    else{
        $('#loadStudents').html("");
    }
});
</script>