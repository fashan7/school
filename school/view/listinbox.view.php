<?php 
session_start();
$mat = new materialController;
?>
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
            $result = $mat->inboxmail($_SESSION['loguserid']);
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