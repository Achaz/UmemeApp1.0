<?php
    $username = $_POST['u'];
	$email = "";
	if($username == null){
		$response["success"] = 0;
	    $response["message"] = "incomplete request";

	    echo json_encode($response);
	}else{
		include("db_core.php");
		$table = "umeme_record_personnel";
		$table2 = "umeme_banned_users";
		$date = date('Y-m-d H:i:s');
		
		$query = "SELECT email_address FROM umeme_record_personnel WHERE username = '".$username ."'";
		$result = db_select2_1($query);
		
		if(mysqli_num_rows($result) > 0){
			while($r = mysqli_fetch_array($result)){
				$email .= $r['email_address'];
			}
			
			$query2 = "INSERT INTO umeme_banned_users VALUES(0, '". $username ."', '". $email ."', '". $date ."')";
		    $query3 = "UPDATE umeme_record_personnel SET status = 'banned' WHERE username = '". $username ."'";
		    $result2 = db_query($query2);
		    $result3 = db_query($query3);
			
			$response["success"] = 1;
		    $response["message"] = "USER BANNED";
		}else{
			$response["success"] = 0;
		    $response["message"] = "USER NOT BANNED";
		}
	  
		echo json_encode($response);
		
	}
?>