<?php
   include_once("db_core.php");
   $mapvals = array();
   $posts = array();
   $post = array();
   $query = "SELECT location, latitude, longitude, complaint, username FROM umeme_logs";
   $result = db_select2_1($query);
      $i = 0;
	  if(mysqli_num_rows($result) > 0){
	  		while($r = mysqli_fetch_array($result)){
		  	    
		    	$data['location'] = $r['location'];
				$data['longitude'] = $r['longitude'];
				$data['latitude'] = $r['latitude'];
				$data['user'] = $r['username'];
				$data['complaint'] = $r['complaint'];
				
				$mapvals['post'] = $data;
			    $post[$i] = $mapvals;
				$i++;
				
			}
			$posts['posts'] = $post;
			
	  	echo json_encode($posts);
	  }
	  
?>