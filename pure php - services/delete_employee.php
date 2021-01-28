<?php
	
	require 'config.php';
	
	// as me user
//	$_POST['email'] = "sema@gmail.com";
	
	// استقبال القيم
	$email = check_security( $_POST['email'], "string");
		
	$sql = "DELETE FROM `employees` WHERE email = :email;";
	
	try{
		$stmt = $conn->prepare($sql);

		$stmt->bindparam( ':email' , $email , PDO::PARAM_STR);
		
		$stmt->execute();
		
	}catch(PDOException $ex){
		$msg = "Error: "  . $ex->getMessage();
			
		$my_response['result_status'] = "failed";
		$my_response['result_code'] = 102;
		$my_response['result_msg'] = $msg;
		die(json_encode($my_response));
	}
	
	
	$my_response['result_status'] = "success";
	$my_response['result_code'] = 200;
	$my_response['result_msg'] = "Done Delete";
	die(json_encode($my_response));
	

	$conn = null;
?>