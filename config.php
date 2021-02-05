<?php
	 class config{
	/*private $host ="192.168.1.113";
	private $dbName = "my_company";
	private $user = "root";
	private $pass = "12345";
	*/
	private $host =getenv('DB_HOST');
	private $dbName =getenv('DB_NAME');
	private $user =getenv('DB_USER');
	private $pass =getenv('DB_PASS');
	
	
	public function connect(){
	try{ 
		$conn = new PDO( 'mysql:host='.$this->host. '; dbname='. $this->dbName, $this->user, $this->pass);
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	}catch(PDOException $ex){ 
		//$msg = "Connection failed: "  . $ex->getMessage();
			
		//$my_response['result_status'] = "failed";
		//$my_response['result_code'] = 100;
		//$my_response['result_msg'] = $msg;
		//die(json_encode($my_response));
		echo'Database Error:'. $ex->getMessage();
	}
	
	}
	}
	
	//echo "<script>alert('connected');</script>";
	
/*	
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
*/
	
?>
