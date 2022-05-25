<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;
$det = new detailsController;
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
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<link href="/../public/css/tableresponsive.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<link rel="stylesheet" href="/../public/css/select2.min.css">
  <script src="/../public/js/select2.min.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini" id="bodytag">
<div class="wrapper" >
<?php 
$objpage->header();
?>
<div class="content-wrapper" id="loadAllDetails">    
<section class="content">
    <div class="row">        
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Search Students By Class Section </h3>
                </div>
                <div class="box-body">
                  <div class="row">
                      <div class="col-lg-4"></div>
                      <div class="col-lg-4">
                          <div class="form-group">
                              <label for="Grade Number">Grade Number</label>
                              <select class="form-control select2" style="width: 100%;" name="gradenumbersss" id="gradenumbersss">
                                  <option selected="selected" value=""> -- Grade Number -- </option>
                                  <?php 
                                  $result = $mat->SelectallGradeNumber();
                                  foreach($result as $row){
                                      ?>
                                        <option value="<?=$row['id']?>"><?=$row['gradenumber']." ".$row['gradesection']?></option>
                                      <?php 
                                  }
                                  ?>
                                </select>
                          </div>
                      </div>
                      <div class="col-lg-4"></div>
                  </div>    
                </div>
            </div>
        </div>            
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Student Update</h3>
                </div>
                <div class="box-body table-responsive">      
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Roll No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Register No</th>
                                <th scope="col">Address</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Blood Group</th>
                                <th scope="col">Email Address</th>
                                <th scope="col">Joined Date</th>
                                <th scope="col">Guardian/Parents Name</th>
                                <th scope="col">Mobile No</th>
                                <th scope="col">Email Address</th>
                                
                            </tr>
                        </thead>
                        <tbody id="studentDetailsLoad"></tbody>
                    </table>
                </div>            
            </div>
        </div>
    </div>
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
<script>
$(document).ready(function () {
    $('.select2').select2();
        $( "#gradenumbersss" ).change(function() {
        function fetch_student_details()
        {
            var gradenumber = $('#gradenumbersss').val();
            $.ajax({
                url: "loadstudentDetailsToedit",
                method: "POST",
                data:{gradenumber:gradenumber},
                success:function(jsonData)
                {
                    $('#studentDetailsLoad').html(jsonData);
                }
            });
        }
        fetch_student_details();
        $('#studentDetailsLoad').editable({
            container: 'body',
            selector: 'td.studentname',
            url: 'updateStudent',
            title: 'Name With Intials',
            type: 'POST',
            validate: function(value){
                if($.trim(value) == "")
                {
                    return 'This Field is required';
                }
            }
        });

        $('#studentDetailsLoad').editable({
            container: 'body',
            selector: 'td.rollno',
            url: 'updateStudent',
            title: 'Roll No',
            type: 'POST',
            validate: function(value){
                if($.trim(value) == "")
                {
                    return 'This Field is required';
                }
            }
        });
            
        $('#studentDetailsLoad').editable({
            container: 'body',
            selector: 'td.studentcode',
            url: 'updateStudent',
            title: 'Student Code',
            type: 'POST',
            validate: function(value){
                if($.trim(value) == "")
                {
                    return 'This Field is required';
                }
            }
        });

        $('#studentDetailsLoad').editable({
            container: 'body',
            selector: 'td.studentadress',
            url: 'updateStudent',
            title: 'Address',
            type: 'POST',
            validate: function(value){            
                if($.trim(value) == "")
                {
                    return 'This Field is required';
                }
            }
        });

        $('#studentDetailsLoad').editable({
            container: 'body',
            selector: 'td.studentgender',
            url: 'updateStudent',
            title: 'Gender',
            type: 'POST',
            source: [{value: "male", text: "Male"}, {value: "female", text: "Female"}],
            validate: function(value){
                if($.trim(value) == "")
                {
                    return 'This Field is required';
                }
            }
        });

        $('#studentDetailsLoad').editable({
            container: 'body',
            selector: 'td.parentname',
            url: 'updateStudent',
            title: 'Guardian/Parents Name',
            type: 'POST',
            validate: function(value){
                if($.trim(value) == "")
                {
                    return 'This Field is required';
                }
            }
        });

        $('#studentDetailsLoad').editable({
            container: 'body',
            selector: 'td.parentmobile',
            url: 'updateStudent',
            title: 'Mobile No',
            type: 'POST',
            validate: function(value){
                if($.trim(value) == "")
                {
                    return 'This Field is required';
                }
                var expression = /^[0-9]+$/;
                if(!expression.test(value))
                {
                    return "Numbers Only!";
                }
            }
        });

        $('#studentDetailsLoad').editable({
            container: 'body',
            selector: 'td.parentemail',
            url: 'updateStudent',
            title: 'Email Address',
            type: 'POST',
            validate: function(value){
                if($.trim(value) == "")
                {
                    return 'This Field is required';
                }
            }
        });
            
        $('#studentDetailsLoad').editable({
            container: 'body',
            selector: 'td.studentemail',
            url: 'updateStudent',
            title: 'Student Email Address',
            type: 'POST',
            validate: function(value){
                if($.trim(value) == "")
                {
                    return 'This Field is required';
                }
            }
        });
    });
    
    
});
</script>
</body>
</html>