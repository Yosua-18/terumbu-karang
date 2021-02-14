<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';

class Order extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct(); 
	 	$this->load->model('orders_model');
	}

	public function index()
	{

		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/orders/list_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	}
  public function detail()
  {
 
    if($this->data['is_can_read']){
      $this->data['content'] = 'admin/orders/detail_v';   
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }

     $order_id = $this->uri->segment(3); 
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
    
    $this->load->view('admin/layouts/page',$this->data);  
  }

 
  public function bayar()
  {

    $this->load->helper('url');
    if($this->data['is_can_read']){
      $this->data['content'] = 'admin/orders/bayar_v';   
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }

    
    $order_id = $this->uri->segment(3); 
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

    
    $this->load->view('admin/layouts/page',$this->data);  
  }
  public function proses_bayar(){
    $order_id = $this->input->post('order_id');
    $status_bayar = $this->input->post('status_bayar');
    $tanggal_bayar = $this->input->post('tanggal_bayar');

    $data = array( 
      'status_bayar' => $status_bayar,
      'tanggal_bayar' => $tanggal_bayar,
    ); 
    $update = $this->orders_model->update($data,array("orders.id"=>$order_id));
    if ($update)
    { 
      $this->session->set_flashdata('message', " Berhasil ");
      redirect("order","refresh");
    }else{
      $this->session->set_flashdata('message_error', " Gagal Diubah");
      redirect("order","refresh");
      }
  }
 

	public function dataList()
	{

		$columns = array( 
            0 =>'id',  
            1 =>'name', 
            2=> 'description',
            3=> ''
        );

		
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->orders_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        

        if(!empty($this->input->post('search')['value'])){
        	$search_value = $this->input->post('search')['value'];
           	$search = array(
           		"roles.name"=>$search_value,
           		"roles.description"=>$search_value
           	); 
           	$totalFiltered = $this->orders_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->orders_model->getAllBy($limit,$start,$search,$order,$dir);
     	
        $new_data = array();
        if(!empty($datas))
        {
        	 
            foreach ($datas as $key=>$data)
            {  

             
     		     $detail_url = "<a href='".base_url()."order/detail/".$data->id."' class='btn btn-sm btn-info white'><i class='fa fa-clock'></i> Detail</a>"; 
              
              if($data->status_bayar == 0){
                  $bayar_url = "<a href='".base_url()."order/bayar/".$data->id."' class='btn btn-sm btn-warning white'><i class='fa fa-clock'></i> Proses</a>"; 
              }else{
                $bayar_url = "";
              }
                
            	
                $nestedData['id'] = $start+$key+1; 
                $nestedData['order_number'] = $data->order_number; 
                $nestedData['first_name'] = $data->first_name; 
                $nestedData['location_name'] = $data->location_name; 
                $nestedData['status_order'] = $data->status_order;   
                 if($data->status_order == 1){ 
                  $nestedData['status_order'] = "Pengajuan Berhasil";   
                } else{
                  $nestedData['status_order'] = "Pengajuan Sedang Proses";   

                }
                $nestedData['tanggal_order'] = $data->tanggal_order;  
                if($data->status_bayar == 1){ 
                  $nestedData['status_bayar'] = "Terkonfirmasi";   
                } else{
                  $nestedData['status_bayar'] = "Belum di Konfirmasi";   

                }
                $nestedData['tanggal_bayar'] = $data->tanggal_bayar;   
           		 $nestedData['action'] = $detail_url." ".$bayar_url;   
                $new_data[] = $nestedData; 
            }
        }
          
        $json_data = array(
                    "draw"            => intval($this->input->post('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $new_data   
                    );
            
        echo json_encode($json_data); 
	} 
}
