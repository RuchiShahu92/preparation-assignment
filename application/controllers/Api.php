<?php 
 
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
//require APPPATH.'libraries/REST_Controller.php';

class Api extends CI_Controller {

    public function __construct() { 
        parent::__construct();
          
    }
 	
 	 
	public function get_employee_list() {
		 	
		 	$offset	='0'; 
			$limit 	= 10;
			//$offset = ($pageno-1) * $limit; 
			 
			$total_rows			  =$this->general_model->get_employee_list($limit,$offset,1);
			$result1['total_rows'] = $total_rows;
			$result1['total_pages']= ceil($total_rows / $limit); 
			   
		 
			$result = $this->general_model->get_employee_list($limit,$offset);
			
			 
			if($result){
				$data = array(
					 
					 'status' => 1,
                    'message' => 'Get Employee list successful.',
                    'data' => $result);
			}else{
				$data = array('status' => 0,
                    'message' => 'Data not Found.',
                    'data' => '');

			} 


			echo json_encode($data);
                // Set the response and exit
                /*$this->response([
                    'status' => 1,
                    'message' => 'Get News list successful.',
                    'data' => $result
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'Wrong restaurant_id.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);}*/
            
		 
		exit;

    }
	

	public function edit_employee() {
			 	
			$id = $this->input->post('id');
			$where = array('empId' => $id);  
			$result = $this->general_model->get_data('employee','data', $where); 
			 
			if($result){
				$data = array(
					 
					 'status' => 1,
                    'message' => 'Get Employee.',
                    'data' => $result);
			}else{
				$data = array('status' => 0,
                    'message' => 'Wrong id.',
                    'data' => '');

			}  
			echo json_encode($data); 
		exit;

    }
 public function insert_update_employee() {
			 	
			$id = $this->input->post('id');
			$data_array = array(
			'name'		=>	$this->input->post('empname'),
			'deptId' 	=> $this->input->post('department'),
			'salary' 	=> $this->input->post('empsalary'),
			'gender' 	=> $this->input->post('gender'), 
			'address' 	=> $this->input->post('address')
			);
				
			if(isset($id) && !empty($id)){
				$where = array('empId' => $id);
				$this->general_model->update_data('employee',$data_array,$where);
				$action = 'update';
			}else{
				$this->general_model->insert_data('employee',$data_array);
				$action = 'insert';
			}
			
			
			 
			if($result){
				$data = array(
					 
					 'status' => 1,
                    'message' => 'Employee '.$action. 'Successfully.',
                    'data' => $result);
			}else{
				$data = array('status' => 0,
                    'message' => 'something went wrong.',
                    'data' => '');

			}  
			echo json_encode($data); 
		exit;

    }
    public function delete_employee() {
			 	
			$id = $this->input->post('id');
			$where = array('empId' => $id);  
			$result = $this->general_model->delete_record('employee', $where); 
			 
			if($result){
				$data = array(
					 
					 'status' => 1,
                    'message' => 'Delete Employee Successfully.',
                    'data' => $result);
			}else{
				$data = array('status' => 0,
                    'message' => 'Wrong id.',
                    'data' => '');

			}  
			echo json_encode($data); 
		exit;

    }
}
?>