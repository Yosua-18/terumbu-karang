<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Orders_model extends CI_Model
{
     

    public function __construct()
    {
        parent::__construct(); 
    }  
    public function getOneBy($where = array()){
        $this->db->select("orders.*")->from("orders");  

        $this->db->where($where);   

        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->row(); 
        } 
        return FALSE;
    }
    public function getAllById($where = array()){
        $this->db->select("orders.*")->from("orders");   

        $this->db->where($where);   

        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->result(); 
        } 
        return FALSE;
    }
    public function insert($data){
        $this->db->insert("orders", $data);
        return $this->db->insert_id();
    }

    public function update($data,$where){
        $this->db->update("orders", $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($where){
        $this->db->where($where);
        $this->db->delete("orders"); 
        if($this->db->affected_rows()){
            return TRUE;
        }
        return FALSE;
    }

    function getAllBy($limit,$start,$search,$col,$dir)
    {
        $this->db->select("orders.*,location.name as location_name, users.first_name")->from("orders");    
        $this->db->join("location","location.id = orders.location_id","left"); 
        $this->db->join("users","users.id = orders.user_id","left"); 

        $this->db->limit($limit,$start)->order_by($col,$dir);
        if(!empty($search)){
            foreach($search as $key => $value){
                $this->db->or_like($key,$value);    
            }   
        } 
  
        $result = $this->db->get();
        if($result->num_rows()>0)
        {
            return $result->result();  
        }
        else
        {
            return null;
        }
    }

    function getCountAllBy($limit,$start,$search,$order,$dir)
    { 
        $this->db->select("orders.*")->from("orders");   
        if(!empty($search)){
            foreach($search as $key => $value){
                $this->db->or_like($key,$value);    
            }   
        }
 
 
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
