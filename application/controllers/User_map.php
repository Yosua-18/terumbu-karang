<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/User_Controller.php';

class User_map extends User_Controller {

	public function __construct()
	{
		parent::__construct();
		 
	}
	public function index()
	{
		$this->data['content'] = 'user/map/index_v';   
		$location_id = $this->session->userdata('location_id');  

		if(!empty($location_id)){
			redirect("shop/".$location_id);
		}
		$this->load->view('user/layouts/page',$this->data); 
    }


	public function getAllLocation(){
		
	 	$this->load->model('location_model');
		$response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();    
		  
		$data = $this->location_model->getAllById(); 

		if(!empty($data)){ 
     		$response_data['status'] = true; 
    		$response_data['data'] = $data; 
		}
		
        echo json_encode($response_data); 
	}
    
    
}
