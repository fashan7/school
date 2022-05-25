<?php
session_start();
if (!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;
$result = $mat->inboxmail($_SESSION['loguserid']);
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
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
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

        <link rel="stylesheet" href="/../public/js/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <script src="/../public/js/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <link rel="stylesheet" href="/../public/css/jquery.tag-editor.css">
        <script src="/../public/js/jquery.tag-editor.js"></script>
        <link rel="stylesheet" href="/../public/css/flat/blue.css">
        <script src="/../public/js/icheck.min.js"></script>    

    </head>
    <body class="hold-transition skin-blue sidebar-mini" id="bodytag">
        <div class="wrapper" >
            <?php
            $objpage->header();
            ?>
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Mailbox
                        <small><?=COUNT($result)?> new messages</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Mailbox</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="javascript:void(0)" id="composeClick" class="btn btn-primary btn-block margin-bottom">Compose</a>
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Folders</h3>
                                    <div class="box-tools">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li class="active"><a href="javascript:void(0)" class="clicktoinboxshw"><i class="fa fa-inbox"></i> Inbox
                                                <span class="label label-primary pull-right"><?=COUNT($result)?></span></a>                                
                                        </li>
                                        <li><a href="javascript:void(0)" class="clicktoinboxall"><i class="fas fa-file-alt"></i> All Inbox Mails</a></li>
                                        <li><a href="javascript:void(0)" class="clicktosentshw"><i class="fab fa-telegram"></i> Sent</a></li>
                                        
                                    </ul>
                                </div>            
                            </div>
<!--                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Labels</h3>
                                    <div class="box-tools">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li><a href="javascript:void(0)"><i class="fas fa-circle-notch text-red"></i> Important</a></li>
                                        <li><a href="javascript:void(0)"><i class="fas fa-circle-notch text-yellow"></i> Promotions</a></li>
                                        <li><a href="javascript:void(0)"><i class="fas fa-circle-notch text-light-blue"></i> Social</a></li>
                                    </ul>
                                </div>        
                            </div>          -->
                        </div>        
                        <div class="col-md-9" id="categoryChange">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Inbox</h3>
                                    <div class="box-tools pull-right">
                                        <div class="has-feedback">
                                            <input type="text" class="form-control input-sm" placeholder="Search Mail">
                                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                        </div>
                                    </div>              
                                </div>            
                                <div class="box-body no-padding">
                                    <div class="table-responsive mailbox-messages">
                                        <?php
                                        
                                        if (COUNT($result) > 0) {
                                            ?>
                                            <table class="table table-hover table-striped">
                                                <tbody>
                                                    <?php
                                                    foreach ($result as $row) {
                                                        ?>
                                                        <tr>
                                                            <td style="width: 10px"><input type="checkbox"></td>
                                                            <td class="mailbox-star"  style="width: 10px"><a href="javascript:void(0)"><i class="fa fa-star text-yellow"></i></a></td>
                                                            <td class="mailbox-name"><a href="javascript:void(0)" id="readmail" data-id="<?= $row['id'] ?>"><?= $row['fromname'] ?></a></td>
                                                            <td class="mailbox-subject"><b><?= $row['subject'] ?></b></td>
                                                            <td class="mailbox-attachment"></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>               
                                                </tbody>
                                            </table>    
                                            <?php
                                        } else {
                                            ?>
                                            <div class="col-lg-12" style="text-align: center">
                                                <h3><b>No Mails Found</b></h3>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>              
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
            $(document).on('click', '.clicktoinboxall', function () {                
                $.ajax({
                    url: "listallinbox",
                    method: "POST",
                    success: function (jsonData) {
                        $('#categoryChange').html(jsonData);
                    }
                });
            });
            $(document).on('click', '.clicktoinboxshw', function () {                
                $.ajax({
                    url: "listinbox",
                    method: "POST",
                    success: function (jsonData) {
                        $('#categoryChange').html(jsonData);
                    }
                });
            });
            $(document).on('click', '.clicktosentshw', function () {                
                $.ajax({
                    url: "listsentbox",
                    method: "POST",
                    success: function (jsonData) {
                        $('#categoryChange').html(jsonData);
                    }
                });
            });
            $(document).on('click', '#composeClick', function () {
                $.ajax({
                    url: "compose",
                    method: "POST",
                    success: function (jsonData) {
                        $('#categoryChange').html(jsonData);
                    }
                });
            });
            $(document).on('click', '#readmail', function () {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "inBox",
                    method: "POST",
                    data:{id:id},
                    success: function (jsonData) {
                        $('#categoryChange').html(jsonData);
                    }
                });
            });
            $(document).on('click', '#readmailsent', function () {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "sentBox",
                    method: "POST",
                    data:{id:id},
                    success: function (jsonData) {
                        $('#categoryChange').html(jsonData);
                    }
                });
            });
        </script>
        <script>
            $(function () {
                //Enable iCheck plugin for checkboxes
                //iCheck for checkbox and radio inputs
                $('.mailbox-messages input[type="checkbox"]').iCheck({
                    checkboxClass: 'icheckbox_flat-blue',
                    radioClass: 'iradio_flat-blue'
                });

                //Enable check and uncheck all functionality
                $(".checkbox-toggle").click(function () {
                    var clicks = $(this).data('clicks');
                    if (clicks) {
                        //Uncheck all checkboxes
                        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
                    } else {
                        //Check all checkboxes
                        $(".mailbox-messages input[type='checkbox']").iCheck("check");
                        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
                    }
                    $(this).data("clicks", !clicks);
                });

                //Handle starring for glyphicon and font awesome
                $(".mailbox-star").click(function (e) {
                    e.preventDefault();
                    //detect type
                    var $this = $(this).find("a > i");
                    var glyph = $this.hasClass("glyphicon");
                    var fa = $this.hasClass("fa");

                    //Switch states
                    if (glyph) {
                        $this.toggleClass("glyphicon-star");
                        $this.toggleClass("glyphicon-star-empty");
                    }

                    if (fa) {
                        $this.toggleClass("fa-star");
                        $this.toggleClass("fa-star-o");
                    }
                });
            });
        </script>
    </body>
</html>