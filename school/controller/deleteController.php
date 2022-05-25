<?php
class deleteController
{
    public function deleteDragSubject()
    {
        $obj = new commonSql;
        
        $p = @$_REQUEST['p'];echo $p;
        list($sub_id, $row, $col) = explode('_', $p);
        $sub_id = substr($sub_id, 0, 2);
        if (is_numeric($row) && is_numeric($col)) {
            $table = "school_timetable WHERE sub_id='$sub_id' and tbl_row=$row and tbl_col=$col limit 1";
            $obj->deletion($table);
        }
    }
    
    public function DeleteClassTimetable()
    {
        $obj = new commonSql; $timetblno = $_POST['timetblno'];
        $table = "school_timetable WHERE timetable_id = '$timetblno'";
        $obj->deletion($table);
        
        $table1 = "school_timetable_child WHERE timetable_id = '$timetblno'";
        $obj->deletion($table1);
    }
    
    public function deleteDragExamSubjects()
    {
        $obj = new commonSql;
        
        $p = @$_REQUEST['p'];
        list($sub_id, $row, $col) = explode('_', $p);
        $sub_id = substr($sub_id, 0, 2);
        if (is_numeric($row) && is_numeric($col)) {
            $table = "school_exam WHERE sub_id='$sub_id' and tbl_row=$row and tbl_col=$col limit 1";
            $obj->deletion($table);
        }
    }
    
    public function DeleteExamTimetable()
    {
        $obj = new commonSql;
        $table = "school_exam";
        $obj->deletion($table);
    }
    
    public function deleteNotes()
    {
        $id = $_POST['id'];
        $obj = new commonSql;
        $table = "short_notes WHERE id = '$id'";
        $obj->deletion($table);
    }
    
    
    public function deleteSubject()
    {
        $id = $_POST['id'];
        $obj = new commonSql;
        $table = "class_subject WHERE id = '$id'";
        $obj->deletion($table);
    }
    
    public function deleteTime()
    {
        $id = $_POST['id'];
        $obj = new commonSql;
        $table = "exam_time WHERE id = '$id'";
        $obj->deletion($table);
    }
    
    public function deleteBookCategory()
    {
        $id = $_POST['id'];
        $obj = new commonSql;
        $table = "book_category WHERE id = '$id'";
        $obj->deletion($table);
    }
    
    public function deleteSomeBooks()
    {
        $obj = new commonSql;  $mat = new materialController; $upd = new updateController;
        $id = $_POST['id'];
                
        $table = "librarybooks_child WHERE id = '$id'";
        
        $res = $mat->bookListChild($id);
        $result = $mat->bookListParent($res['librarybooks_parent']);
        $copies = $result['no_of_copies'] - 1;
        $obj->deletion($table);
        $upd->UpdatebookCopies($result['id'], $copies);    
    }
    
    public function hostelTypedelete()
    {
        $id = $_POST['id'];
        $obj = new commonSql;
        $table = "hostel_type WHERE id = '$id'";
        $obj->deletion($table);   
    }
    
    public function hostelsdelete()
    {
        $id = $_POST['id'];
        $obj = new commonSql;
        $table = "hostels_details WHERE id = '$id'";
        $obj->deletion($table);      
    }
    
    public function hostelsRoomsdelete()
    {
        $mat = new materialController; $obj = new commonSql; $id = $_POST['id'];
        $result = $mat->hostelRoomsDetails($id); $feetype = $result['fees_type'];
        
        $increment = 0;
        if($feetype == 'Annual')
        {
            $increment = 1;
        }
        else if($feetype == 'Bi-Annual')
        {
            $increment = 2;
        }
        else if($feetype == 'Tri-Annual')
        {
            $increment = 3;
        }
        else if($feetype == 'Quaterly')
        {
            $increment = 4;
        }
        else if($feetype == 'Monthly')
        {
            $increment = 12;
        }

        for($y = 1; $y <= $increment; $y++)
        {
            $table1 = "hostel_fees WHERE parent_hostel_rooms = '$id'";
            $obj->deletion($table1);  
        }
        
        $table = "hostel_rooms WHERE id = '$id'";
        $obj->deletion($table);  
    }
    
