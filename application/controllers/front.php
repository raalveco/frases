<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends CI_Controller {

	public function index()
	{
		$this->load->view('templates/front_header');
		$this->load->view('front/index');
		$this->load->view('templates/front_footer');
	}
}
?>