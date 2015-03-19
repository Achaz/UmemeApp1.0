<?php
  include("db_core.php");
  $accnum = $_POST['an'];
  $status = $_POST['st'];
  $type = $_POST['ty'];
  $dept = $_POST['dep'];
  $msg = $_POST['msg'];
  
  $query = "UPDATE umeme_logs SET umeme_reply = '". $msg ."' WHERE account_number = '". $accnum ."'"; 
  $result = db_query($query);
   
  if($result){
  	$dpid = getId("SELECT id FROM umeme_department WHERE department = '$dept'");
	$stid = getId("SELECT id FROM umeme_status WHERE status = '$status'");
	$tyid = getId("SELECT id FROM umeme_type WHERE type = '$type'");
	$lgid = getId("SELECT id FROM umeme_logs WHERE account_number = '$accnum'");
	
	if($dpid == 0 || $stid == 0 || $tyid == 0 || $lgid == 0){
		$response["success"] = 0;
	    $response["message"] = "Operation Failed";
		echo json_encode($response);
	}else{
		   $query6 = "UPDATE umeme_assignment SET dept_id = $dpid, status_id = $stid, type_id = $tyid WHERE log_id = $lgid";
		   $result6 = db_query($query6);
		   
		   if($result6){
		   	$response["success"] = 1;
		    $response["message"] = "Reply Added";
			echo json_encode($response);
		   }else{
		   	$response["success"] = 0;
		    $response["message"] = "Options Edits Failed";
			echo json_encode($response);
		   }
	}			
  }else{
			$response["success"] = 0;
		    $response["message"] = "Reply not added";
			echo json_encode($response);
  }	
?>