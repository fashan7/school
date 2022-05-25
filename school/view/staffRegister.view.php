<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;
date_default_timezone_set('Asia/Colombo');
$date = date('Y-m-d'); 
$year = date('Y');
$month = date('m');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>School</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/../public/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="https://use.fontawesome.com/releases/v5.0.6/js/brands.js"></script>
<script src="https://use.fontawesome.com/releases/v5.0.6/js/solid.js"></script>
<script src="https://use.fontawesome.com/releases/v5.0.6/js/fontawesome.js"></script>
  <!-- Start Calender  -->
  <link rel="stylesheet" href="/../public/css/calender/fullcalendar.min.css">
  <link rel="stylesheet" href="/../public/css/calender/fullcalendar.print.min.css" media='print'>
  <script src="/../public/js/calender/fullcalendar.min.js"></script>
  <script src="/../public/js/calender/moment.min.js"></script>
  <!-- End Calender -->
  <link rel="shortcut icon" href="/../public/img/school.png">
  <!-- Start Latest Links  -->
  <link rel="stylesheet" href="/../public/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="/../public/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="/../public/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="/../public/css/daterangepicker.css">
  <link rel="stylesheet" href="/../public/css/all.css">
  <script src="/../public/js/bootstrap-colorpicker.min.js"></script>
  <script src="/../public/js/bootstrap-datepicker.min.js"></script>
  <script src="/../public/js/bootstrap-timepicker.min.js"></script>
  <script src="/../public/js/daterangepicker.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.date.extensions.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.extensions.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.numeric.extensions.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.phone.extensions.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.regex.extensions.js"></script>
  <script src="/../public/js/icheck.min.js"></script>
  <!-- End Latest Links -->
    
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="/../public/ajax/logout.js"></script>
  <script src="/../public/js/jquery.min.js"></script>
  <link rel="stylesheet" href="/../public/css/jquery-confirm.min.css">
  <script src="/../public/js/jquery-confirm.min.js"></script>
  <link rel="stylesheet" href="/../public/css/admin.css">
  <link rel="stylesheet" href="/../public/css/_all-skins.min.css">
  <link rel="stylesheet" href="/../public/css/pace/themes/silver/pace-theme-minimal.css">
  <link rel="stylesheet" href="/../public/css/alertify.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <script src="/../public/ajax/header.js"></script>
  <script src="/../public/js/alertify.min.js"></script>
  <script src="/../public/js/jquery-ui.min.js"></script>
  <script data-pace-options='{ "ajax": false }' src="/../public/js/pace.js"></script>    
  <script src="/../public/js/jquery.validate.min.js"></script>
  <script src="/../public/js/bootstrap.min.js"></script>
  <script src="/../public/js/admin.min.js"></script>
    
    <!-- Start Latest Links  -->
  <link rel="stylesheet" href="/../public/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="/../public/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="/../public/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="/../public/css/daterangepicker.css">
  <link rel="stylesheet" href="/../public/css/all.css">
  <script src="/../public/js/bootstrap-colorpicker.min.js"></script>
  <script src="/../public/js/bootstrap-datepicker.min.js"></script>
  <script src="/../public/js/bootstrap-timepicker.min.js"></script>
  <script src="/../public/js/daterangepicker.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.date.extensions.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.extensions.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.numeric.extensions.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.phone.extensions.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.regex.extensions.js"></script>
  <script src="/../public/js/icheck.min.js"></script>
  <script src="/../public/ajax/staffreg.js"></script>

  <link rel="stylesheet" href="/../public/js/bootstrap-datepicker/css/datepicker.css">
  <script type="text/javascript" src="/../public/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <!-- End Latest Links -->
  <style>
    .solo-wrapper{
      border: 1px solid #ccc;
      padding: 10px;
      display: inline-block;
    }
    input.solo {border:none; outline: 0;}

    /* FOR SEPERATE INPUTS */
    .date-input-container {
      border: 1px solid #ccc;
      display: inline-block;
      padding: 5px;
    }
    .date-input-container input {
      border: 0;
      outline: 0;
      text-align: center;
      width: 27px;
    }
    .date-input-container input.day, .date-input-container input.month {
      margin-right: 0px;
    }
    .date-input-container input.year {
      width: 40px;
    }
  </style> 
