<?php													
	 include("db_core.php");
	  
	  $dept = "";
	  $query = "SELECT department FROM umeme_department";
	  $result = db_select2_1($query);
	  
	  if(mysqli_num_rows($result) > 0){
	  	    $dept .= "<option>";
	    	$dept .= "";
			$dept .= "</option>";
	  	while($r = mysqli_fetch_array($result)){
	  	    $dept .= "<option>";
	    	$dept .= $r['department'];
			$dept .= "</option>";
	    }
	  }else{
	
	  }
	  
	  echo $dept;
	 										
?>