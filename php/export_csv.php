<?php
 $choice = $_POST['c'];
 $uphone = $_POST['up'];
 $uloc = $_POST['ul'];
 $udatefrom = $_POST['udf'];
 $udateto = $_POST['udt'];
 $u_status = $_POST['us'];
 $u_type = $_POST['ut'];
 $u_dept = $_POST['ud'];

 include_once("db_core.php");
 $out = '';
 $querydef = "SELECT umeme_logs.phone_number, umeme_logs.username, umeme_logs.account_number, umeme_logs.complaint, umeme_logs.location, umeme_logs.umeme_reply, 
			  (SELECT department FROM umeme_db.umeme_department WHERE umeme_department.id = umeme_assignment.dept_id) AS dept, 
			  (SELECT umeme_status.status FROM umeme_db.umeme_status WHERE umeme_status.id = umeme_assignment.status_id) AS _status, 
			  (SELECT umeme_type.type FROM umeme_db.umeme_type WHERE umeme_type.id = umeme_assignment.type_id ) AS _type 
			  FROM umeme_db.umeme_logs 
			  INNER JOIN umeme_assignment 
			  ON umeme_logs.id = umeme_assignment.log_id";
					  
	if(strlen($udatefrom) > 0 && strlen($udateto) > 0){
		 $query = "SELECT umeme_logs.phone_number, umeme_logs.username, umeme_logs.account_number, umeme_logs.complaint, umeme_logs.location, umeme_logs.umeme_reply, 
							  (SELECT department FROM umeme_db.umeme_department WHERE umeme_department.id = umeme_assignment.dept_id) AS dept, 
							  (SELECT umeme_status.status FROM umeme_db.umeme_status WHERE umeme_status.id = umeme_assignment.status_id) AS _status, 
							  (SELECT umeme_type.type FROM umeme_db.umeme_type WHERE umeme_type.id = umeme_assignment.type_id ) AS _type 
							  FROM umeme_db.umeme_logs 
							  INNER JOIN umeme_assignment 
							  ON umeme_logs.id = umeme_assignment.log_id WHERE date_sent BETWEEN '$udatefrom' AND '$udateto'";
			
		            if(strlen($u_dept) > 0){
				 		$query .= " AND department = '$u_dept";
				 	}
				 	
				 	if(strlen($uphone) > 0){
				 		$query .= " AND phone_number = '$uphone'";
				 	}
					
					if(strlen($uloc) > 0){
				 		$query .= " AND location = '$uloc'";
				 	}
				 	
				 	if(strlen($u_status) > 0){
				 		$query .= " AND status = '$u_status'";
				 	}
				 	
				 	if(strlen($u_type) > 0){
				 		$query .= " AND type = '$u_type'";
				 	}
				 	
				 	$result=db_select2_1($query);
					$columns = mysqli_num_fields($result);
				    for ($i = 0; $i < $columns; ++$i) {
					    // Fetch the field information
					    $field = mysqli_fetch_fields($result, $i);
					    $out .= '"'.$field->name.'",';
					}
					
					$out .= "\r";
						
					// Add all values in the table to $out.
					while ($l = mysqli_fetch_array($result)) 
					{
						   for ($i = 0; $i < $columns; $i++) 
						   {
						      $out .='"'.$l["$i"].'",';
						   }
						
						   $out .= "\r";
					}
						
						// Open file export.csv.
					$f = fopen ('/home/julian/export.csv','w');
						
					// Put all values from $out to export.csv.
					fputs($f, $out);
					fclose($f);
					
					header('Content-type: application/csv');
					header('Content-Disposition: attachment; filename="export.csv"');
					readfile('/home/julian/export.csv');
						
					mysqli_free_result($result);
					
	}else{
		$result=db_select2_1($querydef);
		$columns = mysqli_num_fields($result);
			for ($i = 0; $i < $columns; ++$i) {
			    // Fetch the field information
			    $field = mysqli_fetch_fields($result, $i);
			    $out .= '"'.$field->name.'",';
		    }
		
			$out .= "\r";
			
			// Add all values in the table to $out.
			while ($l = mysqli_fetch_array($result)) 
			{
			   for ($i = 0; $i < $columns; $i++) 
			   {
			      $out .='"'.$l["$i"].'",';
			   }
			
			   $out .= "\r";
			}
			
			// Open file export.csv.
			$f = fopen ('/home/julian/export.csv','w');
			
			// Put all values from $out to export.csv.
			fputs($f, $out);
			fclose($f);
			
			header('Content-type: application/csv');
			header('Content-Disposition: attachment; filename="export.csv"');
			readfile('/home/julian/export.csv');
			
			mysqli_free_result($result);
	
	}			  
					  



?>
