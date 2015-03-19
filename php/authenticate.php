<?php
	$username = $_POST['u'];
	$password = $_POST['p'];
	
	if($username == null || $password == null){
		$response["success"] = 0;
	    $response["message"] = "incomplete request";

	    echo json_encode($response);
	}else{
		include("db_core.php");
		$table = "umeme_record_personnel";
		$query = "SELECT * FROM $table where username = '$username' and password = md5('$password') and status = 'active'";
		$result = db_select($query, $table);
		$date = date('Y-m-d H:i:s');
		if(count($result) > 0){
			
			$query2 = "UPDATE $table SET last_login= '$date' WHERE username= '$username'";
			db_query($query2);
							
			$response["success"] = 1;
	    	$response["message"] = "VALID USER";
			$response["auth_id"] = $result[0][0];

	    	echo json_encode($response);
		}else{
		$response["success"] = 0;
	    $response["message"] = "INVALID USER";

	    	echo json_encode($response);
		}		
	}
	
	
	
?>
