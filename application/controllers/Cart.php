<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/User_Controller.php';
class Cart extends User_Controller {

	public function __construct()
	{
		parent::__construct();
		 
	}
	public function index()
	{
		$this->data['content'] = 'user/cart/index_v';   
		$this->data['location_id'] = $this->uri->segment(2);

		$this->load->view('user/layouts/page',$this->data); 
    } 
	
	public function checkout()
	{

		// $this->session->set_userdata('location_id', "");
		// $this->cart->destroy();
		$this->data['content'] = 'user/cart/checkout_v';   

		$this->load->view('user/layouts/page',$this->data);
	}
	public function do_checkout()
	{
		
	 	$this->form_validation->set_rules('user_id', "User Harus Diisi", 'trim|required');
	 	$this->form_validation->set_rules('location_id', "User Harus Diisi", 'trim|required');
	 	$this->load->model("orders_model");
	 	$this->load->model("orders_item_model");
		if ($this->form_validation->run() === TRUE)
		{
			$data_orders = $this->orders_model->getAllById(); 
			$total_order = count($data_orders)+1;
			$order_number = str_pad($total_order, 4, '0', STR_PAD_LEFT);
			date_default_timezone_set("Asia/Jakarta");
			$data = array(
				'order_number' =>"#REQ".date('dmY').$order_number, 
				'user_id' => $this->input->post('user_id'), 
				'location_id' => $this->input->post('location_id'),
				'status_order' => 1,
				'tanggal_order' => date("Y-m-d H:i:s"),
				'created_at' => date("Y-m-d H:i:s"),
				'created_by' => $this->data['users']->id,
			);
			$insert_orders = $this->orders_model->insert($data);
			if ($insert_orders)
			{  
				$order_id = $insert_orders;

				$this->load->library('cart');
				$carts = $this->cart->contents(); 
				foreach ($carts as $value) {
					$items = array(
						"order_id"=>$order_id,
						"product_id"=>$value['id'],
						"size_id"=>$value['options']['Size'],
						"qty"=>$value['qty'],
						"price"=>$value['price']
					);
					$insert_orders_item = $this->orders_item_model->insert($items);
				}

				$this->session->set_userdata('location_id', "");
				$this->cart->destroy();
				$this->session->set_flashdata('message', "Request Berhasil Ditambah");
				redirect("account#history","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Request Gagal Ditambah");
				redirect("checkout","refresh");
			}
		} 
		else
		{ 
			$this->session->set_flashdata('message_error',"Request Gagal Ditambah");
		 	redirect("checkout");
		}
	}

	public function detail_order(){

		$this->data['content'] = 'user/cart/detail_order';    

		$order_id = $this->uri->segment(2);


		$this->load->model("orders_model");
	 	$this->load->model("orders_item_model");
	 	$where = array("orders.id"=>$order_id);
	 	$data_orders = $this->orders_model->getAllById($where);
	 	$data_orders_item = $this->orders_item_model->getAllById($where); 
	 	foreach ($data_orders as $value) {
	 		$data_items = $this->getItems($value->id,$data_orders_item);
	 		if(!empty($data_items)){ 
	 			$value->total_transaksi = $data_items['total_transaksi'];  
	 			$value->items = $data_items['items'];  
	 		}else{

	 			$value->items = array(); 
	 			$value->total_transaksi = 0; 

	 		}
	 	} 
	  

	 	$this->data['data_orders'] = $data_orders;
		$this->load->view('user/layouts/page',$this->data); 
	}


    private function getItems($order_id,$items){
    	$data = array();
    	foreach ($items as $value) {
    		if($order_id == $value->order_id){ 
    			$data['items'][] = $value;
    			$data['total_transaksi'] = ($value->price * $value->qty);
    		}
    	}

    	return $data;
    }
    
}
