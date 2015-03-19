<?php
//include_once("../function/android.php");
include_once("db_core.php");
$data = array();

	 $query = "SELECT distinct(phone_number) FROM umeme_logs";
	 $result = db_select2_1($query);
     $i = 0;
	  if(mysqli_num_rows($result) > 0){
	  	while($r = mysqli_fetch_array($result)){
	  	    
	    	$data[$i] = $r['phone_number'];
			$i++;
	    }
		echo json_encode($data);
	  }
    			
	
?>
