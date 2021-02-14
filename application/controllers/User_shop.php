<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/User_Controller.php';

class User_shop extends User_Controller {

	public function __construct()
	{
		parent::__construct();
		 
	}
	public function index()
	{ 
		$this->load->model("products_model");
		
		$this->data['content'] = 'user/shop/index_v';   

		$this->data['location_id'] = $this->uri->segment(2);
		$this->session->set_userdata('location_id', $this->data['location_id']);
		$this->data['data_products'] = $this->products_model->getAllById(); 
		$this->load->view('user/layouts/page',$this->data); 
    } 
	public function detail()
	{
		$this->data['content'] = 'user/shop/detail_v';   

		$this->load->view('user/layouts/page',$this->data); 
    }

    public function add_to_cart(){ 
    	$id = $this->input->post('id'); 
    	$name = $this->input->post('name');   
    	$photo = $this->input->post('photo');   
    	$price = $this->input->post('price');  
    	$size = $this->input->post('size');  
    	$location_id = $this->input->post('location_id');  
  		$data = array(
		        'id'      => $id,
		        'qty'     => 1,
		        'price'   => $price,
		        'name'    => $name,
		        'photo'    => $photo,
		        'location_id'    => $location_id,
		        'options' => array('Size' => $size)
		);

		$this->cart->insert($data);

 		$response_data['status'] = true; 
    	$response_data['msg'] = "";
		$response_data['data'] = $data; 
 
		
        echo json_encode($response_data); 
    }
    
    
}
