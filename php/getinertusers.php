<?php
     include("db_core.php");
	 $table = "";
	 
	 $query = "SELECT id, username, user_level, email_address FROM umeme_record_personnel WHERE status = 'inactive'";
     $actresult = db_select2_1($query);
	 
	 if(mysqli_num_rows($actresult) > 0){
			$table .= "<table class=\"table table-striped\"><thead><tr><th>#id</th><th>Username</th><th>User Level</th><th>Email</th><th><input id = 'actall' type='checkbox' value='1'></th></tr></thead><tbody>";														
			while($r = mysqli_fetch_array($actresult)){
				$table .=  "<tr id = '". $r['id'] ."'>";							
				$table .=  "<td>".  $r['id'] ."</td>";												
				$table .=  "<td>".  $r['username'] ."</td>";
				$table .= "<td>". $r['user_level'] ."</td>";
				$table .= "<td>". $r['email_address'] ."</td>";
				$table .= "<td><input type='checkbox' value='1'></td>";
				$table .= "</tr>";		
			}
			$table .= "</tbody></table>";
			echo $table;
	}   
?>