</head>
<body class="hold-transition skin-blue sidebar-mini" id="bodytag">
<div class="wrapper" >
<?php 
$objpage->header();
?>
<div class="content-wrapper" id="loadAllDetails">    
<?php
//$material = new materialController;
//$maxcode = $material->maxStaff();
//
//    if($maxcode == '')
//    {
//        $code = '0001';
//    }
//    else
//    {
//        $incrementcode = $maxcode + 1;
//        $code = str_pad($incrementcode, 4, '0', STR_PAD_LEFT);
//    }
?>
<section class="content">
    <form method="post" id="staffregistersubmit" role="form" enctype="multipart/form-data" target="upload_frame">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Staff Registration</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="form-group">
                    <label for="Name">Name With Initials</label>                  
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </div>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name">
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
                <div class="form-group">
                    <label for="Code">Staff Code</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-code"></i>
                        </div>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Staff Code" maxlength="5">
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
                <div class="form-group">
                  <label for="Address">Address</label>
                  <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-address-book"></i>
                        </div>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                      <label for="gender">Gender</label>
                      <select class="form-control" id="gender" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                      <span class="help-block" id="error"></span>
                  </div>
                  <div class="col-md-6">
                      <label for="Date of Birth">Date of Birth</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <div class="form-control date-input-container">
                              <input type="text" id="day" name="day" maxlength="2" placeholder="DD" class="day" />
                              <span class="separator">/</span>
                              <input type="text" name="month" id="month" maxlength="2" placeholder="MM" class="month" />
                              <span class="separator">/</span>
                              <input type="text" name="year" id="year" maxlength="4" placeholder="YYYY"class="year" />
                            </div>
                    </div>
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-6">
                      <label for="Address">Mobile No</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask id="phone1" name="phone1">
                    </div>
                    <span class="help-block" id="error"></span>
                  </div>
                  <div class="col-lg-6">
                      <label for="Address">Land Line No</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask id="phone2" name="phone2">
                    </div> 
                    <span class="help-block" id="error"></span>
                  </div>
                </div>
                  <div class="form-group">
                      <label for="Email Address">Email Address</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Address">
                        <input type="hidden" name="olnums" id="olnums" value="1">
                        <input type="hidden" name="alnums" id="alnums" value="1">
                    </div>
                    <span class="help-block" id="error"></span>
                  </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="Joining Date">Joining Date</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" value="<?=$date?>" readonly>
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="col-md-6">                      
                    <div class="form-group">
                        <label for="Department">Department</label>
                        <select name="department" id="department" class="form-control select2" style="width: 100%;">
                            <option value="">-- Grade Number --</option>
                            <?php 
                                $result12 = $mat->SelectallDepartment();
                                foreach($result12 as $row12){
                                ?>
                                    <option value="<?=$row12['id']?>"><?=$row12['name']?></option>
                                <?php 
                                }
                                ?>
                        </select>
                        <span class="help-block" id="error"></span>
                    </div>                    
                  </div>
              </div>
              <!-- /.box-body -->
          </div>
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Working Experience</h3>
            </div>
            <div class="box-body">
              <div class="form-group">                    
                  <label for="Have You Work Worked Before?">
                      <input type="checkbox" class="icheckbox_minimal-red" id="workcheck" name="workcheck" onchange="workcheckdone();"  value="yes">&nbsp;&nbsp;&nbsp;Have You Work Worked Before?
                  </label>
                  <div id="workhidden" style="display: none;">
                      <div class="form-group">
                        <label for="Address">School Or Company Name?</label>
                        <input type="text" class="form-control" id="schoolname" name="schoolname" placeholder="Enter the Previous Company Name">
                        <span class="help-block" id="error"></span>
                      </div>
                      <div class="form-group">
                        <label for="Designation?">Designation?</label>
                        <input type="text" class="form-control" id="designation" name="designation" placeholder="What is Your Role in the Company?">
                        <span class="help-block" id="error"></span>
                      </div>
                      <div class="form-group">
                          <label for="Address">Work Start Date?</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>     
                            <div class="form-control date-input-container">
                              <input type="text" id="workperiod1" name="workperiod1" maxlength="2" placeholder="DD" class="day" />
                              <span class="separator">/</span>
                              <input type="text" name="workperiod2" id="workperiod2" maxlength="2" placeholder="MM" class="month" />
                              <span class="separator">/</span>
                              <input type="text" name="workperiod3" id="workperiod3" maxlength="4" placeholder="YYYY"class="year" />
                            </div>
                          </div>
                          <span class="help-block" id="error"></span>
                      </div>
                  </div>
              </div>              
            </div>
            <!-- /.box-body -->
          </div>          
    </div>
    <div class="col-lg-6">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Education</h3>
            </div>
            <div class="box-body">
                <div class="form-group" >                    
                    <label for="O/L">
                        <input type="checkbox" id="olcheck" name="olcheck" onchange="oldone()" class="icheckbox_minimal-red"  value="yes">&nbsp;&nbsp;&nbsp;O/L
                    </label>
                    <div id="olhidden" style="display: none;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" id="olresult1" maxlength="1" name="olresult1">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="O/L Subject" id="olSubject1" name="olSubject1">
                                </div>
                            </div>
                            <div id="oladdrowid"></div>
                        </div>
                        <div class="form-group">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success" id="oladdmore" onclick="addMoreOL()"><i class="fa fa-check"></i></button>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="form-group">                    
                    <label for="A/L">
                        <input type="checkbox" class="icheckbox_minimal-red" id="alcheck" name="alcheck" onchange="aldone();" value="yes">&nbsp;&nbsp;&nbsp;A/L
                    </label>
                    <div id="alhidden" style="display: none;">
                        <div class="row" >
                            <div class="col-md-12">
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" id="alresult1" name="alresult1" maxlength="1">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="A/L Subject" id="alSubject1" name="alSubject1">
                                </div>
                            </div>
                            <div id="aladdrowid"></div>
                        </div>
                        <div class="form-group">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success" id="aladdmore" onclick="addMoreAL()"><i class="fa fa-check"></i></button>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="form-group" id="hidebutton">
                    <button type="submit" class="btn btn-block btn-success btn-flat">Save</button>
                </div>
            </div>
            <!-- /.box-body -->
         </div>
    </div>
