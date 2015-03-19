<?php
	include_once("db_connect.php");
	
	function selectEditableTables(){
		$options = "";
		$i =0;
		
		$tables = array(0 => 'umeme_logs', 1 => 'umeme_status', 2 => 'umeme_type', 3 => 'umeme_department', 4 => 'umeme_assignment');
		for($i =0; $i<count($tables); $i++)
			$options.= "<option>$tables[$i]</option>";		
		return $options;
	}
	
	function getTableColumns($table_name){
		$table_columns = "";
		$db = new ConnectDB();
		$conn = $db->connect();
		$query = mysqli_query("describe $table_name");
		while ($row = mysqli_fetch_array($query)) {
			if(!($row[3] == "PRI"))
				$table_columns.=$row[0].", ";
		}	
		$table_columns = removeLastOccurenceOfChar(',', $table_columns);
		return $table_columns;
	}
	
	function getAllTableColumns($table_name){
		$table_columns = "";
		$db = new ConnectDB();
		$conn = $db->connect();
		$query = mysqli_query("describe $table_name");
		while ($row = mysqli_fetch_array($query)) {
			$table_columns.=$row[0].", ";
		}	
		$table_columns = removeLastOccurenceOfChar(',', $table_columns);
		return $table_columns;
	}
	
	function getTableColumnTypes($table_name){
		$column_types = array();
		$i=0;
		
		$db = new ConnectDB();
		$conn = $db->connect();
		$query = mysqli_query($conn, "describe $table_name");
		while ($row = mysqli_fetch_array($query)) {
			$column_types[$i++]=$row[1].", ";
		}
		
		return $column_types;
	}
	
	function countTableColumns($table_name){
		$count = 0;
		$db = new ConnectDB();
		$conn = $db->connect();
		$query = mysqli_query("describe $table_name");
		while ($row = mysqli_fetch_array($query)) {
			if(!($row[3] == "PRI"))
				$count++;
		}	
		return $count;
	}
	
	function countColumns($table_name){
		$count = 0;
		$db = new ConnectDB();
		$conn = $db->connect();
		$query1 = mysqli_query($conn, "describe $table_name");
		while ($row = mysqli_fetch_array($query1)) 
				$count++;
		//echo "count: $count";
		return $count;
	}
	
	function removeLastOccurenceOfChar($char, $string)
	{
	    if( ($pos = strrpos($string, $char)) !== FALSE) {
	        return substr_replace($string, '', $pos, 1);
	    }
	    return $string;
	}
	
	function toString($array){
		$result = ""; $i =0;
		for($i =0; $i<count($array); $i++)
			$result.="$array ";
		return $result;
	}
?>