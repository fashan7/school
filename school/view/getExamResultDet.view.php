<?php
$id = $_POST['id'];
$mat = new materialController;
$resultPro = $mat->singReultsheet($id);
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Result Sheet</h3>
    </div>
    <div class="box-body">
        <div class="row">            
            <div class="col-lg-12">
                <?=$resultPro['track']?>
            </div>
        </div>
    </div>
</div>