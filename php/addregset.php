<?php
    include("db_core.php");
    $aact = $_POST['aact'];
	$ulm = $_POST['ulm'];
	$ulmx = $_POST['ulmx'];
	$plm = $_POST['plm'];
	$plmx = $_POST['plmx'];
	$sendwelcome = $_POST['sw'];
	$e_captcha = $_POST['ec'];
	$unlower = $_POST['unl'];
	
		
		$query = "UPDATE umeme_reg SET account_activation = '". $aact ."', username_length_min = ". $ulm .", username_length_max = ". $ulmx .", password_length_min = ". $plm .", password_length_max = ". $plmx .","; 
		$query .= "send_welcome_email = '". $sendwelcome ."', enable_captcha = '". $e_captcha ."', username_lowercase = '". $unlower ."' WHERE id = 1";                                                                  
		$result = db_query($query);

		if($result){
			$response["success"] = 1;
		    $response["message"] = "Registration settings made";
			echo json_encode($response);
		}else{
			$response["success"] = 0;
		    $response["message"] = "Registration settings not made";
			echo json_encode($response);
		}	
	
?>