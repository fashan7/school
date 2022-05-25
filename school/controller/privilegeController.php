<?php
class privilegeController
{
    public function pageCount()
    {
        $fields = 'id'; //table coloumn names
        $table = "pageallocation WHERE status = 'yes'"; //table name
        
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }
    
    public function countUserPrivledge($userid, $pagesid)
    {
        $fields = "COUNT(id)";
        $table = "user_priviledge WHERE userid = '$userid' AND pageallocation_id = '$pagesid'";
        
        $obj = new commonSql;
        return $obj->displayCount($fields, $table);
    }
    
    public function getDate()
    {
        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d');
        return $date;
    }
    
    public function getTime()
    {
        date_default_timezone_set('Asia/Colombo');
        $time = date('H:i:s:A');
        return $time;
    }
    
    public function selectPageSide($loguserid)
    {
        $fields = "pa.primarysection, pa.sectionposition";
        $table = "pageallocation pa JOIN user_priviledge  pr ON pr.pageallocation_id = pa.id WHERE pa.status = 'yes' AND pr.viewstatus = 'yes' AND  pr.userid  = '$loguserid' GROUP BY pa.primarysection ORDER BY pa.sectionposition ";
        
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }
    
    public function enablePriviledge($loguserid, $sectioName)
    {
        $fields = "pa.pages";
        $table = "pageallocation pa JOIN user_priviledge pr ON pr.pageallocation_id = pa.id WHERE pr.userid = '$loguserid' AND pa.primarysection = '$sectioName' AND pa.status = 'yes'";
        
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }
    
    public function CustomizePageRelatedView($loguserid, $primarysection)
    {        
        $fields = "pa.pages, pa.name, pa.image";
        $table  = "pageallocation pa JOIN user_priviledge pr ON pr.pageallocation_id = pa.id WHERE pr.userid = '$loguserid' AND pa.primarysection = '$primarysection' AND pr.viewstatus = 'yes'  AND pa.status = 'yes' ORDER BY pa.position";
        
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }
    
    public function getSamePage()
    {
        $page  = $_POST['page'];
        $fields = "pages";
        $table  = "pageallocation WHERE pages = '$page'";
                
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }
    
    public function selectsectionTB()
    {
        $fields = "primarysection";
        $table  = "pageallocation WHERE status = 'yes' GROUP BY primarysection ORDER BY id";
        
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }
    
    public function userprivOldPage($section, $id)
    {
        $fields = "pa.name, pr.viewstatus, pr.id";
        $table  = "user_priviledge pr JOIN pageallocation pa ON pa.id = pr.pageallocation_id 
		JOIN user_reg ur ON ur.id = pr.userid WHERE pa.primarysection = '$section' AND pa.status = 'yes' AND pr.userid = '$id' ORDER BY pa.position";
        
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }
    
    public function userprivNewPage($section)
    {
        $fields = "pa.name, pa.pages, pa.id";
        $table  = "pageallocation pa LEFT OUTER JOIN user_priviledge up ON pa.id = up.pageallocation_id 
		WHERE pa.primarysection = '$section' AND pa.status = 'yes' AND up.pageallocation_id IS NULL ORDER BY pa.position";
        
        $obj = new commonSql;
        return $obj->displaySum($fields, $table);
    }
}