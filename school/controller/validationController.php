<?php
//session_start();
class validationController
{
    public function usernameValidation()
    {
        $username = $_REQUEST['username'];
        $fields = 'username';
        $table  = "user_reg WHERE username = '$username'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';
    }
    
    public function passwordValidation()
    {
        $loguserid = $_SESSION['loguserid'];
        $cpassword = $_REQUEST['cpassword'];
        $cpassword = base64_encode($cpassword);
        $table  = "user_reg WHERE id = '$loguserid'";
        $obj = new commonSql;
        
        $row = $obj->display($table);
        if($row['password'] != $cpassword)
            echo  'false';
        else
            echo  'true';
    }
    
    public function userTypeValidation()
    {
        $name = $_REQUEST['usertype'];
        $fields = 'name';
        $table  = "user_type WHERE name = '$name'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';
    }
    
    public function SubjectValidation()
    {
        $name = $_REQUEST['newSubject'];
        $fields = 'sub_name';
        $table  = "class_subject WHERE sub_name = '$name'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';
    }
    
    public function staffCodeValidation()
    {
        $name = $_REQUEST['code'];
        $fields = 'code';
        $table  = "staff_reg WHERE code = '$name'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';   
    }
    
    public function studentCodeValidation()
    {
        $name = $_REQUEST['studentcode'];
        $fields = 'studentcode';
        $table  = "studentreg WHERE studentcode = '$name'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';   
    }
    
    public function monthCheckSalary()
    {
        $monthOnly = $_POST['monthOnly']; $staffid = $_POST['staffid'];
        
        $fields = 'id';
        $table  = "staff_salary WHERE payment_month = '$monthOnly' AND staff_id = '$staffid'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true'; 
    }
    
    public function monthCheckStudentFees()
    {
        $monthOnly = $_POST['monthOnly']; $stuid = $_POST['stuid'];
        
        $fields = 'id';
        $table  = "student_fees WHERE payment_month = '$monthOnly' AND student_id = '$stuid'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true'; 
    }
    
    public function DepartmentValidation()
    {
        $name = $_REQUEST['depname'];
        $fields = 'name';
        $table  = "staff_department WHERE name = '$name' AND status = 'yes'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';
    }
    
    public function bankValidation()
    {
        $name = $_REQUEST['bankname'];
        $fields = 'name';
        $table  = "banks WHERE name = '$name' AND status = 'yes'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';   
    }
    
    public function LeaveCategoryValidation()
    {
        $name = $_REQUEST['leaveCat'];
        $fields = 'name';
        $table  = "leave_category WHERE name = '$name' AND status = 'yes'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';
    }
    
    public function bookCategoryValidation()
    {
        $name = $_REQUEST['categoryname'];
        $fields = 'name';
        $table  = "book_category WHERE name = '$name' AND status = 'yes'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';   
    }
    
    public function bookCategorySectionValidation()
    {
        $name = $_REQUEST['sectioncode'];
        $fields = 'name';
        $table  = "book_category WHERE code = '$name' AND status = 'yes'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true'; 
    }
    
    public function bookCategoryupdValidation()
    {
        $name = $_REQUEST['categorynameupd']; $id = $_REQUEST['cid'];
        $fields = 'name';
        $table  = "book_category WHERE name = '$name' AND status = 'yes' AND id != '$id'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';
    }
    public function bookCategorySectionupdValidation()
    {
        $name = $_REQUEST['sectioncodeupd']; $id = $_REQUEST['cid'];
        $fields = 'name';
        $table  = "book_category WHERE code = '$name' AND status = 'yes' AND id != '$id'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';
    }
    
    public function BooknoValidation()
    {
        $bookno = $_REQUEST['bookno']; $isbnno = $_REQUEST['isbnno'];
        $fields = 'bookno';
        $table  = "librarybooks WHERE bookno = '$bookno' AND isbn_no = '$isbnno'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';   
    }
    
    public function hostelTypeValidation()
    {
        $name = $_REQUEST['hosteltype'];
        $fields = 'name';
        $table  = "hostel_type WHERE name = '$name' AND active = 'yes'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';  
    }
    
    public function hostelTypeUpdateValidation()
    {
        $name = $_REQUEST['hosteltypeupd']; $id = $_REQUEST['htypeid'];
        $fields = 'name';
        $table  = "hostel_type WHERE name = '$name' AND active = 'yes' AND id != '$id'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';
    }
    
