<?php
    include("db_core.php");
    $utime = $_POST['ut'];
	$cpath = $_POST['cp'];
	$cexpiry = $_POST['ce'];
	$gtime = $_POST['gt'];
	
		
		$query = "UPDATE umeme_session SET ui_timeout = ". $utime .", guest_timeout = ". $gtime .", cookie_path = '". $cpath ."', cookie_expiry = ". $cexpiry ." WHERE id = 1";                                                                  
		$result = db_query($query);
        
		if($result){
			$response["success"] = 1;
		    $response["message"] = "Session settings made";
			echo json_encode($response);
		}else{
			$response["success"] = 0;
		    $response["message"] = "Session settings not made";
			echo json_encode($response);
		}
			
	
?>