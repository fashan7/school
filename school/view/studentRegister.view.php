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
  <link rel="shortcut icon" href="/../public/img/school.png">
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
  <script src="/../public/ajax/studentreg.js"></script>
  <link rel="stylesheet" href="/../public/css/select2.min.css">
  <script src="/../public/js/select2.min.js"></script>
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
<section class="content">
    <form method="post" id="studentregistersubmit" role="form" enctype="multipart/form-data" target="upload_frame">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Student Registration</h3>
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
                        <input type="text" class="form-control" id="studentname" name="studentname" placeholder="Full Name">
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="Register No">Register No</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-code"></i>
                            </div>
                            <input type="text" class="form-control" id="studentcode" name="studentcode" placeholder="Register No">
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="Roll No">Roll No</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-code"></i>
                            </div>
                            <input type="text" class="form-control" id="rollno" name="rollno" placeholder="Roll No">
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="form-group">
                  <label for="Address">Address</label>
                  <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-address-book"></i>
                        </div>
                        <input type="text" class="form-control" id="studentaddress" name="studentaddress" placeholder="Address">
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                      <label for="gender">Gender</label>
                      <select class="form-control" id="studentgender" name="studentgender">
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
                              <input type="text" name="year" id="year" maxlength="4" placeholder="YYYY" class="year" />
                            </div>
                    </div>
                    <span class="help-block" id="error"></span>
                  </div>
                  <div class="col-md-6">                      
                    <div class="form-group">
                        <label for="Current Grade To Study">Current Grade To Study</label>
                        <select name="classno" id="classno" class="form-control select2" style="width: 100%;">
                            <option value="">-- Grade Number --</option>
                            <?php 
                                $result = $mat->SelectallGradeNumber();
                                foreach($result as $row){
                                ?>
                                    <option value="<?=$row['id']?>"><?=$row['gradenumber']." ".$row['gradesection']?></option>
                                <?php 
                                }
                                ?>
                        </select>
                        <span class="help-block" id="error"></span>
                    </div>                    
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
                        <label for="Blood Group">Blood Group</label>
                        <select name="bloodgrp" id="bloodgrp" class="form-control select2" style="width: 100%;">
                            <option value="">-- Select Blood Group --</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                        <span class="help-block" id="error"></span>
                    </div>                    
                  </div>
                  <div class="col-md-6">                      
                    <div class="form-group">
                        <label for="Nationality">Nationality</label>
                        <select name="nationality" id="nationality" class="form-control select2" style="width: 100%;">
                            <option value="">-- Select Nationality --</option>
                            <option value="AF">Afghanistan</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="AS">American Samoa</option>
                            <option value="AD">Andorra</option>
                            <option value="AO">Angola</option>
                            <option value="AI">Anguilla</option>
                            <option value="AQ">Antarctica</option>
                            <option value="AR">Argentina</option>
                            <option value="AM">Armenia</option>
                            <option value="AW">Aruba</option>
                            <option value="AU">Australia</option>
                            <option value="AT">Austria</option>
                            <option value="AZ">Azerbaijan</option>
                            <option value="BS">Bahamas</option>
                            <option value="BH">Bahrain</option>
                            <option value="BD">Bangladesh</option>
                            <option value="BB">Barbados</option>
                            <option value="BY">Belarus</option>
                            <option value="BE">Belgium</option>
                            <option value="BZ">Belize</option>
                            <option value="BJ">Benin</option>
                            <option value="BM">Bermuda</option>
                            <option value="BT">Bhutan</option>
                            <option value="BO">Bolivia</option>
                            <option value="BA">Bosnia and Herzegowina</option>
                            <option value="BW">Botswana</option>
                            <option value="BV">Bouvet Island</option>
                            <option value="BR">Brazil</option>
                            <option value="IO">British Indian Ocean Territory</option>
                            <option value="BN">Brunei Darussalam</option>
                            <option value="BG">Bulgaria</option>
                            <option value="BF">Burkina Faso</option>
                            <option value="BI">Burundi</option>
                            <option value="KH">Cambodia</option>
                            <option value="CM">Cameroon</option>
                            <option value="CA">Canada</option>
                            <option value="CV">Cape Verde</option>
                            <option value="KY">Cayman Islands</option>
                            <option value="CF">Central African Republic</option>
                            <option value="TD">Chad</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CX">Christmas Island</option>
                            <option value="CC">Cocos (Keeling) Islands</option>
                            <option value="CO">Colombia</option>
                            <option value="KM">Comoros</option>
                            <option value="CG">Congo</option>
                            <option value="CD">Congo, the Democratic Republic of the</option>
                            <option value="CK">Cook Islands</option>
                            <option value="CR">Costa Rica</option>
                            <option value="CI">Cote d'Ivoire</option>
                            <option value="HR">Croatia (Hrvatska)</option>
                            <option value="CU">Cuba</option>
                            <option value="CY">Cyprus</option>
                            <option value="CZ">Czech Republic</option>
                            <option value="DK">Denmark</option>
                            <option value="DJ">Djibouti</option>
                            <option value="DM">Dominica</option>
                            <option value="DO">Dominican Republic</option>
                            <option value="EC">Ecuador</option>
                            <option value="EG">Egypt</option>
                            <option value="SV">El Salvador</option>
                            <option value="GQ">Equatorial Guinea</option>
                            <option value="ER">Eritrea</option>
                            <option value="EE">Estonia</option>
                            <option value="ET">Ethiopia</option>
                            <option value="FK">Falkland Islands (Malvinas)</option>
                            <option value="FO">Faroe Islands</option>
                            <option value="FJ">Fiji</option>
                            <option value="FI">Finland</option>
                            <option value="FR">France</option>
                            <option value="GF">French Guiana</option>
                            <option value="PF">French Polynesia</option>
                            <option value="TF">French Southern Territories</option>
                            <option value="GA">Gabon</option>
                            <option value="GM">Gambia</option>
                            <option value="GE">Georgia</option>
                            <option value="DE">Germany</option>
                            <option value="GH">Ghana</option>
                            <option value="GI">Gibraltar</option>
                            <option value="GR">Greece</option>
                            <option value="GL">Greenland</option>
                            <option value="GD">Grenada</option>
                            <option value="GP">Guadeloupe</option>
                            <option value="GU">Guam</option>
                            <option value="GT">Guatemala</option>
                            <option value="GN">Guinea</option>
                            <option value="GW">Guinea-Bissau</option>
                            <option value="GY">Guyana</option>
                            <option value="HT">Haiti</option>
                            <option value="HM">Heard and Mc Donald Islands</option>
                            <option value="VA">Holy See (Vatican City State)</option>
                            <option value="HN">Honduras</option>
                            <option value="HK">Hong Kong</option>
                            <option value="HU">Hungary</option>
                            <option value="IS">Iceland</option>
                            <option value="IN">India</option>
                            <option value="ID">Indonesia</option>
                            <option value="IR">Iran (Islamic Republic of)</option>
                            <option value="IQ">Iraq</option>
                            <option value="IE">Ireland</option>
                            <option value="IL">Israel</option>
                            <option value="IT">Italy</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japan</option>
                            <option value="JO">Jordan</option>
                            <option value="KZ">Kazakhstan</option>
                            <option value="KE">Kenya</option>
                            <option value="KI">Kiribati</option>
                            <option value="KP">Korea, Democratic People's Republic of</option>
                            <option value="KR">Korea, Republic of</option>
                            <option value="KW">Kuwait</option>
                            <option value="KG">Kyrgyzstan</option>
                            <option value="LA">Lao People's Democratic Republic</option>
                            <option value="LV">Latvia</option>
                            <option value="LB">Lebanon</option>
                            <option value="LS">Lesotho</option>
                            <option value="LR">Liberia</option>
                            <option value="LY">Libyan Arab Jamahiriya</option>
                            <option value="LI">Liechtenstein</option>
                            <option value="LT">Lithuania</option>
                            <option value="LU">Luxembourg</option>
                            <option value="MO">Macau</option>
                            <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                            <option value="MG">Madagascar</option>
                            <option value="MW">Malawi</option>
                            <option value="MY">Malaysia</option>
                            <option value="MV">Maldives</option>
                            <option value="ML">Mali</option>
                            <option value="MT">Malta</option>
                            <option value="MH">Marshall Islands</option>
                            <option value="MQ">Martinique</option>
                            <option value="MR">Mauritania</option>
                            <option value="MU">Mauritius</option>
                            <option value="YT">Mayotte</option>
                            <option value="MX">Mexico</option>
                            <option value="FM">Micronesia, Federated States of</option>
                            <option value="MD">Moldova, Republic of</option>
                            <option value="MC">Monaco</option>
                            <option value="MN">Mongolia</option>
                            <option value="MS">Montserrat</option>
                            <option value="MA">Morocco</option>
                            <option value="MZ">Mozambique</option>
                            <option value="MM">Myanmar</option>
                            <option value="NA">Namibia</option>
                            <option value="NR">Nauru</option>
                            <option value="NP">Nepal</option>
                            <option value="NL">Netherlands</option>
                            <option value="AN">Netherlands Antilles</option>
                            <option value="NC">New Caledonia</option>
                            <option value="NZ">New Zealand</option>
                            <option value="NI">Nicaragua</option>
                            <option value="NE">Niger</option>
                            <option value="NG">Nigeria</option>
                            <option value="NU">Niue</option>
                            <option value="NF">Norfolk Island</option>
                            <option value="MP">Northern Mariana Islands</option>
                            <option value="NO">Norway</option>
                            <option value="OM">Oman</option>
                            <option value="PK">Pakistan</option>
                            <option value="PW">Palau</option>
                            <option value="PA">Panama</option>
                            <option value="PG">Papua New Guinea</option>
                            <option value="PY">Paraguay</option>
                            <option value="PE">Peru</option>
                            <option value="PH">Philippines</option>
                            <option value="PN">Pitcairn</option>
                            <option value="PL">Poland</option>
                            <option value="PT">Portugal</option>
                            <option value="PR">Puerto Rico</option>
                            <option value="QA">Qatar</option>
                            <option value="RE">Reunion</option>
                            <option value="RO">Romania</option>
                            <option value="RU">Russian Federation</option>
                            <option value="RW">Rwanda</option>
                            <option value="KN">Saint Kitts and Nevis</option>
                            <option value="LC">Saint LUCIA</option>
                            <option value="VC">Saint Vincent and the Grenadines</option>
                            <option value="WS">Samoa</option>
                            <option value="SM">San Marino</option>
                            <option value="ST">Sao Tome and Principe</option>
                            <option value="SA">Saudi Arabia</option>
                            <option value="SN">Senegal</option>
                            <option value="SC">Seychelles</option>
                            <option value="SL">Sierra Leone</option>
                            <option value="SG">Singapore</option>
                            <option value="SK">Slovakia (Slovak Republic)</option>
                            <option value="SI">Slovenia</option>
                            <option value="SB">Solomon Islands</option>
                            <option value="SO">Somalia</option>
                            <option value="ZA">South Africa</option>
                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                            <option value="ES">Spain</option>
                            <option value="LK">Sri Lanka</option>
                            <option value="SH">St. Helena</option>
                            <option value="PM">St. Pierre and Miquelon</option>
                            <option value="SD">Sudan</option>
                            <option value="SR">Suriname</option>
                            <option value="SJ">Svalbard and Jan Mayen Islands</option>
                            <option value="SZ">Swaziland</option>
                            <option value="SE">Sweden</option>
                            <option value="CH">Switzerland</option>
                            <option value="SY">Syrian Arab Republic</option>
                            <option value="TW">Taiwan, Province of China</option>
                            <option value="TJ">Tajikistan</option>
                            <option value="TZ">Tanzania, United Republic of</option>
                            <option value="TH">Thailand</option>
                            <option value="TG">Togo</option>
                            <option value="TK">Tokelau</option>
                            <option value="TO">Tonga</option>
                            <option value="TT">Trinidad and Tobago</option>
                            <option value="TN">Tunisia</option>
                            <option value="TR">Turkey</option>
                            <option value="TM">Turkmenistan</option>
                            <option value="TC">Turks and Caicos Islands</option>
                            <option value="TV">Tuvalu</option>
                            <option value="UG">Uganda</option>
                            <option value="UA">Ukraine</option>
                            <option value="AE">United Arab Emirates</option>
                            <option value="GB">United Kingdom</option>
                            <option value="US">United States</option>
                            <option value="UM">United States Minor Outlying Islands</option>
                            <option value="UY">Uruguay</option>
                            <option value="UZ">Uzbekistan</option>
                            <option value="VU">Vanuatu</option>
                            <option value="VE">Venezuela</option>
                            <option value="VN">Viet Nam</option>
                            <option value="VG">Virgin Islands (British)</option>
                            <option value="VI">Virgin Islands (U.S.)</option>
                            <option value="WF">Wallis and Futuna Islands</option>
                            <option value="EH">Western Sahara</option>
                            <option value="YE">Yemen</option>
                            <option value="ZM">Zambia</option>
                            <option value="ZW">Zimbabwe</option>
                        </select>
                        <span class="help-block" id="error"></span>
                    </div>                    
                  </div>
                  <div class="form-group">
                      <label for="Email Address">Email Address</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <input type="text" class="form-control" id="studentemail" name="studentemail" placeholder="Email Address">
                    </div>
                    <span class="help-block" id="error"></span>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
          </div>
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Previous School Details</h3>
            </div>
            <div class="box-body">
              <div class="form-group">                    
                  <label for="Have You Work Worked Before?">
                      <input type="checkbox" class="icheckbox_minimal-red" id="oldschool" name="oldschool" onchange="oldschooldone();"  value="yes">&nbsp;&nbsp;&nbsp;Have You Studied In Other Schools?
                  </label>
                  <div id="oldschoolhidden" style="display: none;">
                      <div class="form-group">
                        <div class = "col-md-6">
                        <label for="Address">School Name</label>
                        <input type="text" class="form-control" id="schoolname" name="schoolname" placeholder="Enter the Previous School Name">
                        <span class="help-block" id="error"></span>
                      </div>
                      <div class = "col-md-6">
                        <label for="Designation?">Grade</label>
                         <select class="form-control" id="grade" name="grade">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">4</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="O/L">O/L</option>
                        <option value="A/L">A/L</option>
                      </select>
                        <span class="help-block" id="error"></span>
                      </div>
                      </div>
                      <div class="form-group">
                        <div class = "col-md-6"> 
                          <label for="Address">Joined Date</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>     
                            <div class="form-control date-input-container">
                              <input type="text" id="joindday" name="joindday" maxlength="2" placeholder="DD" class="day" />
                              <span class="separator">/</span>
                              <input type="text" name="joindmonth" id="joindmonth" maxlength="2" placeholder="MM" class="month" />
                              <span class="separator">/</span>
                              <input type="text" name="joindyear" id="joindyear" maxlength="4" placeholder="YYYY" class="year" />
                            </div>
                          </div>
                          <span class="help-block" id="error"></span>
                        </div>
                         <div class = "col-md-6"> 
                          <label for="Address">Left Date</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>     
                            <div class="form-control date-input-container">
                              <input type="text" id="leftday" name="leftday" maxlength="2" placeholder="DD" class="day" />
                              <span class="separator">/</span>
                              <input type="text" name="leftmonth" id="leftmonth" maxlength="2" placeholder="MM" class="month" />
                              <span class="separator">/</span>
                              <input type="text" name="leftyear" id="leftyear" maxlength="4" placeholder="YYYY" class="year" />
                            </div>
                          </div>
                          <span class="help-block" id="error"></span>
                        </div>
                      </div>
                  </div>
                  <hr>
                  <div class="form-group">
                      <div class="form-group" id="hidebutton">
                          <button type="submit" class="btn btn-block btn-success btn-flat">Save Information</button>
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
                <h3 class="box-title">Guardian/Parents Details</h3>
            </div>
            <div class="box-body">
                <div class="form-group" >                    
                     <label for="Name">Name With Initials</label>                  
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </div>
                        <input type="text" class="form-control" id="parentname" name="parentname" placeholder="Full Name">
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
                <div class="form-group">                    
                   <label for="Address">Address</label>
                  <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-address-book"></i>
                        </div>
                        <input type="text" class="form-control" id="parentaddress" name="parentaddress" placeholder="Address">
                    </div>
                    <span class="help-block" id="error"></span>
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
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email Address">
                    </div>
                    <span class="help-block" id="error"></span>
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
function oldschooldone()
{
    if(document.getElementById("oldschool").checked)
    {
        document.getElementById("oldschoolhidden").style.display="block";
    }
    else
    {
        document.getElementById("oldschoolhidden").style.display="none";
    }
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
    
    $('.select2').select2();
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