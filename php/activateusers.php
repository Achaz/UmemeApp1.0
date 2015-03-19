<?php
    include("db_core.php");
    $jsonStringRaw = $_POST['ids'];
	$cleanedString = stripcslashes($jsonStringRaw);
    $master_array = json_decode($cleanedString, TRUE);	
	$reply = "";
	// for($i = 1; $i < count($master_array); $i++){
		// $query = "UPDATE umeme_record_personnel SET status = 'active' WHERE id = ". $master_array[$i];
		// $result = db_query($query);
// 		
		// if($result){
			// $reply .= $i. "succ, ";
		// }else{
			// $reply .= $i. "fail, ";
		// }
	// }
	        $response["success"] = 0;
		    $response["message"] = $master_array;
	echo json_encode($response)
?>