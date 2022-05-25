<?php 
$mat = new materialController;
$students = $_POST['students'];
$result = $mat->SelectStudentbyid($students);
$gradeRes = $mat->SelectGradeNumberbyid($result['grade']);
?>
<div class="row">    
    <div class="col-md-12">
        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-aqua-active">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="widget-user-username"><?=$result['studentname']?></h3>
                        <h5 class="widget-user"><?=$result['studentcode']?></h5>
                    </div>                   
                </div>
                
            </div>
            <div class="widget-user-image">
                <img class="img-circle" src="/../public/img/studentm.jpg" alt="User Avatar">
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?=$gradeRes['gradenumber']." - ".$gradeRes['gradesection']?></h5>
                            <span class="description-text"><i>Grade - Section</i></span>
                        </div>
                    </div>                
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?=$result['parentname']?></h5>
                            <span class="description-text"><i>Name of Parents</i></span>
                        </div>
                    </div>            
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header"><?=$result['parentmobile']?></h5>
                            <span class="description-text"><i>Parents Contact No</i></span>
                        </div>                  
                    </div>                
                </div> 
                <div class="row">
                    <div class="col-sm-12 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?=$result['parentaddress']?></h5>
                            <span class="description-text"><i>Address</i></span>
                        </div>
                    </div>                  
                </div> 
                
            </div>
        </div>    
    </div>
</div>