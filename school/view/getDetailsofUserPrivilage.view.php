<?php
$reg = new registerController;
$upd = new updateController;
$object = new privilegeController;
$obj = new materialController;

if (isset($_POST['user']) && isset($_POST['id']) && isset($_POST['sign'])) {
    $user = $_POST['user'];	// Search User Id
	$pId = $_POST['id'];		// Page Id
	$sign = $_POST['sign'];	// View  Yes / No   
    
    if (isset($_POST['newId'])) {	// For New Page
        $reg->AddNewPrivilagePage($user, $pId, $sign);
    }
        $upd->UpdatePrivilagePage($sign, $pId);
}
else
{
    $user = $_POST['user'];
}

$row = $obj->userregDetails($user);
?>

<script src="/../public/js/jquery.mask.js"></script>
<script src="/../public/ajax/userPriviliageUserEdit.js"></script>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">User Privilage</h3>
    </div>
    <div class="box-body">
        <form method="post" id="UserPrivilageUserTOEdit" role="form" enctype="multipart/form-data" target="upload_frame">
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="First Name">First Name</label>                  
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?=$row['first_name']?>">
                        <input type="hidden" class="form-control" id="userid" name="userid" placeholder="First Name" value="<?=$user?>">
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="Last Name">Last Name</label>                  
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fab fa-linode"></i>
                        </div>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?=$row['last_name']?>">
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="Mobile No">Mobile No</label>                  
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile No" value="<?=$row['mobile']?>">
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="Date Of Birth">Date Of Birth</label>                  
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-birthday-cake"></i>
                        </div>
                        <input type="text" id="dob" name="dob" placeholder="Date Of Birth" value="<?=$row['birthday']?>" class="form-control simple-field-data-mask-selectonfocus" data-mask="00/00/0000" data-mask-selectonfocus="true" placeholder="DD/MM/YYYY">
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="N I C">N I C</label>                  
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-tag"></i>
                        </div>
                        <input type="text" class="form-control" id="nic" name="nic" placeholder="N I C" value="<?=$row['nic']?>">
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="Email Address">Email Address</label>                  
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="<?=$row['email']?>">
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="Address">Address</label>                  
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-address-book"></i>
                        </div>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?=$row['address']?>">
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="UserName">UserName</label>                  
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <input type="text" class="form-control" id="username" name="username" placeholder="UserName" value="<?=$row['username']?>" readonly>
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="UserType">UserType</label>                  
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-user"></i>
                        </div>
                        <select class="form-control select2" style="width: 100%;" name="usertype" id="usertype">
                          <option selected="selected" value=""> -- UserName -- </option>
                          <?php
                          $result = $obj->usertypeSelect();
                          foreach($result as $rows){
                              if($row['usertype'] == $rows['id'])
                              {
                                 ?>
                                <option value="<?=$rows['id']?>" selected><?=$rows['name']?></option>
                                <?php  
                              }
                              else
                              {
                                  ?>
                                  <option value="<?=$rows['id']?>"><?=$rows['name']?></option>
                                  <?php 
                              }                              
                          }
                          ?>
                        </select>
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group" id="hidebutton">
                    <button type="submit" class="btn btn-block btn-warning btn-flat" name="update" id="update"><i>Update</i></button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">User Privilage</h3>
        </div>
        <div class="box-body">
          <?php 
            $resultCount = $object->pageCount();
            foreach($resultCount as $rowCount){
                $pageid = $rowCount['id'];
                
                $select_privileges = $object->countUserPrivledge($user, $pageid);  
                ?>    
                <?php
                if($select_privileges > 0)
                {//// Have Record In Privilege Page
                }
                else 
                {
                    $reg->noRecordInPrivilagePage($user, $pageid);
                }
            }
            $resultSelectTB = $object->selectsectionTB();
            ?>
            <div>
                <table id="myTable" class=" table order-list">
                    <?php 
                    foreach($resultSelectTB as $rowSelectTB){
                        ?>
                        <thead>
                            <tr>
                                <th scope="col"><?php echo $rowSelectTB['primarysection'];?></th>
                                <th scope="col">View (Yes/No)</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php   
                        $sectionName = $rowSelectTB['primarysection'];
                        $select_page = $object->userprivOldPage($sectionName, $user);
                        
                        foreach($select_page as $rowSelect_page){
                            $ids = $rowSelect_page['id'];
                            if($rowSelect_page['viewstatus'] == 'yes')
                            {
                                $check = "checked='checked'";	// Checkbox On
                                $span = "(Yes)";
                            }
                            else
                            {
                                $check = '';	// Checkbox Off
                                $span = "(No)";
                            }
                            ?>
                            <tr>
                                <td data-label="<?php echo $rowSelect_page['name'];?>">
                                    <label><?php echo $rowSelect_page['name'];?></label>
                                </td>
                                <td data-label="View (Yes/No)">
                                    <div class="form-animate-checkbox" style="padding: 0px;font-size: 1px;">
                                        <label><input type="checkbox" class="checkbox" name="changeCon<?php echo $ids?>" id="changeCon<?php echo $ids?>" <?php echo $check;?> onClick="fillSpan('<?php echo $ids;?>')">
                                            <span id="viewCon<?php echo $ids;?>" style='margin-left:5px'><?php echo $span;?></span>
                                        </label>
                                    </div>
                                </td>
                                <td data-label="Edit">
                                    <a style="text-decoration: none;" href="javascript:getUserPrivileges('<?php echo $ids;?>')">Edit</a>
                                </td>
                            </tr>
                            <?php 
                        }
                        $select_new_page = $object->userprivNewPage($sectionName);
                        foreach($select_new_page as $result_new_page){
                            if($result_new_page['name'] == $rowSelect_page['name'])
                            {}
                            else
                            {
                                $newId = $result_new_page['id'];
                                $reg->selectNewPagePrivilage($user, $newId);
                                ?>
                                <tr>
                                    <td data-label="<?php echo $rowSelect_page['name'];?>">
                                        <label><?php echo $rowSelect_page['name'];?></label>
                                    </td>
                                    <td data-label="View (Yes/No)">
                                        <div class="form-animate-checkbox" style="padding: 0px;font-size: 1px;">
                                            <label><input type="checkbox" class="checkbox"  name="changeNewCon<?php echo $newId?>" id="changeNewCon<?php echo $newId?>"  onClick="fillSpan('<?php echo $newId;?>')" >
                                            <span id="viewNewCon<?php echo $newId;?>" style='margin-left:5px'>(No)</span></label>
                                        </div>
                                    </td>
                                    <td data-label="Edit">
                                        <a style="text-decoration: none;" href="getNewUserPrivileges('<?php echo $newId;?>')">Edit</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }
                    ?>
                </table>
            </div>
        
        </div>
      </div>
    </div>
    <div class="col-md-3"></div>
  </div>
<script>
$(document).ready(function(){ 
    $('.select2').select2();
});
</script>