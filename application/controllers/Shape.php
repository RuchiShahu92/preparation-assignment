<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shape extends CI_Controller {

	 function __construct() {

        parent::__construct();
        
        $this->viewname   = $this->router->uri->segments[1];
       
    }

/*
    @Description: get Shape
    @Author: Ruchi Shahu
    @Output: 
*/

	public function index()
	{
		 
        $config['base_url'] = site_url($this->viewname);
		  
        $data['main_content'] =   '';
		$this->load->view('shape/list',$data);
        
	} 
}
