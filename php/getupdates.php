<?php
   include_once("db_core.php");
   $updates = array();
   $posts = array();
   $post = array();
   $query = "SELECT * FROM umeme_updates";
   $result = db_select2_1($query);
      $i = 0;
	  if(mysqli_num_rows($result) > 0){
	  		while($r = mysqli_fetch_array($result)){
		  	    
		    	$data['location'] = $r['location'];
				$data['msg'] = $r['msg'];
				
				
				$updates['post'] = $data;
			    $post[$i] = $updates;
				$i++;
		    }
			$posts['posts'] = $post;
	  	echo json_encode($posts);
	  }
?>