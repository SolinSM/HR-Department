<?php
	
	require 'config.php';

//	$_POST['email'] = "hotmail";
	
	$email = '%' . check_security( $_POST['email'], "string") . '%';

	$sql = "select * from employees where email like :email ";  
	
	
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
	
	$result = $stmt->fetchAll(PDO::FETCH_OBJ);
	$res = array();
	

	if( $result && $stmt->rowCount() >= 1){
		
		foreach( $result as $emp ){
		
			$resp['full_name'] = $emp->f_name ." ". $emp->l_name;
			$resp['email'] = $emp->email;	
			array_push($res , $resp);
		}
		//print_r($res);
		
	}
	
	$my_response['result_status'] = "success";
	$my_response['result_code'] = 200;
	$my_response['result_msg'] = $res;
	die(json_encode($my_response));
	
	$conn = null;

?>