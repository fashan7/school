<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new detailsController;
$objpage = new pageController;
$mat = new materialController;

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>School</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="/../public/img/school.png">
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
  <script src="/../public/js/select2.min.js"></script>      
  <link rel="stylesheet" href="/../public/css/select2.min.css">
  <script src="/../public/ajax/header.js"></script>
  <script src="/../public/js/alertify.min.js"></script>
  <script src="/../public/js/jquery-ui.min.js"></script>
  <script data-pace-options='{ "ajax": false }' src="/../public/js/pace.js"></script>    
  <script src="/../public/js/jquery.validate.min.js"></script>
  <script src="/../public/js/bootstrap.min.js"></script>
  <script src="/../public/js/admin.min.js"></script>
<style>
table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}
table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}
table tr {
  background: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}
table th,
table td {
  padding: .625em;
  text-align: center;
}
table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}
@media screen and (max-width: 600px) {
  table {
    border: 0;
  }
  table caption {
    font-size: 1.3em;
  }
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  table td:before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  table td:last-child {
    border-bottom: 0;
  }
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
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Select Grade And Name The TimeTable</h3>
                </div>                
                    <div class="box-body">
                        <div class="row">                           
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="Grade Number">Grade Number</label>
                                    <select class="form-control select2" style="width: 100%;" name="gradenumbersss" id="gradenumbersss">
                                        <option selected="selected" value=""> -- Grade Number -- </option>
                                        <?php 
                                        $result12 = $mat->SelectallGradeNumber();
                                        foreach($result12 as $rows){
                                            ?>
                                            <option value="<?=$rows['id']?>"><?=$rows['gradenumber']." ".$rows['gradesection']?></option>
                                            <?php 
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group" id="tmenoload">
                                    <label for="TimeTable No">TimeTable No</label>
                                    <select class="form-control select2" style="width: 100%;" name="timetblno" id="timetblno">
                                        <option selected="selected" value=""> -- Select -- </option>                                        
                                    </select>
                                </div>
                            </div>                            
                            <div class="col-lg-2" style="padding-top: 24px">
                                <a class="btn btn-primary" id="loadtb" name="loadtb" onclick="pageLink()">Load TimeTable</a> 
                            </div>
                        </div>
                    </div>                
                </div>
        </div>
    </div>
    <div id="loadtimetable"></div>
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
$(document).ready(function(){ 
    $('.select2').select2();
});
$(document).on('change', '#gradenumbersss', function(){
    var grade = $('#gradenumbersss option:selected').val();
    if(grade != '')
    {
        $.ajax({
            url: "loadTimetableprofno",
            method: "POST",
            data:{grade:grade},
            success:function(jsonData)
            {
                $('#tmenoload').html(jsonData);
                $('#loadtimetable').html("");
            }
        });
    }
    else
        $('#tmenoload').html("");
        $('#loadtimetable').html("");
});
function pageLink()
{
    var timetblno = $('#timetblno').val();
    if(timetblno == '')
    {
        alert('Please Select The TimeTable No');
    }
    else
    {
        var a = document.getElementById('loadtb'); //or grab it by tagname etc
        a.href = "TimeTableEdit?timetblno="+timetblno;    
    }    
}
</script>
</body>
</html>