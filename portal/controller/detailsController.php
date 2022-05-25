<?php
class detailsController extends materialController
{
    public function autoCompleteStudent()
    {
        $search = $_GET['term']   ;
        $result = $this->SearchStudent($search);
        
        $data = array();
        foreach($result as $row){
            $sub_array['value'] = $row['studentname']." - ".$row['studentcode'];
            $sub_array['studentid'] = $row['id'];
            array_push($data, $sub_array);
        }
        echo json_encode($data);
    }
}
?>