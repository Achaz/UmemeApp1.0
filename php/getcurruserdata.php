<?php
   include("db_core.php");
   $username = $_GET['u'];
   $card = "";
   $query = "SELECT username, user_level, email_address FROM umeme_record_personnel WHERE username = '". $username ."'";
   $result = db_select2_1($query);

   if(mysqli_num_rows($result) > 0){
		while($r = mysqli_fetch_array($result)){
			$card .= "Username:   ". $username ."<br/>";
            $card .= "Email:      ". $r['email_address'] ."<br/>";
            $card .= "User level: ". $r['user_level'] ."<br/>";	
		}
		echo $card;
	}else{
		$card .= "Username:     ". $username ."<br/>";
        $card .= "Email:        none<br/>";
        $card .= "User level:   none<br/>";
		echo $card;	
	} 
   
?>