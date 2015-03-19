<?php
     include("db_core.php");
	 $table = "";
	 
	 $query = "SELECT username, date_banned FROM umeme_banned_users";
     $result = db_select2_1($query);
	 
	 if(mysqli_num_rows($result) > 0){
			$table .= "<table class=\"table table-striped\"><thead><tr><th>Username</th><th>Time Banned</th></tr></thead><tbody>";														
			while($r = mysqli_fetch_array($result)){
				$table .=  "<tr>";																			
				$table .=  "<td>".  $r['username'] ."</td>";
				$table .= "<td>". $r['date_banned'] ."</td>";
				$table .= "</tr>";		
			}
			$table .= "</tbody></table>";
			echo $table;
	}   
?>