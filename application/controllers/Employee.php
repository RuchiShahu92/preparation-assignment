<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	 function __construct() {

        parent::__construct();
        
        $this->viewname   = $this->router->uri->segments[1];
       
    }

/*
    @Description: get List of employee, pagination
    @Author: Ruchi Shahu
    @Output: 
*/

	public function index()
	{
		$perpage = $this->input->post('perpage');
        $search_keyword = $this->input->post('search_keyword');
        $search_field = $this->input->post('search_field');
        $config['per_page'] = '5';
        $perpage = '5';
        $uri_segment = $this->uri->segment(2);
        $config['uri_segment'] = 2;
        $config['base_url'] = site_url($this->viewname);
		$data['datalist']	=	$this->general_model->get_employee_list($perpage,$uri_segment,'',$search_field,$search_keyword);
 	//	echo $this->db->last_query();  
        $config['total_rows'] = $this->general_model->get_employee_list('','',1,$search_field,$search_keyword);
		$this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        if($this->input->post('ajax_type') == '')

	 if ($this->input->post('result_type') == 'ajax') {
	 		$data['search_field'] = $search_field;
	 		$data['search_keyword'] = $search_keyword;

            $this->load->view($this->viewname . '/ajax_list', $data);
        } else {
            $data['main_content'] =  $this->viewname . "/list";
			$this->load->view('employee/list',$data);
        }
	}

/*
    @Description: Add Data of Employee
    @Author: Ruchi Shahu
    @Output: 
   
    */

	public function add()
	{
		//Fetch department data
		$data['dept_list']	=	$this->general_model->get_data('department'); 
		
		  
		$this->load->view('employee/add',$data);
	}
 


/*
    @Description: Insert Data of Employee
    @Author: Ruchi Shahu
    @Output: Insert data into employee table
    
    */

	public function insert_data()
	{
		
		$data = array(
			'name'		=>	$this->input->post('empname'),
			'deptId' 	=> $this->input->post('department'),
			'salary' 	=> $this->input->post('empsalary'),
			'gender' 	=> $this->input->post('gender'), 
			'address' 	=> $this->input->post('address')
			);

		$this->general_model->insert_data('employee',$data);
		redirect('employee');
	}
/*
    @Description: edit Data of Employee
    @Author: Ruchi Shahu
    @Input:employeeid 
    
    */

	public function edit_data()
	{
		$id = $this->uri->segment(3);
		//Fetch department data
		$data['dept_list']	=	$this->general_model->get_data('department'); 
		 
		//Fetch employee data by id 
		$where = array('empId' => $id);
		$data['editRecord']	=	$this->general_model->get_data('employee','data', $where); 
		
		$this->load->view('employee/add',$data);
	}

	/*
    @Description: Insert Data of Employee
    @Author: Ruchi Shahu
    @Output: Insert data into employee table
   
    */

	public function update_data()
	{
		
		$data = array(
			'name'		=>	$this->input->post('empname'),
			'deptId' 	=> $this->input->post('department'),
			'salary' 	=> $this->input->post('empsalary'),
			'gender' 	=> $this->input->post('gender'), 
			'address' 	=> $this->input->post('address')
			);
		$where = array('empId' => $this->input->post('id'));

		$this->general_model->update_data('employee',$data,$where);
		redirect('employee');
	}
	
/*
    @Description: Delete Data of Employee
    @Author: Ruchi Shahu
    @Output: 
   
    */

	public function delete_data()
	{
		$where  = array('empId' => $this->input->post('id'));
		//Delete Employee data
		$this->general_model->delete_record('employee',$where); 
		
	}
}
