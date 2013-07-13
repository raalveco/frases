<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function index(){
		$this->load->model('Page');
		
		$data["pages"] = $this->Page->report("id > 0");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/pages/report',$data);
		$this->load->view('templates/admin_footer');
	}
}
?>