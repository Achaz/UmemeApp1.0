<?php
     $vphone = $_POST['up'];
     $vloc = $_POST['ul'];
     $vdatefrom = $_POST['udf'];
     $vdateto = $_POST['udt'];
     $v_status = $_POST['us'];
     $v_type = $_POST['ut'];
     $v_dept = $_POST['ud'];
	 
	 include("db_core.php");	 
	 $table =  "<table class=\"table table-striped\" ><thead><tr><th> Contact </th><th> Acc No </th><th> Location </th><th> Department </th><th> Complaint </th><th> Reply </th><th> Status </th><th> Type </th></tr></thead><tbody style='height: 100px; overflow: auto'> ";
						 
	 $vsearchquery = "SELECT umeme_logs.phone_number, umeme_logs.username, umeme_logs.account_number, umeme_logs.complaint, umeme_logs.location, umeme_logs.umeme_reply, 
					  (SELECT department FROM umeme_db.umeme_department WHERE umeme_department.id = umeme_assignment.dept_id) AS dept, 
					  (SELECT umeme_status.status FROM umeme_db.umeme_status WHERE umeme_status.id = umeme_assignment.status_id) AS _status, 
					  (SELECT umeme_type.type FROM umeme_db.umeme_type WHERE umeme_type.id = umeme_assignment.type_id ) AS _type 
					  FROM umeme_db.umeme_logs 
					  INNER JOIN umeme_assignment 
					  ON umeme_logs.id = umeme_assignment.log_id";
   
       if(strlen($vdatefrom) > 0 && strlen($vdateto) > 0){
	 			
		 		$vsearchquery .= " WHERE date_sent BETWEEN '$vdatefrom' AND '$vdateto'"; 
				if(strlen($vphone) > 0){
				 		$vsearchquery .= " AND phone_number = '$vphone'";
				}
					
				if(strlen($vloc) > 0){
				        $vsearchquery .= " AND location = '$vloc'";
				}
	
			 	$vsearchresult = db_select2_1($vsearchquery);	
					if(mysqli_num_rows($vsearchresult) > 0){
						
						if(strlen($v_dept) > 0 && strlen($v_status) > 0 && strlen($v_type) > 0){
							while($r = mysqli_fetch_array($vsearchresult)){
						 	//Print table
						 	if($v_dept == $r['dept'] && $v_status == $r['_status'] && $v_type == $r['_type']){
						 		     
								 		$table .=  "<tr><td>". $r['phone_number'] ."</td>";
										$table .=  "<td>". $r['account_number']."</td>";
										$table .=  "<td>". $r['location']."</td>";							
										$table .=  "<td>". $r['dept'] ."</td>";
										$table .=  "<td>". $r['complaint']."</td>";
										$table .=  "<td>". $r['umeme_reply']."</td>";
										$table .=  "<td>".$r['_status'] ."</td>";
										$table .=  "<td>". $r['_type'] ."</td></tr>";
								 
						 	 }else{
						 		
						 	 }							
						  }
						}else if(strlen($v_dept) > 0 && strlen($v_status) > 0){
							while($r = mysqli_fetch_array($vsearchresult)){
						 	//Print table
						 	  if($v_dept == $r['dept'] && $v_status == $r['_status']){
						 		    
								 		$table .=  "<tr><td>". $r['phone_number'] ."</td>";
										$table .=  "<td>". $r['account_number']."</td>";
										$table .=  "<td>". $r['location']."</td>";							
										$table .=  "<td>". $r['dept'] ."</td>";
										$table .=  "<td>". $r['complaint']."</td>";
										$table .=  "<td>". $r['umeme_reply']."</td>";
										$table .=  "<td>".$r['_status'] ."</td>";
										$table .=  "<td>". $r['_type'] ."</td></tr>";
								 
						 	 }else{
						 			
						 	 }							
						   }
						}else if(strlen($v_type) > 0 && strlen($v_status) > 0){
							while($r = mysqli_fetch_array($vsearchresult)){
						 	//Print table
						 	if($v_status == $r['_status'] && $v_type == $r['_type']){
						 		    
								 		$table .=  "<tr><td>". $r['phone_number'] ."</td>";
										$table .=  "<td>". $r['account_number']."</td>";
										$table .=  "<td>". $r['location']."</td>";							
										$table .=  "<td>". $r['dept'] ."</td>";
										$table .=  "<td>". $r['complaint']."</td>";
										$table .=  "<td>". $r['umeme_reply']."</td>";
										$table .=  "<td>".$r['_status'] ."</td>";
										$table .=  "<td>". $r['_type'] ."</td></tr>";
								 	
						 	}else{
						 			
						 	}							
						 }
						}else if(strlen($v_dept) > 0 && strlen($v_type) > 0){
							while($r = mysqli_fetch_array($vsearchresult)){
						 	//Print table
						 	if($v_dept == $r['dept'] && $v_type == $r['_type']){
						 		    
								 		$table .=  "<tr><td>". $r['phone_number'] ."</td>";
										$table .=  "<td>". $r['account_number']."</td>";
										$table .=  "<td>". $r['location']."</td>";							
										$table .=  "<td>". $r['dept'] ."</td>";
										$table .=  "<td>". $r['complaint']."</td>";
										$table .=  "<td>". $r['umeme_reply']."</td>";
										$table .=  "<td>".$r['_status'] ."</td>";
										$table .=  "<td>". $r['_type'] ."</td></tr>";
								 
						 	}else{
						 			
						 	}							
						 }
						}else if(strlen($v_dept) > 0){
							while($r = mysqli_fetch_array($vsearchresult)){
								if($v_dept == $r['dept']){
									
									 		$table .=  "<tr><td>". $r['phone_number'] ."</td>";
											$table .=  "<td>". $r['account_number']."</td>";
											$table .=  "<td>". $r['location']."</td>";							
											$table .=  "<td>". $r['dept'] ."</td>";
											$table .=  "<td>". $r['complaint']."</td>";
											$table .=  "<td>". $r['umeme_reply']."</td>";
											$table .=  "<td>".$r['_status'] ."</td>";
											$table .=  "<td>". $r['_type'] ."</td></tr>";
								
								}else{
										
								}				
							     
                           }

						}else if(strlen($v_status) > 0){
							while($r = mysqli_fetch_array($vsearchresult)){
								if($v_status == $r['_status']){
									
									 		$table .=  "<tr><td>". $r['phone_number'] ."</td>";
											$table .=  "<td>". $r['account_number']."</td>";
											$table .=  "<td>". $r['location']."</td>";							
											$table .=  "<td>". $r['dept'] ."</td>";
											$table .=  "<td>". $r['complaint']."</td>";
											$table .=  "<td>". $r['umeme_reply']."</td>";
											$table .=  "<td>".$r['_status'] ."</td>";
											$table .=  "<td>". $r['_type'] ."</td></tr>";
									
								}else{
										 
								}				
							     
                           }
						}else if(strlen($v_type) > 0){
							while($r = mysqli_fetch_array($vsearchresult)){
								if($v_type == $r['_type']){
									
									 		$table .=  "<tr><td>". $r['phone_number'] ."</td>";
											$table .=  "<td>". $r['account_number']."</td>";
											$table .=  "<td>". $r['location']."</td>";							
											$table .=  "<td>". $r['dept'] ."</td>";
											$table .=  "<td>". $r['complaint']."</td>";
											$table .=  "<td>". $r['umeme_reply']."</td>";
											$table .=  "<td>".$r['_status'] ."</td>";
											$table .=  "<td>". $r['_type'] ."</td></tr>";
										
								}else{
									
								}				
							     
                           }
						}else{
							while($r = mysqli_fetch_array($vsearchresult)){
							     
								 		$table .=  "<tr><td>". $r['phone_number'] ."</td>";
										$table .=  "<td>". $r['account_number']."</td>";
										$table .=  "<td>". $r['location']."</td>";							
										$table .=  "<td>". $r['dept'] ."</td>";
										$table .=  "<td>". $r['complaint']."</td>";
										$table .=  "<td>". $r['umeme_reply']."</td>";
										$table .=  "<td>".$r['_status'] ."</td>";
										$table .=  "<td>". $r['_type'] ."</td></tr>";
								
                           }
						}			
												 
						$table .= "</tbody></table><br/>";
						echo $table;
					 
				    }else{
					 	//No info											 	
						$table .="<span ><font size = '2px' color = '#ff0000'><b>0 results found using </b></font></span>";
						echo $table;
				    }									 
				    
			  }else{
				//$table .= "<span ><font size = '2px'><b>date fields are empty</b></font>".$vsearchquery."</span>";		
		        //echo $table;
		        $vsearchquery .= " LIMIT 5";
		         $vsearchresultdef = db_select2_1($vsearchquery);	
		         if(mysqli_num_rows($vsearchresultdef) > 0){
			    						
				  while($r = mysqli_fetch_array($vsearchresultdef)){
				 	       //Print Default table
				 	        
						 		$table .=  "<tr><td>". $r['phone_number'] ."</td>";
								$table .=  "<td>". $r['account_number']."</td>";
								$table .=  "<td>". $r['location']."</td>";
								$table .=  "<td>". $r['dept'] ."</td>";
								$table .=  "<td>". $r['complaint']."</td>";
								$table .=  "<td>". $r['umeme_reply']."</td>";
								$table .=  "<td>".$r['_status'] ."</td>";
								$table .=  "<td>". $r['_type'] ."</td></tr>";
						 					
				 }
					  
				    $table .= "</tbody></table><br/>";
				    echo $table;
						 
		        }else{
		 	       //No info
			       $table .= "Default View";
				   echo $table;
			
	            }
		      }

?>											