<?php													
	  
include("db_core.php");
	  $type = "";
	  $query = "SELECT type FROM umeme_type";
	  $result = db_select3($query);
	  $result = db_select2_1($query);
	  
	  if(mysqli_num_rows($result) > 0){
	  	    $type .= "<option>";
	    	$type .= "";
			$type .= "</option>";
	  	while($r = mysqli_fetch_array($result)){
	  	    $type .= "<option>";
	    	$type .= $r['type'];
			$type .= "</option>";
	    }
	  }else{
	
	  }
	  
	  echo $type;
	  													
?>