<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];



  
$fields = "id, name";
$table = "user_type WHERE active = 'yes'";
        
    $obj = new commonSql;
    $row = $obj->displaySingle($fields, $table);
$count = count($row);
for($i=0;$i<2;$i++)
{
    echo $row->name;
}

?>
/*
<?php
class detailsController extends materialController
{
    public function eventLoad()
    {
        $obj = new commonSql;
        $fields = 'id, title, start_event, end_event, loguserid, status';
        $table = 'school_events';
        
        $data = array();
        $row = $obj->displaySum($fields, $table);   
        
        foreach($row as $result)
        {
            $data[] = array(
                "id" => $result['id'],
                "title" => $result['title'],
                "start" => $result['start_event'],
                "end" => $result['end_event']
            );
        }
        echo json_encode($data);
    }
    
    public function loadStaffDetailsToedit()
    {
        $field = "id, fullname, code, address, gender, dob, mobile, email, department, joiningdate";
        $table = "staff_reg";
        $data = array();
        $obj = new commonSql;
        
        
        if(isset($_POST['staffno']))
        {
            $table .= ' WHERE id = "'.$_POST['staffno'].'"';
        }
        
        $row = $obj->displaySum($field, $table);    
        $html_data = '';
        foreach($row as $result){
            
            $res = $this->departmentDetails($result["department"]);
            
            $html_data = '<tr><td data-label="Fullname" data-name="fullname" class="fullname" data-type="text" data-pk="'.$result["id"].'">'.$result["fullname"].'</td>';
            $html_data .= '<td data-label="Code" data-name="code" class="code" data-type="text" data-pk="'.$result["id"].'">'.$result["code"].'</td>';
            $html_data .= '<td data-label="Address" data-name="address" class="address" data-type="text" data-pk="'.$result["id"].'">'.$result["address"].'</td>';
            $html_data .= '<td data-label="Gender" data-name="gender" class="gender" data-type="select" data-pk="'.$result["id"].'">'.$result["gender"].'</td>';
            $html_data .= '<td data-label="Date OF Birth" data-name="dob" class="dob" data-type="combodate" data-format="DD-MM-YYYY" data-template="D / MMM / YYYY" data-pk="'.$result["id"].'">'.$result["dob"].'</td>';
            $html_data .= '<td data-label="Mobile" data-name="mobile" class="mobile" data-type="text" data-pk="'.$result["id"].'">'.$result["mobile"].'</td>';
            $html_data .= '<td data-label="E-Mail" data-name="email" class="email" data-type="text" data-pk="'.$result["id"].'">'.$result["email"].'</td>';
             $html_data .= '<td data-label="Joined Date" data-name="joiningdate" class="joiningdate" data-type="text" data-pk="'.$result["id"].'">'.$result["joiningdate"].'</td>';
            $html_data .= '<td data-label="Department" data-name="department" class="department" data-type="text" data-pk="'.$result["id"].'">'.$res['name'].'</td></tr>';
            echo $html_data;
        }
    }
    
    public function loadstudentDetailsToedit()
    {
        $gradenumber = $_POST['gradenumber'];
        $field = "id, studentname, studentcode, studentadress, studentgender, parentname, parentmobile, parentemail, grade, rollno, joiningdate, bloodgroup, nationality, studentemail";
        $table = "studentreg WHERE grade = '$gradenumber'";
        $data = array();
        $obj = new commonSql;
        $row = $obj->displaySum($field, $table); 
        $noofrow = count($row); 
        $html_data = '';
        if($noofrow > 0)
        {
            foreach($row as $result){

                $field1 = "gradenumber, gradesection, id";
                $table1 = "class_register WHERE id = '{$result["grade"]}'";
                $row1 = $obj->displaySum($field1, $table1);


                $html_data .= '<tr><td data-label="Roll No" data-name="rollno" class="rollno" data-type="text" data-pk="'.$result["id"].'">'.$result['rollno'].'</td>';
                $html_data .= '<td data-label="Fullname" data-name="studentname" class="studentname" data-type="text" data-pk="'.$result["id"].'">'.$result["studentname"].'</td>';
                $html_data .= '<td data-label="Register No" data-name="studentcode" class="studentcode" data-type="text" data-pk="'.$result["id"].'">'.$result["studentcode"].'</td>';
                $html_data .= '<td data-label="Address" data-name="studentadress" class="studentadress" data-type="text" data-pk="'.$result["id"].'">'.$result["studentadress"].'</td>';
                $html_data .= '<td data-label="Gender" data-name="studentgender" class="studentgender" data-type="select" data-pk="'.$result["id"].'">'.$result["studentgender"].'</td>';
                $html_data .= '<td data-label="Grade"><a href="javascript:void(0)" style="text-decoration: none;" data-toggle="modal" data-target="#myModal">'; 
                foreach($row1 as $result1){
                    $html_data .= $result1["gradenumber"]." ".$result1["gradesection"];
                }
                $html_data .='</a>                
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Student Grade</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                        <input type="hidden" name="uid" id="uid" value="'.$result["id"].'">
                            <select class="form-control select2" style="width: 100%;" name="gradenumber" id="gradenumber">
                                <option selected="selected" value=""> -- Grade Number -- </option> '; 
                              $result2 = $this->SelectallGradeNumber();
                              foreach($result2 as $row2){
                                $html_data .= '<option value="'.$row2['id'].'">'.$row2['gradenumber']." ".$row2['gradesection'].'</option>'; 
                            }   
            $html_data .= '</select>
                        </div> 
                      </div>
                      <div class="modal-footer" >
                        <button type="button" class="btn btn-primary" id="save" name="save">Save Grade</button>
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal" >Close</button>                    
                      </div>
                    </div>
                  </div>
                </div></td>';
                $html_data .= '<td data-label="Blood Group" data-name="bloodgroup" class="bloodgroup" data-type="text" data-pk="'.$result["id"].'">'.$result["bloodgroup"].'</td>';
                $html_data .= '<td data-label="Student Email" data-name="studentemail" class="studentemail" data-type="text" data-pk="'.$result["id"].'">'.$result["studentemail"].'</td>';
                $html_data .= '<td data-label="Joined Date" data-name="joiningdate" class="joiningdate" data-type="text" data-pk="'.$result["id"].'">'.$result["joiningdate"].'</td>';
                $html_data .= '<td data-label="Guardian/Parents Name" data-name="parentname" class="parentname" data-type="text" data-pk="'.$result["id"].'">'.$result["parentname"].'</td>';
                $html_data .= '<td data-label="Mobile" data-name="parentmobile" class="parentmobile" data-type="text" data-pk="'.$result["id"].'">'.$result["parentmobile"].'</td>';
                $html_data .= '<td data-label="Parents E-Mail" data-name="parentemail" class="parentemail" data-type="text" data-pk="'.$result["id"].'">'.$result["parentemail"].'</td>';
                $html_data .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script><script src="/../public/js/jquery.min.js"></script><script>$(document).ready(function (){var loading = false;$("#save").click(function (event){event.preventDefault();if(loading){return ;}loading = true; var uid = $("#uid").val(); var gradenumber = $("#gradenumber").val();
            if(gradenumber == ""){$.confirm({icon: "fa fa-exclamation-triangle",title: "Encountered Empty Seletion !",content: "Select a Grade", type: "red",typeAnimated: true,buttons: {close: function(){}}});}
            else{$.ajax({type: "POST",url: "updatestudentGrade",data: {uid:uid, gradenumber:gradenumber}, success: function(jsonData){if(jsonData == "ok"){loading = false;}else{$.confirm({icon: "fa fa-exclamation-triangle",title: "Something Went Wrong !", type: "red",typeAnimated: true,buttons: {close: function(){}}});loading = false;}},});}}); });  </script></tr>';
                
            }
        }
        else 
        {
            $html_data = '<tr><td data-label="No Records Found" colspan="8">No Records Found</td></tr>';
        }
        echo $html_data;
    }
    
    public function loadStaffDetailsinDataTableToedit()
    {
        $obj = new commonSql;
        
        $columns = array('id', 'fullname', 'code', 'address', 'gender', 'dob', 'mobile', 'email');
        
        $field = "id, fullname, code, address, gender, dob, mobile, email";
        $table = "staff_reg";
        
        if(isset($_POST["search"]["value"]))
        {
            $table .= ' WHERE id LIKE "%'.$_POST["search"]["value"].'%" OR fullname LIKE "%'.$_POST["search"]["value"].'%" OR code LIKE "%'.$_POST["search"]["value"].'%" OR address LIKE "%'.$_POST["search"]["value"].'%" OR gender LIKE "%'.$_POST["search"]["value"].'%" OR dob LIKE "%'.$_POST["search"]["value"].'%" OR mobile LIKE "%'.$_POST["search"]["value"].'%" OR email LIKE "%'.$_POST["search"]["value"].'%"';
        }
        
        if(isset($_POST['order']))
        {
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= 'ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)
        {
            $query = 'LIMIT ' . $_POST['start'] . ' , ' . $_POST['length'];
        }
        $number_filer_row = $obj->displayRow($field, $table);
        
        $tablejoin = $table ." ". $query;
        $row = $obj->displaySum($field, $tablejoin);  
        
        $data = array();
        foreach($row as $result){
            $sub_array = array();
            $sub_array[] = '<div contenteditable class="update" data-id="'.$result["id"].'" data-column ="fullname">'.$result["fullname"].'</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="'.$result["id"].'" data-column ="code">'.$result["code"].'</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="'.$result["id"].'" data-column ="address">'.$result["address"].'</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="'.$result["id"].'" data-column ="gender">'.$result["gender"].'</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="'.$result["id"].'" data-column ="dob">'.$result["dob"].'</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="'.$result["id"].'" data-column ="mobile">'.$result["mobile"].'</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="'.$result["id"].'" data-column ="email">'.$result["email"].'</div>';
            $sub_array[] = '<button type="button" name="delete" id="delete" class="btn btn-danger btn-xs delete" id="'.$result["id"].'">Delete</button>';
            $data[] =$sub_array;
        }
        
        $field1 = "id";
        $table1 = "staff_reg";
        $get_all_data = $obj->displayRow($field1, $table1);
        $output = array(
            "draw"              => intval($_POST["draw"]),
            "recordsTotal"      => $get_all_data,
            "recordsFiltered"   => $number_filer_row,
            "data"              => $data
        );
        echo json_encode($output);
    }
    
    public function loadGradesection()
    {
        $gradenumber = $_POST['gradenumberValue'];
        $fields = "id, gradesection";
        $table = "class_register WHERE gradenumber = '$gradenumber'";
        
        $obj = new commonSql;
        $result = $obj->displaySum($fields, $table);
        $html_data = '';
        $html_data .= '<label for="Grade Section">Grade Section</label>';
        $html_data .= '<select class="form-control select2" style="width: 100%;" name="gradesection" id="gradesection" onchange="loadDeti()">
                        <option value=""> -- Select Section --</option>';
        foreach($result as $row){
            $html_data .= '<option value="'.$row["id"].'">'.$row["gradesection"].'</option>';
        }
        $html_data .= '</select>';
        $html_data .= '<script>
                            $(document).ready(function(){ 
                                $(".select2").select2(); });
                            function loadDeti()
                            {
                                var gradesection = document.getElementById("gradesection").value;
                                if(gradesection != "")
                                {
                                    document.getElementById("loadtimetable").style.display = "block";
                                }
                                else{
                                    document.getElementById("loadtimetable").style.display = "none";
                                }
                            }
                        </script>';
        echo $html_data;
    }
    
    public function subjects()
    {
        $fields = "sub_id, sub_name, color";
        $table = "class_subject ORDER BY sub_name";
        
        $obj = new commonSql;
        $result = $obj->sqlSelectQuery($fields, $table);
        $html_data = '';
        foreach($result as $row){
            $id = $row['sub_id'];
            $name = $row['sub_name'];
            $color = $row['color'];
            $html_data .= "<tr><td data-label=\"$name\" class=\"dark\" id=\"eventhand\"><div id=\"$id\" class=\"redips-drag redips-clone $id\" style=\"background: $color; color: #fff\">$name</div><input id=\"b_$id\" class=\"$id\"type=\"button\" value=\"\" onclick=\"redips.report('$id')\" style=\"background: $color\" title=\"Show only $name\"/></td></tr>";
        }
        echo $html_data;
    }
      
    public function timetable($hour, $row)
    {
        $rs = null;
        global $rs;
        if($rs === null)
        {
            $fields = "concat(t.tbl_row,'_',t.tbl_col) as pos, t.tbl_id, t.sub_id, s.sub_name, s.color";
            $table  = "school_timetable t, class_subject s where t.sub_id = s.sub_id";
            $obj = new commonSql;
            $rs = $obj->sqlSelectQuery($fields, $table, 'pos');
        }
        
        print '<tr>';
        print '<td class="mark dark">' . $hour . '</td>';
        for ($col = 1; $col <= 5; $col++) {
            print '<td>';
            $pos = $row . '_' . $col;
            
            if (array_key_exists($pos, $rs)) {
                $elements = $rs[$pos];
                $id = $elements['sub_id'] . 'b' . $elements['tbl_id'];
                $name = $elements['sub_name'];
                $color = $elements['color'];
                $class = substr($id, 0, 2);
                print "<div id=\"$id\" class=\"redips-drag $class\" style=\"background: $color; color: #fff\">$name</div>";
            }
            print '</td>';
        }
        print "</tr>\n";
    }
    
    public function ValuesOfClassTimetable($hour, $row)
    {
        $rs = null;
        global $rs;
        if($rs === null)
        {
            $fields = "concat(t.tbl_row,'_',t.tbl_col) as pos, t.tbl_id, t.sub_id, s.sub_name, s.color";
            $table  = "school_timetable t, class_subject s where t.sub_id = s.sub_id";
            $obj = new commonSql;
            $rs = $obj->sqlSelectQuery($fields, $table, 'pos');
        }
        
        print '<tr>';
        print '<td class="mark dark">' . $hour . '</td>';
        for ($col = 1; $col <= 5; $col++) {
            print '<td>';
            $pos = $row . '_' . $col;
            
            if (array_key_exists($pos, $rs)) {
                $elements = $rs[$pos];
                $id = $elements['sub_id'] . 'b' . $elements['tbl_id'];
                $name = $elements['sub_name'];
                $color = $elements['color'];
                $class = substr($id, 0, 2);
                print "<div id=\"$id\" class=\"redips-drag $class\" style=\"background: $color; color: #fff\">$name</div>";
            }
            print '</td>';
        }
        print "</tr>\n";
    }
    
    public function valueofTimetablesingle()
    {
        $fields = "className, term, year";
        $table = "school_timetable GROUP BY className";
        
        $obj = new commonSql;
        return $obj->sqlSelectQuery($fields, $table); 
    }
    
    public function LoadTimePeriod()
    {
        $fields = "timeperiod, colors, id, sub_id";
        $table = "exam_time WHERE active = 'yes' ORDER BY timeperiod";
        
        $obj = new commonSql;
        $result = $obj->sqlSelectQuery($fields, $table);
        $html_data = '';
        foreach($result as $row){
            $id = $row['sub_id'];
            $name = $row['timeperiod'];
            $color = $row['colors'];
            $html_data .= "<tr><td data-label=\"$name\" class=\"dark\" id=\"eventhand\"><div id=\"$id\" class=\"redips-drag redips-clone $id\" style=\"background: $color; color: #fff\">$name</div><input id=\"b_$id\" class=\"$id\"type=\"button\" value=\"\" onclick=\"redips.report('$id')\" style=\"background: $color\" title=\"Show only $name\"/></td></tr>";
        }
        echo $html_data;
    }
    
    public function Examtimetable($row)
    {
        $rs = null;
        global $rs; 
        $rs1 = null;
        global $rs1;
        if($rs === null)
        {
            $fields = "concat(t.tbl_row,'_',t.tbl_col) as pos, t.tbl_id, t.sub_id, s.sub_name, s.color";
            $table  = "school_exam t, class_subject s where t.sub_id = s.sub_id";
            $obj = new commonSql;
            $rs = $obj->sqlSelectQuery($fields, $table, 'pos');
            
            $fields1 = "concat(t.tbl_row,'_',t.tbl_col) as pos, t.tbl_id, t.sub_id, e.timeperiod, e.colors";
            $table1  = "school_exam t, exam_time e where t.sub_id = e.sub_id";
            $rs1 = $obj->sqlSelectQuery($fields1, $table1, 'pos');
        }
        
        print '<tr>';
        
        for ($col = 0; $col <= 9; $col++) {
            print '<td>';
            $pos = $row . '_' . $col;
            $ratio = $col % 2;
            if($ratio == 0)
            {
                if (array_key_exists($pos, $rs1)) {
                    $elements = $rs1[$pos];
                    $id = $elements['sub_id'] . 'b' . $elements['tbl_id'];
                    $name = $elements['timeperiod'];
                    $color = $elements['colors'];
                    $class = substr($id, 0, 2);
                    print "<div id=\"$id\" class=\"redips-drag $class\" style=\"background: $color; color: #fff\">$name</div>";
                }
            }
            else if($ratio == 1)
            {
                if (array_key_exists($pos, $rs)) {
                    $elements = $rs[$pos];
                    $id = $elements['sub_id'] . 'b' . $elements['tbl_id'];
                    $name = $elements['sub_name'];
                    $color = $elements['color'];
                    $class = substr($id, 0, 2); 
                    print "<div id=\"$id\" class=\"redips-drag $class\" style=\"background: $color; color: #fff\">$name</div>";
                }   
            }
            print '</td>';
        }
        print "</tr>\n";
    }
    
    public function valueofExamTimetablesingle()
    {
        $fields = "className, term, year, dateperiod";
        $table = "school_exam WHERE dateperiod != '' AND length(dateperiod) > 4 GROUP BY className";
        
        $obj = new commonSql;
        return $obj->sqlSelectQuery($fields, $table); 
    }
    
    public function ExamtimetableVerfication($row, $x)
    {
        $bool = false;
        
        $rss = null;
        global $rss; 
        $rss1 = null;
        global $rss1;
        if($rss === null)
        {
            $fields = "concat(t.tbl_row,'_',t.tbl_col) as pos, t.tbl_id, t.sub_id, s.sub_name,  t.tbl_row";
            $table  = "school_exam t, class_subject s where t.sub_id = s.sub_id";
            $obj = new commonSql;
            $rss = $obj->sqlSelectQuery($fields, $table, 'pos');
            
            $fields1 = "concat(t.tbl_row,'_',t.tbl_col) as pos, t.tbl_id, t.sub_id,  t.tbl_row";
            $table1  = "school_exam t, exam_time e where t.sub_id = e.sub_id";
            $rss1 = $obj->sqlSelectQuery($fields1, $table1, 'pos');
        }
        
        
        for ($col = 0; $col <= 9; $col++) {
            $pos = $row . '_' . $col;
            $ratio = $col % 2;
            if($ratio == 0)
            {                
                if (array_key_exists($pos, $rss1)) {
                    $elements = $rss1[$pos];
                    $id = $elements['sub_id'] . 'b' . $elements['tbl_id'];
                    $class = substr($id, 0, 2);                    
                    $rowid = $elements['tbl_row'];
                    if($rowid == $x)
                    {
                        $bool = true;
                    }
                }
            }
            else if($ratio == 1)
            {
                if (array_key_exists($pos, $rss)) {
                    $elements = $rss[$pos];
                    $id = $elements['sub_id'] . 'b' . $elements['tbl_id'];
                    $class = substr($id, 0, 2);
                    $rowid = $elements['tbl_row'];
                    if($rowid == $x)
                    {
                        $bool = true;
                    }
                }   
            }
        }
        return $bool;
    }
    
    public function loadNotes()
    {
        $logusrnme = $_POST['logusrnme'];
        $obj = new commonSql;
        $fields = 'notes, id';
        $table = "short_notes WHERE username = '$logusrnme'";
        
        $data = array();
        $row = $obj->displaySum($fields, $table);   
        $html = '';
        $html .= '<ul class="event-list">';
        foreach($row as $result)
        {
            $html .= '<li>'.$result['notes'].'<a href="#" class="event-close" id="'.$result['id'].'"><i class="ico-close2"></i></a></li>';
        }
        $html .= '</ul>';
        echo $html;
    }

    public function loadStudentFees()
    {
        $obj = new commonSql;
        $columns = array('studentname', 'studentcode', 'studentadress', 'parentname', 'parentmobile');
        
        $field = 'studentname, studentcode, studentadress, grade, parentname, parentmobile, id';        
        $table = 'studentreg ';
        
        $table .= 'WHERE ';
        
        if(isset($_POST['classno']))
        {
            $table .= 'grade = "'.$_POST['classno'].'" AND ';
        }
        
        if(isset($_POST["search"]["value"]))
        {
            $table .= ' (studentname LIKE "%'.$_POST["search"]["value"].'%"';
            $table .= ' OR studentcode LIKE "%'.$_POST["search"]["value"].'%"';
            $table .= ' OR studentadress LIKE "%'.$_POST["search"]["value"].'%"';
            $table .= ' OR parentname LIKE "%'.$_POST["search"]["value"].'%"';
            $table .= ' OR parentmobile LIKE "%'.$_POST["search"]["value"].'%")';
            
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST["length"] != -1)
        {
            $query .= 'LIMIT '. $_POST['start']. ' , '.$_POST['length'];
        }
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        
        $data = array(); $i = 0;
        foreach($result as $row)
        {
            $field1 = "gradenumber, gradesection";
            $table1 = "class_register";
            
            if(isset($_POST['classno']))
            {
                $table1 .= 'WHERE id = "'.$_POST['classno'].'"';
            }
            else
            {
               $table1 .= 'WHERE id = "'.$row['grade'].'"'; 
            }
            
            
            $sub_array = array();
            $sub_array[] = $row['studentname'];
            $sub_array[] = $row['studentcode'];
            $sub_array[] = $row['studentadress'];
            $sub_array[] = $row['parentname'];
            $sub_array[] = $row['parentmobile'];
            $sub_array[] = '<a href="paymentProcess?sid='.$row['id'].'" class="btn btn-social-icon btn-bitbucket" name="action'.$i.'" id="action'.$i.'"><i class="fa fa-check"></i></a>';
            $data[] = $sub_array;
            $i++;
        }
        
        $field2 = "id";
        $table2 = "studentreg";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output);
    }
    
    public function getAllSubjects()
    {
        $columns = array('sub_name');
        
        $obj = new commonSql;
        $data = array();
        $field = "sub_name, color, id";
        $table = 'class_subject ';
        if(isset($_POST['search']['value']))
        {
            $table .= 'WHERE sub_name LIKE "%'.$_POST['search']['value'].'%"';
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        
        foreach($result as $row)
        {
            $sub_array = array();
            $sub_array[] = $row['sub_name'];
            $sub_array[] = '<div style="text-align: center;"><a href="javascript:void(0)" style="background-color: '.$row['color'].'" class="btn btn-social-icon btn-bitbucket delete" name="delete" id="'.$row['id'].'"><i class="fas fa-minus-circle"></i></a></div>';
            $data[] = $sub_array;
        }
        
        $field2 = "id";
        $table2 = "class_subject";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output);        
    }
    
    public function getAllTime()
    {
        $columns = array('timeperiod');
        
        $obj = new commonSql;
        $data = array();
        $field = "timeperiod, colors, id";
        $table = 'exam_time ';
        if(isset($_POST['search']['value']))
        {
            $table .= 'WHERE timeperiod LIKE "%'.$_POST['search']['value'].'%"';
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        
        foreach($result as $row)
        {
            $sub_array = array();
            $sub_array[] = $row['timeperiod'];
            $sub_array[] = '<div style="text-align: center;"><a href="javascript:void(0)" style="background-color: '.$row['colors'].'" class="btn btn-social-icon btn-bitbucket delete" name="delete" id="'.$row['id'].'"><i class="fas fa-minus-circle"></i></a></div>';
            $data[] = $sub_array;
        }
        
        $field2 = "id";
        $table2 = "exam_time";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output);        
    }
    
    public function loadStaffDetails()
    {
        $obj = new commonSql;
        $columns = array('code', 'fullname', 'address', 'mobile', 'landline', 'email');
        
        $field = 'code, fullname, address, mobile, mobile, landline, email, id';        
        $table = "staff_reg WHERE status = 'yes'";
        
        if(isset($_POST["search"]["value"]))
        {
            $table .= ' AND (code LIKE "%'.$_POST["search"]["value"].'%"';
            $table .= ' OR fullname LIKE "%'.$_POST["search"]["value"].'%"';
            $table .= ' OR address LIKE "%'.$_POST["search"]["value"].'%"';
            $table .= ' OR mobile LIKE "%'.$_POST["search"]["value"].'%"';
            $table .= ' OR landline LIKE "%'.$_POST["search"]["value"].'%"';
            $table .= ' OR email LIKE "%'.$_POST["search"]["value"].'%")';
            
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST["length"] != -1)
        {
            $query .= 'LIMIT '. $_POST['start']. ' , '.$_POST['length'];
        }
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        
        $data = array(); $i = 0;
        foreach($result as $row)
        {
            $sub_array = array();
            $sub_array[] = $row['fullname'];
            $sub_array[] = $row['code'];
            $sub_array[] = $row['address'];
            $sub_array[] = $row['mobile'];
            $sub_array[] = $row['landline'];
            $sub_array[] = $row['email'];
            $sub_array[] = '<a href="SalaryProcess?stf='.$row['id'].'" class="btn btn-social-icon btn-bitbucket" name="action'.$i.'" id="action'.$i.'"><i class="fa fa-check"></i></a>';
            $data[] = $sub_array;
            $i++;
        }
        
        $field2 = "id";
        $table2 = "staff_reg";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output);
    }
    
    public function getAllFees()
    {
        $columns = array('receipt_no', 'student_name', 'student_code', '','payment_month', 'payment_date', 'paying_amount');
        $obj = new commonSql;
        $data = array();
        $field = "receipt_no, student_id, payment_month, payment_date, paying_amount, student_name, student_code, id";
        $table = 'student_fees ';
        if(isset($_POST['search']['value']))
        {
            $table .= 'WHERE receipt_no LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR student_name LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR student_code LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR payment_month LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR paying_amount LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR payment_date LIKE "%'.$_POST['search']['value'].'%"';
        }
        
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        
        $studentName = ''; $studentCode = ''; $studentAddress = '';
        foreach($result as $row)
        {            
            $field3 = "studentname, studentcode, studentadress";
            $table3 = "studentreg WHERE id = '{$row['student_id']}'";
            $result3 = $obj->displaySum($field3, $table3);
            foreach($result3 as $row3){
                $studentName = $row3['studentname'];
                $studentCode = $row3['studentcode'];
                $studentAddress = $row3['studentadress'];
            }
            
            $sub_array = array();
            $sub_array[] = $row['receipt_no'];
            $sub_array[] = $studentName;
            $sub_array[] = $studentCode;
            $sub_array[] = $studentAddress;
            $sub_array[] = $row['payment_month'];
            $sub_array[] = $row['payment_date'];
            $sub_array[] = $row['paying_amount'];
            $sub_array[] = '<div style="text-align: center;"><a href="printStudentSlip?ReciptNo='.$row['receipt_no'].'&SecondPrint=true " style="background-color: rgba(25,145,232,0.52)" class="btn btn-social-icon btn-bitbucket print" name="print" id="'.$row['id'].'"><i class="fa fa-print"></i></a></div>';
            $data[] = $sub_array;
        }
        
        $field2 = "id";
        $table2 = "class_subject";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output); 
    }
    
    public function getAllSalary()
    {
        $columns = array('receipt_no', 'staff_name', 'staff_code', 'payment_month', 'payment_date', 'amount');
        
        $obj = new commonSql;
        $data = array();
        $field = "receipt_no, staff_id, payment_month, payment_date, amount, staff_name, staff_code, id";
        $table = 'staff_salary ';
        if(isset($_POST['search']['value']))
        {
            $table .= 'WHERE receipt_no LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR staff_name LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR staff_code LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR payment_month LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR payment_date LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR amount LIKE "%'.$_POST['search']['value'].'%"';
        }
        
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        
        $staffName = ''; $staffCode = '';
        foreach($result as $row)
        {            
            $field3 = "fullname, code";
            $table3 = "staff_reg WHERE id = '{$row['staff_id']}'";
            $result3 = $obj->displaySum($field3, $table3);
            foreach($result3 as $row3){
                $staffName = $row3['fullname'];
                $staffCode = $row3['code'];
            }
            
            $sub_array = array();
            $sub_array[] = $row['receipt_no'];
            $sub_array[] = $staffName;
            $sub_array[] = $staffCode;
            $sub_array[] = $row['payment_month'];
            $sub_array[] = $row['payment_date'];
            $sub_array[] = $row['amount'];
            $sub_array[] = '<div style="text-align: center;"><a href="printSalarySlip?ReciptNo='.$row['receipt_no'].'&SecondPrint=true" style="background-color: rgba(25,145,232,0.52)" class="btn btn-social-icon btn-bitbucket print" name="print" id="'.$row['id'].'"><i class="fa fa-print"></i></a></div>';
            $data[] = $sub_array;
        }
        
        $field2 = "id";
        $table2 = "class_subject";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output); 
    }
    
    public function loadGradeDetailsToedit()
    {
        $field = "id, gradenumber, gradesection";
        $table = "class_register";
        $data = array();
        $obj = new commonSql;
                
        $row = $obj->displaySum($field, $table);    
        $html_data = '';
        foreach($row as $result){
            $html_data = '<tr><td data-label="Grade Number" data-name="gradenumber" class="gnumber" data-type="text" data-pk="'.$result["id"].'">'.$result["gradenumber"].'</td>';
            $html_data .= '<td data-label="Grade Section" data-name="gradesection" class="gsection" data-type="text" data-pk="'.$result["id"].'">'.$result["gradesection"].'</td></tr>';
            echo $html_data;
        }
    }
    
    public function loadusertypeDetailsToedit()
    {
        $field = "id, name";
        $table = "user_type";
        $data = array();
        $obj = new commonSql;
                
        $row = $obj->displaySum($field, $table);    
        $html_data = '';
        foreach($row as $result){
            $html_data = '<tr><td data-label="User Type" data-name="name" class="usertype" data-type="text" data-pk="'.$result["id"].'">'.$result["name"].'</td></tr>';
            echo $html_data;
        }
    }
    
    public function loadDepDetailsToedit()
    {
        $field = "id, name";
        $table = "staff_department  WHERE status = 'yes'";
        $data = array();
        $obj = new commonSql;
                
        $row = $obj->displaySum($field, $table);    
        $html_data = '';
        foreach($row as $result){
            $html_data = '<tr><td data-label="Department" data-name="name" class="name" data-type="text" data-pk="'.$result["id"].'">'.$result["name"].'</td></tr>';
            echo $html_data;
        }
    }
    
    public function loadbankDetailsToedit()
    {
        $field = "id, name";
        $table = "banks  WHERE status = 'yes'";
        $data = array();
        $obj = new commonSql;
                
        $row = $obj->displaySum($field, $table);    
        $html_data = '';
        foreach($row as $result){
            $html_data = '<tr><td data-label="Bank Name" data-name="name" class="name" data-type="text" data-pk="'.$result["id"].'">'.$result["name"].'</td></tr>';
            echo $html_data;
        }
    }
    
    public function loadEmployeewithBanks()
    {
        $obj = new commonSql;
        $staffmember = $_POST['staffmember'];
        $field = "bank, employee, branch, accountno, bank_address, id";
        $table = " employeebank WHERE status = 'yes' AND employee = '$staffmember'";
        $row = $obj->displaySum($field, $table);  
        
        $COUNT = COUNT($row);
        if($COUNT > 0)
        {
            $html_data = '';
            $html_data .= '<div class="table-responsive"><table class="table table-bordered table-striped" id="allbanksemp"><thead><tr>
                            <td>Staff Name</td><td>Bank Name</td><td>Account No</td><td>Branch</td><td>Bank Address</td></tr></thead>';

            foreach($row as $result){

                $tableemp = "staff_reg WHERE id = '{$result["employee"]}'";
                $rowemp = $obj->display($tableemp);

                $tablebank = "banks WHERE id = '{$result["bank"]}'";
                $rowbank = $obj->display($tablebank);

                $html_data .= '<tr><td>'.$rowemp['fullname'].'</td>';
                $html_data .= '<td>'.$rowbank["name"].'</td>';
                $html_data .= '<td>'.$result["accountno"].'</td>';
                $html_data .= '<td>'.$result["branch"].'</td>';
                $html_data .= '<td>'.$result["bank_address"].'</td></tr>';
            }

            $html_data .= '</table></div>';
            echo $html_data;
        }
        else
        {
            echo "<center><b>No Records Found</b></center>";
        }
    }
    
    public function loadCategoryDetailsToedit()
    {
        $field = "id, name";
        $table = "leave_category  WHERE status = 'yes'";
        $data = array();
        $obj = new commonSql;
                
        $row = $obj->displaySum($field, $table);    
        $html_data = '';
        foreach($row as $result){
            $html_data = '<tr><td data-label="Category Name" data-name="name" class="name" data-type="text" data-pk="'.$result["id"].'">'.$result["name"].'</td></tr>';
            echo $html_data;
        }
    }
    
    public function loadleaveDetailsToedit()
    {
        $mat = new materialController;
        
        $field = "id, category, department, leave_count";
        $table = "leave_detail_category  WHERE status = 'yes'";
        $data = array();
        $obj = new commonSql;
                
        $row = $obj->displaySum($field, $table);    
        $html_data = '';
        foreach($row as $result){
            $result1 = $mat->SelectCategory($result['category']);
            $result2 = $mat->departmentDetails($result['department']);
            $html_data .= '<tr><td data-label="Category Name" data-name="name" class="name" data-type="text" data-pk="'.$result1["id"].'">'.$result1["name"].'</td>';
            $html_data .= '<td data-label="Department" data-name="name" class="name" data-type="text" data-pk="'.$result2["id"].'">'.$result2["name"].'</td>';
            $html_data .= '<td data-label="Leave Count" data-name="leave_count" class="leave_count" data-type="text" data-pk="'.$result["id"].'">'.$result["leave_count"].'</td></tr>';
            echo $html_data;
        }
    }
    
    public function getEmployee()
    {
        $mat = new materialController;
        $html_data = '';
        $department = $_POST['department'];
        $result = $mat->SelectStaffbyDept($department);
        ?>


        <?php
        $html_data .= '<div class="form-group"><label for="Staff Members">Staff Members</label><select name="staffmem" id="staffmem" class="form-control select2" style="width: 100%;"><option value="" selected>-- Select Members --</option>';
        foreach($result as $row){
            $html_data .= '<option value="'.$row['id'].'">'.$row["fullname"].'</option>';
        }
        $html_data .= '</select></div>';
        $html_data .= '<script>$(document).ready(function(){$(".select2").select2(); });</script> ';
        echo $html_data;
    }
    
    public function getAllleaveApplication()
    {
        $columns = array('', '', 'fdate', 'tdate', 'status');
        
        $obj = new commonSql;
        $data = array();
        $field = "leave_category, department, staff, fdate, tdate, status, id";
        $table = 'leave_application ';
        if(isset($_POST['search']['value']))
        {
            $table .= 'WHERE fdate LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR tdate LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR status LIKE "%'.$_POST['search']['value'].'%"';
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        
        foreach($result as $row)
        {
            $resultSpe = $this->SelectCategory($row['leave_category']);
            $resultStf = $this->SelectStaffbyid($row['staff']);
            
            $sub_array = array();
            $sub_array[] = $resultSpe['name'];
            $sub_array[] = $resultStf['fullname'];
            $sub_array[] = $row['fdate'];
            $sub_array[] = $row['tdate'];
            $sub_array[] = $row['status'];
            $sub_array[] = '<div style="text-align: center;"><a href="javascript:void(0)" style="background-color: #247bcc" class="btn btn-social-icon btn-bitbucket viewc" name="view" id="'.$row['id'].'"><i class="fa fa-eye"></i></a></div>';
            $data[] = $sub_array;
        }
        
        $field2 = "id";
        $table2 = "leave_application";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output); 
    }
    
    public function getAllBookCategory()
    {
        $columns = array('name', 'code');
        
        $obj = new commonSql;
        $data = array();
        $field = "name, code, id";
        $table = 'book_category ';
        if(isset($_POST['search']['value']))
        {
            $table .= 'WHERE name LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR code LIKE "%'.$_POST['search']['value'].'%"';
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        
        foreach($result as $row)
        {
            $sub_array = array();
            $sub_array[] = $row['name'];
            $sub_array[] = $row['code'];
            $sub_array[] = '<div style="text-align: center;"><a href="javascript:void(0)" style="background-color: #46494f" class="btn btn-social-icon btn-bitbucket edit" name="edit" id="'.$row['id'].'"><i class="fas fa-pen-square"></i></a>&nbsp;<a href="javascript:void(0)" style="background-color: #f00e0e" class="btn btn-social-icon btn-bitbucket delete" name="delete" id="'.$row['id'].'"><i class="fas fa-minus-circle"></i></a></div>';
            $data[] = $sub_array;
        }
        
        $field2 = "id";
        $table2 = "book_category";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output);   
    }
    
    public function getAllBooks()
    {
        $columns = array('isbn_no', 'bookno', '', '', '', '', 'status');
        
        $obj = new commonSql;
        $data = array();
        $field = "librarybooks_parent, isbn_no, bookno, status, id";
        $table = "librarybooks_child WHERE active = 'yes'";
        
        if(isset($_POST['search']['value']))
        {
            $table .= ' OR isbn_no LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR bookno LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR status LIKE "%'.$_POST['search']['value'].'%"';
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        
        foreach($result as $row)
        {
            $resultSpec = $this->bookListParent($row['librarybooks_parent']);
            $sub_array = array();
            $sub_array[] = $row['isbn_no'];
            $sub_array[] = $row['bookno'];
            $sub_array[] = $resultSpec['title'];
            $sub_array[] = $resultSpec['shelf_no'];
            $sub_array[] = $resultSpec['book_position'];
            $sub_array[] = $resultSpec['language'];
            $sub_array[] = $row['status'];
            $sub_array[] = '<div style="text-align: center;"><a href="javascript:void(0)" style="background-color: #f00e0e" class="btn btn-social-icon btn-bitbucket delete" name="delete" id="'.$row['id'].'"><i class="fas fa-minus-circle"></i></a></div>';
            $data[] = $sub_array;
        }
        
        $field2 = "id";
        $table2 = "librarybooks_child";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output);  
    }
    
    public function autoCompleteBook()
    {
        $search = $_GET['term'];
        $result = $this->SearchLibrary($search);
        
        $data = array();
        
        foreach($result as $row){
            $sub_array['value'] = $row['bookno']." - ".$row['title'];
            $sub_array['parentID'] = $row['id'];
            array_push($data, $sub_array);
        }
        echo json_encode($data);
    }
    
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
    
    public function autoCompleteStaff()
    {
        $search = $_GET['term'];
        $result = $this->SearchStaff($search);
        
        $data = array();
        foreach($result as $row){
            $sub_array['value'] = $row['fullname']." - ".$row['code'];
            $sub_array['staffid'] = $row['id'];
            array_push($data, $sub_array);
        }
        echo json_encode($data);
    }
    
    public function getAllissuedBooksDetails()
    {
        $columns = array('', 'usertype', '', '', '', '', 'issue_date', 'due_date');
        
        $obj = new commonSql;
        $data = array();
        $field = "booklibrary_child, bookno_title, usertype, user, issue_date, due_date";
        $table = "issue_books WHERE 1=1 AND status = 'issued' ";
        if(isset($_POST['search']['value']))
        {
            $table .= ' OR usertype LIKE "%'.$_POST['search']['value'].'%" AND status = "issued" ';
            $table .= ' OR issue_date LIKE "%'.$_POST['search']['value'].'%" AND status = "issued"';
            $table .= ' OR due_date LIKE "%'.$_POST['search']['value'].'%" AND status = "issued"';
            $table .= ' OR bookno_title LIKE "%'.$_POST['search']['value'].'%" AND status = "issued"';
            
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        $i = 1;
        foreach($result as $row)
        {
            $username = "";
            if($row['usertype'] == 'student')
            {
                $userid = $row['user'];
                $resultStudent = $this->SelectStudentbyid($userid);
                $username = $resultStudent['studentname'];
            }
            else if($row['usertype'] == 'employee')
            {
                $userid = $row['user'];
                $resultStaff = $this->SelectStaffbyid($userid);
                $username = $resultStaff['fullname'];
            }
            
            $resultChilLibrary = $this->bookListChild($row['booklibrary_child']);
            
            $sub_array = array();
            $sub_array[] = $i;
            $sub_array[] = $row['usertype'];
            $sub_array[] = $username;
            $sub_array[] = $resultChilLibrary['bookno'];
            $sub_array[] = $resultChilLibrary['isbn_no'];
            $sub_array[] = $resultChilLibrary['title'];
            $sub_array[] = $row['issue_date'];
            $sub_array[] = $row['due_date'];
            $data[] = $sub_array;
            $i++;
        }
        
        $field2 = "id";
        $table2 = "issue_books WHERE status = 'issued'";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output); 
    }
    
    public function autoCompleteBookIssued()
    {
        $search = $_GET['term'];
        $result = $this->SearchLibraryIssued($search);
        
        $data = array();
        
        foreach($result as $row){
            $sub_array['value'] = $row['bookno']." - ".$row['title'];
            $sub_array['parentID'] = $row['id'];
            array_push($data, $sub_array);
        }
        echo json_encode($data);
    }
    
    public function getDueDate()
    {
        $id = $_POST['id'];
        $result = $this->getDetailsIssuedBook($id);
        echo $result['due_date'];
    }
    
    public function getAllBooksIssueClosed()
    {
        $columns = array('', 'usertype', '', '', '', '', 'fine', 'remarks', 'return_date');
        
        $obj = new commonSql;
        $data = array();
        $field = "booklibrary_child, bookno_title, usertype, user, issue_date, due_date, fine, return_date, remarks";
        $table = "issue_books WHERE 1=1 AND status = 'closed' ";
        if(isset($_POST['search']['value']))
        {
            $table .= ' OR usertype LIKE "%'.$_POST['search']['value'].'%" AND status = "closed" ';
            $table .= ' OR issue_date LIKE "%'.$_POST['search']['value'].'%" AND status = "closed"';
            $table .= ' OR fine LIKE "%'.$_POST['search']['value'].'%" AND status = "closed"';
            $table .= ' OR bookno_title LIKE "%'.$_POST['search']['value'].'%" AND status = "closed"';
            $table .= ' OR return_date LIKE "%'.$_POST['search']['value'].'%" AND status = "closed"';
            $table .= ' OR remarks LIKE "%'.$_POST['search']['value'].'%" AND status = "closed"';
            
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        $i = 1;
        foreach($result as $row)
        {
            $username = "";
            if($row['usertype'] == 'student')
            {
                $userid = $row['user'];
                $resultStudent = $this->SelectStudentbyid($userid);
                $username = $resultStudent['studentname'];
            }
            else if($row['usertype'] == 'employee')
            {
                $userid = $row['user'];
                $resultStaff = $this->SelectStaffbyid($userid);
                $username = $resultStaff['fullname'];
            }
            
            $resultChilLibrary = $this->bookListChild($row['booklibrary_child']);
            
            $sub_array = array();
            $sub_array[] = $i;
            $sub_array[] = $row['usertype'];
            $sub_array[] = $username;
            $sub_array[] = $resultChilLibrary['bookno'];
            $sub_array[] = $resultChilLibrary['isbn_no'];
            $sub_array[] = $resultChilLibrary['title'];
            $sub_array[] = $row['fine'];
            $sub_array[] = $row['remarks'];
            $sub_array[] = $row['return_date'];
            $data[] = $sub_array;
            $i++;
        }
        
        $field2 = "id";
        $table2 = "issue_books WHERE status = 'closed'";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output); 
    }
    
    public function getHotelTypes()
    {
        $columns = array('', 'name', '');
        
        $obj = new commonSql;
        $data = array();
        $field = "name, id";
        $table = "hostel_type WHERE active = 'yes' ";
        if(isset($_POST['search']['value']))
        {
            $table .= ' AND name LIKE "%'.$_POST['search']['value'].'%"';
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        $i = 1;
        foreach($result as $row)
        {
            $sub_array = array();
            $sub_array[] = $i;
            $sub_array[] = $row['name'];
            $sub_array[] = '<div style="text-align: center;"><a href="javascript:void(0)" style="background-color: #75a8e3" class="btn btn-social-icon btn-bitbucket edit" name="edit" id="'.$row['id'].'"><i class="fas fa-pen-square"></i></a>&nbsp;<a href="javascript:void(0)" style="background-color: #f00404" class="btn btn-social-icon btn-bitbucket delete" name="delete" id="'.$row['id'].'"><i class="fas fa-minus-circle"></i></a></div>';
            $data[] = $sub_array;
            $i++;
        }
        
        $field2 = "id";
        $table2 = "hostel_type";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output);    
    }
    
    public function getHostels()
    {
        $columns = array('', 'hostel_name');
        
        $obj = new commonSql;
        $data = array();
        $field = "hostel_type, hostel_name, id";
        $table = "hostels_details WHERE active = 'yes' ";
        if(isset($_POST['search']['value']))
        {
            $table .= ' AND hostel_name LIKE "%'.$_POST['search']['value'].'%"';
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        $i = 1;
        foreach($result as $row)
        {
            $res = $this->hosteltypeID($row['hostel_type']);
            $sub_array = array();
            $sub_array[] = $i;
            $sub_array[] = $row['hostel_name'];
            $sub_array[] = $res['name'];
            $sub_array[] = '<div style="text-align: center;"><a href="javascript:void(0)" style="background-color: #75a8e3" class="btn btn-social-icon btn-bitbucket editx" name="editx" id="'.$row['id'].'"><i class="fas fa-pen-square"></i></a>&nbsp;<a href="javascript:void(0)" style="background-color: #f00404" class="btn btn-social-icon btn-bitbucket deletex" name="deletex" id="'.$row['id'].'"><i class="fas fa-minus-circle"></i></a></div>';
            $data[] = $sub_array;
            $i++;
        }
        
        $field2 = "id";
        $table2 = "hostels_details";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output);
    }
    
    public function getHostelName()
    {
        $mat = new materialController;
        $html_data = '';
        $hosteltype = $_POST['hosteltype'];
        $result = $mat->hostelDetailByType($hosteltype);
        ?>


        <?php
        $html_data .= '<div class="form-group"><label for="Hostel Name">Hostel Name</label><select name="hostelname" id="hostelname" class="form-control select2" style="width: 100%;"><option value="" selected>-- Select Hostel Name --</option>';
        foreach($result as $row){
            $html_data .= '<option value="'.$row['id'].'">'.$row["hostel_name"].'</option>';
        }
        $html_data .= '</select><span class="help-block" id="error"></span></div>';
        $html_data .= '<script>$(document).ready(function(){$(".select2").select2(); });</script> ';
        echo $html_data;   
    }
    
    public function getAllHostelRooms()
    {
        $columns = array('', '', '', 'floor_name', 'room_no', 'no_of_beds', 'amount', 'fees_type');
        
        $obj = new commonSql;
        $data = array();
        $field = "hostel_type, hostel_name, floor_name, room_no, no_of_beds, amount, fees_type, id";
        $table = "hostel_rooms WHERE status = 'Available'";
        if(isset($_POST['search']['value']))
        {
            $table .= ' OR floor_name LIKE "%'.$_POST['search']['value'].'%" AND status = "Available"';
            $table .= ' OR room_no LIKE "%'.$_POST['search']['value'].'%" AND status = "Available"';
            $table .= ' OR no_of_beds LIKE "%'.$_POST['search']['value'].'%" AND status = "Available"';
            $table .= ' OR amount LIKE "%'.$_POST['search']['value'].'%" AND status = "Available"';
            $table .= ' OR fees_type LIKE "%'.$_POST['search']['value'].'%" AND status = "Available"';
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        $i = 1;
        foreach($result as $row)
        {
            $res = $this->hosteltypeID($row['hostel_type']);
            $res1 = $this->hostelDetails($row['hostel_name']);
            $sub_array = array();
            $sub_array[] = $i;
            $sub_array[] = $res['name'];
            $sub_array[] = $res1['hostel_name'];
            $sub_array[] = $row['floor_name'];
            $sub_array[] = $row['room_no'];
            $sub_array[] = $row['no_of_beds'];
            $sub_array[] = $row['amount'];
            $sub_array[] = $row['fees_type'];
            $sub_array[] = '<div style="text-align: center;"><a href="javascript:void(0)" style="background-color: #f00404" class="btn btn-social-icon btn-bitbucket deletex" name="deletex" id="'.$row['id'].'"><i class="fas fa-minus-circle"></i></a></div>';
            $data[] = $sub_array;
            $i++;
        }
        
        $field2 = "id";
        $table2 = "hostel_rooms WHERE status = 'Available'";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output);
    }
    
    public function getHostelRooms()
    {
        $mat = new materialController;
        $html_data = '';
        $hostelname = $_POST['hostelname'];
        $result = $mat->hostelAvailableRoom($hostelname);
        ?>


        <?php
        $html_data .= '<div class="form-group"><label for="Hostel Room">Hostel Room</label><select name="hostelroomID" id="hostelroomID" class="form-control select2" style="width: 100%;"><option value="">-- Select Hostel Room --</option>';
        foreach($result as $row){
            $html_data .= '<option value="'.$row['id'].'">'.$row["floor_name"]." - ".$row["room_no"].'</option>';
        }
        $html_data .= '</select></div>';
        $html_data .= '<script>$(document).ready(function(){$(".select2").select2(); });</script> ';
        echo $html_data;
    }
    
    public function getAllRegisteredRoomsMembers()
    {
        $columns = array('', 'usertype', '', '', '', '', '', 'reg_date', 'vacate_date');
        
        $obj = new commonSql;
        $data = array();
        $field = "usertype, user, hostel_type, hostel_name, hostel_room, reg_date, vacate_date, id";
        $table = "hostelmem_reg WHERE status = 'rent'";
        if(isset($_POST['search']['value']))
        {
            $table .= ' OR usertype LIKE "%'.$_POST['search']['value'].'%" AND status = "rent"';
            $table .= ' OR reg_date LIKE "%'.$_POST['search']['value'].'%" AND status = "rent"';
            $table .= ' OR vacate_date LIKE "%'.$_POST['search']['value'].'%" AND status = "rent"';
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        $i = 1;
        foreach($result as $row)
        {
            $username = "";
            if($row['usertype'] == 'student')
            {
                $userid = $row['user'];
                $resultStudent = $this->SelectStudentbyid($userid);
                $username = $resultStudent['studentname'];
            }
            else if($row['usertype'] == 'employee')
            {
                $userid = $row['user'];
                $resultStaff = $this->SelectStaffbyid($userid);
                $username = $resultStaff['fullname'];
            }
            
            $res = $this->hosteltypeID($row['hostel_type']);
            $res1 = $this->hostelDetails($row['hostel_name']);
            $res2 = $this->hostelRoomsDetails($row['hostel_room']);
            $sub_array = array();
            $sub_array[] = $i;
            $sub_array[] = $row['usertype'];
            $sub_array[] = $username;
            $sub_array[] = $res['name'];
            $sub_array[] = $res1['hostel_name'];
            $sub_array[] = $res2['floor_name'];
            $sub_array[] = $res2['room_no'];
            $sub_array[] = $row['reg_date'];
            $sub_array[] = $row['vacate_date'];
            $sub_array[] = '<div style="text-align: center;"><a href="javascript:void(0)" style="background-color: #f00404" class="btn btn-social-icon btn-bitbucket deletex" name="deletex" id="'.$row['id'].'"><i class="fas fa-minus-circle"></i></a></div>';
            $data[] = $sub_array;
            $i++;
        }
        
        $field2 = "id";
        $table2 = "hostelmem_reg WHERE status = 'rent'";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output);
    }
    
    public function SmallMemberDetails()
    {
        $usertype = $_POST['usertype']; $username = ''; $hostelname = ''; $floorname = ''; $roomno = ''; $amount = '';
        
        if($usertype == 'student')
        {
            $userid = $_POST['userid'];
            if($this->CountSingleMemberRooms($userid, $usertype) > 0)
            {
                $resultStudent = $this->SelectStudentbyid($userid);
                $username = $resultStudent['studentname'];

                $result = $this->hostelRoomByUser($userid, $usertype);
                $roomid = $result['hostel_room'];

                $resultRooms = $this->hostelRoomsDetails($roomid);
                $floorname = $resultRooms['floor_name'];
                $roomno = $resultRooms['room_no'];
                $amount = $resultRooms['amount'];

                $hostelDetails = $this->hostelDetails($result['hostel_name']);
                $hostelname = $hostelDetails['hostel_name'];
                
                $err = "found";
            }
            else 
                $err = "notfound";
            
        }
        else if($usertype == 'employee')
        {
            
            $userid = $_POST['userid'];
            
            if($this->CountSingleMemberRooms($userid, $usertype) > 0)
            {
                $resultStaff = $this->SelectStaffbyid($userid);
                $username = $_POST['userid'];

                $result = $this->hostelRoomByUser($userid, $usertype);
                $roomid = $result['hostel_room'];

                $resultRooms = $this->hostelRoomsDetails($roomid);
                $floorname = $resultRooms['floor_name'];
                $roomno = $resultRooms['room_no'];
                $amount = $resultRooms['amount'];

                $hostelDetails = $this->hostelDetails($result['hostel_name']);
                $hostelname = $hostelDetails['hostel_name'];
                
                $err = "found";
            }
            else 
                $err = "notfound";
        }
        $html_data = '';
        if($err == 'found')
        {
            $html_data .= '<div class="alert alert-primary" role="alert" style="    color: #383d41; background-color: #e2e3e5; border-color: #d6d8db;"><center><p>Hostel  :   '."$hostelname".'</p></center><center><p>Floor - Room No  :   '."$floorname". -  " $roomno".'</p></center><center><p>Hostel Rent  :   '."$amount".'</p></center></div>';
        }
        else if($err == 'notfound')
        {
            $html_data .= '<div class="alert alert-primary" role="alert" style="    color: #383d41; background-color: #e2e3e5; border-color: #d6d8db;"><center><p>Not Found Any Records Please Register</p></center></div>';   
        }
        echo $html_data;
    }
    
    public function getAllVacateRooms()
    {
        $columns = array('', 'usertype', '', '', '', '', '', 'reg_date', 'vacate_date');
        
        $obj = new commonSql;
        $data = array();
        $field = "usertype, user, hostel_type, hostel_name, hostel_room,  vacate_date, id";
        $table = "hostelmem_reg WHERE status = 'vacate'";
        if(isset($_POST['search']['value']))
        {
            $table .= ' OR usertype LIKE "%'.$_POST['search']['value'].'%" AND status = "vacate"';
            $table .= ' OR vacate_date LIKE "%'.$_POST['search']['value'].'%" AND status = "vacate"';
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        $i = 1;
        foreach($result as $row)
        {
            $username = "";
            if($row['usertype'] == 'student')
            {
                $userid = $row['user'];
                $resultStudent = $this->SelectStudentbyid($userid);
                $username = $resultStudent['studentname'];
            }
            else if($row['usertype'] == 'employee')
            {
                $userid = $row['user'];
                $resultStaff = $this->SelectStaffbyid($userid);
                $username = $resultStaff['fullname'];
            }
            
            $res = $this->hosteltypeID($row['hostel_type']);
            $res1 = $this->hostelDetails($row['hostel_name']);
            $res2 = $this->hostelRoomsDetails($row['hostel_room']);
            $sub_array = array();
            $sub_array[] = $i;
            $sub_array[] = $row['usertype'];
            $sub_array[] = $username;
            $sub_array[] = $res['name'];
            $sub_array[] = $res1['hostel_name'];
            $sub_array[] = $res2['floor_name'];
            $sub_array[] = $res2['room_no'];
            $sub_array[] = $row['vacate_date'];
            $data[] = $sub_array;
            $i++;
        }
        
        $field2 = "id";
        $table2 = "hostelmem_reg WHERE status = 'vacate'";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output);
    }
    
    public function getAllPaidFees()
    {   
        $columns = array('', '', '', '', '', '', '');
        $obj = new commonSql;
        $data = array();
        $field = "paiddate, paidamount, total_amount, fine, discount,  recipt_no, remarks, id, fees_id";
        $table = "hostelfee_pay WHERE status = 'paid' ";
        if(isset($_POST['search']['value']))
        {
            $table .= ' OR paiddate LIKE "%'.$_POST['search']['value'].'%" AND status = "paid"';
            $table .= ' OR paidamount LIKE "%'.$_POST['search']['value'].'%" AND status = "paid"';
            $table .= ' OR fine LIKE "%'.$_POST['search']['value'].'%" AND status = "paid"';
            $table .= ' OR discount LIKE "%'.$_POST['search']['value'].'%" AND status = "paid"';
            $table .= ' OR recipt_no LIKE "%'.$_POST['search']['value'].'%" AND status = "paid"';
            $table .= ' OR remarks LIKE "%'.$_POST['search']['value'].'%" AND status = "paid"';
        }
        
        if(isset($_POST["order"]))
        {   
            $table .= ' GROUP BY recipt_no ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' GROUP BY recipt_no ORDER BY id DESC ';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        $i = 1;
        foreach($result as $row)
        {
            $resultFee = $this->HostelFeeGetRoomID($row['fees_id']);
            $roomID = $resultFee['parent_hostel_rooms'];
            $resultRooms = $this->hostelRoomsDetails($roomID);
            $resultHostelName = $this->hostelDetails($resultRooms['hostel_name']);
            $hostelname = $resultHostelName['hostel_name'];
            $sub_array = array();
            $sub_array[] = $i;
            $sub_array[] = $row['recipt_no'];
            $sub_array[] = $hostelname;
            $sub_array[] = $row['paiddate'];
            $sub_array[] = $row['paidamount'];
            $sub_array[] = $row['fine'];
            $sub_array[] = $row['discount'];
            $sub_array[] = $row['remarks'];
            $sub_array[] = '<div style="text-align: center;"><a href="hostelInvoice?ReciptNo='.$row['recipt_no'].'" target="_BLANK" style="background-color: primary" class="btn btn-social-icon btn-bitbucket print" name="print" id="'.$row['id'].'"><i class="fa fa-print"></i></a></div>';
            $data[] = $sub_array;
            $i++;
        }
        
        $field2 = "id";
        $table2 = "hostelfee_pay WHERE status = 'paid' GROUP BY recipt_no";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output);
    }
    
    public function getLeaveCategory()
    {
        $mat = new materialController;
        $html_data = '';
        $department = $_POST['department'];
        $result = $mat->SelectLeaveCatbyid($department);
        ?>


        <?php
        $html_data .= '<label for="Leave Category Name">Leave Category</label><select name="leaveCategory" id="leaveCategory" class="form-control select2" style="width: 100%;"><option value="">-- Please Select --</option>';
        foreach($result as $row){
            $resultSp = $mat->SelectCategory($row['category']);
            $html_data .= '<option value="'.$row['id'].'">'.$resultSp["name"].'</option>';
        }
        $html_data .= '</select>';
        $html_data .= '<script>$(document).ready(function(){$(".select2").select2(); });</script> ';
        echo $html_data;
    }
    
    public function getAllVehicles()
    {
        $columns = array('', 'vehicle_no', 'no_of_seats', 'maximum_allo', 'contact_person');
        $obj = new commonSql;
        $data = array();
        $field = "vehicle_no, no_of_seats, maximum_allo, contact_person, id";
        $table = "vehicle_reg WHERE status = 'yes'";
        if(isset($_POST['search']['value']))
        {
            $table .= ' OR vehicle_no LIKE "%'.$_POST['search']['value'].'%" AND status = "yes"';
            $table .= ' OR no_of_seats LIKE "%'.$_POST['search']['value'].'%" AND status = "yes"';
            $table .= ' OR maximum_allo LIKE "%'.$_POST['search']['value'].'%" AND status = "yes"';
            $table .= ' OR contact_person LIKE "%'.$_POST['search']['value'].'%" AND status = "yes"';
        }
        
        if(isset($_POST["order"]))
        {   
            $table .= ' ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC ';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        $i = 1;
        foreach($result as $row)
        {
            $sub_array = array();
            $sub_array[] = $i;
            $sub_array[] = $row['vehicle_no'];
            $sub_array[] = $row['no_of_seats'];
            $sub_array[] = $row['maximum_allo'];
            $sub_array[] = $row['contact_person'];
            $sub_array[] = '<a class="btn btn-social-icon btn-facebook prove" id="" style="background-color: #001f3f !important"><i class="fa fa-check-square"></i></a>&nbsp;<a class="btn btn-social-icon btn-facebook reject" style="background-color: #e80b0b" id=""><i class="fas fa-minus-circle"></i></a>';
            $data[] = $sub_array;
            $i++;
        }
        
        $field2 = "id";
        $table2 = "vehicle_reg WHERE status = 'yes'";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output);
    }
    
    public function getAllFeeCategory()
    {
        $columns = array('category_name', 'prefix', 'description');
        
        $obj = new commonSql;
        $data = array();
        $field = "category_name, prefix, description, id";
        $table = 'fee_category ';
        if(isset($_POST['search']['value']))
        {
            $table .= 'WHERE category_name LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR prefix LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR description LIKE "%'.$_POST['search']['value'].'%"';
            
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        
        foreach($result as $row)
        {
            $sub_array = array();
            $sub_array[] = $row['category_name'];
            $sub_array[] = $row['prefix'];
            $sub_array[] = $row['description'];
            $sub_array[] = '<a href="javascript:void(0)" style="font-size:16px" class="edit" name="edit" id="'.$row['id'].'"><i class="fas fa-pen-square"></i></a>&nbsp;<a href="javascript:void(0)" style="font-size:16px" class="delete" name="delete" id="'.$row['id'].'"><i class="fas fa-minus-circle"></i></a></div>';
            $data[] = $sub_array;
        }
        
        $field2 = "id";
        $table2 = "fee_category";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output); 
    }
    
    public function getAllFeeSubCategories()
    {
        $columns = array('', '', 'sub_category_name', 'amount', 'feetype');
        
        $obj = new commonSql;
        $data = array();
        $field = "fee_category, sub_category_name, amount, id, feetype";
        $table = 'sub_fee_category ';
        if(isset($_POST['search']['value']))
        {
            $table .= 'WHERE sub_category_name LIKE "%'.$_POST['search']['value'].'%" AND status = "yes"';
            $table .= 'OR amount LIKE "%'.$_POST['search']['value'].'%" AND status = "yes"';
            $table .= 'OR feetype LIKE "%'.$_POST['search']['value'].'%" AND status = "yes"';
            
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        $i = 1;
        foreach($result as $row)
        {
            $result1 = $this->SelectFeeCategory($row['fee_category']);
            $sub_array = array();
            $sub_array[] = $i;
            $sub_array[] = $result1['category_name'];
            $sub_array[] = $row['sub_category_name'];
            $sub_array[] = $row['amount'];
            $sub_array[] = $row['feetype'];
            $sub_array[] = '<a href="javascript:void(0)" style="font-size:16px" class="edit" name="edit" id="'.$row['id'].'"><i class="fas fa-pen-square"></i></a>&nbsp;<a href="javascript:void(0)" style="font-size:16px" class="delete" name="delete" id="'.$row['id'].'"><i class="fas fa-minus-circle"></i></a></div>';
            $data[] = $sub_array;$i++;
        }
        
        $field2 = "id";
        $table2 = "sub_fee_category WHERE status = 'yes'";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output); 
    }
    
    public function getAllSubCategorybyMain()
    {
        $mat = new materialController;
        $html_data = '';
        $category = $_POST['feecategory'];
        $result = $mat->SelectSubFeeCategoryAll($category);
        ?>


        <?php
        $html_data .= '<div class="form-group"><label for="Fee Sub Category Name">Fee Sub Category Name</label><select name="feesubcategoryname" id="feesubcategoryname" class="form-control select2" style="width: 100%;"><option value="">-- Select --</option>';
        foreach($result as $row){
            $html_data .= '<option value="'.$row['id'].'">'.$row["sub_category_name"].'</option>';
        }
        $html_data .= '</select></div>';
        $html_data .= '<script>$(document).ready(function(){$(".select2").select2(); });</script> ';
        echo $html_data;
    }
    
    public function getAllFineSubFees()
    {
        $columns = array('', 'type', 'fine_amount', 'fine_type');
        
        $obj = new commonSql;
        $data = array();
        $field = "sub_fee_category, type, fine_amount, id, fine_type";
        $table = 'sub_fee_category_fine ';
        if(isset($_POST['search']['value']))
        {
            $table .= 'WHERE type LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR fine_amount LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR fine_type LIKE "%'.$_POST['search']['value'].'%"';
            
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        $i = 1;
        foreach($result as $row)
        {
            $result1 = $this->getSubcategoryFee($row['sub_fee_category']);
            $sub_array = array();
            $sub_array[] = $i;
            $sub_array[] = $result1['sub_category_name'];
            $sub_array[] = $row['type'];
            $sub_array[] = $row['fine_amount'];
            $sub_array[] = $row['fine_type'];
            $sub_array[] = '<center><a href="javascript:void(0)" style="font-size:16px" class="delete" name="delete" id="'.$row['id'].'"><i class="fas fa-minus-circle"></i></a></center>';
            $data[] = $sub_array;$i++;
        }
        
        $field2 = "id";
        $table2 = "sub_fee_category_fine";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output);    
    }
    
    public function loadSmallamountDetailFee()
    {
        $id = $_POST['subcategoryId'];
        $result = $this->getSubcategoryFee($id);
        $html_data = '';
        $html_data .= '<div class="alert alert-primary" role="alert" style="color: #383d41; background-color: #e2e3e5; border-color: #d6d8db;"><center><p style="color: green;">Fees Amount  :   '.$result['amount'].'</p></center></div><input type="hidden" name="amount" id="amount" value="'.$result['amount'].'">';
        echo $html_data;
    }
    
    public function getStudentsDet()
    {
        $mat = new materialController;
        $html_data = '';
        $grade = $_POST['gradenumberlist'];
        $result = $mat->SelectStudentbyGrade($grade);
        ?>


        <?php
        $html_data .= '<div class="form-group"><label for="Students">Students</label><select name="students[]" id="students[]" class="form-control select2" style="width: 100%;" multiple="multiple"><option value="" disabled>-- Select Students --</option>';
        foreach($result as $row){
            $html_data .= '<option value="'.$row['id'].'">'.$row["studentname"]."-".$row["studentcode"].'</option>';
        }
        $html_data .= '</select></div>';
        $html_data .= '<script>$(document).ready(function(){$(".select2").select2(); });</script> ';
        echo $html_data;
    }
    
    public function getFeeAllocation()
    {
        $columns = array('', '', 'amount', 'fee_for', '', '', 'date');
        
        $obj = new commonSql;
        $data = array();
        $field = "fee_category, fee_category_sub, fee_for, id, amount, grade, student, time, date";
        $table = 'fee_allocation ';
        if(isset($_POST['search']['value']))
        {
            $table .= 'WHERE fee_for LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR amount LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR time LIKE "%'.$_POST['search']['value'].'%"';
            $table .= 'OR date LIKE "%'.$_POST['search']['value'].'%"';
            
        }
        if(isset($_POST["order"]))
        {   
            $table .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
        }
        else{
            $table .= ' ORDER BY id DESC';
        }
        
        $query = '';
        if($_POST['length'] != -1)        
        {
            $query .= 'LIMIT ' .$_POST['start'].','.$_POST['length'];
        }       
        
        $number_filer_row = $obj->displayRow($field, $table);
        $jointable = $table . " " . $query;
        $result = $obj->displaySum($field, $jointable);
        $i = 1;
        foreach($result as $row)
        {
            $ResultCat = $this->SelectFeeCategory($row['fee_category']);
            $studentRes = ''; $studentd = '';
            if($row['fee_for'] == 'Students in a grade')
            {
                $studentRes = $this->SelectStudent($row['student']);
                if(COUNT($studentRes) > 0)
                {
                    $RESULTs = $this->SelectStudentbyid($row['student']);
                    $studentd = $RESULTs['studentname']."-".$RESULTs['studentcode'];    
                }
                
            }
            $result1 = $this->getSubcategoryFee($row['fee_category_sub']);
            $grade = $this->SelectGradeNumberbyid($row['grade']);
            $sub_array = array();
            $sub_array[] = $i;
            $sub_array[] = $ResultCat['category_name'];
            $sub_array[] = $result1['sub_category_name'];
            $sub_array[] = $row['amount'];
            $sub_array[] = $row['fee_for'];
            $sub_array[] = $grade['gradenumber']."-".$grade['gradesection'];
            $sub_array[] = $studentd;
            $sub_array[] = $row['date']." / ".$row['time'];
            $sub_array[] = '<center><a href="javascript:void(0)" style="font-size:16px" class="delete" name="delete" id="'.$row['id'].'"><i class="fas fa-minus-circle"></i></a></center>';
            $data[] = $sub_array;$i++;
        }
        
        $field2 = "id";
        $table2 = "fee_allocation";
        $get_all_data = $obj->displayRow($field2, $table2);
        
        
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $get_all_data,
            "recordsFiltered" => $number_filer_row,
            "data" => $data
        );
        echo json_encode($output);  
    }
    
    public function getStudentsDetSingle()
    {
        $mat = new materialController;
        $html_data = '';
        $grade = $_POST['gradenumberlist'];
        $result = $mat->SelectStudentbyGrade($grade);
        ?>


        <?php
        $html_data .= '<div class="form-group"><label for="Students">Students</label><select name="students" id="students" class="form-control select2" style="width: 100%;"><option value="" >-- Select Students --</option>';
        foreach($result as $row){
            $html_data .= '<option value="'.$row['id'].'">'.$row["studentname"]."-".$row["studentcode"].'</option>';
        }
        $html_data .= '</select></div>';
        $html_data .= '<script>$(document).ready(function(){$(".select2").select2(); });</script> ';
        echo $html_data;
    }
}





















*/
