<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/User_Controller.php';
class User_news extends User_Controller {

	public function __construct()
	{
		parent::__construct();
		 
	}
	public function index()
	{
		$this->data['content'] = 'user/news/index_v';   

		$this->load->view('user/layouts/page',$this->data); 
    }
	public function detail()
	{
		$this->data['content'] = 'user/news/detail_v';   

		$this->load->view('user/layouts/page',$this->data); 
    }
    
    
}
