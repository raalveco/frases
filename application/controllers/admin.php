<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index(){
		$this->load->model('Category');
		
		$category = $this->Category->fetch(2);
		
		print_r($category);
	}
}
?>