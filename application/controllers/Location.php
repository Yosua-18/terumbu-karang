<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Location extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct(); 
	 	$this->load->model('location_model');
	}

	public function index()
	{

		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/location/list_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	}

	public function create()
	{  
		$this->form_validation->set_rules('name',"Nama Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('lat',"Latitude Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('long',"Longitude Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('luas',"Luas wilayah Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('kerusakan',"Kerusakan Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('description',"description Harus Diisi", 'trim|required');
		if ($this->form_validation->run() === TRUE)
		{ 
			$data = array(
				'name' => $this->input->post('name'), 
				'lat' => $this->input->post('lat'), 
				'long' => $this->input->post('long'), 
				'luas' => $this->input->post('luas'), 
				'kerusakan' => $this->input->post('kerusakan'), 
				'description' => $this->input->post('description')
			); 
			if ($this->location_model->insert($data))
			{ 
				$this->session->set_flashdata('message', "Location Baru Berhasil Disimpan");
				redirect("location");
			}
			else
			{
				$this->session->set_flashdata('message_error',"Location Baru Gagal Disimpan");
				redirect("location");
			}
		}else{    
			$this->data['content'] = 'admin/location/create_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}
	} 

	public function edit($id)
	{  
		$this->form_validation->set_rules('name',"Nama Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('lat',"Latitude Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('long',"Longitude Harus Diisi", 'trim|required');
		$this->form_validation->set_rules('luas',"Luas wilayah Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('kerusakan',"Kerusakan Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('description',"description Harus Diisi", 'trim|required');
		if ($this->form_validation->run() === TRUE)
		{ 
			$data = array(
				'name' => $this->input->post('name'), 
				'lat' => $this->input->post('lat'), 
				'long' => $this->input->post('long'), 
				'luas' => $this->input->post('luas'), 
				'kerusakan' => $this->input->post('kerusakan'), 
				'description' => $this->input->post('description')
			); 
			$update = $this->location_model->update($data,array("location.id"=>$id));
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Location Berhasil Diubah");
				redirect("location","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Location Gagal Diubah");
				redirect("location","refresh");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("location/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$location = $this->location_model->getAllById(array("location.id"=>$this->data['id']));  
				$this->data['name'] =   (!empty($location))?$location[0]->name:"";
				$this->data['lat'] =   (!empty($location))?$location[0]->lat:"";
				$this->data['long'] =   (!empty($location))?$location[0]->long:"";
				$this->data['luas'] =   (!empty($location))?$location[0]->luas:"";
				$this->data['kerusakan'] =   (!empty($location))?$location[0]->kerusakan:"";
				$this->data['description'] =   (!empty($location))?$location[0]->description:""; 
				
				$this->data['content'] = 'admin/location/edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
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
        $totalData = $this->location_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        

        if(!empty($this->input->post('search')['value'])){
        	$search_value = $this->input->post('search')['value'];
           	$search = array(
           		"roles.name"=>$search_value,
           		"roles.description"=>$search_value
           	); 
           	$totalFiltered = $this->location_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->location_model->getAllBy($limit,$start,$search,$order,$dir);
     	
        $new_data = array();
        if(!empty($datas))
        {
        	 
            foreach ($datas as $key=>$data)
            {  

            	$edit_url = "";
     			$delete_url = "";
     		
            	if($this->data['is_can_edit'] && $data->is_deleted == 0){
            		$edit_url = "<a href='".base_url()."location/edit/".$data->id."' class='btn btn-sm btn-info white'><i class='fa fa-pencil'></i> Edit</a>";
            	}  
            	if($this->data['is_can_delete']){
	            	if($data->is_deleted == 0) {
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."location/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm btn-danger white delete' ><i class='fa fa-trash'></i> Non Active
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."location/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm btn-warning white delete' 
	        				 > Active
	        				</a>";
	        		} 
        		}
            	
                $nestedData['id'] = $start+$key+1; 
                $nestedData['name'] = $data->name; 
                $nestedData['lat'] = $data->lat; 
				$nestedData['long'] = $data->long;
				$nestedData['luas'] = $data->luas; 
                $nestedData['kerusakan'] = $data->kerusakan;  
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
 			$this->load->model("location_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			); 
			$update = $this->location_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
}
