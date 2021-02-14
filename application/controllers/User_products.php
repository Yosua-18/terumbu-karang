<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/User_Controller.php';
class User_products extends User_Controller {

	public function __construct()
	{
		parent::__construct();
		 
	}
	public function index()
	{
		$this->load->model("products_model");
		$this->data['content'] = 'user/products/index_v';   
		$this->data['data_products'] = $this->products_model->getAllById(); 
		$this->load->view('user/layouts/page',$this->data); 
    }
    
    
}
