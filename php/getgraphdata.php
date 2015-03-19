<?php
   include_once("db_core.php");
   $graphvals = array();
   $query = "SELECT location, count(username) AS nums FROM umeme_logs GROUP BY location";
   $result = db_select2_1($query);
      $i = 0;
	  if(mysqli_num_rows($result) > 0){
	  		while($r = mysqli_fetch_array($result)){
		  	    
		    	$data['location'] = $r['location'];
				$data['frequency'] = $r['nums'];
				
				$graphvals[$i] = $data;
				$i++;
		    }
	  	echo json_encode($graphvals);
	  }
	  
	  // $data[$i][0] = $r['location'];
	  // $data[$i][1] = $r['nums'];
?>