</div>
    </form>
</section>
</div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 2019 <a href="https://www.linkedin.com/in/mohammed-fashan-a59092187/" target="_blank">Fashan</a>.</strong> All rights
    reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<script type="text/javascript">
function oldone()
{
    if(document.getElementById("olcheck").checked)
    {
        document.getElementById("olhidden").style.display="block";
    }
    else
    {
        document.getElementById("olhidden").style.display="none";
    }
}
    
function aldone()
{
    if(document.getElementById("alcheck").checked)
    {
        document.getElementById("alhidden").style.display="block";
    }
    else
    {
        document.getElementById("alhidden").style.display="none";
    }
}
    
function workcheckdone()
{
    if(document.getElementById("workcheck").checked)
    {
        document.getElementById("workhidden").style.display="block";
    }
    else
    {
        document.getElementById("workhidden").style.display="none";
    }
}
    
function addMoreOL()
{
    var olresult = new Array();
    var olSubject = new Array(); 
    
    num_rows = parseInt(document.getElementById("olnums").value);
    totalrows = num_rows  + 1;
    
    for(i = 2; i < totalrows; i++)
    {
        olresult[i] = document.getElementById("olresult"+i).value;
        olSubject[i] = document.getElementById("olSubject"+i).value;
    }
    document.getElementById("oladdrowid").innerHTML = "";
    tech = '';
    
    for(i = 2; i <= totalrows; i++)
    {
        if(i ==  totalrows)
        {
            tech += '<div class="col-md-12">';
            tech += '<div class="form-group col-md-4"><input type="text" class="form-control" id="olresult' + i + '" name="olresult' + i + '" maxlength="1" ></div>';   

            tech += '<div class="form-group col-md-6"><input type="text" class="form-control" placeholder="O/L Subject" id="olSubject' + i + '" name="olSubject' + i + '"></div>';
            
            tech += '<div class="form-group col-md-2 btn-group"><button type="button" class="btn btn-danger" id="deleteolrow'+i+'" onclick="javascript:deleteolAddRows('+i+')"><i class="fa fa-window-close"></i></button></div></div>';
        }
        else    
        {
            tech += '<div class="col-md-12">';
            tech += '<div class="form-group col-md-4"><input type="text" class="form-control" id="olresult' + i + '" name="olresult' + i + '" maxlength="1" value="'+olresult[i]+'"></div>';   

            tech += '<div class="form-group col-md-6"><input type="text" class="form-control" placeholder="O/L Subject" id="olSubject' + i + '" value="'+olSubject[i]+'" name="olSubject' + i + '"></div>';

            tech += '<div class="form-group col-md-2 btn-group"><button type="button" class="btn btn-danger" id="deleteolrow'+i+'" onclick="javascript:deleteolAddRows('+i+')"><i class="fa fa-window-close"></i></button></div></div>';
        }
    }
    
    tech += "";
    document.getElementById("oladdrowid").innerHTML = tech;
    document.getElementById("olnums").value = totalrows;
}

