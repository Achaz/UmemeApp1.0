<?php
    $currpass = $_POST['cp'];
	$newpass = $_POST['np'];
	$email = $_POST['e'];
    
	if($currpass == null || $newpass == null || $email == null){
		$response["success"] = 0;
	    $response["message"] = "incomplete request";

	    echo json_encode($response);
	}else{
		include("db_core.php");
		$table = "umeme_record_personnel";
		$query = "UPDATE $table SET password= md5('$newpass') WHERE email_address= '$email'";
		$result = db_query($query);
		if($result){
           $response["success"] = 1;
	       $response["message"] = "ACCOUNT EDITTED";

	    	echo json_encode($response);
			
		}else{
		   $response["success"] = 0;
	       $response["message"] = "FAILED TO UPDATE";

	    	echo json_encode($response);
		}
	}
	
?>