    public function hostelRoomsCountUsers($user, $usertype)
    {
        if($usertype == 'student')
        {
            $fields = 'id';
            $table  = "hostelmem_reg WHERE user = '$user' AND usertype = '$usertype' AND active = 'yes'";
            $obj = new commonSql;

            $count = count($obj->displaySum($fields, $table));
            return $count;
        }
        else if($usertype == 'employee')
        {
            $fields = 'id';
            $table  = "hostelmem_reg WHERE user = '$user' AND usertype = '$usertype' AND active = 'yes'";
            $obj = new commonSql;

            $count = count($obj->displaySum($fields, $table));
            return $count;
        }
            
    }
    
    public function hostelRoomsCountUsers1($user, $usertype)
    {
        if($usertype == 'student')
        {
            $fields = 'id';
            $table  = "hostelmem_reg WHERE user = '$user' AND usertype = '$usertype' AND active = 'yes' AND status = 'rent'";
            $obj = new commonSql;

            $count = count($obj->displaySum($fields, $table));
            return $count;
        }
        else if($usertype == 'employee')
        {
            $fields = 'id';
            $table  = "hostelmem_reg WHERE user = '$user' AND usertype = '$usertype' AND active = 'yes' AND status = 'rent'";
            $obj = new commonSql;

            $count = count($obj->displaySum($fields, $table));
            return $count;
        }
            
    }
    
    public function hostelRoomsCountVacateUsers($user, $usertype, $roomid)
    {
        if($usertype == 'student')
        {
            $fields = 'id';
            $table  = "hostelmem_reg WHERE user = '$user' AND usertype = '$usertype' AND hostel_room = '$roomid' AND  status = 'vacate'";
            $obj = new commonSql;

            $count = count($obj->displaySum($fields, $table));
            return $count;
        }
        else if($usertype == 'employee')
        {
            $fields = 'id';
            $table  = "hostelmem_reg WHERE user = '$user' AND usertype = '$usertype' AND hostel_room = '$roomid' AND  status = 'vacate'";
            $obj = new commonSql;

            $count = count($obj->displaySum($fields, $table));
            return $count;
        }            
    }
    
    public function vehicleValidation()
    {
        $vehicleno = $_REQUEST['vehicleno1']."-".$_REQUEST['vehicleno2'];
        $fields = 'vehicle_no';
        $table  = "vehicle_reg WHERE vehicle_no = '$vehicleno' AND status = 'yes'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';    
    }
    
    public function feecategoryValidation()
    {
        $feecategory = $_REQUEST['feecategory'];
        $fields = 'id';
        $table  = "fee_category WHERE category_name = '$feecategory' AND status = 'yes'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';  
    }
    
    public function feecategoryUpdateValidation()
    {
        $feecategory = $_REQUEST['feecategoryupd']; $feesid = $_REQUEST['feesid'];
        $fields = 'id';
        $table  = "fee_category WHERE category_name = '$feecategory' AND status = 'yes' AND id != '$feesid'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';  
    }
    
    public function SubFeeCategoryValidation()
    {
        $feecategory = $_REQUEST['feesubcategoryname'];
        $fields = 'id';
        $table  = "sub_fee_category WHERE sub_category_name = '$feecategory' AND status = 'yes'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';  
    }
    
    public function vehicleValidationUpdate()
    {
        $id = $_REQUEST['vehicleid'];
        $vehicleno = $_REQUEST['vehicleno1Upd']."-".$_REQUEST['vehicleno2Upd'];
        $fields = 'vehicle_no';
        $table  = "vehicle_reg WHERE vehicle_no = '$vehicleno' AND status = 'yes' AND id != '$id'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true';
    }
    
    public function branchValidation()
    {
        $name = $_REQUEST['branchname'];
        $fields = 'name';
        $table  = "branch WHERE name = '$name' AND active = 'yes'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true'; 
    }
    
    public function parentUsernameValidation()
    {
        $name = $_REQUEST['username'];
        $fields = 'username';
        $table  = "user_reg WHERE username = '$name' AND status = 'yes' AND usertype = '5'";
        $obj = new commonSql;
        
        $count = count($obj->displaySum($fields, $table));
        if($count > 0)
            echo  'false';
        else
            echo  'true'; 
    }
}