function deleteolAddRows(row)
{
    var olresult = new Array();
    var olSubject = new Array(); 
    
    num_rows = parseInt(document.getElementById("olnums").value);
    int_num_rows = num_rows;
    row = parseInt(row);
    
    k = 2;
    m = k;
    
    for(; k <= int_num_rows; k++)
    {
        if(k == row){
            
        }
        else
        {
            olresult[m] = document.getElementById("olresult"+k).value;
            olSubject[m] = document.getElementById("olSubject"+k).value;
            m++;
        }
    }
    document.getElementById("oladdrowid").innerHTML = "";
    tech = '';
    i = 2;
    j = i;
    
    for(; i <= int_num_rows; i++)
    {
        if(i == row){
            
        }
        else
        {
            tech += '<div class="col-md-12">';
            tech += '<div class="form-group col-md-4"><input type="text" class="form-control" id="olresult' + j + '" name="olresult' + j + '" maxlength="1" value="'+olresult[j]+'"></div>';   

            tech += '<div class="form-group col-md-6"><input type="text" class="form-control" placeholder="O/L Subject" id="olSubject' + j + '" name="olSubject' + j + '" value="'+olSubject[j]+'" ></div>';

            tech += '<div class="form-group col-md-2 btn-group"><button type="button" class="btn btn-danger" id="deleteolrow'+j+'" onclick="javascript:deleteolAddRows('+j+')"><i class="fa fa-window-close"></i></button></div></div>';
            
            j++;
        }
    }
    tech += "";
    document.getElementById("oladdrowid").innerHTML = tech;
    document.getElementById("olnums").value = int_num_rows-1;
}
    
