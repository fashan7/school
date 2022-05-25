<?php
class commonSql extends App
{
    public function display($table)
    {
        return App::get('database')->selectAll($table);
    }
    
    public function displayQs($table)
    {
        return App::get('database')->selectQs($table);
    }
    
    public function displaySum($fields, $tables)
    {
        return App::get('database')->selectSpecific($fields, $tables);
    }
    
    public function displaySingle($fields, $tables)
    {
        return App::get('database')->selectSingle($fields, $tables);
    }
    
    public function displaySample($fields, $tables)
    {
        return App::get('database')->sample($fields, $tables);
    }
    
    public function displayCount($fields, $tables)
    {
        return App::get('database')->selectCount($fields, $tables);
    }
    
    public function displayRow($fields, $tables)
    {
        return App::get('database')->RowCount($fields, $tables);
    }
    
    public function insertion($dbname, $arr = array())
    {
        return App::get('database')->insert($dbname, "'".implode("','", $arr)."'");        
    }
    
    public function insertionLastID($dbname, $arr = array())
    {
        return App::get('database')->insertwithlastid($dbname, "'".implode("','", $arr)."'");        
    }
    
    public function updation($dbname, $arr = array())
    {
        return App::get('database')->update($dbname, "".implode("','", $arr)."");        
    }
    
    public function deletion($tables)
    {
        return App::get('database')->delete($tables);
    }
        
    public function displayAllFields($fields, $tables)
    {
        return App::get('database')->selectSpecificAll($fields, $tables);
    }
    
    public function sqlSelectQuery($fields, $tables, $key = NULL) 
    {	
        $db_result = App::get('database')->selectSpecific($fields, $tables);
               
        $resultSet = Array(); 
        
        if ($db_result !== true) {
            
            foreach ($db_result as $row) {
                
                if ($key !== NULL) {
                    $resultSet[$row[$key]] = $row;
                }
                
                else {
                    $resultSet[] = $row;
                }
            }
        }
        return $resultSet;
    }
    
    public function update($query)
	{
		$result = App::get('database')->updateAll($query);
		return $result;
	}

	public function delete($table, $id)
	{
		$result = App::get('database')->deleteAll($table, $id);
		return $result;
	}

	public function clearstring($string)
	{
		return mysqli_real_escape_string(App::get('database'),$string);
	}
    
    public function save($query)
	{
		$conn = App::get('database')->insertAll($query);
		return $conn;
	}
}