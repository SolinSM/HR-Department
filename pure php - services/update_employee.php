<?php
	
	require 'config.php';
	
/*	// as me user
	$_POST['fname']= "Ayah";
	$_POST['lname'] = "Dom";
	$_POST['email'] = "aya@hotmail.com";
	$_POST['jobID'] = 2;
*/	

	// استقبال القيم
	$first_name = check_security( $_POST['fname'], "string");
	$last_name = check_security( $_POST['lname'], "string");
	$email = check_security( $_POST['email'], "string");
	$job_id = check_security( $_POST['jobID'], "number");
	
	
		
	$update_sql = "UPDATE `employees`
				SET `f_name` = :f_name ,
					`l_name` = :l_name ,
					`emp_job_id` = :emp_job_id
				where `email` = :email";
	
	try{
		$stmt = $conn->prepare($update_sql);
		
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
	$my_response['result_msg'] = "Done Update";
	die(json_encode($my_response));
	

	$conn = null;
?>