<?php
	
	require_once 'config.php';
	
/*	// as me user
	$_POST['fname']= "Sema";
	$_POST['lname'] = "Dom";
	$_POST['email'] = "sema@gmail.com";
	$_POST['jobID'] = "2u";
*/	
	// استقبال القيم
	$first_name = check_security( $_POST['fname'], "string");
	$last_name = check_security( $_POST['lname'], "string");
	$email = check_security( $_POST['email'], "string");
	$job_id = check_security( $_POST['jobID'], "number");
	
		
	$add_sql = "INSERT INTO `employees`(`f_name`, `l_name`, `email`, `emp_job_id`) 
				VALUES ( :f_name, :l_name, :email, :emp_job_id );";
	
	try{
		$stmt = $conn->prepare($add_sql);
		
		$stmt->bindparam( ':f_name' , $first_name , PDO::PARAM_STR);
		$stmt->bindparam( ':l_name' , $last_name , PDO::PARAM_STR);
		$stmt->bindparam( ':email' , $email , PDO::PARAM_STR);
		$stmt->bindparam( ':emp_job_id' , $job_id , PDO::PARAM_INT);
		
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
	$my_response['result_msg'] = "Done Insert";
	die(json_encode($my_response));
	
	$conn = null;
?>