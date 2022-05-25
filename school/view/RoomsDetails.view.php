<?php 
$mat = new materialController;
$id = $_POST['hostelroomID'];
$result = $mat->hostelRoomsDetails($id);
$resultHostelType = $mat->hosteltypeID($result['hostel_type']);
$resultHostelDetails = $mat->hostelDetails($result['hostel_name']);
?>

<div class="row">    
        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-aqua-active">
                <div class="row">
                    <h3 class="widget-user-username">Hostel Name- &nbsp;<?=$resultHostelDetails['hostel_name']?></h3> 
                    <h5 class="widget-user">Hostel Tyoe - &nbsp;<?=$resultHostelType['name']?></h5>
                </div>                
            </div>
            <div class="widget-user-image">
                <img class="img-circle" src="/../public/img/hostel.png" alt="User Avatar">
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?=$result['floor_name']?></h5>
                            <span class="description-text"><i>Floor Name</i></span>
                        </div>
                    </div>                
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?=$result['room_no']?></h5>
                            <span class="description-text"><i>Room No</i></span>
                        </div>
                    </div>            
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header"><?=$result['no_of_beds']?></h5>
                            <span class="description-text"><i>No Of Beds</i></span>
                        </div>                  
                    </div>                
                </div>
                <div class="row">
                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">Rs <?=number_format($result['amount'],2)?></h5>
                            <span class="description-text"><i>Rent Amount</i></span>
                        </div>
                    </div>                
                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?=$result['available_beds']?></h5>
                            <span class="description-text"><i>Available Beds</i></span>
                        </div>
                    </div>            
                    <div class="col-sm-3">
                        <div class="description-block">
                            <h5 class="description-header"><?=$result['accepted_beds']?></h5>
                            <span class="description-text"><i>Accepted Beds</i></span>
                        </div>                  
                    </div> 
                    <div class="col-sm-3">
                        <div class="description-block">
                            <h5 class="description-header"><?=$result['allocated_bed']?></h5>
                            <span class="description-text"><i>Allocated Beds</i></span>
                        </div>                  
                    </div> 
                </div>
            </div>
        </div>    
</div>