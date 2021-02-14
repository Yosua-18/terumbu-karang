<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/User_Controller.php';

class Payment extends User_Controller {

	public function __construct()
	{
		parent::__construct();
		 
	}
	public function index()
	{
		$this->data['content'] = 'user/payment/index_v';   

		$order_id = $this->uri->segment(2);


		$this->load->model("orders_model");
	 	$this->load->model("orders_item_model");
	 	$where = array("orders.id"=>$order_id);
	 	$data_orders = $this->orders_model->getOneBy($where); 
	   
 		$data_orders_item = $this->orders_item_model->getAllById(array(
	      "orders.id"=>$data_orders->id
	    )); 
	    $total_transaksi = 0;
	    foreach ($data_orders_item as $value) {
	      $total_transaksi += $value->qty * $value->price;
	    }
	    $data_orders->total_transaksi = $total_transaksi;

	    $this->data['data_orders'] = $data_orders;
	    $this->data['data_orders_item'] = $data_orders_item; 
	 	$this->data['order_id'] = $order_id;
		$this->load->view('user/layouts/page',$this->data); 

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

    public function do_payment(){ 
    	$order_id = $this->input->post("order_id");
    	$data = array();
    	$location_path = "./uploads/bayar/";
		$uploaded      = uploadFile('file', $location_path,"BUKTI_".$order_id);
		date_default_timezone_set("Asia/Jakarta");
	    if($uploaded['status']==1){
	    	$data['file_bayar'] = str_replace(' ', '_', $uploaded['message']);
	    	$data['status_bayar'] = 1;
		    $data['tanggal_bayar'] = date("Y-m-d H:i:s");

			$this->load->model("orders_model");

			$update = $this->orders_model->update($data,array("id"=>$order_id));
 			
      		$this->session->set_flashdata('message', "Pengajuan Berhasil");
 			redirect('payment/'.$order_id);
	    }else{

      		$this->session->set_flashdata('message', "Pengajuan Gagal");
 			redirect('payment/'.$order_id);
	    }

	   
    }
 
 
    
    
}
