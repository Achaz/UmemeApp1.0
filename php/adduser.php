<?php
    $username = $_POST['u'];
	$password = $_POST['p'];
	$level = $_POST['l'];
	$email = $_POST['e'];
	
	if($username == null || $password == null || $level == null || $email == null){
		$response["success"] = 0;
	    $response["message"] = "incomplete request";

	    echo json_encode($response);
	}else{
		include("db_core.php");
		$table = "umeme_record_personnel";
		$date = date('Y-m-d H:i:s');
		$query = "INSERT INTO $table VALUES(0, '$username', md5('$password'), '$level', '$email', '$date', '0000-00-00 00:00:00', 'inactive')";
		$result = db_query($query);
		
		if($result){
           $response["success"] = 1;
	       $response["message"] = "USER ADDED";

	    	echo json_encode($response);
			
		}else{
		   $response["success"] = 0;
	       $response["message"] = "USER NOT ADDED";

	    	echo json_encode($response);
		}
	}
?>