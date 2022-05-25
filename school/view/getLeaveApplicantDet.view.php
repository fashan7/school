<?php
$id = $_POST['id'];
$mat = new materialController;
$resultPro = $mat->getSingleChildleaveApp($id);
$resultMain = $mat->SelectdetailLeaveCate($resultPro['parent_app']);
$result = $mat->SelectStaffbyid($resultMain['staff']);
$resultdep = $mat->departmentDetails($resultMain['department']);
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Leave Applicant Details</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="Leave Type">Leave Type</label>
                    &nbsp;&nbsp;<?=$resultdep['name']?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="Staff Name">Staff Name</label>
                    &nbsp;&nbsp;<?=$result['fullname']?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="From Date">From Date</label>
                    &nbsp;&nbsp;<?=$resultPro['fdate']?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="To Date">To Date</label>
                    &nbsp;&nbsp;<?=$resultPro['tdate']?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="Status">Status</label>
                    &nbsp;&nbsp;<?=$resultPro['status']?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="Reason">Reason</label>
                    &nbsp;&nbsp;<?=$resultPro['reason']?>
                </div>
            </div>
        </div>
    </div>
</div>