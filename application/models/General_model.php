<?php

/*
    @Description: common function Model
    @Author: Ruchi Shahu
    @Input: 
    @Output: 
*/

class General_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	/*
    @Description: Fetch department data
    @Author: Ruchi Shahu
    @Output: Get department list
   
    */
    public function get_data($table,$data='',$where='')
    { 
        $this->db->select('*',FALSE);
        $this->db->from($table, NULL, FALSE); 

        if($data == 'data')
        {
            $this->db->where($where);
        }
        $query_FC = $this->db->get();
        return $query_FC->result_array();
        
    }

   /*
    @Description: insert data
    @Author: Ruchi Shahu
    @Output: insert into table
  
    */
    public function insert_data($table,$data)
    { 
       $this->db->insert($table, $data);
        return $this->db->insert_id();
        
    }

 /*
        @Description: Function for Update Data
        @Author     : Ruchi Shahu
        @Input      : Update id
        @Output     : 
      
    */   
    public function update_data($table, $data, $where='')
    {
        if(!empty($where))
            $this->db->where($where);
        $this->db->update($table, $data);
    }
    

     /*
    @Description: Get employee list
    @Author: Ruchi Shahu
    @Output: employee list

    */
    public function get_employee_list($perpage='',$offset='',$totalrow='',$search_field='', $search_keyword='')
    { 
        $this->db->select('d.deptName, em.empId as id, em.name, em.salary, em.gender, em.address');
        $this->db->from('employee as em');
        $this->db->join('department as d','d.deptId = em.deptId','Left');
         

        
        if(!empty($search_field) &&  ($search_field == 'gender') ){
           
            $this->db->where($search_field, $search_keyword);
        }elseif(!empty($search_field) && !empty($search_keyword) ){
            $this->db->like($search_field, $search_keyword);
        }
        $this->db->order_by('em.empId','desc');


        if(!empty($perpage) && !empty($offset))
            $this->db->limit($perpage, $offset);
        elseif(!empty($perpage))
            $this->db->limit($perpage);

          $query_FC = $this->db->get();
          
        if (!empty($totalrow))
            return $query_FC->num_rows();
        else
            return $query_FC->result_array();

        $query=$this->db->get();
        return   $query->result_array();
           
            
    }

  /*
    @Description: Delete Employee 
    @Author: Ruchi Shahu
    @Input: employee id
    @Output: employee delete
   
    */
    public function delete_record($table,$where)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

}