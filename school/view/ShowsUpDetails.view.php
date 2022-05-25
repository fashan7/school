<?php 
$mat = new materialController;
$id = $_POST['id'];
$ResultChild = $mat->bookListChild($id);
$ResultParent = $mat->bookListParent($ResultChild['librarybooks_parent']);
$ResultCategory = $mat->bookcategorybyID($ResultParent['book_category']);
$color = '';
if($ResultChild['status'] == 'Available')
{
    $color = 'success';
}
else if($ResultChild['status'] == 'issued')
{
    $color = 'danger';
}
$ResultIssued = $mat->getDetailsIssuedBook($id);
?>

<div class="row">    
    <div class="col-md-12">
        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-aqua-active">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="widget-user-username"><?=$ResultChild['title']?></h3>
                        <h6 class="widget-user"><i class="fa fa-circle text-<?=$color?>"></i>&nbsp;&nbsp;<?=$ResultChild['status']?></h6>
                    </div>                    
                    <div class="col-md-6">  
                        <h5 class="widget-user-desc" style="text-align: right">Author - <?=$ResultChild['author']?></h5>
                        <?php 
                        if($ResultChild['publisher'] != "")
                        {
                          ?>
                            <h5 class="widget-user-desc"  style="text-align: right">Published By - <?=$ResultChild['publisher']?></h5>
                          <?php  
                        }
                        ?>
                    </div>                    
                </div>
                
            </div>
            <div class="widget-user-image">
                <img class="img-circle" src="/../public/img/books.jpg" alt="User Avatar">
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?=$ResultChild['isbn_no']?></h5>
                            <span class="description-text"><i>ISBN No</i></span>
                        </div>
                    </div>                
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?=$ResultChild['bookno']?></h5>
                            <span class="description-text"><i>Book No</i></span>
                        </div>
                    </div>            
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header"><?=$ResultParent['edition']?></h5>
                            <span class="description-text"><i>Edition</i></span>
                        </div>                  
                    </div>                
                </div> 
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?=$ResultCategory['name']?></h5>
                            <span class="description-text"><i>Category</i></span>
                        </div>
                    </div>                
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?=$ResultParent['shelf_no']?></h5>
                            <span class="description-text"><i>Shelf No</i></span>
                        </div>
                    </div>            
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header"><?=$ResultParent['book_position']?></h5>
                            <span class="description-text"><i>Book Position</i></span>
                        </div>                  
                    </div>                
                </div> 
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?=$ResultParent['no_of_copies']?></h5>
                            <span class="description-text"><i>No Of Copies</i></span>
                        </div>
                    </div>                
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?=$ResultParent['book_cost']?></h5>
                            <span class="description-text"><i>Cost</i></span>
                        </div>
                    </div>            
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header"><?=$ResultParent['book_condition']?></h5>
                            <span class="description-text"><i>Condition</i></span>
                        </div>                  
                    </div>                
                </div> 
                <div class="row">
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?=$ResultIssued['issue_date']?></h5>
                            <span class="description-text"><i>Issued Date</i></span>
                        </div>
                    </div>              
                    <div class="col-sm-6">
                        <div class="description-block">
                            <h5 class="description-header"><?=$ResultIssued['due_date']?></h5>
                            <span class="description-text"><i>Due Date</i></span>
                        </div>                  
                        <input type="hidden" name="dueDates" id="dueDates" value="<?=$ResultIssued['due_date']?>">
                        <input type="hidden" name="issueDates" id="issueDates" value="<?=$ResultIssued['issue_date']?>">
                    </div>                
                </div> 
            </div>
        </div>    
    </div>
    <div class="col-md-4"></div>
</div>