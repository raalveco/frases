<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends CI_Controller {

	public function index(){
		$this->load->model('Tag');
		
		$data["tags"] = $this->Tag->report("id > 0");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/tags/report',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function phrases($tag_id){
		$this->load->model('PhraseTag');
		
		$data["phrases"] = $this->PhraseTag->report("tag_id = $tag_id");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/tags/phrases',$data);
		$this->load->view('templates/admin_footer');
	}
}
?>