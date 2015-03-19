<?php
    include("db_core.php");
    $sitename = $_POST['sn'];
	$sitedesc = $_POST['sd'];
	$hp = $_POST['hp'];
	$siteroot = $_POST['sr'];
	$ename = $_POST['en'];
	$e_admin = $_POST['ea'];
	
		
		$query = "UPDATE umeme_site_settings SET site_name = '". $sitename ."', site_description = '". $sitedesc ."', email_name = '". $ename ."', admin_email = '". $e_admin ."', site_root = '". $siteroot ."', homepage = '". $hp ."' WHERE id = 1";                                                                  
		$result = db_query($query);

		if($result){
			$response["success"] = 1;
		    $response["message"] = "Site Settings made";
			echo json_encode($response);
		}else{
			$response["success"] = 0;
		    $response["message"] = "Site Settings not made";
			echo json_encode($response);
		}
	
?>