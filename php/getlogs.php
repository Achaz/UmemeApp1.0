<?php
    include("db_core.php");
	$logs = array();
    $posts = array();
    $post = array();
	$query = "SELECT umeme_logs.id, umeme_logs.time_sent, umeme_logs.date_sent, umeme_logs.account_number, umeme_logs.phone_number, umeme_logs.username, umeme_logs.account_number, umeme_logs.complaint, umeme_logs.location, umeme_logs.latitude, umeme_logs.longitude, umeme_logs.umeme_reply, 
					  (SELECT department FROM umeme_db.umeme_department WHERE umeme_department.id = umeme_assignment.dept_id) AS dept, 
					  (SELECT umeme_status.status FROM umeme_db.umeme_status WHERE umeme_status.id = umeme_assignment.status_id) AS _status, 
					  (SELECT umeme_type.type FROM umeme_db.umeme_type WHERE umeme_type.id = umeme_assignment.type_id ) AS _type 
					  FROM umeme_db.umeme_logs 
					  INNER JOIN umeme_assignment 
					  ON umeme_logs.id = umeme_assignment.log_id order by date_sent";
      					  
      $result = db_select2_1($query);
      $i = 0;
	  if(mysqli_num_rows($result) > 0){
	  		while($r = mysqli_fetch_array($result)){
		  	    
				$data['id'] = $r['id'];
				$data['account_number'] = $r['account_number'];
				$data['date_sent'] = $r['date_sent'];
				$data['time_sent'] = $r['time_sent'];
		    	$data['location'] = $r['location'];
				$data['longitude'] = $r['longitude'];
				$data['latitude'] = $r['latitude'];
				$data['user'] = $r['username'];
				$data['complaint'] = $r['complaint'];
				$data['phonenumber'] = $r['phone_number'];
				$data['status '] = $r['_status'];
				$data['type'] = $r['_type'];
				$data['department'] = $r['dept'];
				$data['reply'] = $r['umeme_reply'];
				
				$logs['post'] = $data;
			    $post[$i] = $logs;
				$i++;
				
			}
			$posts['posts'] = $post;
			
	  	echo json_encode($posts);
	  }					  
?>