function addMoreAL()
{
    var alresult = new Array();
    var alSubject = new Array(); 
    
    num_rows = parseInt(document.getElementById("alnums").value);
    totalrows = num_rows  + 1;
    
    for(i = 2; i < totalrows; i++)
    {
        alresult[i] = document.getElementById("alresult"+i).value;
        alSubject[i] = document.getElementById("alSubject"+i).value;
    }
    document.getElementById("aladdrowid").innerHTML = "";
    tech = '';
    
    for(i = 2; i <= totalrows; i++)
    {
        if(i ==  totalrows)
        {
            tech += '<div class="col-md-12">';
            tech += '<div class="form-group col-md-4"><input type="text" class="form-control" id="alresult' + i + '" name="alresult' + i + '" maxlength="1" ></div>';   

            tech += '<div class="form-group col-md-6"><input type="text" class="form-control" placeholder="A/L Subject" id="alSubject' + i + '" name="alSubject' + i + '"></div>';

            tech += '<div class="form-group col-md-2 btn-group"><button type="button" class="btn btn-danger" id="deletealrow'+i+'" onclick="javascript:deletealAddRows('+i+')"><i class="fa fa-window-close"></i></button></div></div>';
        }
        else    
        {
            tech += '<div class="col-md-12">';
            tech += '<div class="form-group col-md-4"><input type="text" class="form-control" id="alresult' + i + '" name="alresult' + i + '"  maxlength="1" value="'+alresult[i]+'"></div>';   

            tech += '<div class="form-group col-md-6"><input type="text" class="form-control" placeholder="A/L Subject" id="alSubject' + i + '" name="alSubject' + i + '" value="'+alSubject[i]+'" ></div>';

            tech += '<div class="form-group col-md-2 btn-group"><button type="button" class="btn btn-danger" id="deletealrow'+i+'" onclick="javascript:deletealAddRows('+i+')"><i class="fa fa-window-close"></i></button></div></div>';
        }
    }
    
    tech += "";
    document.getElementById("aladdrowid").innerHTML = tech;
    document.getElementById("alnums").value = totalrows;
}

function deletealAddRows(row)
{
    var alresult = new Array();
    var alSubject = new Array(); 
    
    num_rows = parseInt(document.getElementById("alnums").value);
    int_num_rows = num_rows;
    row = parseInt(row);
    
    k = 2;
    m = k;
    
    for(; k <= int_num_rows; k++)
    {
        if(k == row){
            
        }
        else
        {
            alresult[m] = document.getElementById("alresult"+k).value;
            alSubject[m] = document.getElementById("alSubject"+k).value;
            m++;
        }
    }
    document.getElementById("aladdrowid").innerHTML = "";
    tech = '';
    i = 2;
    j = i;
    
    for(; i <= int_num_rows; i++)
    {
        if(i == row){
            
        }
        else
        {
            tech += '<div class="col-md-12">';
            tech += '<div class="form-group col-md-4"><input type="text" class="form-control" id="alresult' + j + '"  name="alresult' + j + '" maxlength="1" value="'+alresult[j]+'" required></div>';   

            tech += '<div class="form-group col-md-6"><input type="text" class="form-control" placeholder="A/L Subject" id="alSubject' + j + '" name="alSubject' + j + '" value="'+alSubject[j]+'" required></div>';

            tech += '<div class="form-group col-md-2 btn-group"><button type="button" class="btn btn-danger" id="deletealrow'+j+'" onclick="javascript:deletealAddRows('+j+')"><i class="fa fa-window-close"></i></button></div></div>';
            
            j++;
        }
    }
    tech += "";
    document.getElementById("aladdrowid").innerHTML = tech;
    document.getElementById("alnums").value = int_num_rows-1;
}
 $(function () {
     $('#dob').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
     $('#workperiod').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
     $('[data-mask]').inputmask();
 });
</script>
<script>
$(document).ready(function (){
    
    $('#datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    
    var soloInput = $('input.solo');

soloInput.on('keyup', function(){
  var v = $(this).val();
  if (v.match(/^\d{2}$/) !== null) {
    $(this).val(v + '/');
  } else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
    $(this).val(v + '/');
  }  
});


function moveToNext(selector, nextSelector) {
  $(selector).on('input', function () {    
    if (this.value.length >= 2) {
      // Date has been entered, move
      $(nextSelector).focus();
    }
  });
}


$(function () {
  moveToNext('.day', '.month');
  moveToNext('.month', '.year');
});
});
</script>
</body>
</html>