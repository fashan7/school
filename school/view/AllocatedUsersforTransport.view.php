<?php
$mat = new materialController;
$res = $mat->transAllocbyUsertyp($_POST['usertype']);
if($res['usertype'] == 'student')
{
?>
<div class="col-lg-4">
    <div class="form-group">
        <label for="Grade">Grade</label>
        <select name="grade" id="grade" class="form-control select2" style="width: 100%;">
            <option value="">-- Select Grade --</option>  
            <?php 
            $result = $mat->SelectallGradeNumber();
            foreach($result as $row){
                ?>
                <option value="<?=$row['id']?>" ><?=$row['gradenumber']." ".$row['gradesection']?></option>
                <?php
            }
            ?>
        </select>
        <span class="help-block" id="error"></span>
    </div>
</div>
<div class="col-lg-4 form-group" id="loadStudents"></div>
<?php
}
else if($res['usertype'] == 'employee')
{
?>
<div class="col-lg-4">
    <div class="form-group">
    <label for="Staff">Staff</label>
    <select name="staff" id="staff" class="form-control select2" style="width: 100%;">
        <option value="">-- Select Staff --</option>
        <?php 
        $result = $mat->getEmployeesAll();
        foreach($result as $row){
            ?>
            <option value="<?=$row['id']?>" ><?=$row['fullname']." ".$row['code']?></option>
            <?php
        }
        ?>
    </select>
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
<input type="hidden" name="usertypes" id="usertypes" value="<?=$res['usertype']?>">
<script>
$(document).ready(function(){
    $(".select2").select2();
});
$(document).on('change', '#grade', function(){
    var gradenumberlist = $('#grade').val();
    if(gradenumberlist != '')
    {
        $.ajax({
            url: "getStudentsDetSingle",
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
$(document).on('change', '#staff', function(){
    var usertype = $('#usertypes').val();
    var user = $('#staff').val();
    if(user != '')
    {
        $.ajax({
            url: "getdestinationBystaffandType",
            method: "POST",
            data:{usertype:usertype, user:user},
            success:function(jsonData)
            {
                $('#getdestinyMan').html("");
                $('#getdestinyMan').html(jsonData);
            }
        });
    }
    else{
        $('#getdestinyMan').html("");
    }
});
$(document).on('change', '#students', function(){
    var usertype = $('#usertypes').val();
    var user = $('#students').val();
    if(user != '')
    {
        $.ajax({
            url: "getdestinationBystaffandType",
            method: "POST",
            data:{usertype:usertype, user:user},
            success:function(jsonData)
            {
                $('#getdestinyMan').html("");
                $('#getdestinyMan').html(jsonData);
            }
        });
    }
    else{
        $('#getdestinyMan').html("");
    }
});
</script>