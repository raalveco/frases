<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fonts extends CI_Controller {

	public function index(){
		$this->load->model('Font');
		
		$data["fonts"] = $this->Font->report("id > 0","name ASC");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/fonts',$data);
		$this->load->view('templates/admin_footer');
	}
}
?>