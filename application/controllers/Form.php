<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Form extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
        $this->load->model('Form_model');
	}
	public function index()
	{
		$this->load->helper('url');
		if($this->data['is_can_read']){
			$this->data['content'] = 'admin/form/list_v';
		}else{
			$this->data['content'] = 'errors/html/restrict';
		}

		$this->load->view('admin/layouts/page',$this->data);
	}


	public function create()
	{
		$this->form_validation->set_rules('value_text_input',"Input", 'trim|required');
		$this->form_validation->set_rules('value_textarea',"Textarea", 'trim|required');
		$this->form_validation->set_rules('value_dropdown',"Dropdown", 'trim|required');
        $this->form_validation->set_rules('user_id',"User Id", 'trim|required');
        $this->form_validation->set_rules('value_currency',"Harga", 'trim|required');
        $this->form_validation->set_rules('value_datepicker',"Tanggal", 'trim|required');
        $this->form_validation->set_rules('value_datetimepicker',"Timestamp", 'trim|required');

		if ($this->form_validation->run() === TRUE)
		{

            $data = [
                'value_text_input' => $this->input->post('value_text_input'),
                'value_textarea' => $this->input->post('value_textarea'),
                'value_tinymce' => $this->input->post('value_tinymce'),
                'value_dropdown' => $this->input->post('value_dropdown'),
                'value_checkbox' => ($this->input->post('value_checkbox')) ? $this->input->post('value_checkbox') : NULL,
                'value_radio' => $this->input->post('value_radio'),
                'user_id' => $this->input->post('user_id'),
                'value_currency' => $this->input->post('value_currency'),
                'value_datepicker' => $this->input->post('value_datepicker'),
                'value_datetimepicker' => $this->input->post('value_datetimepicker'),
            ];

            // untuk upload file
            $error_upload = "";
            if ($_FILES['nama_file']['name'])
            {
                $location_path = "./assets/images/profile/";
                if(!is_dir($location_path))
    		    {
    		        mkdir($location_path);
    		    }

                $config['upload_path']          = $location_path;
                $config['allowed_types']        = 'gif|jpg|png';
                // $config['max_size']             = 100;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;
                $config['file_name'] = "upload_".time();

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('nama_file'))
                {
                        $error_upload = ", Upload error : ";
                        $error_upload .= $this->upload->display_errors();
                        //die($error_upload);
                }
                else
                {
                        $data_upload = $this->upload->data();

                        $data['nama_file'] = $data_upload['file_name'];
                }
            }

			$insert = $this->Form_model->insert($data);
			if ($insert)
			{
				$this->session->set_flashdata('message', "data Baru Berhasil Disimpan " . $error_upload);
				redirect("form");
			}
			else
			{
				$this->session->set_flashdata('message_error',"data Baru gagal Disimpan " . $error_upload);
				redirect("form");
			}
		}else{

		 	$this->data['user'] = $this->user_model->getAllById();
			$this->data['content'] = 'admin/form/create_v';
			$this->load->view('admin/layouts/page',$this->data);
		}
	}

	public function edit($id)
	{
        $this->form_validation->set_rules('value_text_input',"Input", 'trim|required');
		$this->form_validation->set_rules('value_textarea',"Textarea", 'trim|required');
		$this->form_validation->set_rules('value_dropdown',"Dropdown", 'trim|required');
        $this->form_validation->set_rules('user_id',"User Id", 'trim|required');
        $this->form_validation->set_rules('value_currency',"Harga", 'trim|required');
        $this->form_validation->set_rules('value_datepicker',"Tanggal", 'trim|required');
        $this->form_validation->set_rules('value_datetimepicker',"Timestamp", 'trim|required');

		if ($this->form_validation->run() === TRUE)
		{
            $data = [
                'value_text_input' => $this->input->post('value_text_input'),
                'value_textarea' => $this->input->post('value_textarea'),
                'value_tinymce' => $this->input->post('value_tinymce'),
                'value_dropdown' => $this->input->post('value_dropdown'),
                'value_checkbox' => ($this->input->post('value_checkbox')) ? $this->input->post('value_checkbox') : NULL,
                'value_radio' => $this->input->post('value_radio'),
                'user_id' => $this->input->post('user_id'),
                'value_currency' => $this->input->post('value_currency'),
                'value_datepicker' => $this->input->post('value_datepicker'),
                'value_datetimepicker' => $this->input->post('value_datetimepicker'),
            ];

            // untuk upload file
            $error_upload = "";
            if ($_FILES['nama_file']['name'])
            {
                $location_path = "./assets/images/profile/";
                if(!is_dir($location_path))
    		    {
    		        mkdir($location_path);
    		    }

                $config['upload_path']          = $location_path;
                $config['allowed_types']        = 'gif|jpg|png';
                // $config['max_size']             = 100;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;
                $config['file_name'] = "upload_".time();

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('nama_file'))
                {
                        $error_upload = ", Upload error : ";
                        $error_upload .= $this->upload->display_errors();
                        //die($error_upload);
                }
                else
                {
                        $data_upload = $this->upload->data();

                        $data['nama_file'] = $data_upload['file_name'];
                }
            }

			$id = $this->input->post('id');
			$update = $this->Form_model->update($data, ['id' => $id]);
			if ($update)
			{
				$this->session->set_flashdata('message', "data berhasil Diubah");
				redirect("form","refresh");
			}else{
				$this->session->set_flashdata('message_error', "data gagal Diubah");
				redirect("form","refresh");
			}
		}
		else
		{
			if(!empty($_POST)){
				$id = $this->input->post('id');
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("form/edit/".$id);
			}else{
				$this->data['id']= $id;
                $data = $this->Form_model->getOneBy(['form.id' => $id]);
                if ($data === FALSE)
                {
                    redirect('form');
                }
                $this->data['data'] = $data;
                $this->data['user'] = $this->user_model->getAllById();
				$this->data['content'] = 'admin/form/edit_v';
				$this->load->view('admin/layouts/page',$this->data);
			}
		}

	}

	public function dataList()
	{
		$columns = array(
            0 =>'form.id',
      		1 =>'form.value_text_input',
            2 =>'form.value_textarea',
            3 =>'form.value_dropdown',
            4 => 'form.value_datepicker',
            5 => 'users.first_name',
            6 => 'action'
        );
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$where= array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->Form_model->getCountAllBy($limit,$start,$search,$order,$dir,$where);

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;

        if ($searchColumn[1]['search']['value'])
        {
            $search_value = json_decode($searchColumn[1]['search']['value']);

            if($search_value->value_text_input != '')
            {
                $isSearchColumn = true;
                $search['form.value_text_input'] = $search_value->value_text_input;
            }

            if($search_value->value_textarea != '')
            {
                $isSearchColumn = true;
                $search['form.value_textarea'] = $search_value->value_textarea;
            }

            if($search_value->value_dropdown != '')
            {
                $isSearchColumn = true;
                $search['form.value_dropdown'] = $search_value->value_dropdown;
            }

            if($search_value->value_tinymce != '')
            {
                $isSearchColumn = true;
                $search['form.value_tinymce'] = $search_value->value_tinymce;
            }

            if($search_value->user_name != '')
            {
                $isSearchColumn = true;
                $search['users.first_name'] = $search_value->user_name;
            }

            if($search_value->jenis_kelamin != '')
            {
                $isSearchColumn = true;
                $where['form.value_radio'] = $search_value->jenis_kelamin;
            }
        }

    	if($isSearchColumn){
			$totalFiltered = $this->Form_model->getCountAllBy($limit,$start,$search,$order,$dir,$where);
        }else{
        	$totalFiltered = $totalData;
        }

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
		$datas = $this->Form_model->getAllBy($limit,$start,$search,$order,$dir,$where);

        $new_data = array();
        if(!empty($datas))
        {
            foreach ($datas as $key=>$data)
            {

            	$edit_url = "";
     			$delete_url = "";

            	if($this->data['is_can_edit'] && $data->is_deleted == 0){
            		$edit_url = "<a href='".base_url()."form/edit/".$data->id."' class='btn btn-sm btn-info'><i class='fa fa-pencil'></i> Ubah</a>";
            	}
            	if($this->data['is_can_delete']){
	            	if($data->is_deleted == 0){
	        			$delete_url = "<a href='#'
	        				url='".base_url()."form/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm btn-danger delete' >NonAktifkan
	        				</a>";
	        		}else{
	        			$delete_url = "<a href='#'
	        				url='".base_url()."form/destroy/".$data->id."/".$data->is_deleted."'
	        				class='btn btn-sm btn-danger delete'
	        				 >Aktifkan
	        				</a>";
	        		}
        		}

                $pdf_url = "";
                if ($data->is_deleted == 0)
                {
                    $pdf_url = '<a href="' . base_url() . 'form/pdf/' . $data->id . '" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> Pdf</a>';
                }

                $nestedData['id'] = $start+$key+1;
                $nestedData['value_text_input'] = $data->value_text_input;
                $nestedData['value_textarea'] = $data->value_textarea;
                $nestedData['value_dropdown'] = $data->value_dropdown;
                $nestedData['value_datepicker'] = $data->value_datepicker;
                $nestedData['users_name'] = $data->users_name;

           		$nestedData['action'] = $edit_url." ".$delete_url . " " . $pdf_url;
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

			$data = array(
				'is_deleted' => ($is_deleted == 1)?0:1
			);
			$update = $this->Form_model->update($data,array("id"=>$id));

        	$response_data['data'] = $data;
         	$response_data['status'] = true;
 		}else{
 		 	$response_data['msg'] = "ID Harus Diisi";
 		}

        echo json_encode($response_data);
	}

    public function export_to_excel()
    {
        $where = [];
        $search = [];
        if ($this->input->get('value_text_input'))
        {
            $value = $this->input->get('value_text_input');
            $search["form.value_text_input"] = $value;
        }

        if ($this->input->get('value_textarea'))
        {
            $value = $this->input->get('value_textarea');
            $search["form.value_textarea"] = $value;
        }

        if ($this->input->get('value_text_input'))
        {
            $value = $this->input->get('value_text_input');
            $search["form.value_text_input"] = $value;
        }

        if ($this->input->get('value_dropdown'))
        {
            $value = $this->input->get('value_dropdown');
            $search["form.value_dropdown"] = $value;
        }

        if ($this->input->get('user_name'))
        {
            $value = $this->input->get('user_name');
            $search["users.first_name"] = $value;
        }

        if ($this->input->get('jenis_kelamin'))
        {
            $value = $this->input->get('jenis_kelamin');
            $where["form.value_radio"] = $value;
        }

        $datas = $this->Form_model->getAllBy(0,0,$search,NULL,NULL,$where);
        //die($this->db->last_query());
        $data['data'] = $datas;
        $this->load->view('admin/form/export_to_excel_v', $data);
    }

    public function pdf($id)
    {
        $datas = $this->Form_model->getOneBy(['form.id' => $id]);
        if ($datas === FALSE)
        {
            redirect('form');
        }
        $data['data'] = $datas;
        $html = $this->load->view('admin/form/pdf_v', $data, TRUE);
        $mpdf = new \Mpdf\Mpdf;
        $mpdf->writeHtml($html);
        $mpdf->output('file_pdf.pdf', "I");
    }

    public function ajax_form()
    {
        $this->data['content'] = 'admin/form/ajax_form_v';
        $this->load->view('admin/layouts/page',$this->data);
    }

    public function ajax_post()
    {
        $data = [
            'value_text_input' => $this->input->post('value_text_input'),
            'value_textarea' => $this->input->post('value_textarea')
        ];

        $insert = $this->Form_model->insert($data);
        $ret['status'] = $insert === FALSE ? FALSE : TRUE;
        echo json_encode($ret);
    }
}
