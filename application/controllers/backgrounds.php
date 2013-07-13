<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backgrounds extends CI_Controller {

	public function index(){
		$this->load->model('Background');
		
		$data["backgrounds"] = $this->Background->report("id > 0");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/backgrounds/report',$data);
		$this->load->view('templates/admin_footer');
	}
}
?>