<?php
	
	require 'config.php';

	$sql = "select e.* ,  ej.job_name
			from employees e , employee_jobs ej
			where e.emp_job_id = ej.emp_job_id";  
	
	
	try{
		$stmt = $conn->prepare($sql);
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
			$resp['job_name'] = $emp->job_name;
			
			array_push($res , $resp);
		}
		
	}
	
	$my_response['result_status'] = "success";
	$my_response['result_code'] = 200;
	$my_response['result_msg'] = $res;
	die(json_encode($my_response));
	
	$conn = null;

?>