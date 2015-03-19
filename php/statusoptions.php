<?php													
	  include("db_core.php");	  
	  
	  $status = "";
	  $query = "SELECT status FROM umeme_status";
	  $result = db_select3($query);
	  $result = db_select2_1($query);
	  
	  if(mysqli_num_rows($result) > 0){
	  	    $status .= "<option>";
	    	$status .= "";
			$status .= "</option>";
	  	while($r = mysqli_fetch_array($result)){
	  	    $status .= "<option>";
	    	$status .= $r['status'];
			$status .= "</option>";
	    }
	  }else{
	
	  }
	  
	  echo $status;
	  
	  
													
?>