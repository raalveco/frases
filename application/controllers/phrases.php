<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phrases extends CI_Controller {

	public function index(){
		$this->load->model('Phrase');
		
		$data["phrases"] = $this->Phrase->report("id > 0");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/phrases/report',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function visits($phrase_id){
		$this->load->model("Visit");
		
		$data["visits"] = $this->Visit->report("phrase_id = $phrase_id");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/phrases/visits',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function tags($phrase_id){
		$this->load->model("PhraseTag");
		
		$data["tags"] = $this->PhraseTag->report("phrase_id = $phrase_id");
	
		$this->load->view('templates/admin_header');
		$this->load->view('admin/phrases/tags',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function posts($phrase_id){
		$this->load->model("Post");
		
		$data["posts"] = $this->Post->report("phrase_id = $phrase_id");
	
		$this->load->view('templates/admin_header');
		$this->load->view('admin/phrases/posts',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function categories($phrase_id){
		$this->load->model("PhraseCategory");
		
		$data["categories"] = $this->PhraseCategory->report("phrase_id = $phrase_id");
	
		$this->load->view('templates/admin_header');
		$this->load->view('admin/phrases/categories',$data);
		$this->load->view('templates/admin_footer');
	}
}
?>