<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function categories()
	{
		$this->load->view('templates/admin_header');
		$this->load->view('admin/categories');
		$this->load->view('templates/admin_footer');
	}
}
?>