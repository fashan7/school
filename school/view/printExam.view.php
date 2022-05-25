<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new detailsController;
$objpage = new pageController;
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
  <link rel="shortcut icon" href="/../public/img/school.png">
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
<body class="hold-transition skin-blue sidebar-mini" id="bodytag" onload="window.print();">
<div class="row">        
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <?php 
                $arr = array();
                $row = $obj->valueofExamTimetablesingle();
                foreach($row as $res){
                    $arr[0] = $res['className'];
                    $arr[1] = $res['year'];
                    $arr[2] = $res['dateperiod'];
                }
                ?>
                <h3 class="box-title">Exam TimeTable of &nbsp;<?=$arr[0]?>&nbsp;<small><?=$arr[1]?></small></h3>
                <div style="text-align: right">
                    Exam Start From <?=$arr[2]?>
                </div>
            </div>
            <div class="box-body">
                <table id="table2" class="table order-list">
                    <tbody>
                        <tr>
                            <td class="redips-mark dark">Hour</td>
                            <td class="redips-mark dark">Monday</td>
                            <td class="redips-mark dark">Hour</td>
                            <td class="redips-mark dark">Tuesday</td>
                            <td class="redips-mark dark">Hour</td>
                            <td class="redips-mark dark">Wednesday</td>
                            <td class="redips-mark dark">Hour</td>
                            <td class="redips-mark dark">Thursday</td>
                            <td class="redips-mark dark">Hour</td>
                            <td class="redips-mark dark">Friday</td>
                        </tr>
                        <?php 
                            $obj->Examtimetable(1); 
                            $result0 = $obj->ExamtimetableVerfication(2, 2);
                            if($result0 == 'false')
                            {
                               $obj->Examtimetable(2);  
                            }
                            else{}                                 
                            $result = $obj->ExamtimetableVerfication(4, 4);
                            if($result == 'false')
                            {
                            ?>
                            <tr>
                                <td class="redips-mark dark">Hour</td>
                                <td class="redips-mark dark">Monday</td>
                                <td class="redips-mark dark">Hour</td>
                                <td class="redips-mark dark">Tuesday</td>
                                <td class="redips-mark dark">Hour</td>
                                <td class="redips-mark dark">Wednesday</td>
                                <td class="redips-mark dark">Hour</td>
                                <td class="redips-mark dark">Thursday</td>
                                <td class="redips-mark dark">Hour</td>
                                <td class="redips-mark dark">Friday</td>
                            </tr>
                            <?php $obj->Examtimetable(4); 
                            }
                            else{}
                            $result1 = $obj->ExamtimetableVerfication(5, 5);
                            if($result1 == 'false')
                            {
                               $obj->Examtimetable(5);  
                            }
                            else{}
                            ?>
                    </tbody>
                </table>                    
            </div>              
        </div>
    </div>            
</div>
<footer class="main-footer">
    <div class="pull-right hidden-xs"></div>
    <strong>Copyright &copy; 2019 <a href="https://www.linkedin.com/in/mohammed-fashan-a59092187/" target="_blank">Fashan</a>.</strong> All rights reserved.
</footer>
</body>
</html>