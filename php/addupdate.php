<?php
    $location = $_POST['l'];
	$msg = $_POST['m'];
	
	
	if($msg == null || $location == null){
		$response["success"] = 0;
	    $response["message"] = "incomplete request";

	    echo json_encode($response);
	}else{
		include("db_core.php");
		$table = "umeme_updates";
		$date = date('Y-m-d H:i:s');
		$query = "INSERT INTO $table VALUES(0, '$location', '$msg')";
		$result = db_query($query);
		
		if($result){
           $response["success"] = 1;
	       $response["message"] = "UPDATE ADDED";

	    	echo json_encode($response);
			
		}else{
		   $response["success"] = 0;
	       $response["message"] = "UPDATE NOT ADDED";

	    	echo json_encode($response);
		}
	}
?>