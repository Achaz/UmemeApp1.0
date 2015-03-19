<?php
     include("db_core.php");
	 $table = "";
	 
	 $query = "SELECT username, user_level, email_address, date_created, last_login FROM umeme_record_personnel WHERE status = 'active'";
     $actresult = db_select2_1($query);
	 
	 if(mysqli_num_rows($actresult) > 0){
			$table .= "<table class=\"table table-striped\"><thead><tr><th>Username</th><th>User Level</th><th>Email</th><th>Date created</th><th>Last login time</th></tr></thead><tbody>";														
			while($r = mysqli_fetch_array($actresult)){
				$table .=  "<tr>";																			
				$table .=  "<td>".  $r['username'] ."</td>";
				$table .= "<td>". $r['user_level'] ."</td>";
				$table .= "<td>". $r['email_address'] ."</td>";
				$table .= "<td>". $r['date_created'] ."</td>";
				$table .= "<td>". $r['last_login'] ."</td>";
				$table .= "</tr>";		
			}
			$table .= "</tbody></table>";
			echo $table;
	}   
?>