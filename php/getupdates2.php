<?php
   include_once("db_core.php");
   $updates = array();
   $posts = array();
   $post = array();
   $query = "SELECT * FROM umeme_updates";
   $table =  "<table class=\"table table-striped\" style='height: 100px; overflow: auto'><thead><tr><th> Location </th><th>Update</th></tr></thead><tbody > ";
   $result = db_select2_1($query);
      $i = 0;
	  if(mysqli_num_rows($result) > 0){
	  		while($r = mysqli_fetch_array($result)){
		  	    
		    	$table .= "<tr><td>".$r['location']."</td>";
				$table .= "<td>".$r['msg']."</td></tr>";
			}
			$table .= "</tbody></table><br/>";
	  	echo $table;
	  }
?>