<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/User_Controller.php';

class User_profile extends User_Controller {

	public function __construct()
	{
		parent::__construct();
		 
	}
	public function index()
	{
		$this->data['content'] = 'user/profile/index_v';   

	 	$this->load->model("orders_model");
	 	$this->load->model("orders_item_model");
	 	$where = array("orders.user_id"=>$this->data['users']->id);
	 	$data_orders = $this->orders_model->getAllById($where);
	 	$data_orders_item = $this->orders_item_model->getAllById($where);

		if(!empty($data_orders)){
	 	foreach ($data_orders as $value) {
	 		$data_items = $this->getItems($value->id,$data_orders_item);
	 		if(!empty($data_items)){ 
	 			$value->total_transaksi = $data_items['total_transaksi'];  
	 		}else{
 
	 			$value->total_transaksi = 0; 

	 		}
		 }
	}
	  

	 	$this->data['data_orders'] = $data_orders;


		$this->load->view('user/layouts/page',$this->data); 
    } 

    private function getItems($order_id,$items){
    	$data = array();
    	foreach ($items as $value) {
    		if($order_id == $value->order_id){ 
    			$data['total_transaksi'] = ($value->price * $value->qty);
    		}
    	}

    	return $data;
    }
 
    
    
}
