<?php 
$mat = new materialController;
$id = $_POST['id'];
$result = $mat->inboxmailsingle($id);
$ob = new updateController;
$ob->updateinbox($id);
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Read Mail</h3>
<!--        <div class="box-tools pull-right">
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
        </div>-->
    </div>
    <div class="box-body no-padding">
        <div class="mailbox-read-info">
            <h3><?=$result['subject']?></h3>
            <h5>From: <?=$result['frommail']?>
        </div>                
        <div class="mailbox-read-message">
            <?=$result['remarks']?>
        </div>        
    </div>    
    
<!--    <div class="box-footer">
        <div class="pull-right">
            <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
            <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
        </div>
        <button type="button" class="btn btn-default"><i class="fas fa-trash"></i> Delete</button>
        <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
    </div>        -->
</div>