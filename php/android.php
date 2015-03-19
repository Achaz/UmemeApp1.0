<?php
    include("db_core.php");
	//Get the json string from the parameter in the request body     
     $jsonStringRaw = $_POST["complaint"]; // *******************************	I DON'T KNOW WHAT YOU SENT
     
     //Remove any redundant slashes in the string( this part might bring issues, let BISHAKA know if any )
     $cleanedString = stripcslashes($jsonStringRaw);

     //decode the json string, this returns an array object that is simillar to the object passed in the json string(I HOPE)
     $master_array = json_decode($cleanedString, TRUE);	
     
	$comp = $master_array['complaint'];
	$ds = $master_array['date_sent'];		
	$ts = $master_array['time_sent'];		
	$lon = $master_array['longitude'];
	$lat = $master_array['latitude'];
	$an = $master_array['account_number'];
	$pn = $master_array['phone_number'];	
	$un = $master_array['username'];
	$loc  = $master_array['location'];
	
	$query = "INSERT INTO umeme_logs VALUES(0, '$pn', '$un', '$an', '$comp', '$loc', '$ds', '$ts', '$lon', '$lat', '')";
	$result = db_query($query);
	
	if($result){
		
		$lgid = getId("SELECT id FROM umeme_logs WHERE account_number = $an");
	    
	    if($lgid == 0){
	    	$response["success"] = 0;
		    $response["message"] = "Complaint Not Added";
		    echo json_encode($response); 
	    }else{
	    	$query2 = "INSERT INTO umeme_assignment VALUES(0, $lgid, 1, 2, 3)";
		    $result2 = db_query($query2);
			
			if($result2){
				$response["success"] = 1;
				$response["message"] = "Complaint Added";
				echo json_encode($response);	
			}else{
			   $response["success"] = 0;
		       $response["message"] = "Complaint Not Added";
		       echo json_encode($response); 	
			}
	    }
				
		
	}else{
		$response["success"] = 0;
		$response["message"] = "Complaint Not Added";
		echo json_encode($response);
	}
	
?>
