<?php
   include("db_core.php");

   $query = "SELECT username, email_address FROM umeme_record_personnel WHERE status = 'active'";
   $result = db_select2_1($query);
   
   if(mysqli_num_rows($result) > 0){
			$table .= "<table class=\"table table-striped\"><thead><tr><th>Username</th><th>Email</th></tr></thead><tbody>";														
			while($r = mysqli_fetch_array($result)){
				$table .=  "<tr>";																			
				$table .=  "<td>".  $r['username'] ."</td>";
				$table .= "<td>". $r['email_address'] ."</td>";
				$table .= "</tr>";		
			}
			$table .= "</tbody></table>";
			echo $table;
	} 
?>