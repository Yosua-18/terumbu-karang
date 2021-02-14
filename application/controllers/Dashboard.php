<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Dashboard extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct();
		 
	}
	public function index()
	{
		$this->load->helper('url');
		$this->data['content'] = 'admin/dashboard';   

	 	$this->load->model("orders_model");
	 	$this->load->model("user_model");

	 	$data_order = $this->orders_model->getAllById();
	 	$this->data['total_order'] = @count($data_order);
	 	$data_user = $this->user_model->getAllById();
	 	$this->data['total_user'] = @count($data_user);

		$this->load->view('admin/layouts/page',$this->data); 
	} 
}
