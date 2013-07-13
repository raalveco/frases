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
	
	public function posts($user_id){
		$this->load->model('Post');
		
		$data["posts"] = $this->Post->report("user_id = $user_id");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/users/posts',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function phrases($user_id){
		$this->load->model('UserPhrase');
		
		$data["phrases"] = $this->UserPhrase->report("user_id = $user_id");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/users/phrases',$data);
		$this->load->view('templates/admin_footer');
	}
}
?>