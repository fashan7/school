<?php 
class searchController
{
    public function searchStaff()
    {
        $keyword = strval($_POST['query']);
        
        $field = "fullname, code, address";
        $table = "staff_reg WHERE fullname LIKE '%$keyword%' OR code LIKE '%$keyword%'";
        $data = array();
        $obj = new commonSql;
        $row = $obj->displaySum($field, $table);   
        
        $html = '';
        $html .= '<table class="table table-bordered table-striped">
                    <tr>
                        <td>Name</td>
                        <td>Code</td>
                        <td>Address</td>
                    </tr>';
        
        foreach($row as $result)
        {
            $data[] = $result["fullname"];
            $data[] = $result["code"];
            $html .= '<tr>
                        <td>'.$result["fullname"].'</td>
                        <td>'.$result["code"].'</td>
                        <td>'.$result["address"].'</td>
                      </tr>';
        }
        $html .= "</table>";
        if(isset($_POST['typeahead_search']))
        {
            echo $html;
        }
        else
        {
            $data = array_unique($data);
            echo json_encode($data);
        }               
    }
}