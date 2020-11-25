<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Database\Query;

/**
 * Description of EmployeeModel
 *
 * @author Solin SM
 */
class EmployeeModel extends Model{
    
    protected $db, $builder;

    public function __construct(){
        $this->db =\Config\Database::connect();
        $this->builder = $this->db->table('employees');
    }    
    
    function load_employee($emp_id = 0){    
        try{
            if($emp_id > 0)
                $this->builder->where('emp_id', $emp_id);
            
            $this->builder->select('*');
            $this->builder->join('employee_jobs', 'employee_jobs.emp_job_id = employees.emp_job_id');
            $query = $this->builder->get();

            $results = $query->getResult();
            return $results;

	}catch(PDOException $ex){
            $msg = "Error: "  . $ex->getMessage();

            $my_response['result_status'] = "failed";
            $my_response['result_code'] = 102;
            $my_response['result_msg'] = $msg;
            die(json_encode($my_response));
	}
    }
    
    function delete_employee($emp_id){
               
	try{
            $this->builder->where('emp_id', $emp_id);
            $this->builder->delete();
            
            //if(!$res->affected_rows)
              
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
    }
    
    function search_employee($emp_email){
           /////// ****************** have error    
	try{
            $this->builder->like('email', $emp_email);
            $this->builder->select('*');
            $this->builder->join('employee_jobs', 'employee_jobs.emp_job_id = employees.emp_job_id');
            $query = $this->builder->get();
            
            $results = $query->getResult();
            return $results;
              
	}catch(PDOException $ex){
            $msg = "Error: "  . $ex->getMessage();

            $my_response['result_status'] = "failed";
            $my_response['result_code'] = 102;
            $my_response['result_msg'] = $msg;
            die(json_encode($my_response));
	}
        
    }
    
    function add_employee($emp_firstName, $emp_lastName, $emp_email, $emp_job_id){
        try{
            // check exist row
            $this->builder->where( 'email' , $emp_email );
            $this->builder->select('*');
            $count = $this->builder->countAllResults();

            if ($count === 0) {
                
                $data = [
                    'f_name' => $emp_firstName,
                    'l_name'  => $emp_lastName,
                    'email'  => $emp_email,
                    'emp_job_id'  => $emp_job_id
                ];

                $this->builder->insert($data);
                
                $result = "success";
                $code = 200;
                $msg = "Done Adding Successfully";
            }else{
                $result = "success";
                $code = 200;
                $msg = "Email account already exist";
            }
            
            $my_response['result_status'] = $result;
            $my_response['result_code'] = $code;
            $my_response['result_msg'] = $msg;
            die(json_encode($my_response));
            
              
	}catch(PDOException $ex){
            $msg = "Error: "  . $ex->getMessage();

            $my_response['result_status'] = "failed";
            $my_response['result_code'] = 102;
            $my_response['result_msg'] = $msg;
            die(json_encode($my_response));
	}
        
    }

    function update_employee($emp_firstName, $emp_lastName, $emp_email, $emp_job_id)
    {
        try{
            // check exist row
            $this->builder->where( 'email' , $emp_email );
            $this->builder->select('*');
            $count = $this->builder->countAllResults();

            if ($count === 0) {
                $result = "failed";
                $code = 104;
                $msg = "No employee with this email";
            }else{
                
                $data = [
                    'f_name' => $emp_firstName,
                    'l_name'  => $emp_lastName,
                    'emp_job_id'  => $emp_job_id
                ];

                $this->builder->where('email', $emp_email);
                $this->builder->update($data);

                $result = "success";
                $code = 200;
                $msg = "Successfully Updated";
            }
            
            $my_response['result_status'] = $result;
            $my_response['result_code'] = $code;
            $my_response['result_msg'] = $msg;
            die(json_encode($my_response));
            
        
	}catch(PDOException $ex){
            $msg = "Error: "  . $ex->getMessage();

            $my_response['result_status'] = "failed";
            $my_response['result_code'] = 102;
            $my_response['result_msg'] = $msg;
            die(json_encode($my_response));
	}
    }
    
}
