<?php
	
	$username = "root";
	$password = "";
	$host ="localhost";
	$dbname = "my_company";
	
	try{ 
		$conn = new PDO( "mysql:host=$host; dbname=$dbname", $username , $password );
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	}catch(PDOException $ex){ 
		$msg = "Connection failed: "  . $ex->getMessage();
			
		$my_response['result_status'] = "failed";
		$my_response['result_code'] = 100;
		$my_response['result_msg'] = $msg;
		die(json_encode($my_response));
	}
	
	//echo "<script>alert('connected');</script>";
	
	
function check_security($var, $type){
	
    $error_in_value = false;
    
    $var = trim($var);
    $var = stripslashes($var);
    
    if($type != "passward"){
        
        $var = htmlspecialchars($var);
        
        $chk_array = array( "'", ")", "(", "]", "[", "--", "#", ";", "!");

        foreach($chk_array as $arr){
            $var = str_ireplace($arr,"",$var);
        }

        if($type == "number" && !is_numeric($var)){
            $error_in_value = true;
            
        }
        
        $var = strip_tags($var);
        
        if( $error_in_value == true){
			
			$my_response['result_status'] = "failed";
			$my_response['result_code'] = 101;
			$my_response['result_msg'] = "Invalid Info";
			die(json_encode($my_response));
        }
        
    }   
    
    $var = strip_tags($var);  
    return $var;
}

	
?>