<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function index(){
		$this->load->model('Category');
		
		$data["categories"] = $this->Category->report("id > 0","name ASC");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/categories',$data);
		$this->load->view('templates/admin_footer');
	}
}
?>