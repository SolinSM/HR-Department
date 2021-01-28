<?php
	
	require 'config.php';

//	$_POST['email'] = "s@hotmail.com";
	
	$email = check_security( $_POST['email'], "string");

	$sql = "select * from employees where email= :email ";
	
	
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
	
	$result = $stmt->fetch();
	
	if( $result && $stmt->rowCount() == 1){
		$resp['full_name'] = $result['f_name']." ".$result['l_name'];
		$resp['email'] = $result['email'];
		
		
		$my_response['result_status'] = "success";
		$my_response['result_code'] = 200;
		$my_response['result_msg'] = $resp;
		die(json_encode($my_response));
		
		
	}else if( $result && $stmt->rowCount() > 1){
		$msg = "more than one result";
		
	}else{
		$msg = "no result";
	}
	
	
	$my_response['result_status'] = "success";
	$my_response['result_code'] = 200;
	$my_response['result_msg'] = $msg;
	die(json_encode($my_response));
	
	
	$conn = null;

?>