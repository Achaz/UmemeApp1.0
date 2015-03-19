<?php
     $uphone = $_POST['up'];
     $uloc = $_POST['ul'];
     $udatefrom = $_POST['udf'];
     $udateto = $_POST['udt'];
     $u_status = $_POST['us'];
     $u_type = $_POST['ut'];
     $u_dept = $_POST['ud'];
	 
	 include("db_core.php");	 
	 $table =  "<table class=\"table table-striped\" ><thead><tr><th> Acc No </th><th> Contact </th><th> Location </th><th> Department </th><th> Complaint </th><th> Reply </th><th> Status </th><th> Type </th><th>Extras</th></tr></thead><tbody style='height: 100px; overflow: auto'> ";
						 
	 $usearchquery = "SELECT umeme_logs.phone_number, umeme_logs.username, umeme_logs.account_number, umeme_logs.complaint, umeme_logs.location, umeme_logs.umeme_reply, 
					  (SELECT department FROM umeme_db.umeme_department WHERE umeme_department.id = umeme_assignment.dept_id) AS dept, 
					  (SELECT umeme_status.status FROM umeme_db.umeme_status WHERE umeme_status.id = umeme_assignment.status_id) AS _status, 
					  (SELECT umeme_type.type FROM umeme_db.umeme_type WHERE umeme_type.id = umeme_assignment.type_id ) AS _type 
					  FROM umeme_db.umeme_logs 
					  INNER JOIN umeme_assignment 
					  ON umeme_logs.id = umeme_assignment.log_id";
   
       if(strlen($udatefrom) > 0 && strlen($udateto) > 0){
	 			
		 		$usearchquery .= " WHERE date_sent BETWEEN '$udatefrom' AND '$udateto'"; 
				if(strlen($uphone) > 0){
				 		$usearchquery .= " AND phone_number = '$uphone'";
				}
					
				if(strlen($uloc) > 0){
				        $usearchquery .= " AND location = '$uloc'";
				}	
			 	$usearchresult = db_select2_1($usearchquery);	
					if(mysqli_num_rows($usearchresult) > 0){
						
						if(strlen($u_dept) > 0 && strlen($u_status) > 0 && strlen($u_type) > 0){
							while($r = mysqli_fetch_array($usearchresult)){
						 	//Print table
						 	if($u_dept == $r['dept'] && $u_status == $r['_status'] && $u_type == $r['_type']){
						 		     
								 		$table .=  "<tr><td>". $r['account_number'] ."</td>";
										$table .=  "<td>". $r['phone_number']."</td>";
										$table .=  "<td>". $r['location']."</td>";							
										$table .=  "<td>". $r['dept'] ."</td>";
										$table .=  "<td>". $r['complaint']."</td>";
										$table .=  "<td>". $r['umeme_reply']."</td>";
										$table .=  "<td>".$r['_status'] ."</td>";
										$table .=  "<td>". $r['_type'] ."</td>";
										$table .=  "<td><button class = 'btn-primary' id = 'reply'>Reply</button></td></tr>";
									
						 	 }else{
						 		
						 	 }							
						  }
						}else if(strlen($u_dept) > 0 && strlen($u_status) > 0){
							while($r = mysqli_fetch_array($usearchresult)){
						 	//Print table
						 	  if($u_dept == $r['dept'] && $u_status == $r['_status']){
						 		    
								 		$table .=  "<tr><td>". $r['account_number'] ."</td>";
										$table .=  "<td>". $r['phone_number']."</td>";
										$table .=  "<td>". $r['location']."</td>";							
										$table .=  "<td>". $r['dept'] ."</td>";
										$table .=  "<td>". $r['complaint']."</td>";
										$table .=  "<td>". $r['umeme_reply']."</td>";
										$table .=  "<td>".$r['_status'] ."</td>";
										$table .=  "<td>". $r['_type'] ."</td>";
										$table .=  "<td><button class = 'btn-primary' id = 'reply'>Reply</button></td></tr>";
									
						 	 }else{
						 		
						 	 }							
						   }
						}else if(strlen($u_type) > 0 && strlen($u_status) > 0){
							while($r = mysqli_fetch_array($usearchresult)){
						 	//Print table
						 	if($u_status == $r['_status'] && $u_type == $r['_type']){
						 		    
								 		$table .=  "<tr><td>". $r['account_number'] ."</td>";
										$table .=  "<td>". $r['phone_number']."</td>";
										$table .=  "<td>". $r['location']."</td>";							
										$table .=  "<td>". $r['dept'] ."</td>";
										$table .=  "<td>". $r['complaint']."</td>";
										$table .=  "<td>". $r['umeme_reply']."</td>";
										$table .=  "<td>".$r['_status'] ."</td>";										
										$table .=  "<td>". $r['_type'] ."</td>";
										$table .=  "<td><button class = 'btn-primary' id = 'reply'>Reply</button></td></tr>";
									
						 	}else{
						 	   	
						 	}							
						 }
						}else if(strlen($u_dept) > 0 && strlen($u_type) > 0){
							while($r = mysqli_fetch_array($usearchresult)){
						 	//Print table
						 	if($u_dept == $r['dept'] && $u_type == $r['_type']){
						 		    
								 		$table .=  "<tr><td>". $r['account_number'] ."</td>";
										$table .=  "<td>". $r['phone']."</td>";
										$table .=  "<td>". $r['location']."</td>";							
										$table .=  "<td>". $r['dept'] ."</td>";
										$table .=  "<td>". $r['complaint']."</td>";
										$table .=  "<td>". $r['umeme_reply']."</td>";
										$table .=  "<td>".$r['_status'] ."</td>";
										$table .=  "<td>". $r['_type'] ."</td>";
										$table .=  "<td><button class = 'btn-primary' id = 'reply'>Reply</button></td></tr>";
									
						 	}else{
						 	   	
						 	}							
						 }
						}else if(strlen($u_dept) > 0){
							while($r = mysqli_fetch_array($usearchresult)){
								if($u_dept == $r['dept']){
									
									 		$table .=  "<tr><td>". $r['account_number'] ."</td>";
											$table .=  "<td>". $r['phone_number']."</td>";
											$table .=  "<td>". $r['location']."</td>";							
											$table .=  "<td>". $r['dept'] ."</td>";
											$table .=  "<td>". $r['complaint']."</td>";
											$table .=  "<td>". $r['umeme_reply']."</td>";
											$table .=  "<td>".$r['_status'] ."</td>";
											$table .=  "<td>". $r['_type'] ."</td>";
											$table .=  "<td><button class = 'btn-primary' id = 'reply'>Reply</button></td></tr>";
									 	
								}else{
										
								}				
							     
                           }

						}else if(strlen($u_status) > 0){
							while($r = mysqli_fetch_array($usearchresult)){
								if($u_status == $r['_status']){
									
									 		$table .=  "<tr><td>". $r['account_number'] ."</td>";
											$table .=  "<td>". $r['phone_number']."</td>";
											$table .=  "<td>". $r['location']."</td>";							
											$table .=  "<td>". $r['dept'] ."</td>";
											$table .=  "<td>". $r['complaint']."</td>";
											$table .=  "<td>". $r['umeme_reply']."</td>";
											$table .=  "<td>".$r['_status'] ."</td>";											
											$table .=  "<td>". $r['_type'] ."</td>";
											$table .=  "<td><button class = 'btn-primary' id = 'reply'>Reply</button></td></tr>";
									 
								}else{
										
								}				
							     
                           }
						}else if(strlen($u_type) > 0){
							while($r = mysqli_fetch_array($usearchresult)){
								if($u_type == $r['_type']){
									 		$table .=  "<tr><td>". $r['account_number'] ."</td>";
											$table .=  "<td>". $r['phone_number']."</td>";
											$table .=  "<td>". $r['location']."</td>";							
											$table .=  "<td>". $r['dept'] ."</td>";
											$table .=  "<td>". $r['complaint']."</td>";
											$table .=  "<td>". $r['umeme_reply']."</td>";
											$table .=  "<td>".$r['_status'] ."</td>";
											$table .=  "<td>". $r['_type'] ."</td>";
											$table .=  "<td><button class = 'btn-primary' id = 'reply'>Reply</button></td></tr>";
									 	
								}else{
										
								}				
							     
                           }
						}else{
							while($r = mysqli_fetch_array($usearchresult)){
							     
								 		$table .=  "<tr><td>". $r['account_number'] ."</td>";
										$table .=  "<td>". $r['phone_number']."</td>";
										$table .=  "<td>". $r['location']."</td>";							
										$table .=  "<td>". $r['dept'] ."</td>";
										$table .=  "<td>". $r['complaint']."</td>";
										$table .=  "<td>". $r['umeme_reply']."</td>";
										$table .=  "<td>".$r['_status'] ."</td>";										
										$table .=  "<td>". $r['_type'] ."</td>";
										$table .=  "<td><button class = 'btn-primary' id = 'reply'>Reply</button></td></tr>";
								
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
				
		        $usearchquery .= " LIMIT 5";
		         $usearchresultdef = db_select2_1($usearchquery);	
		         if(mysqli_num_rows($usearchresultdef) > 0){
			    						
				  while($r = mysqli_fetch_array($usearchresultdef)){
				 	       //Print Default table
				 	        
						 		$table .=  "<tr><td>". $r['account_number'] ."</td>";
								$table .=  "<td>". $r['phone_number']."</td>";
								$table .=  "<td>". $r['location']."</td>";
								$table .=  "<td>". $r['dept'] ."</td>";
								$table .=  "<td>". $r['complaint']."</td>";
								$table .=  "<td>". $r['umeme_reply']."</td>";
								$table .=  "<td>".$r['_status'] ."</td>";
								$table .=  "<td>". $r['_type'] ."</td>";
								$table .=  "<td><button class = 'btn-primary' id = 'reply'>Reply</button></td></tr>";
							
					
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