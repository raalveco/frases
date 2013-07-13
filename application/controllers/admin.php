<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index(){
		$this->load->view('templates/admin_header');
		$this->load->view('admin/phrases');
		$this->load->view('templates/admin_footer');
	}

	public function categories()
	{
		$this->load->model('Category');
		
		$data["categories"] = $this->Category->last_entries(30);

		$this->load->view('templates/admin_header');
		$this->load->view('admin/categories',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function fonts()
	{
		$this->load->model('Font');
		
		$data["fonts"] = $this->Font->last_entries(30);

		$this->load->view('templates/admin_header');
		$this->load->view('admin/fonts',$data);
		$this->load->view('templates/admin_footer');
	}
}
?>