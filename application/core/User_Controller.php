<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Controller extends CI_Controller {
 	public function __construct()
	{
		parent::__construct();
		$this->data = array();          
		$this->data['users'] = array();
		if ($this->ion_auth->logged_in())
		{
			 
			$this->data['users']= $this->ion_auth->user()->row();
			$this->data['users_groups']=   $this->ion_auth->get_users_groups($this->data['users']->id)->row();
		}  
		$this->load->library('cart');
		$this->data['carts'] = $this->cart->contents(); 
		$this->data['total_items'] = $this->cart->total_items(); 
		$this->data['cart_total'] = $this->cart->total(); 
		$this->data['location_id'] = $this->session->userdata('location_id');  

		$path_url = $this->uri->segment(1) ; 
		$this->data['is_superadmin'] = false;
		if ($this->ion_auth->in_group(1))
		{
			$this->data['is_superadmin'] = true;
		}
		$this->data['path_url'] = $path_url;
	}  
}
