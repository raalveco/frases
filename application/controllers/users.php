<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index(){
		$this->load->model('User');
		
		$data["users"] = $this->User->report("id > 0");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/users/report',$data);
		$this->load->view('templates/admin_footer');
	}
}
?>