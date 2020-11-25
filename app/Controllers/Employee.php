<?php
namespace App\Controllers;

use \App\Models\EmployeeModel;
/**
 * Description of Employee
 *
 * @author Solin SM
 */
class Employee extends BaseController{
    
    
    public function delete()
    {
        $emp_id = $this->request->getVar('emp_id');
        if(empty($emp_id)){
            $this->_invalid_info();
        }
        
        $EmployeeModel = new EmployeeModel();
        $EmployeeModel->delete_employee($emp_id);
    }
    
    /*
     * For specefic select & select all
     * 
     */
    public function list() 
    {
        $emp_id =  ($this->request->getVar('emp_id') >= 0) ? $this->request->getVar('emp_id') : 0;
        
        $EmployeeModel = new EmployeeModel();
        $results = $EmployeeModel->load_employee($emp_id);
        
        $response = array();
        if($results){
            foreach ($results as $row)
            {
                $respo['emp_id'] = $row->emp_id;
                $respo['f_name'] = $row->f_name;
                $respo['l_name'] = $row->l_name;
                $respo['email'] = $row->email;
                $respo['job_name'] = $row->job_name;

                array_push($response, $respo);
            }
            
            $result = "success";
            $code = 200;
            $msg = $response;
            
        }else{
            $result = "faild";
            $code = 103;
            $msg = "No result";
        }
        
        $my_response['result_status'] = $result;
		$my_response['result_code'] = $code;
		$my_response['result_msg'] = $msg;
		die(json_encode($my_response));
        
    }

    
    public function search() 
    {
        $emp_email = $this->request->getPost('email');
        if(empty($emp_email)){
            $this->_invalid_info();
        }
        
        $EmployeeModel = new EmployeeModel();
        $results = $EmployeeModel->search_employee($emp_email);
        
        $response = array();
        if($results){
            foreach ($results as $row)
            {
                $respo['emp_id'] = $row->emp_id;
                $respo['f_name'] = $row->f_name;
                $respo['l_name'] = $row->l_name;
                $respo['email'] = $row->email;
                $respo['job_name'] = $row->job_name;

                array_push($response, $respo);
            }
            
            $result = "success";
            $code = 200;
            $msg = $response;
        }else{
            $result = "failed";
            $code = 103;
            $msg = "No result";    
        }
        
        $my_response['result_status'] = $result;
		$my_response['result_code'] = $code;
		$my_response['result_msg'] = $msg;
		die(json_encode($my_response));
        
    }
    
    
    public function add() 
    {
        $emp_firstName = $this->request->getPost('f_name');
        $emp_lastName = $this->request->getPost('l_name');
        $emp_email = $this->request->getPost('email');
        $emp_job_id = $this->request->getPost('emp_job_id');
        
        if(empty($emp_firstName) || empty($emp_lastName) || empty($emp_email) || empty($emp_job_id)){
            $this->_invalid_info();
        }
        
        $EmployeeModel = new EmployeeModel();
        $EmployeeModel->add_employee($emp_firstName, $emp_lastName, $emp_email, $emp_job_id);
    }
    
    public function update() 
    {
        $emp_firstName = $this->request->getPost('f_name');
        $emp_lastName = $this->request->getPost('l_name');
        $emp_email = $this->request->getPost('email');
        $emp_job_id = $this->request->getPost('emp_job_id');
        
        if(empty($emp_firstName) || empty($emp_lastName) || empty($emp_email) || empty($emp_job_id)){
            $this->_invalid_info();
        }
        
        $EmployeeModel = new EmployeeModel();
        $EmployeeModel->update_employee($emp_firstName, $emp_lastName, $emp_email, $emp_job_id);
    }
    
    private function _invalid_info(){
        $msg = "Invalid Information";
            
        $my_response['result_status'] = "failed";
        $my_response['result_code'] = 103;
        $my_response['result_msg'] = $msg;
        die(json_encode($my_response));
    }
}
