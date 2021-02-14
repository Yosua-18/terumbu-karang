<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';

class Products extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct(); 
	 	$this->load->model('products_model');
	}

	public function index()
	{

		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/products/list_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	}

	public function create()
	{  
		$this->form_validation->set_rules('name',"Nama Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('sku',"SKU Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('price',"Harga Harus Diisi", 'trim|required'); 
		 
		if ($this->form_validation->run() === TRUE)
		{ 

			$data = array(
				'name' => $this->input->post('name'), 
				'sku' => $this->input->post('sku'), 
				'price' => $this->input->post('price'), 
				'description' => $this->input->post('description')
			); 

			$photo         = $this->input->post('photo');
			$location_path = "./uploads/products/";
		    if(!is_dir($location_path))
		    {
		        mkdir($location_path);
		    }
		    $uploaded      = uploadFile("photo ".$photo, $location_path,$this->input->post('name')); 
		    if($uploaded['status']==1){
		    	$data['photo'] = str_replace(' ', '_', $uploaded['message']);
		    }

			
			if ($this->products_model->insert($data))
			{ 
				$this->session->set_flashdata('message', "Produk Baru Berhasil Disimpan");
				redirect("products");
			}
			else
			{
				$this->session->set_flashdata('message_error',"Produk Baru Gagal Disimpan");
				redirect("products");
			}
		}else{    
			$this->data['content'] = 'admin/products/create_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}
	} 

	public function edit($id)
	{  
		$this->form_validation->set_rules('name', "Nama Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('sku', "SKU Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('price', "Harga Harus Diisi", 'trim|required');

		if ($this->form_validation->run() === TRUE)
		{
			$data = array(
				'name' => $this->input->post('name'), 
				'sku' => $this->input->post('sku'), 
				'price' => $this->input->post('price'), 
				'description' => $this->input->post('description')
			);

			$photo         = $this->input->post('photo');
			$location_path = "./uploads/products/";
		    if(!is_dir($location_path))
		    {
		        mkdir($location_path);
		    }
		    $uploaded      = uploadFile("photo".$photo, $location_path,$this->input->post('name'));
		    if($uploaded['status']==1){
		    	$data['photo'] = str_replace(' ', '_', $uploaded['message']);
		    }

			$update = $this->products_model->update($data,array("products.id"=>$id));
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Produk Berhasil Diubah");
				redirect("products","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Produk Gagal Diubah");
				redirect("products","refresh");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("products/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$products = $this->products_model->getAllById(array("products.id"=>$this->data['id']));  
				$this->data['name'] =   (!empty($products))?$products[0]->name:"";
				$this->data['sku'] =   (!empty($products))?$products[0]->sku:"";
				$this->data['price'] =   (!empty($products))?$products[0]->price:"";
				$this->data['description'] =   (!empty($products))?$products[0]->description:""; 
				$this->data['content'] = 'admin/products/edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 

	public function dataList()
	{

		 $columns = array( 
            0 =>'id',  
            1 =>'name', 
            2 =>'sku', 
            3 =>'price', 
            4=> 'description',
            5=> ''
        );

		
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->products_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        

        if(!empty($this->input->post('search')['value'])){
        	$search_value = $this->input->post('search')['value'];
           	$search = array(
           		"roles.name"=>$search_value,
           		"roles.description"=>$search_value
           	); 
           	$totalFiltered = $this->products_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->products_model->getAllBy($limit,$start,$search,$order,$dir);
     	
        $new_data = array();
        if(!empty($datas))
        {
        	 
            foreach ($datas as $key=>$data)
            {  

            	$edit_url = "";
     			$delete_url = "";
     		
            	if($this->data['is_can_edit'] && $data->is_deleted == 0){
            		$edit_url = "<a href='".base_url()."products/edit/".$data->id."' class='btn btn-sm btn-info white'><i class='fa fa-pencil'></i> Edit</a>";
            	}  
            	if($this->data['is_can_delete']){
	            	if($data->is_deleted == 0) {
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."products/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm btn-danger white delete' ><i class='fa fa-trash'></i> Non Active
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."products/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm btn-warning white delete' 
	        				 > Active
	        				</a>";
	        		} 
        		}
            	
                $nestedData['id'] = $start+$key+1; 
                $nestedData['name'] = $data->name; 
                $nestedData['sku'] = $data->sku; 
                $nestedData['price'] = "Rp. ".number_format($data->price); 
                
				if(empty($data->photo)){
                	$nestedData['photo'] = ''; 	
                }else{
                	$photo = explode(".", $data->photo);
                	$nestedData['photo'] = "<img width='40px' src=".base_url()."uploads/products/".$data->photo.">"; 
                }
                $nestedData['description'] = substr(strip_tags($data->description),0,50);
           		$nestedData['action'] = $edit_url." ".$delete_url;   
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
 

	public function destroy(){
		$response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();   

		$id =$this->uri->segment(3);
		$is_deleted = $this->uri->segment(4);
 		if(!empty($id)){
 			$this->load->model("products_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			); 
			$update = $this->products_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
}
