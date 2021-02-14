<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Penjadwalan extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct(); 
	 	$this->load->model('penjadwalan_model');
	}

	public function index()
	{

		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/penjadwalan/list_v'; 	
		}else{
			$this->data['content'] = 'errors/html/restrict'; 
		}
		
		$this->load->view('admin/layouts/page',$this->data);  
	}
	public function export()
     {
		$semua_jadwal = $this->penjadwalan_model->getAll()->result();

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A1', 'No')
					->setCellValue('B1', 'List Number')
					->setCellValue('C1', 'Tanggal Pengiriman')
					->setCellValue('D1', 'Tanggal Penanaman');

		$kolom = 2;
		$nomor = 1;
		foreach($semua_jadwal as $jadwal) {

			$spreadsheet->setActiveSheetIndex(0)
						->setCellValue('A' . $kolom, $nomor)
						->setCellValue('B' . $kolom, $jadwal->no_penjadwalan)
						// ->setCellValue('C' . $kolom, $jadwal->jadwal_pengiriman)
						->setCellValue('C' . $kolom, date('j F Y', strtotime($jadwal->jadwal_pengiriman)))
						->setCellValue('D' . $kolom, date('j F Y', strtotime($jadwal->jadwal_penanaman)));

			$kolom++;
			$nomor++;

		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.time().'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
     }

	public function create()
	{  
		$this->form_validation->set_rules('no_penjadwalan',"No Penjadwalan Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('jadwal_pengiriman',"Jadwal Pengiriman Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('jadwal_penanaman',"Jadwal Penanaman Harus Diisi", 'trim|required'); 
		 
		if ($this->form_validation->run() === TRUE)
		{ 
			$data = array(
				'no_penjadwalan' => $this->input->post('no_penjadwalan'), 
				'jadwal_pengiriman' => $this->input->post('jadwal_pengiriman'), 
				'jadwal_penanaman' => $this->input->post('jadwal_penanaman')
			); 
			if ($this->penjadwalan_model->insert($data))
			{ 
				$this->session->set_flashdata('message', "Penjadwalan Baru Berhasil Disimpan");
				redirect("penjadwalan");
			}
			else
			{
				$this->session->set_flashdata('message_error',"Penjadwalan Baru Gagal Disimpan");
				redirect("penjadwalan");
			}
		}else{    
			$this->data['content'] = 'admin/penjadwalan/create_v'; 
			$this->load->view('admin/layouts/page',$this->data); 
		}
	} 

	public function edit($id)
	{  
		$this->form_validation->set_rules('no_penjadwalan',"No Penjadwalan Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('jadwal_pengiriman',"Jadwal Pengiriman Harus Diisi", 'trim|required'); 
		$this->form_validation->set_rules('jadwal_penanaman',"Jadwal Penanaman Harus Diisi", 'trim|required'); 

		if ($this->form_validation->run() === TRUE)
		{
			$data = array(
				'no_penjadwalan' => $this->input->post('no_penjadwalan'), 
				'jadwal_pengiriman' => $this->input->post('jadwal_pengiriman'), 
				'jadwal_penanaman' => $this->input->post('jadwal_penanaman')
			);
			$update = $this->penjadwalan_model->update($data,array("penjadwalan.id"=>$id));
			if ($update)
			{ 
				$this->session->set_flashdata('message', "Berita Berhasil Diubah");
				redirect("penjadwalan","refresh");
			}else{
				$this->session->set_flashdata('message_error', "Berita Gagal Diubah");
				redirect("penjadwalan","refresh");
			}
		} 
		else
		{
			if(!empty($_POST)){ 
				$id = $this->input->post('id'); 
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("penjadwalan/edit/".$id);	
			}else{
				$this->data['id']= $this->uri->segment(3);
				$penjadwalan = $this->penjadwalan_model->getAllById(array("penjadwalan.id"=>$this->data['id']));  
				$this->data['no_penjadwalan'] =   (!empty($penjadwalan))?$penjadwalan[0]->no_penjadwalan:"";
				$this->data['jadwal_pengiriman'] =   (!empty($penjadwalan))?$penjadwalan[0]->jadwal_pengiriman:""; 
				$this->data['jadwal_penanaman'] =   (!empty($penjadwalan))?$penjadwalan[0]->jadwal_penanaman:""; 
				
				$this->data['content'] = 'admin/penjadwalan/edit_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
		
	} 

	public function dataList()
	{

		 $columns = array( 
            0 =>'id',  
            1 =>'no_penjadwalan', 
            2=> 'jadwal_pengiriman',
            3=> 'jadwal_penanaman',
            4=> ''
        );

		
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->penjadwalan_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        

        if(!empty($this->input->post('search')['value'])){
        	$search_value = $this->input->post('search')['value'];
           	$search = array(
           		"penjadwalan.no_penjadwalan"=>$search_value
           		// "news.description"=>$search_value
           	); 
           	$totalFiltered = $this->penjadwalan_model->getCountAllBy($limit,$start,$search,$order,$dir); 
        }else{
        	$totalFiltered = $totalData;
        } 
       
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
     	$datas = $this->penjadwalan_model->getAllBy($limit,$start,$search,$order,$dir);
     	
        $new_data = array();
        if(!empty($datas))
        {
        	 
            foreach ($datas as $key=>$data)
            {  

            	$edit_url = "";
     			$delete_url = "";
     		
            	if($this->data['is_can_edit'] && $data->is_deleted == 0){
            		$edit_url = "<a href='".base_url()."penjadwalan/edit/".$data->id."' class='btn btn-sm btn-info white'><i class='fa fa-pencil'></i> Edit</a>";
            	}  
            	if($this->data['is_can_delete']){
	            	if($data->is_deleted == 0) {
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."penjadwalan/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm btn-danger white delete' ><i class='fa fa-trash'></i> Delete
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#' 
	        				url='".base_url()."penjadwalan/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm btn-warning white delete' 
	        				 > Undo Delete
	        				</a>";
	        		} 
        		}
            	
                $nestedData['id'] = $data->id; 
                $nestedData['no_penjadwalan'] = $data->no_penjadwalan; 
                $nestedData['jadwal_pengiriman'] = $data->jadwal_pengiriman; 
                $nestedData['jadwal_penanaman'] = $data->jadwal_penanaman;
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
 			$this->load->model("penjadwalan_model");
			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			); 
			$update = $this->penjadwalan_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data; 
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}
		
        echo json_encode($response_data); 
	}
}
