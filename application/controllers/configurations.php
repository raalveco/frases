<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configurations extends CI_Controller {

	public function index(){
		$this->load->model('Configuration');
		
		$data["configurations"] = $this->Configuration->report("id > 0");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/configurations/report',$data);
		$this->load->view('templates/admin_footer');
	}
}
?>