    public function hostelMemberDelete()
    {
        $mat = new materialController; $obj = new commonSql; 
        
        $id = $_POST['id'];
        $result = $mat->allHostelMemSingle($id);
        $hostelRoomid = $result['hostel_room'];
        
        $resultHostelRooms = $mat->hostelRoomsDetails($hostelRoomid);
        $allocatedbed = $resultHostelRooms['allocated_bed'] - 1;
        $availablebeds = $resultHostelRooms['available_beds'] + 1;
        
        $statusAvailble = '';
        if($availablebeds > 0)
        {
            $statusAvailble = 'Available';
        }
        else
        {
            $statusAvailble = 'Closed';
        }
        $collect = "available_beds = '$availablebeds', allocated_bed = '$allocatedbed', status = '$statusAvailble' WHERE id = '$hostelRoomid'"; $arr = array(); $arr[0] = $collect; $table1 = 'hostel_rooms';
        $obj->updation($table1, $arr); 
        
        $table = "hostelmem_reg WHERE id = '$id'";
        $obj->deletion($table); 
    }
    
    public function deleteFeesCategory()
    {
        $id = $_POST['id'];
        $obj = new commonSql;
        $table = "fee_category WHERE id = '$id'";
        $obj->deletion($table);  
    }
    
    public function deleteSubCategoryFine()
    {
        $id = $_POST['id'];
        $obj = new commonSql;
        $table = "sub_fee_category_fine WHERE id = '$id'";
        $obj->deletion($table);   
    }
    
    public function feeallocationdelete()
    {
        $id = $_POST['id'];
        $obj = new commonSql;
        $table = "fee_allocation WHERE id = '$id'";
        $obj->deletion($table); 
    }
    
    public function deleteVehicles() 
    {
        $id = $_POST['id'];
        $obj = new commonSql;
        $table = "vehicle_reg WHERE id = '$id'";
        $obj->deletion($table); 
    }
    
    public function deleteVehiclesdrivers()
    {
        $id = $_POST['id'];
        $obj = new commonSql;
        $table = "vehicle_drive WHERE id = '$id'";
        $obj->deletion($table);    
    }
    
    public function deleteVehiclesRoute()
    {
        $id = $_POST['id'];
        $obj = new commonSql;
        $table = "vehicle_route WHERE id = '$id'";
        $obj->deletion($table);    
    }
    
    public function deleteDestination()
    {
        $mat = new materialController; $obj = new commonSql; $id = $_POST['id'];
        $result = $mat->destinationGetbyid($id); $feetype = $result['fee_type'];
        
        $increment = 0;
        if($feetype == 'Annual')
        {
            $increment = 1;
        }
        else if($feetype == 'Bi-Annual')
        {
            $increment = 2;
        }
        else if($feetype == 'Tri-Annual')
        {
            $increment = 3;
        }
        else if($feetype == 'Quaterly')
        {
            $increment = 4;
        }
        else if($feetype == 'Monthly')
        {
            $increment = 12;
        }

        for($y = 1; $y <= $increment; $y++)
        {
            $table1 = "destination_fees WHERE desitnation = '$id'";
            $obj->deletion($table1);  
        }
        
        $table = "destination WHERE id = '$id'";
        $obj->deletion($table); 
    }
    
    public function deleteFeeSubCat()
    {
        $mat = new materialController; $obj = new commonSql; $id = $_POST['id'];
        $result = $mat->getSubcategoryFee($id); $feetype = $result['feetype'];
        
        $increment = 0;
        if($feetype == 'Annual')
        {
            $increment = 1;
        }
        else if($feetype == 'Bi-Annual')
        {
            $increment = 2;
        }
        else if($feetype == 'Tri-Annual')
        {
            $increment = 3;
        }
        else if($feetype == 'Quaterly')
        {
            $increment = 4;
        }
        else if($feetype == 'Monthly')
        {
            $increment = 12;
        }
        else if($feetype == 'One-Time')
        {
            $increment = 1;
        }
        for($y = 1; $y <= $increment; $y++)
        {
            $table1 = "fees_types WHERE parent_sub_category = '$id'";
            $obj->deletion($table1);  
        }
        
        $table = "sub_fee_category WHERE id = '$id'";
        $obj->deletion($table); 
    }
}
?>